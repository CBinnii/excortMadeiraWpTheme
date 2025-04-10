<meta name="description" content="<?php echo the_field('meta_description'); ?>">
<meta name="keywords" content="<?php echo the_field('meta_key'); ?>">

<?php 
	get_header();
?>

    <section class="main">
        <div class="section">
            <div class="section-general-banner slider">
                <div class="swiper slider-general">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="banner-image" style="background-image: url('<?php echo wp_get_attachment_url(get_post_thumbnail_id(), 'full');?>');">
                                <div class="overlay white"></div>
                                <div class="container">
                                    <div class="banner-text">
                                        <h1>Pricing</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-button-next swiper-button-next-slider-general"></div>
                <div class="swiper-button-prev swiper-button-prev-slider-general"></div>
            </div>

            <div class="section-pricing">
                <div class="title pt-0">
                    <div class="container">
                        <h3>Payment and rate</h3>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <?php echo apply_filters('the_content', $post->post_content); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
	get_footer();
?>