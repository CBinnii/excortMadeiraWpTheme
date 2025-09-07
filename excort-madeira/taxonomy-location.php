<?php 
    $term = get_queried_object();
?>

<title>The Girl Next Door - <?php echo $term->name; ?> Escorts</title>
<meta name="description" content="<?php echo the_field('meta_description', 'location_' . get_queried_object()->term_id); ?>">
<meta name="keywords" content="<?php echo the_field('meta_key', 'location_' . get_queried_object()->term_id); ?>">

<?php 
	get_header();

    $title_text_field_1_page = get_field('title_text_field_1_page', 'location_' . get_queried_object()->term_id);
    $text_field_1_page = get_field('text_field_1_page', 'location_' . get_queried_object()->term_id);
    $title_text_field_2_page = get_field('title_text_field_2_page', 'location_' . get_queried_object()->term_id);
    $text_field_2_page = get_field('text_field_2_page', 'location_' . get_queried_object()->term_id);
?>
    <section class="main">
        <div class="section">
            <?php 
                $featured_image = get_field('featured_image_location', 'location_' . get_queried_object()->term_id); // Obtém o ID da imagem destacada
            ?>
            
            <?php if (!empty( $featured_image ) ) { ?>
                <div class="section-general-banner slider desktop">
                    <div class="swiper slider-general">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="banner-image" style="background-image: url('<?php echo $featured_image['url'];?>');">
                                    <div class="overlay white"></div>
                                    <div class="container">
                                        <div class="banner-text">
                                            <h1><?php echo $term->name; ?></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
            <?php if (!empty( $featured_image ) ) : ?>
                <div class="section-general-banner slider mobile">
                    <div class="swiper slider-general">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="<?php echo $featured_image['url'];?>" alt="Banner Image">
                                <div class="overlay white"></div>
                                <div class="container">
                                    <div class="banner-text">
                                        <h1><?php echo $term->name; ?></h1>
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

            <?php
    
                // Configura a consulta personalizada
                $args = array(
                    'post_type' => 'profile',  // ou o tipo de post que você está usando
                    'status' => 'publish',
                    'showposts' => -1, // ou qualquer número de posts que você quiser
                    'lang' => pll_current_language('slug'), // 'pt' ou 'en' conforme a tela
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'location', // Substitua pela sua taxonomia
                            'field'    => 'slug',
                            'terms'    => $term->slug,
                        ),
                    ),
                    'meta_query' => array(
                        array(
                            'key' => 'photos',
                            'compare' => 'EXISTS',
                        ),
                        array(
                            'key' => 'more_fields',
                            'compare' => 'EXISTS',
                        ),
                        array(
                            'key' => 'only_member',
                            'compare' => 'EXISTS',
                        ),
                    ),
                );

                $more = new WP_Query( $args );

			    if (!empty($more->posts)): ?>
                    <div class="section-escorts">
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
                                            if (strtolower($label_more) == 'age') {
                                                // Aqui você tem o $label_more e o $value_more quando o label é "Age"
                                                $age_more = $value_more;
                                            }
                                            // Verifica se o valor de $label_more é o que você está buscando (exemplo "location")
                                            if (strtolower($label_more) == 'location') {
                                                // Aqui você tem o $label_more e o $value_more quando o label é "location"
                                                $location_more = $value_more;
                                            }
                                            // Verifica se o valor de $label_more é o que você está buscando (exemplo "nationality")
                                            if (strtolower($label_more) == 'nationality') {
                                                // Aqui você tem o $label_more e o $value_more quando o label é "nationality")
                                                $nationality_more = $value_more;
                                            }
                                        endforeach;
                                    endif;
                                    ?>
                                    <div class="col-6 col-md-3 col-adjust-escorts">
                                        <a href="<?php echo get_permalink($post->ID); ?>" class="escort-box">
                                            <div class="image-container">
                                                <?php if (is_user_logged_in() ) : ?>
                                                    <div class="image">
                                                        <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(), 'full');?>" alt="<?php echo get_the_title($post->ID); ?>">
                                                    </div>
                                                <?php elseif ( $member == 'No' && !is_user_logged_in()): ?>
                                                    <div class="image">
                                                        <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(), 'full');?>" alt="<?php echo get_the_title($post->ID); ?>">
                                                    </div>
                                                <?php else : ?>
                                                    <div class="blur-container"></div>
                                                    <div class="image">
                                                        <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(), 'full');?>" alt="<?php echo get_the_title($post->ID); ?>">
                                                    </div>
                                                <?php endif; ?>
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
                <?php endif;
                wp_reset_query();
            ?>
            
            <?php if( !empty($title_text_field_2_page) || !empty($text_field_2_page) ): ?>
                <div class="section-about bg-white">
                    <div class="title">
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
            <?php if( have_rows('faq', 'location_' . get_queried_object()->term_id) ): ?>
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
                                        while( have_rows('faq', 'location_' . get_queried_object()->term_id) ) : the_row();
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