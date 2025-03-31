<meta name="description" content="<?php echo the_field('meta_description'); ?>">
<meta name="keywords" content="<?php echo the_field('meta_key'); ?>">

<?php 
	get_header();

    $bio = get_field('bio');
    $age = get_field('age');
    $height = get_field('height');
    $eyes = get_field('eyes');
    $bust = get_field('bust');
    $weight = get_field('weight');
    $hair = get_field('hair');
    $shoes = get_field('shoes');
    $nationality = get_field('nationality');
    $location = get_field('location');
    $photos = get_field( 'photos' );

    $terms = get_the_terms( $post->ID, 'personal-detail' );
?>
    <section class="profile">
        <div class="section">
            <?php if (has_post_thumbnail($post)) : ?>
                <div class="section-general-banner slider">
                    <div class="swiper slider-general-profile">
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

                    <!-- <div class="swiper-button-next swiper-button-next-slider-general"></div>
                    <div class="swiper-button-prev swiper-button-prev-slider-general"></div> -->
                </div>
            <?php endif; ?>

            <div class="section-profile">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-5">
                            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper profile-slider">
                                <div class="swiper-wrapper">
                                    <?php foreach( $photos as $photo ): ?>
                                        <div class="swiper-slide">
                                            <div class="escort-box">
                                                <div class="image" style="background-image: url('<?php echo esc_url($photo); ?>');"></div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="swiper-button-next swiper-button-next-profile"></div>
                                <div class="swiper-button-prev swiper-button-prev-profile"></div>
                            </div>
                            <div thumbsSlider="" class="swiper profile-thumb">
                                <div class="swiper-wrapper">
                                    <?php foreach( $photos as $photo ): ?>
                                        <div class="swiper-slide">
                                            <a data-fslightbox="gallery_1" href="<?php echo esc_url($photo); ?>">
                                                <img src="<?php echo esc_url($photo); ?>" />
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="profile-info mobile mob-mt-24 mob-mb-24">
                                <div class="profile-info-box">
                                    <div class="profile-title">
                                        <div>
                                            <h3><?php echo get_the_title(); ?></h3>
                                            <span class="txt-paragraph xl">Age: <?php echo $age ?> years</span>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <a href="booking" class="button bold medium">
                                                BOOK NOW
                                            </a>
                                        </div>
                                    </div>

                                    <div class="profile-location">
                                        <div class="d-flex align-items-center gap-16">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/location.svg" alt="Location icon">
                                            <span class="txt-paragraph md">Location: <strong><?php echo $location ?></strong></span>
                                        </div>
                                    </div>

                                    <div class="profile-stat">
                                        <div class="stats">
                                            <span class="txt-heading block md mb-16">STATS</span>

                                            <div class="row d-flex align-items-center mb-16">
                                                <div class="col-3 col-md-3">
                                                    <span class="txt-paragraph block lg"><strong>Height</strong></span>
                                                    <span class="txt-paragraph block lg"><?php echo $height ?>m</span>
                                                </div>

                                                <div class="col-3 col-md-3">
                                                    <span class="txt-paragraph block lg"><strong>Eyes</strong></span>
                                                    <span class="txt-paragraph block lg"><?php echo $eyes ?></span>
                                                </div>

                                                <div class="col-3 col-md-3">
                                                    <span class="txt-paragraph block lg"><strong>Bust</strong></span>
                                                    <span class="txt-paragraph block lg"><?php echo $bust ?></span>
                                                </div>

                                                <div class="col-3 col-md-3">
                                                    <span class="txt-paragraph block lg"><strong>Weight</strong></span>
                                                    <span class="txt-paragraph block lg"><?php echo $weight ?></span>
                                                </div>
                                            </div>

                                            <div class="row d-flex align-items-center mb-30">
                                                <div class="col-3 col-md-3">
                                                    <span class="txt-paragraph block lg"><strong>Age</strong></span>
                                                    <span class="txt-paragraph block lg"><?php echo $age ?></span>
                                                </div>

                                                <div class="col-3 col-md-3">
                                                    <span class="txt-paragraph block lg"><strong>Hair</strong></span>
                                                    <span class="txt-paragraph block lg"><?php echo $hair ?></span>
                                                </div>

                                                <div class="col-3 col-md-3">
                                                    <span class="txt-paragraph block lg"><strong>Shoes</strong></span>
                                                    <span class="txt-paragraph block lg"><?php echo $shoes ?></span>
                                                </div>

                                                <div class="col-3 col-md-3">
                                                    <span
                                                        class="txt-paragraph block lg"><strong>Nationality</strong></span>
                                                    <span class="txt-paragraph block lg"><?php echo $nationality ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="profile-bio">
                                        <span class="txt-heading block md mb-16">My Bio</span>

                                        <?php echo apply_filters('the_content', $bio); ?>
                                    </div>

                                    <div class="profile-rate">
                                        <span class="txt-heading block uppercase md mb-16">My Rates</span>

                                        <div class="box-rate">
                                            <ul class="nav nav-pills" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="eur-tab" data-bs-toggle="tab" data-bs-target="#eur" type="button" role="tab" aria-controls="eur" aria-selected="true">EUR</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="usd-tab" data-bs-toggle="tab" data-bs-target="#usd" type="button" role="tab" aria-controls="usd" aria-selected="false">USD</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="gbp-tab" data-bs-toggle="tab" data-bs-target="#gbp" type="button" role="tab" aria-controls="gbp" aria-selected="false">GBP</button>
                                                </li>
                                            </ul>

                                            <div class="tab-content mt-3" id="myTabContent">
                                                <div class="tab-pane fade show active" id="eur" role="tabpanel" aria-labelledby="eur-tab">
                                                    <div class="rate row">
                                                        <div class="col-6">
                                                            <div class="duration">
                                                                <span class="txt-heading sm block bold uppercase mb-16 red">Duration</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">1 hour</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">2 hours</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">Aditional hour</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">Overnaight</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="value">
                                                                <span class="txt-heading sm block bold uppercase mb-16 red">Outcall</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">€200</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">€300</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">€100</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">€1500</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="usd" role="tabpanel" aria-labelledby="usd-tab">
                                                    <div class="rate row">
                                                        <div class="col-6">
                                                            <div class="duration">
                                                                <span class="txt-heading sm block bold uppercase mb-16 red">Duration</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">1 hour</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">2 hours</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">Aditional hour</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">Overnaight</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="value">
                                                                <span class="txt-heading sm block bold uppercase mb-16 red">Outcall</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">$200</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">$300</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">$100</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">$1500</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="gbp" role="tabpanel" aria-labelledby="gbp-tab">
                                                    <div class="rate row">
                                                        <div class="col-6">
                                                            <div class="duration">
                                                                <span class="txt-heading sm block bold uppercase mb-16 red">Duration</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">1 hour</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">2 hours</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">Aditional hour</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">Overnaight</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="value">
                                                                <span class="txt-heading sm block bold uppercase mb-16 red">Outcall</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">£100</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">£250</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">£90</span>
                                                                <span class="txt-paragraph lg block bold uppercase mb-8">£1100</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box-payment">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/bitcoin.svg" alt="Bitcoin">

                                        <span>We also accept payments with all kinds of <strong>cryptocurrencies!</strong></span>
                                    </div>
                                </div>
                            </div>

                            <div class="profile-personal-details mb-30">
                                <span class="txt-heading block uppercase md mb-16">My personal details</span>

                                <div class="tags">
                                    <?php foreach( $terms as $term ): ?>
                                        <a href="<?php echo get_home_url(); ?>/personal-detail/<?php echo $term->slug ?>" class="tag">
                                            <?php echo $term->name; ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <?php 
                                $services = get_field('services'); 

                                if( $services ) :
                            ?>
                                <div class="profile-personal-services mb-30">
                                    <span class="txt-heading block uppercase md mb-16">My services</span>
                                    
                                    <div class="tags">
                                        <?php foreach( $services as $service ): ?>
                                            <a href="<?php echo get_permalink($service->ID); ?>" class="tag">
                                                <?php echo get_the_title($service->ID); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php wp_reset_postdata(); ?>
                            <?php endif; ?>
                            
                            <?php if( have_rows('languages') ): ?>
                                <div class="profile-languages">
                                    <span class="txt-heading block uppercase md mb-16">My languages</span>

                                    <div class="languages">
                                        <?php
                                            while( have_rows('languages') ) : the_row();
                                                $count = 5;
                                                $language = get_sub_field('language');
                                                $language_rate = get_sub_field('language_rate');

                                                $count = $count - $language_rate;
                                        ?>
                                            <div class="language mb-16">
                                                <span class="txt-paragraph lg block bold"><?php echo $language ?></span>
                                                <div class="d-flex align-items-center gap-8">
                                                    <?php for ($i=0; $i < $language_rate; $i++) { ?>
                                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/star-full.svg" alt="Full star">
                                                    <?php } ?>
                                                    <?php for ($i=0; $i < $count; $i++) { ?>
                                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/star.svg" alt="Star">
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-sm-7 desktop">
                            <div class="profile-info">
                                <div class="profile-info-box">
                                    <div class="profile-title">
                                        <div>
                                            <h3><?php echo get_the_title(); ?></h3>
                                            <span class="txt-paragraph xl">Age: <?php echo $age ?> years</span>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <a href="booking" class="button bold medium">
                                                BOOK NOW
                                            </a>
                                        </div>
                                    </div>

                                    <div class="profile-location">
                                        <div class="d-flex align-items-center gap-16">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/location.svg" alt="Location icon">
                                            <span class="txt-paragraph md">Location: <strong><?php echo $location ?></strong></span>
                                        </div>
                                    </div>

                                    <div class="profile-stat">
                                        <div class="stats">
                                            <span class="txt-heading block md mb-16">STATS</span>

                                            <div class="row d-flex align-items-center mb-16">
                                                <div class="col-3 col-md-3">
                                                    <span class="txt-paragraph block lg"><strong>Height</strong></span>
                                                    <span class="txt-paragraph block lg"><?php echo $height ?>m</span>
                                                </div>

                                                <div class="col-3 col-md-3">
                                                    <span class="txt-paragraph block lg"><strong>Eyes</strong></span>
                                                    <span class="txt-paragraph block lg"><?php echo $eyes ?></span>
                                                </div>

                                                <div class="col-3 col-md-3">
                                                    <span class="txt-paragraph block lg"><strong>Bust</strong></span>
                                                    <span class="txt-paragraph block lg"><?php echo $bust ?></span>
                                                </div>

                                                <div class="col-3 col-md-3">
                                                    <span class="txt-paragraph block lg"><strong>Weight</strong></span>
                                                    <span class="txt-paragraph block lg"><?php echo $weight ?></span>
                                                </div>
                                            </div>

                                            <div class="row d-flex align-items-center mb-30">
                                                <div class="col-3 col-md-3">
                                                    <span class="txt-paragraph block lg"><strong>Age</strong></span>
                                                    <span class="txt-paragraph block lg"><?php echo $age ?></span>
                                                </div>

                                                <div class="col-3 col-md-3">
                                                    <span class="txt-paragraph block lg"><strong>Hair</strong></span>
                                                    <span class="txt-paragraph block lg"><?php echo $hair ?></span>
                                                </div>

                                                <div class="col-3 col-md-3">
                                                    <span class="txt-paragraph block lg"><strong>Shoes</strong></span>
                                                    <span class="txt-paragraph block lg"><?php echo $shoes ?></span>
                                                </div>

                                                <div class="col-3 col-md-3">
                                                    <span
                                                        class="txt-paragraph block lg"><strong>Nationality</strong></span>
                                                    <span class="txt-paragraph block lg"><?php echo $nationality ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="profile-bio">
                                        <span class="txt-heading block md mb-16">My Bio</span>
                                        
                                        <?php echo apply_filters('the_content', $bio); ?>
                                    </div>
                                    
                                    <?php if( have_rows('rate') ): ?>
                                        <div class="profile-rate">
                                            <span class="txt-heading block uppercase md mb-16">My Rates</span>

                                            <div class="box-rate">
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
                                                                <div class="rate row">
                                                                    <div class="col-6">
                                                                        <div class="duration">
                                                                            <span class="txt-heading sm block bold uppercase mb-16 red">Duration</span>
                                                                            <?php
                                                                                while( have_rows('values') ) : the_row();
                                                                                    $duration = get_sub_field('duration');
                                                                                    $value = get_sub_field('value');
                                                                                ?>
                                                                                    <span class="txt-paragraph lg block bold uppercase mb-8"><?php echo $duration ?></span>
                                                                            <?php endwhile; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="value">
                                                                            <span class="txt-heading sm block bold uppercase mb-16 red">Outcall</span>
                                                                            <?php
                                                                                while( have_rows('values') ) : the_row();
                                                                                    $duration = get_sub_field('duration');
                                                                                    $value = get_sub_field('value');
                                                                                ?>
                                                                                    <span class="txt-paragraph lg block bold uppercase mb-8"><?php echo $value ?></span>
                                                                            <?php endwhile; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    <?php endwhile; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="box-payment">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/bitcoin.svg" alt="Bitcoin">

                                        <span>We also accept payments with all kinds of <strong>cryptocurrencies!</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="box-profile-authenticity">
                                <p>The pictures on the website are 100% real.</p>
                                <p>The models of our agency, who are on this website, offer their professional services as independent and autonomous; and they can be hired by our clients without having in any case a contract with our company. The agreements concerning their services, their remuneration and the methods of payment will be agreed between the client and the models. The photos, texts and data of the models on our website have been inserted at their request and with the content requested by them. The models are the ones who freely decide which are the services they perform for the clients and it must be the clients who specify and contract with the models such services without any intervention of the agency. At the request of the models, the web page of this agency informs of the remunerations that normally must pay their clients for the works they perform.</p>
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
                    'showposts' => 3,
                    'post__not_in' => array($post->ID),
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
                    <div class="related">
                        <div class="title">
                            <div class="container">
                                <h3>You may also like</h3>
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
            
            <div class="section-why bg-white">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 mob-mb-24 desktop">
                            <div class="image-about-us">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/about-us.png" alt="Welcome to Escort Madeira">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <h3>Why choose us?</h3>
                            <p>At <strong>Escort Madeira</strong>, we stand out as a leading <strong>escort agency in
                                    Madeira</strong>, exemplifying professionalism in every detail. We offer
                                personalized attention and guarantee strict privacy for both our clients and our models.
                                We ensure that all photos of our <strong>escorts in Madeira</strong> are accurate and up
                                to date, and we meticulously verify the rates to maintain the highest luxury standards
                                that characterize our elite agency.</p>
                            <p><strong>We promise to deliver the highest quality throughout the entire experience.</strong></p>
                            
                            <div class="swiper slider-why desktop">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="points bg-white">
                                            <div class="icon">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/verified.svg" alt="Icon 1">
                                            </div>
                                            <h4>Verified</h4>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="points bg-white">
                                            <div class="icon">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/easy.svg" alt="Icon 1">
                                            </div>
                                            <h4>Easy booking</h4>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="points bg-white">
                                            <div class="icon">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/support.svg" alt="Icon 1">
                                            </div>
                                            <h4>Best support</h4>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="points bg-white">
                                            <div class="icon">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/discret.svg" alt="Icon 1">
                                            </div>
                                            <h4>Discretion</h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-pagination-why"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
	get_footer();
?>