<title>The Girl Next Door - <?php echo get_the_title(); ?></title>
<?php 
	get_header();
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
                                            <!-- <h1><?php echo get_the_title(); ?></h1> -->
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
                                        <!-- <h1><?php echo get_the_title(); ?></h1> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="section-pricing">
                <div class="title pt-0">
                    <div class="container">
                        <h1><?php echo get_the_title(); ?></h1>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="content">
                            <div class="col-md-12">
                                <?php echo apply_filters('the_content', $post->post_content); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
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