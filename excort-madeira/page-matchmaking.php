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

            <div class="section-contact">
                <div class="container"> 
                    <div class="row">
                        <div class="col-md-12">
                            <form id="matchMakingForm">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="gender" class="form-label"><strong>Gender</strong></label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="" disabled selected>Select gender</option>
                                            <option value="female">Female</option>
                                            <option value="male">Male</option>
                                            <option value="non-binary">Non-binary</option>
                                            <option value="prefer-not-to-say">Prefer not to say</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="firsName" class="form-label"><strong>First name</strong></label>
                                        <input type="text" class="form-control" id="firsName" name="firstName" placeholder="First name">
                                    </div>
                                    <div class="col-6">
                                        <label for="lastName" class="form-label"><strong>Last name</strong></label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last name">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label"><strong>E-mail</strong></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="confirmEmail" class="form-label"><strong>Confirm E-mail</strong></label>
                                    <input type="email" class="form-control" id="confirmEmail" placeholder="name@example.com">
                                    <div id="emailError" style="color: red; display: none;">Os e-mails não coincidem.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="aboutYou" class="form-label"><strong>About you</strong></label>
                                    <textarea name="aboutYou" id="aboutYou" class="form-control" rows="4" placeholder="Describe yourself"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput3" class="form-label"><strong>Which languages are you fluent in?</strong></label>
                                    <select name="languages[]" id="languages" class="form-select" multiple>
                                        <option value="Portuguese">Portuguese</option>
                                        <option value="English">English</option>
                                        <option value="Spanish">Spanish</option>
                                        <option value="French">French</option>
                                        <option value="Italian">Italian</option>
                                        <option value="German">German</option>
                                        <option value="Dutch">Dutch</option>
                                        <option value="Russian">Russian</option>
                                        <option value="Chinese">Chinese</option>
                                        <option value="Mandarin">Mandarin</option>
                                        <option value="Cantonese">Cantonese</option>
                                        <option value="Japanese">Japanese</option>
                                        <option value="Korean">Korean</option>
                                        <option value="Hindi">Hindi</option>
                                        <option value="Arabic">Arabic</option>
                                        <option value="Turkish">Turkish</option>
                                        <option value="Greek">Greek</option>
                                        <option value="Hebrew">Hebrew</option>
                                        <option value="Swedish">Swedish</option>
                                        <option value="Norwegian">Norwegian</option>
                                        <option value="Danish">Danish</option>
                                        <option value="Finnish">Finnish</option>
                                        <option value="Polish">Polish</option>
                                        <option value="Ukrainian">Ukrainian</option>
                                        <option value="Thai">Thai</option>
                                        <option value="Vietnamese">Vietnamese</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="conversation" class="form-label"><strong>What are you like as a conversationalist?</strong></label>
                                    <textarea name="conversation" id="conversation" class="form-control" rows="4" placeholder="What are you like as a conversationalist?"></textarea>
                                </div>
                                <div class="row mb-3">
                                    <label for="MoreIntroOrExtro" class="form-label"><strong>Are you more introverted or extroverted?</strong></label>
                                    <div class="col-12 col-md-4 mb-3">
                                        <input class="form-check-input m-0" type="radio" name="MoreIntroOrExtro" id="MoreIntroOrExtro1" value="I am more introverted">
                                        <label class="form-check-label m-0" for="MoreIntroOrExtro1">
                                            I am more introverted
                                        </label>
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <input class="form-check-input m-0" type="radio" name="MoreIntroOrExtro" id="MoreIntroOrExtro2" value="Somewhere in the middle">
                                        <label class="form-check-label m-0" for="MoreIntroOrExtro2">
                                            Somewhere in the middle
                                        </label>
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <input class="form-check-input m-0" type="radio" name="MoreIntroOrExtro" id="MoreIntroOrExtro3" value="I am more extroverted">
                                        <label class="form-check-label m-0" for="MoreIntroOrExtro3">
                                            I am more extroverted
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="TakeTheLead" class="form-label"><strong>Who takes the lead?</strong></label>
                                    <div class="col-12 col-md-4 mb-3">
                                        <input class="form-check-input m-0" type="radio" name="TakeTheLead" id="TakeTheLead1" value="I enjoy taking the lead">
                                        <label class="form-check-label m-0" for="TakeTheLead1">
                                            I enjoy taking the lead
                                        </label>
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <input class="form-check-input m-0" type="radio" name="TakeTheLead" id="TakeTheLead2" value="Sometimes me, sometimes the other">
                                        <label class="form-check-label m-0" for="TakeTheLead2">
                                            Sometimes me, sometimes the other
                                        </label>
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <input class="form-check-input m-0" type="radio" name="TakeTheLead" id="TakeTheLead3" value="I prefer when the other takes the lead">
                                        <label class="form-check-label m-0" for="TakeTheLead3">
                                            I prefer when the other takes the lead
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 col-md-6">
                                        <div class="row mb-3">
                                            <label for="smoke" class="form-label"><strong>Do you smoke?</strong></label>
                                            <div class="col-6 col-md-2">
                                                <input class="form-check-input m-0" type="radio" name="smoke" id="smoke1" value="Yes">
                                                <label class="form-check-label m-0" for="smoke1">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="col-6 col-md-2">
                                                <input class="form-check-input m-0" type="radio" name="smoke" id="smoke2" value="No">
                                                <label class="form-check-label m-0" for="smoke2">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row mb-3">
                                            <label for="DoYouMidSmoke" class="form-label"><strong>Do you mind if the escort smokes?</strong></label>
                                            <div class="col-6 col-md-2">
                                                <input class="form-check-input m-0" type="radio" name="DoYouMidSmoke" id="DoYouMidSmoke1" value="Yes">
                                                <label class="form-check-label m-0" for="DoYouMidSmoke1">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="col-6 col-md-2">
                                                <input class="form-check-input m-0" type="radio" name="DoYouMidSmoke" id="DoYouMidSmoke2" value="No">
                                                <label class="form-check-label m-0" for="DoYouMidSmoke2">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row mb-3">
                                            <label for="likeTatoos" class="form-label"><strong>Do you like tattoos?</strong></label>
                                            <div class="col-6 col-md-2">
                                                <input class="form-check-input m-0" type="radio" name="likeTatoos" id="likeTatoos1" value="Yes">
                                                <label class="form-check-label m-0" for="likeTatoos1">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="col-6 col-md-2">
                                                <input class="form-check-input m-0" type="radio" name="likeTatoos" id="likeTatoos2" value="No">
                                                <label class="form-check-label m-0" for="likeTatoos2">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row mb-3">
                                            <label for="bookedEscortBefore" class="form-label"><strong>Have you ever booked an escort before?</strong></label>
                                            <div class="col-6 col-md-2">
                                                <input class="form-check-input m-0" type="radio" name="bookedEscortBefore" id="bookedEscortBefore1" value="Yes">
                                                <label class="form-check-label m-0" for="bookedEscortBefore1">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="col-6 col-md-2">
                                                <input class="form-check-input m-0" type="radio" name="bookedEscortBefore" id="bookedEscortBefore2" value="No">
                                                <label class="form-check-label m-0" for="bookedEscortBefore2">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="aspectsEnjoy" class="form-label"><strong>Which aspects did you enjoy most from your previous experiences?</strong></label>
                                    <textarea class="form-control" id="aspectsEnjoy" name="aspectsEnjoy" rows="4" placeholder="Which aspects did you enjoy most from your previous experiences?"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="aspectsPreference" class="form-label"><strong>Which aspects would you prefer different compared to your previous experiences?</strong></label>
                                    <textarea class="form-control" id="aspectsPreference" name="aspectsPreference" rows="4" placeholder="Which aspects would you prefer different compared to your previous experiences?"></textarea>
                                </div>
                                <div class="row mb-3">
                                    <label for="rangeAge" class="form-label"><strong>From and until what age do you prefer?</strong></label>
                                    <div class="col-6">
                                        <input class="form-control m-0" type="number" name="rangeAgeFrom" id="rangeAgeFrom" placeholder="From">
                                    </div>
                                    <div class="col-6">
                                        <input class="form-control m-0" type="number" name="rangeAgeUntil" id="rangeAgeUntil" placeholder="Until">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="dreamEscortPersonality" class="form-label"><strong>Describe your dream escort (personality)</strong></label>
                                    <textarea class="form-control" id="dreamEscortPersonality" name="dreamEscortPersonality" rows="4" placeholder="Describe your dream escort (personality)"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="dreamEscortAppearance" class="form-label"><strong>Describe your dream escort (appearance)</strong></label>
                                    <textarea class="form-control" id="dreamEscortAppearance" name="dreamEscortAppearance" rows="4" placeholder="Describe your dream escort (appearance)"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="anyTurnOnOtherWish" class="form-label"><strong>Any other turn-ons that you wish to share?</strong></label>
                                    <textarea class="form-control" id="anyTurnOnOtherWish" name="anyTurnOnOtherWish" rows="4" placeholder="Any other turn-ons that you wish to share?"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="anyTurnOffOtherWish" class="form-label"><strong>Any turn-offs that you wish to share?</strong></label>
                                    <textarea class="form-control" id="anyTurnOffOtherWish" name="anyTurnOffOtherWish" rows="4" placeholder="Any turn-offs that you wish to share?"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="dreamBooking" class="form-label"><strong>What does your dream booking look like?</strong></label>
                                    <textarea class="form-control" id="dreamBooking" name="dreamBooking" rows="4" placeholder="What does your dream booking look like?"></textarea>
                                </div>
                                <div class="row mb-3">
                                    <label for="MostImportant" class="form-label"><strong>Select the most important booking aspects</strong></label>
                                    <div class="col-12 col-md-3 mb-2">
                                        <input class="form-check-input m-0" type="checkbox" name="MostImportant1" id="MostImportant1" value="Companionship">
                                        <label class="form-check-label m-0" for="MostImportant1">
                                            Companionship
                                        </label>
                                    </div>
                                    <div class="col-12 col-md-3 mb-2">
                                        <input class="form-check-input m-0" type="checkbox" name="MostImportant2" id="MostImportant2" value="Intellectual conversations">
                                        <label class="form-check-label m-0" for="MostImportant2">
                                            Intellectual conversations
                                        </label>
                                    </div>
                                    <div class="col-12 col-md-3 mb-2">
                                        <input class="form-check-input m-0" type="checkbox" name="MostImportant4" id="MostImportant4" value="Wining and dining">
                                        <label class="form-check-label m-0" for="MostImportant4">
                                            Wining and dining
                                        </label>
                                    </div>
                                    <div class="col-12 col-md-3 mb-2">
                                        <input class="form-check-input m-0" type="checkbox" name="MostImportant5" id="MostImportant5" value="Romance">
                                        <label class="form-check-label m-0" for="MostImportant5">
                                            Romance
                                        </label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input class="form-check-input m-0" type="checkbox" name="MostImportant6" id="MostImportant6" value="Activities (sightseeing, wellness, theatre, museums, sports, etc.)">
                                        <label class="form-check-label m-0" for="MostImportant6" style="display: inline;">
                                            Activities (sightseeing, wellness, theatre, museums, sports, etc.)
                                        </label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input class="form-check-input m-0" type="checkbox" name="MostImportant7" id="MostImportant7" value="Learning new things (for inexperienced clients)">
                                        <label class="form-check-label m-0" style="display: inline;" for="MostImportant7">
                                            Learning new things (for inexperienced clients)
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-4">
                                    <div class="col-12">
                                        <label for="MostImportant" class="form-label"><strong>Terms & Conditions</strong></label> <br>
                                        <input class="form-check-input m-0" type="checkbox" name="terms" id="terms" value="Yes">
                                        <label class="form-check-label m-0" for="terms">
                                            I accept the terms and conditions
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
        </div>
    </section>

<?php
	get_footer();
?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#matchMakingForm").submit(function (event) {
            event.preventDefault(); // Evita o reload da página
            const email = document.getElementById("email").value.trim();
            const confirmEmail = document.getElementById("confirmEmail").value.trim();
            const errorDiv = document.getElementById("emailError");

            if (email !== confirmEmail) {
                errorDiv.style.display = "block";
                return false; // impede o envio do formulário
            } else {
                errorDiv.style.display = "none";
            
                var formData = $(this).serialize(); // Serializa os dados do formulário
                console.log(formData)

                // Alterna a visibilidade dos botões
                document.getElementById('submit').style.display = 'none';
                document.getElementById('submited').style.display = 'block';
                
                $.ajax({
                    type: "POST",
                    url: "<?php echo get_template_directory_uri(); ?>/vendor/matchmaking.php",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        console.log("AJAX Response:", response);

                        if (response.status === "success") {
                            $("#formMessage").html('<p style="color: green;">' + response.message + '</p>');
                            $("#matchMakingForm")[0].reset(); // Clear the form
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
            }
        });
    });
</script>