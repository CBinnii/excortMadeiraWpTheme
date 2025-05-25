<meta name="description" content="<?php echo the_field('meta_description'); ?>">
<meta name="keywords" content="<?php echo the_field('meta_key'); ?>">

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
                <div class="section-general-banner slider">
                    <div class="swiper slider-general">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="banner-image" style="background-image: url('<?php echo wp_get_attachment_url(get_post_thumbnail_id(), 'full');?>');">
                                    <div class="overlay white"></div>
                                    <div class="container">
                                        <div class="banner-text">
                                            <h1><?php echo get_the_title(); ?></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-button-next swiper-button-next-slider-general"></div>
                    <div class="swiper-button-prev swiper-button-prev-slider-general"></div>
                </div>
            <?php } ?>

            <?php if( !empty($title_text_field_1_page) || !empty($text_field_1_page) ): ?>
                <div class="section-about bg-white pb-0">
                    <div class="title">
                        <div class="container">
                            <h3><?php echo $title_text_field_1_page; ?></h3>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p><?php echo $text_field_1_page; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php
                $args = array(
                    'post_type' => 'profile',
                    'status' => 'publish',
                    'showposts' => -1,
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
                                    $age = get_field( 'age' );
                                    $nationality = get_field( 'nationality' );
                                    $photos = get_field( 'photos' );
                                    $location = get_field( 'location' );
                                    $member = get_field( 'only_member' );
                                    ?>
                                    <div class="col-6 col-md-3 col-adjust-escorts">
                                        <a href="<?php echo $post->post_name; ?>" class="escort-box">
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
                                            <h3><?php echo get_the_title($post->ID); ?></h3>
                                            <p><?php echo $location ?></p>
                                            <p class="small"><strong>Age: </strong> <?php echo $age; ?>, <?php echo $nationality ?></p>
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
                    <div class="title pt-0">
                        <div class="container">
                            <h3><?php echo $title_text_field_2_page; ?></h3>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p><?php echo $text_field_2_page; ?></p>
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