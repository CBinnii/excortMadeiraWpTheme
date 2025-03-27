<?php 
	get_header();

    $title_text_field_1_page = get_field('title_text_field_1_page');
    $text_field_1_page = get_field('text_field_1_page');
    $title_text_field_2_page = get_field('title_text_field_2_page');
    $text_field_2_page = get_field('text_field_2_page');
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
                                        <h1><?php echo get_the_title(); ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-button-next swiper-button-next-slider-general"></div>
                <div class="swiper-button-prev swiper-button-prev-slider-general"></div>
            </div>

            <?php if( !empty($title_text_field_1_page) || !empty($text_field_1_page) ): ?>
                <div class="section-about border-bottom">
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

            <div class="section-contact">
                <div class="container"> 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row contact">
                                <div class="col-12">
                                    <span class="txt-heading block md mb-16">Contact Details</span>
                                    <span class="txt-paragraph block lg mb-24">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque asperiores maiores inventore praesentium veniam molestias saepe, odio enim qui? Eveniet perspiciatis nihil velit dolorem provident nisi voluptatum labore in vero?</span>
                                </div>
                                
                                <div class="col-md-6">
                                    <h3 class="text-uppercase">Contact</h3>
                                    <p><a target="_blank" href="tel:+351999888555">(+351) 999 888 555</a></p>
                                    <p><a target="_blank" href="mailto:office@escort-madeira.com?subject=Contact via website&body=Hello">office@escort-madeira.com</a></p>
                                    <ul class="d-flex align-items-center">
                                        <li>
                                            <a href="#" target="_blank">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/whatsapp.svg" width="24" alt="Whatsapp icon">
                                            </a>
                                            <a href="#" target="_blank">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/telegram.svg" width="24" alt="Telegram icon">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
        
                                <div class="col-md-6">
                                    <h3 class="text-uppercase">Opening hours</h3>
                                    <p>Monday to friday 10h to 20h</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <form id="contactForm">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="firstName" class="form-label">First name</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First name">
                                    </div>
                                    <div class="col-6">
                                        <label for="lastName" class="form-label">Last name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last name">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone number">
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="How can we help you?"></textarea>
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
    </section>

<?php
	get_footer();
?>

<script>
    $(document).ready(function () {
        $("#contactForm").submit(function (event) {
            event.preventDefault(); // Evita o reload da página
            
            var formData = $(this).serialize(); // Serializa os dados do formulário

            // Alterna a visibilidade dos botões
            document.getElementById('submit').style.display = 'none';
            document.getElementById('submited').style.display = 'block';
            
            $.ajax({
                type: "POST",
                url: "<?php echo get_template_directory_uri(); ?>/vendor/contact.php",
                data: formData,
                dataType: "json",
                success: function (response) {
                    console.log("AJAX Response:", response);

                    if (response.status === "success") {
                        $("#formMessage").html('<p style="color: green;">' + response.message + '</p>');
                        $("#contactForm")[0].reset(); // Clear the form
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