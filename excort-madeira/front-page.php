<meta name="description" content="<?php echo the_field('meta_description'); ?>">
<meta name="title" content="<?php echo the_field('meta_title'); ?>">

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
                    'lang' => pll_current_language('slug'), // 'pt' ou 'en' conforme a tela
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
                                <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                    <h2>Conheça acompanhantes independentes verificadas em Portugal</h2>
                                <?php else : ?>
                                    <h2>Meet Verified Independent Escorts in Portugal</h2>
                                <?php endif; ?>
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
                                                    <div class="image">
                                                        <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(), 'full');?>" alt="<?php echo get_the_title($post->ID); ?>">
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

                            <div class="d-flex justify-content-center mt-30">
                                <a href="<?php echo get_home_url(); ?>/escorts" class="button bold white">
                                    <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                        Ver acompanhantes
                                    <?php else : ?>
                                        View all escorts
                                    <?php endif; ?>
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
                $subtitle = get_field('subtitle_about_section');
                $text = get_field('text_about_section');
                
                if ($title && $text) : ?>
                <div class="section-about">
                    <div class="title">
                        <div class="container">
                            <h1><?php echo $title; ?></h1>
                            <?php if ($subtitle) : ?>
                                <div class="section-label"><?php echo $subtitle; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="content">
                                <div class="col-md-12">
                                    <?php echo apply_filters('the_content', $text); ?>
                                </div>
                                
                                <div class="d-flex justify-content-center mt-30">
                                    <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                        <a href="<?php echo get_home_url(); ?>/escorts" class="button bold white color-white">
                                            Ver perfis
                                        </a>
                                    <?php else : ?>
                                        <a href="<?php echo get_home_url(); ?>/acompanhantes" class="button bold white color-white">
                                            View profiles
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- your Girl Quiz Section -->
            <?php 
                $title_your_girl = get_field('title_your_girl_section');
                $subtitle_your_girl = get_field('subtitle_your_girl_section');
                $text_your_girl = get_field('text_your_girl_section');
                $button_your_girl_text = get_field('text_button_your_girl_section');
                $button_your_girl_link = get_field('link_button_your_girl_section');
                $image_your_girl = get_field('image_your_girl_section');
                
                if ($title_your_girl && $text_your_girl) : ?>
                <div class="section-your-girl bg-white">
                    <div class="container p-0">
                        <div class="media">
                            <img src="<?php echo $image_your_girl ?>" alt="Image <?php echo $title_your_girl; ?>">
                        </div>

                        <div class="context">
                            <div class="title title-section mob-mb-8">
                                <h1 class="color-white"><?php echo $title_your_girl; ?></h1>
                                <?php if ($subtitle_your_girl) : ?>
                                    <div class="section-label color-white"><?php echo $subtitle_your_girl; ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="row">
                                <div class="content">
                                    <div class="col-md-12 color-white">
                                        <?php echo apply_filters('the_content', $text_your_girl); ?>
                                    </div>

                                    <div class="d-flex justify-content-center mt-30 mob-mt-8">
                                        <a href="<?php echo $button_your_girl_link; ?>" class="button bold white">
                                            <?php echo $button_your_girl_text; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Unlock Access Section -->
            <?php 
                $title_section = get_field('title_section');
                $subtitle_section = get_field('subtitle_section');
                $text_section = get_field('text_section');
                $button_text = get_field('button_text');
                $button_link = get_field('button_link');
                $image_section = get_field('image_section');
            ?>
                <div class="section-unlock-access">
                    <div class="container p-0">
                        <div class="media">
                            <img src="<?php echo $image_section ?>" alt="Image <?php echo $title_section; ?>">
                        </div>
                    
                        <div class="context">
                            <div class="title title-section mob-mb-8">
                                <h1 class="color-white"><?php echo $title_section; ?></h1>
                                <?php if ($subtitle_section) : ?>
                                    <div class="section-label color-white"><?php echo $subtitle_section; ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="row">
                                <div class="content">
                                    <div class="col-md-12 color-white">
                                        <?php echo apply_filters('the_content', $text_section); ?>
                                    </div>

                                    <div class="d-flex justify-content-center mt-30 mob-mt-8">
                                        <a href="<?php echo $button_link; ?>" class="button bold white">
                                            <?php echo $button_text; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Become The Girl Section -->
            <?php 
                $title_become_section = get_field('title_become_section');
                $subtitle_become_section = get_field('subtitle_become_section');
                $text_become_section = get_field('text_become_section');
                $button_become_text = get_field('button_become_text');
                $button_become_link = get_field('button_become_link');
                $image_become_section = get_field('image_become_section');
            ?>
                <div class="section-become-escort">
                    <div class="container p-0">
                        <div class="media">
                            <img src="<?php echo $image_become_section ?>" alt="Image <?php echo $title_become_section; ?>">
                        </div>

                        <div class="context">
                            <div class="title title-section mob-mb-8">
                                <h1 class="color-white"><?php echo $title_become_section; ?></h1>
                                <?php if ($subtitle_become_section) : ?>
                                    <div class="section-label color-white"><?php echo $subtitle_become_section; ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="row">
                                <div class="content">
                                    <div class="col-md-12 color-white">
                                        <?php echo apply_filters('the_content', $text_become_section); ?>
                                    </div>

                                    <div class="d-flex justify-content-center mt-30 mob-mt-8">
                                        <a href="<?php echo $button_become_link; ?>" class="button bold white">
                                            <?php echo $button_become_text; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            <!-- Blog Section -->
            <?php
                $title_blog_section = get_field('title_blog_section');
                $subtitle_blog_section = get_field('subtitle_blog_section');
                $text_blog_section = get_field('text_blog_section');

                $args = array(
                    'post_type' => 'post',
                    'status' => 'publish',
                    'showposts' => 6,
                    'lang' => pll_current_language('slug'), // 'pt' ou 'en' conforme a tela
                    'meta_query' => array(
                        array(
                            'key' => 'featured_image_hover',
                            'compare' => 'EXISTS',
                        ),
                    ),
                );

                $more = new WP_Query( $args );

			    if (!empty($more->posts)): 
                ?>
                    <div class="section-blog bg-white">
                        <div class="title">
                            <div class="container">
                                <h2><?php echo $title_blog_section; ?></h2>

                                <?php if ($subtitle_blog_section) : ?>
                                    <div class="section-label"><?php echo $subtitle_blog_section; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="container">
                            <?php if ($text_blog_section) : ?>
                                <div class="content">
                                    <div class="col-md-12 mb-24">
                                        <?php echo apply_filters('the_content', $text_blog_section); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="row row-adjustment">
                                <?php foreach ( $more->posts as $post ): /*echo '<pre>'; var_dump($post); echo '</pre>';*/
                                    $featured_image_hover = get_field('featured_image_hover');?>
                                    <div class="col-md-6 col-adjustment">
                                        <a href="<?php echo get_home_url(); ?>/blog/<?php echo $post->post_name; ?>" class="post-box">
                                            <div class="image">
                                                <?php if (has_post_thumbnail( $post->ID ) ) { ?>
                                                    <img class="img-normal" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(), 'full');?>" alt="<?php echo get_the_title($post->ID); ?>">
                                                    <img class="img-hover" src="<?php echo $featured_image_hover; ?>" alt="">
                                                <?php } else { ?>
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-image.jpeg" alt="<?php echo get_the_title($post->ID); ?>">
                                                <?php } ?>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="d-flex justify-content-center mt-30">
                                <a href="<?php echo get_home_url(); ?>/blog" class="button bold white">
                                    <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                        Leia mais
                                    <?php else : ?>
                                        Read more
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif;
                wp_reset_query();
            ?>

            <!-- This is the girl next door Section -->
            <?php 
                $title_section_this_is_the_girl_next_door = get_field('title_section_this_is_the_girl_next_door');
                $subtitle_section_this_is_the_girl_next_door = get_field('subtitle_section_this_is_the_girl_next_door');
                $text_section_this_is_the_girl_next_door = get_field('text_section_this_is_the_girl_next_door');
                $button_text_this_is_the_girl_next_door = get_field('button_text_this_is_the_girl_next_door');
                $button_link_this_is_the_girl_next_door = get_field('button_link_this_is_the_girl_next_door');
                $image_section_this_is_the_girl_next_door = get_field('image_section_this_is_the_girl_next_door');
            ?>
                <div class="section-this-is-the-girl-next-door-escort bg-light">
                    <div class="title">
                        <div class="container">
                            <h1><?php echo $title_section_this_is_the_girl_next_door; ?></h1>
                            <?php if ($subtitle_section_this_is_the_girl_next_door) : ?>
                                <div class="section-label"><?php echo $subtitle_section_this_is_the_girl_next_door; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <?php if ($text_section_this_is_the_girl_next_door) : ?>
                                <div class="content">
                                    <div class="col-md-12">
                                        <?php echo apply_filters('the_content', $text_section_this_is_the_girl_next_door); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div>
                            <?php if ($image_section_this_is_the_girl_next_door) : ?>
                                <div class="fs-wrapper">
                                    <?php foreach( $image_section_this_is_the_girl_next_door as $photo ): ?>
                                        <div class="fs-entry-container">
                                            <?php 
                                                $extension = pathinfo($photo['url'], PATHINFO_EXTENSION);
                                                $is_video = in_array(strtolower($extension), ['mp4', 'webm', 'ogg']); // você pode adicionar outras extensões se quiser
                                            ?>
                                            <?php if ($is_video): ?>
                                                <div class="fs-entry">
                                                    <div class="video-container">
                                                        <video 
                                                            autoplay 
                                                            loop
                                                            muted 
                                                            playsinline 
                                                            preload="metadata" 
                                                            style="height: 100%; object-fit: cover;" 
                                                        >
                                                            <source src="<?php echo esc_url($photo['url']); ?>" type="video/<?php echo esc_attr($extension); ?>">
                                                            Seu navegador não suporta vídeo.
                                                        </video>
                                                    </div>
                                                    <div class="fs-text-container" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-image="<?php echo esc_url($photo['url']); ?>" data-bs-title="<?php echo $photo['title'] ?>" data-bs-link="<?php echo $photo['alt'] ?>" data-bs-description="<?php echo $photo['description'] ?>" data-bs-location="<?php echo $photo['caption'] ?>">
                                                        <div class="fs-service-icon">
                                                            <i class="fs-icon fs-fa-instagram"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="fs-entry" style="background-image: url('<?php echo esc_url($photo['url']); ?>')">
                                                    <div class="fs-text-container" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-image="<?php echo esc_url($photo['url']); ?>" data-bs-title="<?php echo $photo['title'] ?>" data-bs-link="<?php echo $photo['alt'] ?>" data-bs-description="<?php echo $photo['description'] ?>" data-bs-location="<?php echo $photo['caption'] ?>">
                                                        <div class="fs-service-icon">
                                                            <i class="fs-icon fs-fa-instagram"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($button_link_this_is_the_girl_next_door && $button_text_this_is_the_girl_next_door) : ?>
                                <div class="d-flex justify-content-center mt-30">
                                    <a href="<?php echo $button_link_this_is_the_girl_next_door; ?>" class="button bold white">
                                        <?php echo $button_text_this_is_the_girl_next_door; ?>
                                    </a>
                                </div>
                            <?php endif; ?>
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

    <div class="modal modal-xl fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    <div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="media-slot mb-3"></div>
                            </div>
                            <div class="col-md-7">
                                <h2 id="title"></h2>
                                <p id="location"></p>
                                <p id="description"></p>

                                <div class="d-flex justify-content-center">
                                    <a href="#" class="button bold medium text-center">
                                        <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                            Ver mais
                                        <?php else : ?>
                                            See more
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
	get_footer();
?>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/modal.js"></script>