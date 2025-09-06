<?php get_header(); ?>

    <section class="main">
        <div class="section">
            <div class="section-general-banner slider">
                <div class="swiper slider-general">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="banner-image" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/bg-7.png');">
                                <div class="overlay white"></div>
                                <div class="container">
                                    <div class="banner-text">
                                        <h1>
                                            <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                Página de pesquisa
                                            <?php else : ?>
                                                Search page
                                            <?php endif; ?>
                                        </h1>
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
                // Termos de pesquisa
                $search_query = get_search_query();

                // Argumentos para a consulta de tipos de post
                $args = array(
                    's' => $search_query, // A pesquisa
                    'posts_per_page' => -1, // Exibir todos os resultados
                    'lang' => pll_current_language('slug'), // 'pt' ou 'en' conforme a tela
                );

                // Query para 'post'
                $args['post_type'] = 'post';
                $post_query = new WP_Query($args);
            ?>
            <div class="section-blog bg-white">
                <div class="title">
                    <div class="container">
                        <h3>Blog</h3>
                    </div>
                </div>

                <div class="container">
                    <?php if (!empty($post_query->posts)): ?>
                        <div class="row row-adjustment">
                            <?php foreach ( $post_query->posts as $post ): /*echo '<pre>'; var_dump($post); echo '</pre>';*/ ?>
                                <div class="col-md-6 col-adjustment">
                                    <a href="<?php echo $post->post_name; ?>" class="post-box">
                                        <div class="image">
                                            <?php if (has_post_thumbnail( $post->ID ) ) { ?>
                                                <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(), 'full');?>" alt="<?php echo get_the_title($post->ID); ?>">
                                            <?php } else { ?>
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-image.jpeg" alt="<?php echo get_the_title($post->ID); ?>">
                                            <?php } ?>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="d-flex justify-content-center mt-30">
                            <a href="blog" class="button bold white">
                                <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                    Ler mais
                                <?php else : ?>
                                    Read more
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php else : ?>
                        <p class="txt-heading block lg">
                            <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                Nenhum post encontrato para <strong>"<?php echo get_search_query(); ?>"</strong>
                            <?php else : ?>
                                No posts found for <strong>"<?php echo get_search_query(); ?>"</strong>
                            <?php endif; ?>
                        </p>

                        <div class="d-flex justify-content-center mt-30">
                            <a href="<?php echo home_url(); ?>" class="button bold white">
                                <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                    Voltar para casa
                                <?php else : ?>
                                    Go back to homepage
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php endif;?>
                </div>
            </div>

            <?php
                // Query para 'profile'
                $args['post_type'] = 'profile';
                $profile_query = new WP_Query($args);
            ?>
            <div class="section-escorts bg-light">
                <div class="title">
                    <div class="container">
                        <h3>
                            <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                Acompanhantes
                            <?php else : ?>
                                Escorts
                            <?php endif; ?>    
                        </h3>
                    </div>
                </div>

                <div class="container">
                    <?php if ($profile_query->have_posts()) : ?>
                        <div class="row row-adjust-escorts">
                            <?php foreach ( $profile_query->posts as $post ): /*echo '<pre>'; var_dump($post); echo '</pre>'*/; 
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
                    <?php else : ?>
                        <p class="txt-heading block lg">
                            <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                Nenhuma acompanhante encontrada para <strong>"<?php echo get_search_query(); ?>"</strong>
                            <?php else : ?>
                                No escorts found for <strong>"<?php echo get_search_query(); ?>"</strong>
                            <?php endif; ?>   
                        </p>

                        <div class="d-flex justify-content-center mt-30">
                            <a href="<?php echo home_url(); ?>" class="button bold white">
                                <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                    Voltar para casa
                                <?php else : ?>
                                    Go back to homepage
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php
                // Query para 'service'
                $args['post_type'] = 'service';
                $service_query = new WP_Query($args);
            ?>
            <div class="section-services bg-white">
                <div class="title">
                    <div class="container">
                        <h3>
                            <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                Serviços
                            <?php else : ?>
                                Services
                            <?php endif; ?>
                        </h3>
                    </div>
                </div>
                <div class="container">
                    <?php if ($service_query->have_posts()) : ?>
                        <div class="row">
                            <?php foreach ( $service_query->posts as $post ): /*echo '<pre>'; var_dump($post); echo '</pre>';*/ ?>
                                <div class="col-sm-3">
                                    <a href="<?php echo $post->post_name; ?>" class="service-box">
                                        <div class="image">
                                            <?php if (has_post_thumbnail( $post->ID ) ) { ?>
                                                <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(), 'full');?>" alt="<?php echo get_the_title($post->ID); ?>">
                                            <?php } else { ?>
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-image.jpeg" alt="<?php echo get_the_title($post->ID); ?>">
                                            <?php } ?>
                                        </div>
                                        <div class="text-box">
                                            <h3><?php echo get_the_title($post->ID); ?></h3>
                                            <p class="ellipsis three-lines"><?php echo get_the_excerpt($post->ID); ?></p>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p class="txt-heading block lg">
                            <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                Nenhum serviço encontrado para <strong>"<?php echo get_search_query(); ?>"</strong>
                            <?php else : ?>
                                No service found for <strong>"<?php echo get_search_query(); ?>"</strong>
                            <?php endif; ?>
                        </p>

                        <div class="d-flex justify-content-center mt-30">
                            <a href="<?php echo home_url(); ?>" class="button bold white">
                                <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                    Voltar para casa
                                <?php else : ?>
                                    Go back to homepage
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
