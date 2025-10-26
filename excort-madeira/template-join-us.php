<title>The Girl Next Door - <?php echo get_the_title(); ?></title>
<?php 
    /**
     * Template Name: Join Us
     * Description: Personalized Page "Join Us"
     */

	get_header();

    $title_text_field_1_page = get_field('title_text_field_1_page');
    $text_field_1_page = get_field('text_field_1_page');
    $title_text_field_2_page = get_field('title_text_field_2_page');
    $text_field_2_page = get_field('text_field_2_page');
?>

    <section class="main">
        <div class="section">
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
                        <h1><?php echo get_the_title(); ?></h1>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="content">
                            <?php echo apply_filters('the_content', $post->post_content); ?>

                            <div class="advertise-contact">
                                <?php 
                                    $whatsapp = get_field('whatsapp_url', 'option');
                                    $phone = get_field('phone', 'option');
                                    $clean_phone = preg_replace('/[^\d+]/', '', $phone);
                                ?>
                                <ul>
                                    <li>
                                        <?php if($whatsapp): ?>
                                            <a href="<?php echo $whatsapp; ?>" target="_blank">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/whatsapp.svg" width="24" alt="Whatsapp icon"> Whatsapp
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <?php if($phone): ?>
                                            <a href="tel:<?php echo $clean_phone; ?>" target="_blank">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/phone.svg" width="24" alt="Telegram icon"> <?php echo $phone; ?>
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if( !empty($title_text_field_2_page) || !empty($text_field_2_page) ): ?>
                <div class="section-about bg-white pb-0">
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
                                    // Vamos acumular aqui as perguntas/respostas para o JSON-LD:
                                    $faq_entities = [];

                                    // Reinicia o loop para garantir leitura correta
                                    while ( have_rows('faq') ) : the_row();
                                        $question = get_sub_field('question');
                                        $answer   = get_sub_field('answer');

                                        // (Opcional) Versão "limpa" para o JSON-LD (remove tags e normaliza espaços)
                                        $q_text = trim( wp_strip_all_tags( $question ) );
                                        $a_text = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( $answer ) ) );

                                        // Evita entradas vazias
                                        if ( $q_text !== '' && $a_text !== '' ) {
                                            $faq_entities[] = [
                                                "@type" => "Question",
                                                "name"  => $q_text,
                                                "acceptedAnswer" => [
                                                    "@type" => "Answer",
                                                    "text"  => $a_text, // Pode ser com tags simples se preferir: use $answer
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
                // Só imprime o JSON-LD se houver pelo menos um item válido
                if ( ! empty( $faq_entities ) ) {
                    $schema = [
                        "@context"   => "https://schema.org",
                        "@type"      => "FAQPage",
                        "mainEntity" => $faq_entities,
                    ];

                    // Dica: use JSON_UNESCAPED_UNICODE para manter acentos
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