<meta name="description" content="<?php echo the_field('meta_description'); ?>">
<meta name="keywords" content="<?php echo the_field('meta_key'); ?>">

<?php 
	get_header();
?>
    <section class="main">
        <div class="section">
            <!-- Banner Video Section -->
            <?php if( have_rows('home_images') ): ?>
                <div class="section-banner slider">
                    <div class="swiper slider-home">
                        <div class="swiper-wrapper">
                            <?php while( have_rows('home_images') ) : the_row(); 
                                $image = get_sub_field('image');
                                $link = get_sub_field('link'); ?>
                                <?php 
                                    $extension = pathinfo($image, PATHINFO_EXTENSION);
                                    $is_video = in_array(strtolower($extension), ['mp4', 'webm', 'ogg']); // você pode adicionar outras extensões se quiser
                                ?>
                                <div class="swiper-slide">
                                    <?php if ($is_video): ?>
                                        <?php if ($link) : ?>
                                            <video 
                                                autoplay 
                                                loop
                                                muted 
                                                playsinline 
                                                preload="metadata" 
                                                style="width: 100%; height: auto; object-fit: cover;" 
                                            >
                                                <source src="<?php echo esc_url($image); ?>" type="video/<?php echo esc_attr($extension); ?>">
                                                Seu navegador não suporta vídeo.
                                            </video>
                                        <?php else : ?>
                                            <video 
                                                autoplay 
                                                loop
                                                muted 
                                                playsinline 
                                                preload="metadata" 
                                                style="width: 100%; height: auto; object-fit: cover;" 
                                            >
                                                <source src="<?php echo esc_url($image); ?>" type="video/<?php echo esc_attr($extension); ?>">
                                                Seu navegador não suporta vídeo.
                                            </video>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if ($link) : ?>
                                            <a href="<?php echo esc_url($link); ?>">
                                                <img src="<?php echo esc_url($image); ?>" alt="Banner Image">
                                            </a>
                                        <?php else : ?>
                                            <img src="<?php echo esc_url($image); ?>" alt="Banner Image">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>

                    <div class="swiper-button-next swiper-button-next-slider-home">
                        <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M-3.13581e-07 11.8462H20.7627L11.8644 20.7308L12.9831 22L24 11L12.9831 0L11.8644 1.26923L20.7627 10.1538H-3.13581e-07V11.8462Z" fill="#D2261A"/>
                        </svg>
                    </div>
                    <div class="swiper-button-prev swiper-button-prev-slider-home">
                        <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24 11.8462H3.23729L12.1356 20.7308L11.0169 22L0 11L11.0169 0L12.1356 1.26923L3.23729 10.1538H24V11.8462Z" fill="#D2261A"/>
                        </svg>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Top Escort Section -->
            <?php
                $args = array(
                    'post_type' => 'profile',
                    'status' => 'publish',
                    'showposts' => 8,
                    'meta_query' => array(
                        array(
                            'key' => 'photos',
                            'compare' => 'EXISTS',
                        ),
                        array(
                            'key' => 'more_fields',
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

                        <div class="container position-relative">
                            <div class="swiper-button-next swiper-button-next-top-escorts"></div>
                            <div class="swiper-button-prev swiper-button-prev-top-escorts"></div>

                            <div class="swiper slider-top-escorts">
                                <div class="swiper-wrapper">
                                    <?php foreach ( $more->posts as $post ) :  
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

                                        <div class="swiper-slide">
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
                                                <h3><?php echo get_the_title($post->ID); ?></h3>
                                                <p>
                                                    <?php if (!empty($location_more)) : ?>
                                                        <?php echo $location_more; ?>
                                                    <?php else : ?>
                                                        <?php echo '-'; ?>
                                                    <?php endif; ?>
                                                </p>
                                                <p class="small"><strong>Age: </strong> 
                                                    <?php if (!empty($age_more)) : ?>
                                                        <?php echo $age_more; ?>
                                                    <?php else : ?>
                                                        <?php echo '-'; ?>
                                                    <?php endif; ?>
                                                    , 
                                                    
                                                    <?php if (!empty($nationality_more)) : ?>
                                                        <?php echo $nationality_more; ?>
                                                    <?php else : ?>
                                                        <?php echo '-'; ?>
                                                    <?php endif; ?>
                                                </p>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
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

                            <div class="d-flex justify-content-center mt-30">
                                <a href="about" class="button bold white">
                                    More about us
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Blog Section -->
            <?php
                $args = array(
                    'post_type' => 'post',
                    'status' => 'publish',
                    'showposts' => 6,
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
                            <div class="row row-adjustment">
                                <?php foreach ( $more->posts as $post ): /*echo '<pre>'; var_dump($post); echo '</pre>';*/ ?>
                                    <div class="col-md-6 col-adjustment">
                                        <a href="<?php echo $post->post_name; ?>" class="post-box">
                                            <div class="image">
                                                <?php if (has_post_thumbnail( $post->ID ) ) { ?>
                                                    <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(), 'full');?>" alt="<?php echo get_the_title($post->ID); ?>">
                                                <?php } else { ?>
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-image.jpeg" alt="<?php echo get_the_title($post->ID); ?>">
                                                <?php } ?>

                                                <h1> <?php echo get_the_title($post->ID); ?> </h1>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="d-flex justify-content-center mt-30">
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