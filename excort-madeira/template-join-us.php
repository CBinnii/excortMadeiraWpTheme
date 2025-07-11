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
    /**
     * Template Name: Join Us
     * Description: Personalized Page "Join Us"
     */

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
                            <h2><?php echo $title_text_field_1_page; ?></h2>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="content">
                                <div class="col-md-12">
                                    <p><?php echo $text_field_1_page; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="section-booking border-bottom">
                <div class="container">
                    <div class="booking">
                        <div class="row m-0">
                            <div class="col-md-6 p-0">
                                <div class="image-booking">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bg-8.png" alt="">
                                </div>
                            </div>
                            <div class="col-md-6 p-0">
                                <div class="form-booking">
                                    <form id="castingForm">
                                        <div class="row mb-16">
                                            <div class="col-md-6 mb-16">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Your name">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Your e-mail">
                                            </div>
                                        </div>

                                        <div class="row mb-16">
                                            <div class="col-md-6 mb-16">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone number">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="city" class="form-label">City</label>
                                                <input type="text" class="form-control" id="city" name="city" placeholder="City">
                                            </div>
                                        </div>

                                        <div class="row mb-16">
                                            <div class="col-md-6 mb-16">
                                                <label for="nacionality" class="form-label">Nacionality</label>
                                                <input type="text" class="form-control" id="nacionality" name="nacionality" placeholder="Your nacionality">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="country" class="form-label">Country</label>
                                                <input type="text" class="form-control" id="country" name="country" placeholder="Your country"> 
                                            </div>
                                        </div>

                                        <div class="row mb-16">
                                            <div class="col-md-6 mb-16">
                                                <label for="instagram" class="form-label">Intagram</label>
                                                <input type="text" class="form-control" id="instagram" name="instagram" placeholder="@Instagram">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="age" class="form-label">Age</label>
                                                <input type="number" class="form-control" id="age" name="age" placeholder="Your age"> 
                                            </div>
                                        </div>

                                        <div class="row mb-16">
                                            <div class="col-md-4 mb-16">
                                                <label for="chest" class="form-label">Chest</label>
                                                <input type="text" class="form-control" id="chest" name="chest" placeholder="Chest (cm)">
                                            </div>
                                            <div class="col-md-4 mb-16">
                                                <label for="hip" class="form-label">Hip</label>
                                                <input type="text" class="form-control" id="hip" name="hip" placeholder="Hip (cm)"> 
                                            </div>
                                            <div class="col-md-4">
                                                <label for="waist" class="form-label">Waist</label>
                                                <input type="text" class="form-control" id="waist" name="waist" placeholder="Waist (cm)"> 
                                            </div>
                                        </div>

                                        <div class="mb-16">
                                            <label for="languages" class="form-label">Languages</label>
                                            <input type="text" class="form-control" id="languages" name="languages" placeholder="Languages">
                                        </div>

                                        <div class="mb-16">
                                            <label for="experience" class="form-label">Experience</label>
                                            <input type="text" class="form-control" id="experience" name="experience" placeholder="Experience">
                                        </div>

                                        <div class="mb-16">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="2" placeholder="Describe you"></textarea>
                                        </div>

                                        <div class="mb-16">
                                            <label for="profile" class="form-label">Profile</label>
                                            <input type="file" class="form-control" id="profile" name="profile" placeholder="Profile">
                                        </div>

                                        <div class="mb-16">
                                            <label for="wholeBody" class="form-label">Whole body</label>
                                            <input type="file" class="form-control" id="wholeBody" name="wholeBody" placeholder="Whole body">
                                        </div>

                                        <div class="mb-16">
                                            <label for="selfie" class="form-label">Selfie</label>
                                            <input type="file" class="form-control" id="selfie" name="selfie" placeholder="Selfie">
                                        </div>

                                        <div>
                                            <!-- Google reCAPTCHA -->
                                            <div id="html_element" class="mb-16"></div>
                                        </div>
                
                                        <div class="d-flex justify-content-start mb-16">
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
                <div class="section-about bg-white pb-0">
                    <div class="title">
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
                    'showposts' => 2,
                );

                $more = new WP_Query( $args );

			    if (!empty($more->posts)): ?>
                    <div class="section-blog bg-white">
                        <div class="title">
                            <div class="container">
                                <h3>Blog</h3>
                            </div>
                        </div>

                        <div class="container">
                            <div class="row row-adjustment">
                                <?php foreach ( $more->posts as $post ): /*echo '<pre>'; var_dump($post); echo '</pre>';*/ ?>
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
        $("#castingForm").submit(function (event) {
            event.preventDefault(); // Evita o reload da página
            
            var formData = $(this).serialize(); // Serializa os dados do formulário

            // Alterna a visibilidade dos botões
            document.getElementById('submit').style.display = 'none';
            document.getElementById('submited').style.display = 'block';
            
            $.ajax({
                type: "POST",
                url: "<?php echo get_template_directory_uri(); ?>/vendor/casting.php",
                data: formData,
                dataType: "json",
                success: function (response) {
                    console.log("AJAX Response:", response);

                    if (response.status === "success") {
                        $("#formMessage").html('<p style="color: green;">' + response.message + '</p>');
                        $("#castingForm")[0].reset(); // Clear the form
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