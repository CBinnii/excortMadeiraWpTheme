<meta name="description" content="<?php echo the_field('meta_description'); ?>">
<meta name="title" content="<?php echo the_field('meta_title'); ?>">

<!-- Adicionando o script do Google reCAPTCHA -->
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<script>
    // Função de callback chamada quando o reCAPTCHA é carregado
    // Você pode usar essa função para inicializar o reCAPTCHA ou executar outras ações
    // Exemplo: exibir um alerta quando o reCAPTCHA estiver pronto
    // Você pode remover ou modificar essa função conforme necessário
    // Se você não precisar dela, pode removê-la
    var onloadCallback = function() {
        // Aqui você pode inicializar o reCAPTCHA, se necessário
        grecaptcha.render('html_element', {
            'sitekey' : '6Lf8zgQrAAAAADm4g0KXA_y0G0-9cx4-SwL-5-ES'
        });
    };
</script>
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
                                            <h1><?php echo get_the_title(); ?></h1>
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
                                        <h1><?php echo get_the_title(); ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

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

            <div class="section-booking border-bottom">
                <div class="container">
                    <div class="booking">
                        <div class="row m-0">
                            <div class="col-12 p-0">
                                <div class="form-booking">
                                    <form id="bookingForm">
                                        <div class="mb-24">
                                            <label for="exampleFormControlInput1" class="form-label">Choose your escort</label>

                                            <?php
                                                $args = array(
                                                    'post_type'      => 'profile',
                                                    'posts_per_page' => -1,
                                                    'orderby'        => 'title',
                                                    'order'          => 'ASC',
                                                );
                                            
                                                $query = new WP_Query($args);
                                            ?>
                                            <select class="form-select" aria-label="Default select example" name="escort">
                                                <option selected>Choose your escort</option>
                                                
                                                <?php if ($query->have_posts()) {
                                                    foreach ( $query->posts as $post ) {
                                                ?>
                                                    <option value="<?php echo get_the_title($post->ID); ?>"><?php echo get_the_title($post->ID); ?></option>
                                                <?php
                                                    }
                                                } ?>
                                            </select>
                                        </div>

                                        <span class="txt-paragraph lg uppercase block mb-16 white">Your details</span>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput3" class="form-label mb-3">Have you booked with us before? </label>
                                                <div class="row mb-3">
                                                    <div class="col-4">
                                                        <input class="form-check-input m-0" type="radio" name="bookedBefore" id="bookedBefore1" value="Yes">
                                                        <label class="form-check-label m-0" for="bookedBefore1">
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="col-4">
                                                        <input class="form-check-input m-0" type="radio" name="bookedBefore" id="bookedBefore2" value="No">
                                                        <label class="form-check-label m-0" for="bookedBefore2">
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput3" class="form-label mb-3">You are: </label>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <input class="form-check-input m-0" type="radio" name="youAre" id="man" value="Man">
                                                        <label class="form-check-label m-0" for="man">
                                                            Man
                                                        </label>
                                                    </div>
                                                    <div class="col-4">
                                                        <input class="form-check-input m-0" type="radio" name="youAre" id="woman" value="Woman">
                                                        <label class="form-check-label m-0" for="woman">
                                                            Woman
                                                        </label>
                                                    </div>
                                                    <div class="col-5">
                                                        <input class="form-check-input m-0" type="radio" name="youAre" id="couple" value="Couple">
                                                        <label class="form-check-label m-0" for="couple">
                                                            Couple
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6 mob-mb-8">
                                                <label for="firstName" class="form-label">First name</label>
                                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First name">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lastName" class="form-label">Last name</label>
                                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last name">
                                            </div>
                                        </div>
                                        <div class="row mb-24">
                                            <div class="col-md-6 mob-mb-8">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Your phone">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4 mob-mb-8">
                                                <label for="telegram" class="form-label">Telegram</label>
                                                <input type="text" class="form-control" id="telegram" name="telegram" placeholder="Telegram username">
                                            </div>
                                            <div class="col-md-4 mob-mb-8">
                                                <label for="nationality" class="form-label">Nationality</label>
                                                <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Your nacionality"> 
                                            </div>
                                            <div class="col-md-4">
                                                <label for="birthYear" class="form-label">Birth year</label>
                                                <input type="text" class="form-control" id="birthYear" name="birthYear" placeholder="Birth year">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="introduceYourself" class="form-label">Introduce yourself</label>
                                            <textarea class="form-control" id="introduceYourself" name="introduceYourself" rows="4" placeholder="Introduce yourself"></textarea>
                                        </div>
                                        
                                        <span class="txt-paragraph lg uppercase block mb-16 white">Booking details</span>
                                        <div class="row mb-3">
                                            <div class="col-md-6 mob-mb-8">
                                                <label for="date" class="form-label">Date</label>
                                                <input type="date" class="form-control" id="date" name="date" placeholder="Date">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="time" class="form-label">Time</label>
                                                <input type="time" class="form-control" id="time" name="time" placeholder="Time">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6 mob-mb-8">
                                                <label for="duration" class="form-label">Booking duration</label>
                                                <input type="text" class="form-control" id="duration" name="duration" placeholder="Duration">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="country" class="form-label">Country</label>
                                                <input type="text" class="form-control" id="country" name="country" placeholder="Country">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Full address">
                                        </div>
                                        <div class="mb-3">
                                            <label for="specialRequirement" class="form-label">Special Requirements</label>
                                            <textarea class="form-control" id="specialRequirement" name="specialRequirement" rows="3" placeholder="Do you have any requirement?"></textarea>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4 mob-mb-8">
                                                <input class="form-check-input m-0" type="radio" name="contactMeBy" id="contactMeBy1" value="Contact me by whatsapp">
                                                <label class="form-check-label m-0" for="contactMeBy1">
                                                    Contact me by whatsapp
                                                </label>
                                            </div>
                                            <div class="col-md-4 mob-mb-8">
                                                <input class="form-check-input m-0" type="radio" name="contactMeBy" id="contactMeBy2" value="Contact me by telegram">
                                                <label class="form-check-label m-0" for="contactMeBy2">
                                                    Contact me by telegram
                                                </label>
                                            </div>
                                            <div class="col-md-4 mob-mb-8">
                                                <input class="form-check-input m-0" type="radio" name="contactMeBy" id="contactMeBy3" value="Contact me by e-mail">
                                                <label class="form-check-label m-0" for="contactMeBy3">
                                                    Contact me by e-mail
                                                </label>
                                            </div>
                                        </div>

                                        <div>
                                            <!-- Google reCAPTCHA -->
                                            <div id="html_element" class="mb-3"></div>
                                        </div>

                                        <div class="d-flex justify-content-start mb-3">
                                            <button type="submit" id="submit" class="button white bold">Submit</button>
                                            <button disabled id="submited" class="button white bold" style="display: none">Submit</button>
                                        </div>
                                    </form>

                                    <!-- Onde será exibida a mensagem de retorno -->
                                    <div id="formMessage"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if( !empty($title_text_field_2_page) || !empty($text_field_2_page) ): ?>
                <div class="section-about bg-white">
                    <div class="title pt-0">
                        <div class="container">
                            <h2><?php echo $title_text_field_2_page; ?></h2>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="content">
                                <div class="col-md-12">
                                    <p><?php echo $text_field_2_page; ?></p>
                                </div>
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
                    <div class="section-blog bg-white">
                        <div class="title">
                            <div class="container">
                                <h2>Blog</h2>
                            </div>
                        </div>

                        <div class="container">
                            <div class="row row-adjustment">
                                <?php foreach ( $more->posts as $post ): /*echo '<pre>'; var_dump($post); echo '</pre>';*/ ?>
                                    <div class="col-md-4 col-adjustment">
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
                                <a href="blog" class="button bold white">
                                    Read more
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
    $(document).ready(function () {
        $("#bookingForm").submit(function (event) {
            event.preventDefault(); // Evita o reload da página
            
            var formData = $(this).serialize(); // Serializa os dados do formulário

            // Alterna a visibilidade dos botões
            document.getElementById('submit').style.display = 'none';
            document.getElementById('submited').style.display = 'block';
            
            $.ajax({
                type: "POST",
                url: "<?php echo get_template_directory_uri(); ?>/vendor/booking.php",
                data: formData,
                dataType: "json",
                success: function (response) {
                    console.log("AJAX Response:", response);

                    if (response.status === "success") {
                        $("#formMessage").html('<p style="color: green;">' + response.message + '</p>');
                        $("#bookingForm")[0].reset(); // Clear the form
                    } else {
                        $("#formMessage").html('<p style="color: red;">' + response.message + '</p>');
                    }

                    document.getElementById('submit').style.display = 'block';
                    document.getElementById('submited').style.display = 'none';
                },
                error: function (xhr, status, error) {
                    console.log("AJAX Error:", error);
                    console.log("Full response:", xhr.responseText);

                    $("#formMessage").html('<p style="color: red;">An error occurred while sending the form.</p>');

                    document.getElementById('submit').style.display = 'block';
                    document.getElementById('submited').style.display = 'none';
                }
            });
        });
    });
</script>