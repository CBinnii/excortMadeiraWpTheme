<?php
    get_header(); 

    $title_text_field_1_page = get_field('title_text_field_1_page');
    $text_field_1_page = get_field('text_field_1_page');
    $title_text_field_2_page = get_field('title_text_field_2_page');
    $text_field_2_page = get_field('text_field_2_page');
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
                                    <div class="overlay white"></div>
                                    <div class="container">
                                        <div class="banner-text">
                                            <h1 id="page-title"><?php echo get_the_title(); ?></h1>
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
                                <div class="overlay white"></div>
                                <div class="container">
                                    <div class="banner-text">
                                        <div class="banner-title"><?php echo get_the_title(); ?></div>
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

            <div class="section-single-page">
                <div class="title pt-0">
                    <div class="container">
                        <h2><?php echo get_the_title(); ?></h2>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="content">
                            <?php echo apply_filters('the_content', $post->post_content); ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if( !empty($title_text_field_2_page) || !empty($text_field_2_page) ): ?>
                <div class="section-about bg-white pb-0">
                    <div class="title">
                        <div class="container">
                            <h3><?php echo $title_text_field_2_page; ?></h3>
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
                                    $faq_entities = [];

                                    // Loop do ACF
                                    while ( have_rows('faq') ) : the_row();
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
?>