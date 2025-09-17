<meta name="description" content="<?php echo the_field('meta_description'); ?>">
<meta name="title" content="<?php echo the_field('meta_title'); ?>">

<meta property="og:title" content="<?php echo get_the_title(); ?>" />
<meta property="og:description" content="<?php echo get_the_excerpt($post->ID); ?>" />
<meta property="og:image" content="<?php echo wp_get_attachment_url(get_post_thumbnail_id(), 'full');?>" />
<meta property="og:url" content="<?php echo get_permalink( get_queried_object_id() ); ?>" />
<meta property="og:type" content="article" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="<?php echo get_the_title(); ?>" />
<meta name="twitter:description" content="<?php echo get_the_excerpt($post->ID); ?>" />
<meta name="twitter:image" content="<?php echo wp_get_attachment_url(get_post_thumbnail_id(), 'full');?>" />

<?php 
    /* Template Name: Escorts Page */

	get_header();

    $title_text_field_1_page = get_field('title_text_field_1_page');
    $text_field_1_page = get_field('text_field_1_page');
    $title_text_field_2_page = get_field('title_text_field_2_page');
    $text_field_2_page = get_field('text_field_2_page');
    
    // 1) Ler o parâmetro da URL como slug seguro
    $selectedLocations = '';
    if (isset($_GET['location']) && $_GET['location'] !== '') {
        // WP recomenda desserializar superglobais antes de sanitizar
        $selectedLocations = sanitize_title( wp_unslash( $_GET['location'] ) ); // vira 'algarve'
    }
?>
    <section class="main">
        <div class="section">
            <?php if (has_post_thumbnail( $post->ID ) ) { ?>
                <div class="section-general-banner slider desktop">
                    <div class="swiper slider-general">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <?php 
                                    $image_id = get_post_thumbnail_id(); // Obtém o ID da imagem destacada
                                    $image = wp_get_attachment_image_src($image_id, array(1400, 933)); // Obtém a URL da imagem com o tamanho específico
                                ?>
                                <div class="banner-image" style="background-image: url('<?php echo $image[0];?>');">
                                    <div class="overlay"></div>
                                    <div class="container">
                                        <div class="banner-text">
                                            <h1><?php echo get_the_title(); ?></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
            <?php if (has_post_thumbnail( $post->ID ) ) : ?>
                <div class="section-general-banner slider mobile">
                    <div class="swiper slider-general">
                        <div class="swiper-wrapper">
                            <?php 
                                $image_id = get_post_thumbnail_id(); // Obtém o ID da imagem destacada
                                $image = wp_get_attachment_image_src($image_id, array(1400, 933)); // Obtém a URL da imagem com o tamanho específico
                            ?>
                            <div class="swiper-slide">
                                <img src="<?php echo $image[0]; ?>" alt="Banner Image">
                                <div class="overlay"></div>
                                <div class="container">
                                    <div class="banner-text">
                                        <h1><?php echo get_the_title(); ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if( !empty($title_text_field_1_page) || !empty($text_field_1_page) ): ?>
                <div class="section-about bg-white pb-0">
                    <div class="title">
                        <div class="container">
                            <h2><?php echo $title_text_field_1_page; ?></h2>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="content">
                                <div class="col-md-12">
                                    <?php echo apply_filters('the_content', $text_field_1_page); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="location-filter">
                <div class="container p-0">
                    <div class="filter-box">
                        <form id="locationFilterForm" method="GET" action="">
                            <label for="locationFilter" class="form-label">
                                <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                    Filtrar por Localização
                                <?php else : ?>
                                    Filter by Location 
                                <?php endif; ?>
                            </label>
                            <?php
                                // Idioma atual
                                $lang = function_exists('pll_current_language') ? pll_current_language('slug') : '';

                                // Busca os termos da taxonomia 'location' no idioma atual
                                $terms = get_terms([
                                    'taxonomy'   => 'location',
                                    'hide_empty' => false,         // coloque true se quiser mostrar só locations com perfis
                                    'orderby'    => 'name',
                                    'order'      => 'ASC',
                                    'lang'       => $lang ?: 'all' // Polylang: traz a tradução certa
                                ]);
                            ?>
                            
                            <select id="locationFilter" class="form-select" name="location" onchange="document.getElementById('locationFilterForm').submit();">
                                <option value="">
                                    <?php echo ($lang === 'pt') ? 'Selecione a cidade' : 'Select location'; ?>
                                </option>

                                <?php if (!is_wp_error($terms) && !empty($terms)): ?>
                                    <?php foreach ($terms as $term): ?>
                                    <option value="<?php echo esc_attr($term->slug); ?>"
                                            <?php selected($selectedLocation, $term->slug); ?>>
                                        <?php echo esc_html($term->description); ?>
                                    </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            <?php
                // 2) Montar o WP_Query
                $args = [
                    'post_type'      => 'profile',
                    'post_status'    => 'publish',
                    'posts_per_page' => -1,
                    'lang'           => function_exists('pll_current_language') ? pll_current_language('slug') : 'all',
                    'meta_query'     => [
                        ['key' => 'photos',      'compare' => 'EXISTS'],
                        ['key' => 'more_fields', 'compare' => 'EXISTS'],
                        ['key' => 'only_member', 'compare' => 'EXISTS'],
                    ],
                ];

                // 3) Adicionar o filtro de taxonomia se veio location
                // Só filtra por taxonomia se houver ao menos um termo
                if (!empty($selectedLocations)) {
                    $args['tax_query'] = [[
                        'taxonomy' => 'location',
                        'field'    => 'slug',
                        'terms'    => $selectedLocations,
                    ]];
                }

                $more = new WP_Query($args);

			    if (!empty($more->posts)) : ?>
                    <div class="section-escorts mob-pt-0">
                        <div class="container">
                            <div class="row row-adjust-escorts">
                                <?php foreach ( $more->posts as $post ): /*echo '<pre>'; var_dump($post); echo '</pre>'*/; 
                                    $photos = get_field( 'photos' );
                                    $member = get_field( 'only_member' );

                                    // Obtém o valor do campo 'more_fields'
                                    $more_fields_posts = get_field('more_fields'); // Use ACF ou get_post_meta(), se necessário

                                    // Inicializa as variáveis para armazenar os valores de 'location', 'nationality' e 'age'
                                    $location_more = '';
                                    $nationality_more = '';
                                    $age_more = '';

                                    if ($more_fields_posts) :
                                        // Loop pelos campos dentro de 'more_fields'
                                        foreach ($more_fields_posts as $field) :
                                            $label_more = $field['label'];
                                            $value_more = $field['value'];
                                            
                                            // Verifica se o valor de $label_more é o que você está buscando (exemplo "Age")
                                            if (strtolower($label_more) == 'age' || strtolower($label_more) == 'idade') {
                                                // Aqui você tem o $label_more e o $value_more quando o label é "Age"
                                                $age_more = $value_more;
                                            }
                                            // Verifica se o valor de $label_more é o que você está buscando (exemplo "location")
                                            if (strtolower($label_more) == 'location' || strtolower($label_more) == 'localização' || strtolower($label_more) == 'localizacao') {
                                                // Aqui você tem o $label_more e o $value_more quando o label é "location"
                                                $location_more = $value_more;
                                            }
                                            // Verifica se o valor de $label_more é o que você está buscando (exemplo "nationality")
                                            if (strtolower($label_more) == 'nationality' || strtolower($label_more) == 'nacionalidade') {
                                                // Aqui você tem o $label_more e o $value_more quando o label é "nationality")
                                                $nationality_more = $value_more;
                                            }
                                        endforeach;
                                    endif;
                                    ?>
                                    <div class="col-6 col-md-3 col-adjust-escorts">
                                        <a href="<?php echo get_permalink($post->ID); ?>" class="escort-box">
                                            <div class="image-container">
                                                <div class="image">
                                                    <?php if ( has_post_thumbnail( $post->ID ) ) : ?>
                                                        <img src="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'full' ) ); ?>" alt="<?php echo esc_attr( get_the_title( $post->ID ) ); ?>">
                                                    <?php else : ?>
                                                        <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder.png" alt="No image available">
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <h2><?php echo get_the_title($post->ID); ?></h2>
                                            <p>
                                                <?php if (!empty($location_more)) : ?>
                                                    <?php echo $location_more; ?>
                                                <?php else : ?>
                                                    <?php echo '-'; ?>
                                                <?php endif; ?>
                                            </p>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php else :
                    if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                        <div class="section-escorts">
                            <div class="container">
                                <div class="row row-adjust-escorts">
                                    <div class="no-results">
                                        <p>Desculpe, nenhum perfil encontrado para a localização selecionada.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="section-escorts">
                            <div class="container">
                                <div class="row row-adjust-escorts">
                                    <div class="no-results">
                                        <p>Sorry, no profiles found for the selected location.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif;
                endif;
                wp_reset_query();
            ?>
            
            <?php if( !empty($title_text_field_2_page) || !empty($text_field_2_page) ): ?>
                <div class="section-about pt-0 bg-white">
                    <div class="title pt-0">
                        <div class="container">
                            <h2><?php echo $title_text_field_2_page; ?></h2>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="content">
                                <div class="col-md-12">
                                    <?php echo apply_filters('the_content', $text_field_2_page); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- FAQ Section -->
            <?php if( have_rows('faq') ): ?>
                <div class="section-faq">
                    <div class="faq-title">
                        <div class="container">
                            <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                <h2>Dúvidas? Nós temos as respostas.</h2>
                            <?php else : ?>
                                <h2>Questions? We have answers.</h2>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="faq">
                        <div class="container">
                            <div class="row m-0">
                                <div class="accordion" id="accordionFAQ">
                                    <?php
                                        while( have_rows('faq') ) : the_row();
                                            $question = get_sub_field('question');
                                            $answer = get_sub_field('answer');
                                    ?>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading<?php echo get_row_index(); ?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo get_row_index(); ?>" aria-expanded="true" aria-controls="collapse<?php echo get_row_index(); ?>">
                                                    <?php echo $question ?>
                                                </button>
                                            </h2>
                                            <div id="collapse<?php echo get_row_index(); ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                                                <div class="accordion-body">
                                                    <?php echo $answer ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php
	get_footer();
?>

<script>
    // Mantém a seleção do filtro após o envio do formulário
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const selectedLocation = urlParams.get('location');
        if (selectedLocation) {
            const locationFilter = document.getElementById('locationFilter');
            if (locationFilter) {
                locationFilter.value = selectedLocation;
            }
        }
    });
</script>