<?php 
    $term = get_queried_object();
?>

<title>The Girl Next Door - <?php echo $term->name; ?> Escorts</title>

<?php 
	get_header();
?>
    <section class="main">
        <div class="section">
            <div class="section-general-banner slider">
                <div class="swiper slider-general">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="banner-image" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/bg-6.png');">
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

                <div class="swiper-button-next swiper-button-next-slider-general"></div>
                <div class="swiper-button-prev swiper-button-prev-slider-general"></div>
            </div>

            <?php
    
                // Configura a consulta personalizada
                $args = array(
                    'post_type' => 'profile',  // ou o tipo de post que você está usando
                    'status' => 'publish',
                    'showposts' => -1, // ou qualquer número de posts que você quiser
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'location', // Substitua pela sua taxonomia
                            'field'    => 'slug',
                            'terms'    => $term->slug,
                        ),
                    ),
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