<?php
/**
 * Template da taxonomia "location"
 * Caminho: taxonomy-location.php
 */

// Define o título apenas para location (o header.php imprime o <title>)
add_filter('pre_get_document_title', function ($title) {
    if (is_tax('location')) {
        $term = get_queried_object();
        if ($term && isset($term->name)) {
            return 'The Girl Next Door - ' . $term->name;
        }
    }
    return $title;
}, 20);

/*
// Se usar Yoast SEO e quiser alinhar o título do Yoast também, descomente:
add_filter('wpseo_title', function ($title) {
    if (is_tax('location')) {
        $term = get_queried_object();
        if ($term && isset($term->name)) {
            return 'The Girl Next Door - ' . $term->name;
        }
    }
    return $title;
}, 20);
*/

get_header();

// Termo atual
$term = get_queried_object();
if ( ! $term || is_wp_error($term) ) {
    // Fallback simples
    $term = (object) ['term_id' => 0, 'name' => '', 'slug' => ''];
}

$term_id = (int) ($term->term_id ?? 0);

// Campos do termo (ACF em taxonomia usa "taxonomy_termid" como $post_id)
$title_text_field_1_page = get_field('title_text_field_1_page', 'location_' . $term_id);
$text_field_1_page       = get_field('text_field_1_page', 'location_' . $term_id);
$title_text_field_2_page = get_field('title_text_field_2_page', 'location_' . $term_id);
$text_field_2_page       = get_field('text_field_2_page', 'location_' . $term_id);

// Banner (imagem destacada da location)
$featured_image = get_field('featured_image_location', 'location_' . $term_id);
$has_banner     = ! empty($featured_image) && ! empty($featured_image['url']);
?>
<section class="main">
    <div class="section">

        <?php if ( $has_banner ) : ?>
            <!-- Banner Desktop -->
            <div class="section-general-banner slider desktop">
                <div class="swiper slider-general">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="banner-image" style="background-image: url('<?php echo esc_url($featured_image['url']); ?>');">
                                <div class="overlay white"></div>
                                <div class="container">
                                    <div class="banner-text">
                                        <h1 id="page-title"><?php echo esc_html($term->name ?? ''); ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Banner Mobile -->
            <div class="section-general-banner slider mobile">
                <div class="swiper slider-general">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="<?php echo esc_url($featured_image['url']); ?>" alt="<?php echo esc_attr($term->name ?? ''); ?>">
                            <div class="overlay white"></div>
                            <div class="container">
                                <div class="banner-text">
                                    <div class="banner-title"><?php echo esc_html($term->name ?? ''); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( ! empty($title_text_field_1_page) || ! empty($text_field_1_page) ) : ?>
            <div class="section-about bg-white pb-0">
                <div class="title">
                    <div class="container">
                        <h2><?php echo esc_html($title_text_field_1_page); ?></h2>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="content">
                            <div class="col-md-12">
                                <?php
                                // text_field_1_page pode conter HTML seguro do editor — sanitize com wp_kses_post
                                echo wp_kses_post( apply_filters('the_content', $text_field_1_page) );
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php
        // Consulta dos perfis vinculados à location
        $args = [
            'post_type'      => 'profile',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'lang'           => function_exists('pll_current_language') ? pll_current_language('slug') : '',
            'tax_query'      => [
                [
                    'taxonomy' => 'location',
                    'field'    => 'slug',
                    'terms'    => $term->slug ?? '',
                ],
            ],
            'meta_query'     => [
                [
                    'key'     => 'more_fields',
                    'compare' => 'EXISTS',
                ],
            ],
        ];

        $more = new WP_Query($args);

        if ( $more->have_posts() ) : ?>
            <div class="section-escorts">
                <div class="container">
                    <div class="row row-adjust-escorts">

                        <?php
                        foreach ( $more->posts as $post ) :
                            $post_id          = $post->ID;
                            $thumb_url        = get_the_post_thumbnail_url($post_id, 'full');
                            $member           = get_field('only_member', $post_id);  // 'Yes' / 'No' (ajuste conforme o ACF)
                            $more_fields_posts = get_field('more_fields', $post_id);

                            // Extrair Age / Location / Nationality de more_fields
                            $location_more   = '';
                            $nationality_more= '';
                            $age_more        = '';

                            if ( $more_fields_posts && is_array($more_fields_posts) ) {
                                foreach ($more_fields_posts as $field) {
                                    $label_more = strtolower( trim( $field['label'] ?? '' ) );
                                    $value_more = trim( (string) ($field['value'] ?? '') );

                                    if ( $label_more === 'age' || $label_more === 'idade' ) {
                                        $age_more = $value_more;
                                    } elseif ( in_array($label_more, ['location','localização','localizacao'], true) ) {
                                        $location_more = $value_more;
                                    } elseif ( in_array($label_more, ['nationality','nacionalidade'], true) ) {
                                        $nationality_more = $value_more;
                                    }
                                }
                            }

                            // Regras de exibição da imagem:
                            // - Se logado OU perfil não é restrito a membros ('No'), mostra imagem normal
                            // - Caso contrário, mostra com blur
                            $can_show_image = is_user_logged_in() || ($member === 'No');
                            ?>
                            <div class="col-6 col-md-3 col-adjust-escorts">
                                <a href="<?php echo esc_url( get_permalink($post_id) ); ?>" class="escort-box">
                                    <div class="image-container">
                                        <?php if ( $can_show_image ) : ?>
                                            <div class="image">
                                                <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( get_the_title($post_id) ); ?>">
                                            </div>
                                        <?php else : ?>
                                            <div class="blur-container"></div>
                                            <div class="image">
                                                <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( get_the_title($post_id) ); ?>">
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <h2><?php echo esc_html( get_the_title($post_id) ); ?></h2>

                                    <p>
                                        <?php
                                        if ( ! empty($location_more) ) {
                                            echo esc_html($location_more);
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </p>
                                </a>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        <?php
        endif;
        // Não usamos setup_postdata, então wp_reset_postdata() é opcional aqui
        wp_reset_postdata();
        ?>

        <?php if ( ! empty($title_text_field_2_page) || ! empty($text_field_2_page) ) : ?>
            <div class="section-about bg-white">
                <div class="title">
                    <div class="container">
                        <h2><?php echo esc_html($title_text_field_2_page); ?></h2>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="content">
                            <div class="col-md-12">
                                <?php echo wp_kses_post( apply_filters('the_content', $text_field_2_page) ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- FAQ Section -->
        <?php
            // Helper para limpar texto para JSON-LD (sem HTML, links, emails, shortcodes)
            function faq_plain_text( $text, $max_len = 1000 ) {
                if ( empty( $text ) ) return '';

                // Remove shortcodes tipo [galeria], etc.
                $text = strip_shortcodes( $text );

                // Decodifica entidades HTML (ex.: &amp; -> &), para não sobrar lixo após strip
                $text = html_entity_decode( $text, ENT_QUOTES | ENT_HTML5, 'UTF-8' );

                // Remove tags (inclui <script> e <style>)
                $text = wp_strip_all_tags( $text, true );

                // Remove URLs (http, https, www) e e-mails
                $text = preg_replace(
                    array(
                        '#\bhttps?://[^\s<>()"]+#i',
                        '#\bwww\.[^\s<>()"]+#i',
                        '/[A-Z0-9._%+\-]+@[A-Z0-9.\-]+\.[A-Z]{2,}/i',
                    ),
                    '',
                    $text
                );

                // Normaliza quebras/espacos
                $text = preg_replace('/\s+/u', ' ', trim($text));

                // (Opcional) Limita tamanho para evitar payload gigante
                if ( function_exists('mb_substr') && mb_strlen($text, 'UTF-8') > $max_len ) {
                    $text = mb_substr($text, 0, $max_len, 'UTF-8') . '…';
                }

                return $text;
            }
        ?>

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
                                $faq_entities = [];

                                // Loop do ACF
                                while ( have_rows('faq', 'location_' . get_queried_object()->term_id) ) : the_row();
                                    $question = get_sub_field('question');
                                    $answer   = get_sub_field('answer');

                                    // Texto limpo para o JSON-LD
                                    $q_text = faq_plain_text( $question );
                                    $a_text = faq_plain_text( $answer );

                                    // Monta entidade apenas se ambos existem
                                    if ( $q_text !== '' && $a_text !== '' ) {
                                        $faq_entities[] = [
                                            "@type" => "Question",
                                            "name"  => $q_text,
                                            "acceptedAnswer" => [
                                                "@type" => "Answer",
                                                "text"  => $a_text,
                                            ],
                                        ];
                                    }
                                    ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading<?php echo esc_attr( get_row_index() ); ?>">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapse<?php echo esc_attr( get_row_index() ); ?>"
                                                aria-expanded="false"
                                                aria-controls="collapse<?php echo esc_attr( get_row_index() ); ?>">
                                                <?php echo wp_kses_post( $question ); ?>
                                            </button>
                                        </h2>
                                        <div id="collapse<?php echo esc_attr( get_row_index() ); ?>"
                                                class="accordion-collapse collapse"
                                                data-bs-parent="#accordionFAQ">
                                            <div class="accordion-body">
                                                <?php echo wp_kses_post( $answer ); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if ( ! empty( $faq_entities ) ) {
                $schema = [
                    "@context"   => "https://schema.org",
                    "@type"      => "FAQPage",
                    "mainEntity" => $faq_entities,
                ];
                $json = wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
                ?>
                <script type="application/ld+json">
                    <?php echo $json; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </script>
                <?php
            }
            ?>
        <?php endif; ?>
    </div>
</section>

<?php
get_footer();
