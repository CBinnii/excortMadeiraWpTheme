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
                                    <?php echo apply_filters('the_content', $text_field_1_page); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="section-single-page">
                <div class="title pt-0">
                    <div class="container">
                        <h2><?php echo get_the_title(); ?></h2>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="content">
                            <?php echo apply_filters('the_content', $post->post_content); ?>

                            <div class="advertise-contact">
                                <?php 
                                    $whatsapp = get_field('whatsapp_url', 'option');
                                    $phone = get_field('phone', 'option');
                                    $clean_phone = preg_replace('/[^\d+]/', '', $phone);
                                ?>
                                <ul>
                                    <li>
                                        <?php if($whatsapp): ?>
                                            <a href="<?php echo $whatsapp; ?>" target="_blank">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/whatsapp.svg" width="24" alt="Whatsapp icon"> Whatsapp
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <?php if($phone): ?>
                                            <a href="tel:<?php echo $clean_phone; ?>" target="_blank">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/phone.svg" width="24" alt="Telegram icon"> <?php echo $phone; ?>
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                </ul>
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
                                    <?php echo apply_filters('the_content', $text_field_2_page); ?>
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