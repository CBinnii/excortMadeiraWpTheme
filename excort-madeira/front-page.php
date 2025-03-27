<?php 
	get_header();
?>
    <section class="main">
        <div class="section">

            <!-- Banner Video Section -->
            <?php 
                $video = get_field('video');
                $title = get_field('title');
                $subtitle = get_field('subtitle');
                $text_button = get_field('text_button');
                $link_button = get_field('link_button');
            ?>
            <?php if ($video) : ?>
                <div class="section-banner slider">
                    <div class="swiper slider-home">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="banner-video">
                                    <div class="overlay">
                                        <iframe loading="lazy" class="sproutvideo-player" src="<?php echo $video ?>" allowfullscreen="" style="border: none;"></iframe>
                                    </div>
                                    <div class="container">
                                        <div class="banner-text">
                                            <h1><?php echo $title ?></h1>
                                            <p><?php echo $subtitle ?></p>

                                            <div class="d-flex justify-content-center">
                                                <a href="<?php echo $link_button ?>" class="button bold white">
                                                    <?php echo $text_button ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-button-next swiper-button-next-slider-home"></div>
                    <div class="swiper-button-prev swiper-button-prev-slider-home"></div>
                </div>
                <div class="slider">
                    <div class="banner" style="background-image: url(<?php echo $banner; ?>);"></div>
                </div>
            <?php endif; ?>
            
            <!-- About Section -->
            <?php 
                $title = get_field('title_about_section');
                $text = get_field('text_about_section');
                
                if ($title && $text) : ?>
                <div class="section-about">
                    <div class="title">
                        <div class="container">
                            <h3><?php echo $title; ?></h3>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo apply_filters('the_content', $text); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Top Escort Section -->
            <?php
                $args = array(
                    'post_type' => 'profile',
                    'status' => 'publish',
                    'showposts' => 3,
                    'meta_query' => array(
                        array(
                            'key' => 'age',
                            'compare' => 'EXISTS',
                        ),
                        array(
                            'key' => 'nationality',
                            'compare' => 'EXISTS',
                        ),
                        array(
                            'key' => 'photos',
                            'compare' => 'EXISTS',
                        ),
                        array(
                            'key' => 'location',
                            'compare' => 'EXISTS',
                        ),
                    ),
                );

                $more = new WP_Query( $args );

			    if (!empty($more->posts)): ?>
                    <div class="section-topexcorts">
                        <div class="title">
                            <div class="container">
                                <h3>Top escorts</h3>
                            </div>
                        </div>

                        <div class="container">
                            <div class="swiper slider-top-escorts">
                                <div class="swiper-wrapper">
                                    <?php foreach ( $more->posts as $post ): /*echo '<pre>'; var_dump($post); echo '</pre>'*/; 
                                        $field_value = get_field( 'age' );
                                        $nationality = get_field( 'nationality' );
                                        $photos = get_field( 'photos' );
                                        $location = get_field( 'location' );
                                        ?>

                                        <div class="swiper-slide">
                                            <a href="<?php echo $post->post_name; ?>" class="escort-box">
                                                <div class="image">
                                                    <img src="<?php echo $photos[0];?>" alt="<?php echo get_the_title($post->ID); ?>">
                                                </div>
                                                <h3><?php echo get_the_title($post->ID); ?></h3>
                                                <p><?php echo $location ?></p>
                                                <p class="small"><strong>Age: </strong> <?php echo $field_value ?>, <?php echo $nationality ?></p>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="swiper-button-next swiper-button-next-top-escorts"></div>
                                <div class="swiper-button-prev swiper-button-prev-top-escorts"></div>
                            </div>

                            <div class="d-flex justify-content-center mt-30">
                                <a href="escorts" class="button bold white">
                                    See all escorts
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif;
                wp_reset_query();
            ?>

            <!-- Blog Section -->
            <?php
                $args = array(
                    'post_type' => 'post',
                    'status' => 'publish',
                    'showposts' => 3,
                );

                $more = new WP_Query( $args );

			    if (!empty($more->posts)): ?>
                    <div class="section-blog">
                        <div class="title">
                            <div class="container">
                                <h3>Blog</h3>
                            </div>
                        </div>

                        <div class="container">
                            <div class="swiper slider-blog">
                                <div class="swiper-wrapper">
                                    <?php foreach ( $more->posts as $post ): /*echo '<pre>'; var_dump($post); echo '</pre>';*/ ?>
                                        <div class="swiper-slide">
                                            <a href="<?php echo $post->post_name; ?>" class="post-box">
                                                <div class="image">
                                                    <?php if (has_post_thumbnail( $post->ID ) ) { ?>
                                                        <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(), 'full');?>" alt="<?php echo get_the_title($post->ID); ?>">
                                                    <?php } else { ?>
                                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-image.jpeg" alt="<?php echo get_the_title($post->ID); ?>">
                                                    <?php } ?>
                                                </div>
                                                <h3><?php echo get_the_title($post->ID); ?></h3>
                                                <p class="ellipsis two-lines"><?php echo get_the_excerpt($post->ID); ?></p>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="swiper-button-next swiper-button-next-blog"></div>
                                <div class="swiper-button-prev swiper-button-prev-blog"></div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <a href="blog" class="button bold white">
                                    Read more
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif;
                wp_reset_query();
            ?>
            
            <!-- FAQ Section -->
            <?php if( have_rows('faq') ): ?>
                <div class="section-faq">
                    <div class="faq-title">
                        <div class="container">
                            <h3>FAQ</h3>
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