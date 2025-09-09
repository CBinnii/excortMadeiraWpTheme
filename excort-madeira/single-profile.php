<meta name="description" content="<?php echo the_field('meta_description'); ?>">
<meta name="title" content="<?php echo the_field('meta_title'); ?>">

<?php 
	get_header();
    
    $age = '';
    $location = '';
    $nationality = '';
    $bio = get_field('bio');
    $video = get_field('my_video');
    $photos = get_field( 'photos' );
    $member_photos = get_field( 'member_photos' );
    $more_fields = get_field( 'more_fields' );
    $only_members = get_field( 'only_members' );

    // var_dump($only_members);

    if( have_rows('more_fields') ): 
        // Loop para percorrer as linhas dos campos repetíveis
        while( have_rows('more_fields') ): the_row();
            // Obtém os valores dos subcampos
            $label = get_sub_field('label');
            $value = get_sub_field('value');
            
            // Verifica se o valor de $label é o que você está buscando (exemplo "Age")
            if (strtolower($label) === 'age') {
                // Aqui você tem o $label e o $value quando o label é "Age"
                $age = $value;
            }
            // Verifica se o valor de $label é o que você está buscando (exemplo "location")
            if (strtolower($label) === 'location') {
                // Aqui você tem o $label e o $value quando o label é "location"
                $location = $value;
            }
            // Verifica se o valor de $label é o que você está buscando (exemplo "nationality")
            if (strtolower($label) === 'nationality")') {
                // Aqui você tem o $label e o $value quando o label é "nationality")
                $nationality = $value;
            }
        endwhile;
    endif;
?>
    <section class="profile">
        <div class="section">
            <div class="section-profile mob-pt-0">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 mob-p-0">
                            <div class="desktop">
                                <div class="row profile-photos">
                                    <?php if ($only_members == 'yes' ) : ?>
                                        <?php if ($member_photos) : ?>
                                            <?php foreach( $member_photos as $photo ): ?>
                                                <?php 
                                                    $extension = pathinfo($photo, PATHINFO_EXTENSION);
                                                    $is_video = in_array(strtolower($extension), ['mp4', 'webm', 'ogg']); // você pode adicionar outras extensões se quiser
                                                ?>
                                                <?php if ($is_video): ?>
                                                    <div class="col-md-6 adjust-col-escort">
                                                        <a class="escort-box" data-fslightbox="gallery_1" href="<?php echo esc_url($photo); ?>">
                                                            <div class="image-container">
                                                                <div class="image">
                                                                    <video 
                                                                        autoplay 
                                                                        loop
                                                                        muted 
                                                                        playsinline 
                                                                        preload="metadata" 
                                                                        style="width: 100%; height: auto; object-fit: cover;" 
                                                                    >
                                                                            <source src="<?php echo esc_url($photo); ?>" type="video/<?php echo esc_attr($extension); ?>">
                                                                            Seu navegador não suporta vídeo.
                                                                    </video>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="col-md-6 adjust-col-escort">
                                                        <a class="escort-box" data-fslightbox="gallery_1" href="<?php echo esc_url($photo); ?>">
                                                            <div class="image-container">
                                                                <div class="image">
                                                                    <img src="<?php echo esc_url($photo); ?>" alt="<?php echo get_the_title($post->ID); ?>">
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if ($photos) : ?>
                                            <?php foreach( $photos as $photo ): ?>
                                                <?php 
                                                    $extension = pathinfo($photo, PATHINFO_EXTENSION);
                                                    $is_video = in_array(strtolower($extension), ['mp4', 'webm', 'ogg']); // você pode adicionar outras extensões se quiser
                                                ?>
                                                <?php if ($is_video): ?>
                                                    <div class="col-md-6 adjust-col-escort">
                                                        <a class="escort-box" data-fslightbox="gallery_1" href="<?php echo esc_url($photo); ?>">
                                                            <div class="image-container">
                                                                <div class="image">
                                                                    <video 
                                                                        autoplay 
                                                                        loop
                                                                        muted 
                                                                        playsinline 
                                                                        preload="metadata" 
                                                                        style="width: 100%; height: auto; object-fit: cover;" 
                                                                    >
                                                                            <source src="<?php echo esc_url($photo); ?>" type="video/<?php echo esc_attr($extension); ?>">
                                                                            Seu navegador não suporta vídeo.
                                                                    </video>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="col-md-6 adjust-col-escort">
                                                        <a class="escort-box" data-fslightbox="gallery_1" href="<?php echo esc_url($photo); ?>">
                                                            <div class="image-container">
                                                                <div class="image">
                                                                    <img src="<?php echo esc_url($photo); ?>" alt="<?php echo get_the_title($post->ID); ?>">
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="swiper profile-slider mobile mb-24">
                                <div class="swiper-wrapper">
                                    <?php if ($only_members == 'yes' ) : ?>
                                        <?php if ($member_photos) : ?>
                                            <?php foreach( $member_photos as $photo ): ?>
                                                <?php 
                                                    $extension = pathinfo($photo, PATHINFO_EXTENSION);
                                                    $is_video = in_array(strtolower($extension), ['mp4', 'webm', 'ogg']); // você pode adicionar outras extensões se quiser
                                                ?>
                                                <?php if ($is_video): ?>
                                                    <div class="swiper-slide">
                                                        <video 
                                                            autoplay 
                                                            loop
                                                            muted 
                                                            playsinline 
                                                            preload="metadata" 
                                                            style="width: 100%; height: auto; object-fit: cover;" 
                                                        >
                                                            <source src="<?php echo esc_url($photo); ?>" type="video/<?php echo esc_attr($extension); ?>">
                                                            Seu navegador não suporta vídeo.
                                                            </video>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="swiper-slide">
                                                        <img src="<?php echo esc_url($photo); ?>" />
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if ($photos) : ?>
                                            <?php foreach( $photos as $photo ): ?>
                                                <?php 
                                                    $extension = pathinfo($photo, PATHINFO_EXTENSION);
                                                    $is_video = in_array(strtolower($extension), ['mp4', 'webm', 'ogg']); // você pode adicionar outras extensões se quiser
                                                ?>
                                                <?php if ($is_video): ?>
                                                    <div class="swiper-slide">
                                                        <video 
                                                            autoplay 
                                                            loop
                                                            muted 
                                                            playsinline 
                                                            preload="metadata" 
                                                            style="width: 100%; height: auto; object-fit: cover;" 
                                                        >
                                                            <source src="<?php echo esc_url($photo); ?>" type="video/<?php echo esc_attr($extension); ?>">
                                                            Seu navegador não suporta vídeo.
                                                            </video>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="swiper-slide">
                                                        <img src="<?php echo esc_url($photo); ?>" />
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="swiper-button-next swiper-button-next-profile"></div>
                                <div class="swiper-button-prev swiper-button-prev-profile"></div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="profile-info">
                                <div class="profile-info-box">
                                    <div class="profile-title mb-24">
                                        <div class="text-center mb-24">
                                            <h3><?php echo get_the_title(); ?></h3>
                                            <span class="txt-paragraph xl">
                                                <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                    Idade: 
                                                <?php else : ?>
                                                    Age: 
                                                <?php endif; ?>
                                                <?php if (!empty($age)) : ?>
                                                    <?php echo $age; ?>
                                                <?php else : ?>
                                                    <?php echo '-'; ?>
                                                <?php endif; ?>
                                                
                                                <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                    anos
                                                <?php else : ?>
                                                    years 
                                                <?php endif; ?>
                                            </span>
                                        </div>

                                        <div class="profile-book">
                                            <?php
                                            $phone = get_field('phonebumber');
                                            $clean_phone = preg_replace('/[^\d+]/', '', $phone);
                                            $whatsapp = get_field('whatsapp_link');
                                            $is_user_logged_in = is_user_logged_in();

                                            if ($only_members === 'yes') {
                                                if ($is_user_logged_in) {
                                                    if ($phone) : ?>
                                                        <a href="tel:<?php echo esc_attr($clean_phone); ?>" class="button bold medium">
                                                            <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                                Ligar
                                                            <?php else : ?>
                                                                Call
                                                            <?php endif; ?>
                                                        </a>
                                                    <?php endif;
                                                    if ($whatsapp) : ?>
                                                        <a href="<?php echo esc_url($whatsapp); ?>" target="_blank" class="ml-4 button bold medium">
                                                            Whatsapp
                                                        </a>
                                                    <?php endif;
                                                } else { ?>
                                                    <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                        <a href="<?php echo esc_url(get_home_url() . '/verifique-se'); ?>" class="button bold medium">
                                                            Verifique-se
                                                        </a>
                                                    <?php else : ?>
                                                        <a href="<?php echo esc_url(get_home_url() . '/get-verified'); ?>" class="button bold medium">
                                                            Get Verified
                                                        </a>
                                                    <?php endif; ?>
                                                <?php }
                                            } elseif ($only_members === 'no') {
                                                if ($phone) : ?>
                                                    <a href="tel:<?php echo esc_attr($clean_phone); ?>" class="button bold medium">
                                                        <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                            Ligar
                                                        <?php else : ?>
                                                            Call
                                                        <?php endif; ?>
                                                    </a>
                                                <?php endif;
                                                if ($whatsapp) : ?>
                                                    <a href="<?php echo esc_url($whatsapp); ?>" target="_blank" class="ml-4 button bold medium">
                                                        Whatsapp
                                                    </a>
                                                <?php endif;
                                            } else { ?>
                                                <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                    <a href="<?php echo esc_url(get_home_url() . '/verifique-se'); ?>" class="button bold medium">
                                                        Verifique-se
                                                    </a>
                                                <?php else : ?>
                                                    <a href="<?php echo esc_url(get_home_url() . '/get-verified'); ?>" class="button bold medium">
                                                        Get Verified
                                                    </a>
                                                <?php endif; ?>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="profile-bio">
                                        <button class="accordion-toggle mb-16 mob-mb-0">
                                            <span class="txt-heading block md text-center">
                                                <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                    SOBRE
                                                <?php else : ?>
                                                    ABOUT
                                                <?php endif; ?>
                                            </span>
                                            <span class="arrow"></span>
                                        </button>
                                        
                                        <div class="accordion-content">
                                            <?php echo apply_filters('the_content', $bio); ?>
                                        </div>
                                    </div>

                                    <?php if( have_rows('more_fields') ): ?>
                                        <div class="profile-stat">
                                            <div class="stats">
                                                <button class="accordion-toggle mb-16 mob-mb-0">
                                                    <span class="txt-heading block md text-center">
                                                        <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                            GERAL
                                                        <?php else : ?>
                                                            GENERAL
                                                        <?php endif; ?>
                                                    </span>
                                                    <span class="arrow"></span>
                                                </button>
                                                
                                                <div class="accordion-content">
                                                    <div class="row">
                                                        <div class="table-style">
                                                            <?php
                                                                while( have_rows('more_fields') ) : the_row();
                                                                    $label = get_sub_field('label');
                                                                    $value = get_sub_field('value');
                                                            ?>
                                                                <div class="row m-0 table-row">
                                                                    <div class="col-6 p-0">
                                                                        <span class="txt-paragraph block lg"><strong><?php echo $label ?></strong></span>
                                                                    </div>
                                                                    <div class="col-6 p-0">
                                                                        <span class="txt-paragraph block lg"><?php echo $value ?></span>
                                                                    </div>
                                                                </div>
                                                            <?php endwhile; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if( have_rows('languages') ): ?>
                                        <div class="profile-stat">
                                            <div class="stats">
                                                <button class="accordion-toggle mb-16 mob-mb-0">
                                                    <span class="txt-heading block md text-center">
                                                        <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                            IDIOMAS
                                                        <?php else : ?>
                                                            LANGUAGE
                                                        <?php endif; ?>
                                                    </span>
                                                    <span class="arrow"></span>
                                                </button>

                                                <div class="accordion-content">
                                                    <div class="row">
                                                        <div class="table-style">
                                                            <?php
                                                                while( have_rows('languages') ) : the_row();
                                                                    $language = get_sub_field('language');
                                                                    $fluency = get_sub_field('fluency');
                                                            ?>
                                                                <div class="row m-0 table-row">
                                                                    <div class="col-6 p-0">
                                                                        <span class="txt-paragraph block lg"><strong><?php echo $language ?></strong></span>
                                                                    </div>
                                                                    <div class="col-6 p-0">
                                                                        <span class="txt-paragraph block lg"><?php echo $fluency ?></span>
                                                                    </div>
                                                                </div>
                                                            <?php endwhile; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if( have_rows('appearance_fields') ): ?>
                                        <div class="profile-stat">
                                            <div class="stats">
                                                <button class="accordion-toggle mb-16 mob-mb-0">
                                                    <span class="txt-heading block md text-center">
                                                        <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                            APARÊNCIA
                                                        <?php else : ?>
                                                            APPEARANCE
                                                        <?php endif; ?>
                                                    </span>
                                                    <span class="arrow"></span>
                                                </button>
                                                
                                                <div class="accordion-content">
                                                    <div class="row">
                                                        <div class="table-style">
                                                            <?php
                                                                while( have_rows('appearance_fields') ) : the_row();
                                                                    $label = get_sub_field('label');
                                                                    $value = get_sub_field('value');
                                                            ?>
                                                                <div class="row m-0 table-row">
                                                                    <div class="col-6 p-0">
                                                                        <span class="txt-paragraph block lg"><strong><?php echo $label ?></strong></span>
                                                                    </div>
                                                                    <div class="col-6 p-0">
                                                                        <span class="txt-paragraph block lg"><?php echo $value ?></span>
                                                                    </div>
                                                                </div>
                                                            <?php endwhile; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if( have_rows('rate') ): 
                                        $rates = get_field('rate');?>
                                        <div class="profile-rate">
                                            <button class="accordion-toggle mb-16 mob-mb-0">
                                                <span class="txt-heading block uppercase md text-center">
                                                    <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                        Tarifas
                                                    <?php else : ?>
                                                        Rates
                                                    <?php endif; ?>
                                                </span>
                                                <span class="arrow"></span>
                                            </button>

                                            <div class="accordion-content">
                                                <div class="box-rate">
                                                    <?php if ($rates && count($rates) != 1) : ?>
                                                        <ul class="nav nav-pills" id="myTab" role="tablist">
                                                            <?php
                                                                while( have_rows('rate') ) : the_row();
                                                                    $currency = get_sub_field('currency');
                                                            ?>
                                                                <li class="nav-item" role="presentation">
                                                                    <?php if (get_row_index() == 1): ?>
                                                                        <button class="nav-link active" id="<?php echo $currency ?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo $currency ?>" type="button" role="tab" aria-controls="<?php echo $currency ?>" aria-selected="true"><?php echo $currency ?></button>
                                                                    <?php else: ?>
                                                                        <button class="nav-link" id="<?php echo $currency ?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo $currency ?>" type="button" role="tab" aria-controls="<?php echo $currency ?>" aria-selected="false"><?php echo $currency ?></button>
                                                                    <?php endif; ?>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        </ul>
                                                    <?php endif; ?>

                                                    <div class="tab-content mt-3" id="myTabContent">
                                                        <?php
                                                            while( have_rows('rate') ) : the_row();
                                                                $currency = get_sub_field('currency');
                                                            ?>
                                                                <?php if (get_row_index() == 1): ?>
                                                                    <div class="tab-pane fade show active" id="<?php echo $currency ?>" role="tabpanel" aria-labelledby="<?php echo $currency ?>-tab">
                                                                <?php else: ?>
                                                                    <div class="tab-pane fade" id="<?php echo $currency ?>" role="tabpanel" aria-labelledby="<?php echo $currency ?>-tab">
                                                                <?php endif; ?>
                                                                    <div class="rate row m-0">
                                                                        <div class="col-4 p-0">
                                                                            <div class="duration">
                                                                                <div class="table-style">
                                                                                    <span class="txt-paragraph lg block bold uppercase">&nbsp;</span>
                                                                                    <?php
                                                                                        while( have_rows('values') ) : the_row();
                                                                                            $duration = get_sub_field('duration');
                                                                                            $value = get_sub_field('value');
                                                                                            $outcall = get_sub_field('outcall');
                                                                                        ?>
                                                                                            <div class="table-row pr-0">
                                                                                                <span class="txt-paragraph lg block bold"><?php echo $duration ?></span>
                                                                                            </div>
                                                                                    <?php endwhile; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-4 p-0">
                                                                            <div class="value">
                                                                                <div class="table-style">
                                                                                    <span class="txt-paragraph lg block bold uppercase">Incall</span>
                                                                                    <?php
                                                                                        while( have_rows('values') ) : the_row();
                                                                                            $duration = get_sub_field('duration');
                                                                                            $value = get_sub_field('value');
                                                                                            $outcall = get_sub_field('outcall');

                                                                                            if (empty($outcall)) {
                                                                                                $outcall = '-';
                                                                                            }
                                                                                        ?>
                                                                                            <div class="table-row pl-0">
                                                                                                <span class="txt-paragraph lg block bold uppercase"><?php echo $value ?></span>
                                                                                            </div>
                                                                                    <?php endwhile; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-4 p-0">
                                                                            <div class="value">
                                                                                <div class="table-style">
                                                                                    <span class="txt-paragraph lg block bold uppercase">Outcall</span>
                                                                                    <?php
                                                                                        while( have_rows('values') ) : the_row();
                                                                                            $duration = get_sub_field('duration');
                                                                                            $value = get_sub_field('value');
                                                                                            $outcall = get_sub_field('outcall');

                                                                                            if (empty($outcall)) {
                                                                                                $outcall = '-';
                                                                                            }
                                                                                        ?>
                                                                                            <div class="table-row pl-0">
                                                                                                <span class="txt-paragraph lg block bold uppercase"><?php echo $outcall ?></span>
                                                                                            </div>
                                                                                    <?php endwhile; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        <?php endwhile; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php $services = get_field('services'); 

                                        if( $services ) : ?>
                                        <div class="profile-personal-services">
                                            <button class="accordion-toggle mb-16 mob-mb-0">
                                                <span class="txt-heading block uppercase md">
                                                    <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                        Meus serviços
                                                    <?php else : ?>
                                                        My services
                                                    <?php endif; ?>
                                                </span>
                                                <span class="arrow"></span>
                                            </button>

                                            <div class="accordion-content">
                                                <div class="tags">
                                                    <div class="row w-100">
                                                        <?php foreach( $services as $service ): ?>
                                                            <div class="col-6 tag">
                                                                <a href="<?php echo get_permalink($service->ID); ?>">
                                                                    <?php echo get_the_title($service->ID); ?>
                                                                </a>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php wp_reset_postdata(); ?>
                                    <?php endif; ?>

                                    <?php $maps = get_field('maps'); 

                                        if( $maps ) : ?>
                                        <div class="profile-maps mb-30">
                                            <button class="accordion-toggle mb-16 mob-mb-0">
                                                <span class="txt-heading block uppercase md">
                                                    <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                        Localização de Incall
                                                    <?php else : ?>
                                                        Incall Location 
                                                    <?php endif; ?>
                                                </span>
                                                <span class="arrow"></span>
                                            </button>

                                            <div class="accordion-content">
                                                <div class="row">
                                                    <?php echo $maps; ?>

                                                    <div class="col-12 mt-24 gap-2 d-flex justify-content-between">
                                                        <?php 
                                                            $direction_link = get_field('direction_link'); 
                                                            $street_view_link = get_field('street_view_link'); 
                                                        ?>
                                                        
                                                        <?php if ($direction_link) : ?>
                                                            <a href="<?php echo $direction_link; ?>" class="button bold medium w-100">
                                                                <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                                    Direções 
                                                                <?php else : ?>
                                                                    Directions 
                                                                <?php endif; ?>
                                                            </a>
                                                        <?php endif;?>
                                                        <?php if ($street_view_link) : ?>
                                                            <a href="<?php echo $street_view_link; ?>" target="_blank" class="button bold medium w-100">
                                                                Street View
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php wp_reset_postdata(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Top Escort Section -->
            <?php
                $args = array(
                    'post_type' => 'profile',
                    'status' => 'publish',
                    'showposts' => 4,
                    'lang' => pll_current_language('slug'), // 'pt' ou 'en' conforme a tela
                    'post__not_in' => array($post->ID),
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

                $more = new WP_Query($args);

                if (!empty($more->posts)): ?>
                    <div class="related">
                        <div class="title">
                            <div class="container">
                                <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                    <h2>Você também pode gostar</h2>
                                <?php else : ?>
                                    <h2>You may also like</h2>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="container">
                            <div class="swiper slider-top-escorts">
                                <div class="swiper-wrapper">
                                    <?php foreach ( $more->posts as $post ): /*echo '<pre>'; var_dump($post); echo '</pre>'*/; 
                                        $photos = get_field( 'photos' );

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

                                <div class="swiper-button-next swiper-button-next-top-escorts"></div>
                                <div class="swiper-button-prev swiper-button-prev-top-escorts"></div>
                            </div>

                            <div class="d-flex justify-content-center mt-30">
                                <a href="<?php echo get_home_url(); ?>/escorts" class="button bold white">
                                    <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                        Ver todas as acompanhantes
                                    <?php else : ?>
                                        See all escorts
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif;
                wp_reset_query();
            ?>
        </div>
    </section>
<?php
	get_footer();
?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggles = document.querySelectorAll('.accordion-toggle');

        toggles.forEach(toggle => {
            const content = toggle.nextElementSibling;

            // Inicializa visibilidade com base na classe
            if (window.innerWidth < 768 && toggle.classList.contains('active')) {
                content.style.display = 'block';
            }

            toggle.addEventListener('click', function () {
                if (window.innerWidth < 768) {
                    const isOpen = this.classList.contains('active');
                    this.classList.toggle('active');
                    content.style.display = isOpen ? 'none' : 'block';
                }
            });
        });
    });
</script>
