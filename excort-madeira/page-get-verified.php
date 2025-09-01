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
                <div class="section-about pb-0">
                    <div class="title">
                        <div class="container">
                            <h2><?php echo $title_text_field_1_page; ?></h2>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="content">
                                <div class="col-md-12">
                                    <?php echo apply_filters('the_content', $text_field_1_page); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="section-booking bg-light">
                <div class="container">
                    <div class="booking">
                        <div class="row m-0">
                            <div class="col-12 p-0">
                                <div class="form-booking form-verified">
                                    <form id="verifiedForm">
                                        <div class="row mb-24">
                                            <div class="col-md-6 mob-mb-8">
                                                <label for="firstName" class="form-label">First name</label>
                                                <input type="text" class="form-control" id="firstName" name="firstName" required placeholder="First name">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lastName" class="form-label">Last name</label>
                                                <input type="text" class="form-control" id="lastName" name="lastName" required placeholder="Last name">
                                            </div>
                                        </div>

                                        <div class="row mb-24">
                                            <div class="col-md-6 mob-mb-8">
                                                <label for="nationality" class="form-label">Nationality</label>
                                                <input type="text" class="form-control" id="nationality" name="nationality" required placeholder="Your nationality"> 
                                            </div>
                                            <div class="col-md-6">
                                                <label for="birthYear" class="form-label">Birth year</label>
                                                <input type="text" class="form-control" id="birthYear" name="birthYear" required placeholder="Birth year">
                                            </div>
                                        </div>

                                        <div class="row mb-24">
                                            <div class="col-md-6 mob-mb-8">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input type="email" class="form-control" id="email" name="email" required placeholder="name@example.com">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" required placeholder="Your phone">
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-24">
                                            <span class="txt-paragraph lg uppercase block mb-16">Verification Method</span>
                                            <div class="col-12 mb-24">
                                                <input class="form-check-input m-0" type="radio" name="verified" id="id" required value="ID">
                                                <label class="form-check-label m-0" for="man">
                                                    ID
                                                </label>
                                            </div>
                                            <div class="col-12 mb-24">
                                                <input class="form-check-input m-0" type="radio" name="verified" id="transfer" required value="€1 transfer via Wise or Revolut">
                                                <label class="form-check-label m-0" for="transfer">
                                                    €1 transfer via Wise or Revolut
                                                </label>
                                            </div>
                                            <div class="col-12 mb-24">
                                                <input class="form-check-input m-0" type="radio" name="verified" id="hotel-screen" required value="Hotel screenshot">
                                                <label class="form-check-label m-0" for="couple">
                                                    Hotel screenshot
                                                </label>
                                            </div>
                                            <div class="col-12 mb-24">
                                                <input class="form-check-input m-0" type="radio" name="verified" id="hotel-phone" required value="Hotel phone verification">
                                                <label class="form-check-label m-0" for="couple">
                                                    Hotel phone verification
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row mb-24">
                                            <span class="txt-paragraph lg uppercase block mb-16">Accept terms</span>
                                            <div class="col-12 mb-24">
                                                <input class="form-check-input m-0" type="checkbox" name="confirm1" id="confirm1" value="I confirm I am over 18 years of age">
                                                <label class="form-check-label m-0" for="confirm1" style="display: inline;">
                                                    I confirm I am over 18 years of age.
                                                </label>
                                            </div>
                                            <div class="col-12 mb-24">
                                                <input class="form-check-input m-0" type="checkbox" name="confirm2" id="confirm2" value="I understand the girl next door only facilitates introductions">
                                                <label class="form-check-label m-0" for="confirm2" style="display: inline;">
                                                    I understand the girl next door only facilitates introductions.
                                                </label>
                                            </div>
                                            <div class="col-12 mb-24">
                                                <input class="form-check-input m-0" type="checkbox" name="confirm4" id="confirm4" value="I agree to the Privacy Policy and Terms & Conditions">
                                                <label class="form-check-label m-0" for="confirm4" style="display: inline;">
                                                    I agree to the <a href="<?php echo get_home_url(); ?>/privacy-policy-2" target="_blank">Privacy Policy</a> and <a href="<?php echo get_home_url(); ?>/terms-conditions" target="_blank">Terms & Conditions</a>.
                                                </label>
                                            </div>
                                            <div class="col-12 mb-24">
                                                <input class="form-check-input m-0" type="checkbox" name="confirm5" id="confirm5" value="I understand all introductions are subject to verification">
                                                <label class="form-check-label m-0" for="confirm5" style="display: inline;">
                                                    I understand all introductions are subject to verification.
                                                </label>
                                            </div>
                                        </div>

                                        <div>
                                            <!-- Google reCAPTCHA -->
                                            <div id="html_element" class="mb-3"></div>
                                        </div>

                                        <div class="d-flex justify-content-start">
                                            <button type="submit" id="submit" class="button white bold">Get Verified</button>
                                            <button disabled id="submited" class="button white bold" style="display: none">Get Verified</button>
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
                <div class="section-about pb-0">
                    <div class="title">
                        <div class="container">
                            <h2><?php echo $title_text_field_2_page; ?></h2>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="content">
                                <div class="col-md-12">
                                    <?php echo apply_filters('the_content', $text_field_2_page); ?>
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
                                <h2>Our Blog</h2>
                            </div>
                        </div>

                        <div class="container">
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
        $("#verifiedForm").submit(function (event) {
            event.preventDefault(); // Evita o reload da página

            // Verificar se todos os checkboxes obrigatórios estão marcados
            const requiredCheckboxes = ['#confirm1', '#confirm2', '#confirm4', '#confirm5'];
            let allChecked = true;

            requiredCheckboxes.forEach(function(selector) {
                if (!$(selector).is(':checked')) {
                    allChecked = false;
                }
            });

            if (!allChecked) {
                $("#formMessage").html('<p style="color: red;">Please check all the required confirmations before submitting the form.</p>');
                return; // Impede o envio
            }
            
            var formData = $(this).serialize(); // Serializa os dados do formulário

            // Alterna a visibilidade dos botões
            document.getElementById('submit').style.display = 'none';
            document.getElementById('submited').style.display = 'block';
            
            $.ajax({
                type: "POST",
                url: "<?php echo get_template_directory_uri(); ?>/vendor/verified.php",
                data: formData,
                dataType: "json",
                success: function (response) {
                    console.log("AJAX Response:", response);

                    if (response.status === "success") {
                        $("#formMessage").html('<p style="color: green;">' + response.message + '</p>');
                        $("#verifiedForm")[0].reset(); // Clear the form
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