<meta name="description" content="<?php echo the_field('meta_description'); ?>">
<meta name="title" content="<?php echo the_field('meta_title'); ?>">

<?php
/* Template Name: Quiz Your Girl */

get_header();
?>
    <div class="quiz-template">
        <div class="container">
            <div class="quiz-intro">
                <div class="quiz-intro-content">
                    <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                        <h1>Encontre sua namorada</h1>
                    <?php else : ?>
                        <h1>Find Your Girl Next Door</h1>
                    <?php endif; ?>

                    <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                        <p>Toque numa imagem para escolher a sua localização. De seguida, continue a escolher a rapariga que lhe chamar a atenção até que sobre apenas uma. A Sua Menina da Porta ao Lado</p>
                    <?php else : ?>
                        <p>Tap an image to choose your location. Then keep picking the girl who catches your eye untill one remains. Your Girl Next Door</p>
                    <?php endif; ?>

                    <div class="buttons">
                        <button id="begin-quiz-btn" class="button bold pointer">
                            <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                Iniciar
                            <?php else : ?>
                                Let's Begin
                            <?php endif; ?>
                        </button>
                    </div>
                </div>
            </div>

            <div class="location-selection" style="display:none;">
                <div class="location-selection-content">
                    <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                        <h2>Onde está à procura da Your Girl Next Door?</h2>
                    <?php else : ?>
                        <h2>Where are you looking for Your Girl Next Door?</h2>
                    <?php endif; ?>

                    <div id="location-list" class="row">
                        <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                            <div class="col-12 col-md-5 location button bold medium pointer" data-location="acompanhantes-lisboa" style="background-image: url('https://the-girl-next-door.com/wp-content/uploads/2025/08/escorts-lisbon-portugal.png'); background-size: cover; background-position: center center;">Lisboa</div>
                            <div class="col-12 col-md-5 location button bold medium pointer" data-location="acompanhantes-porto" style="background-image: url('https://the-girl-next-door.com/wp-content/uploads/2025/08/escorts-porto-portugal.png'); background-size: cover; background-position: center center;">Porto</div>
                            <div class="col-12 col-md-5 location button bold medium pointer" data-location="acompanhantes-madeira" style="background-image: url('https://the-girl-next-door.com/wp-content/uploads/2025/08/escorts-madeira-portugal.png'); background-size: cover; background-position: center center;">Madeira</div>
                            <div class="col-12 col-md-5 location button bold medium pointer" data-location="acompanhantes-algarve" style="background-image: url('https://the-girl-next-door.com/wp-content/uploads/2025/08/escorts-algarve-portugal.png'); background-size: cover; background-position: center center;">Algarve</div>
                        <?php else : ?>
                            <div class="col-12 col-md-5 location button bold medium pointer" data-location="lisbon-escort" style="background-image: url('https://the-girl-next-door.com/wp-content/uploads/2025/08/escorts-lisbon-portugal.png'); background-size: cover; background-position: center center;">Lisbon</div>
                            <div class="col-12 col-md-5 location button bold medium pointer" data-location="porto-escort" style="background-image: url('https://the-girl-next-door.com/wp-content/uploads/2025/08/escorts-porto-portugal.png'); background-size: cover; background-position: center center;">Porto</div>
                            <div class="col-12 col-md-5 location button bold medium pointer" data-location="madeira-escort" style="background-image: url('https://the-girl-next-door.com/wp-content/uploads/2025/08/escorts-madeira-portugal.png'); background-size: cover; background-position: center center;">Madeira</div>
                            <div class="col-12 col-md-5 location button bold medium pointer" data-location="algarve-escort" style="background-image: url('https://the-girl-next-door.com/wp-content/uploads/2025/08/escorts-algarve-portugal.png'); background-size: cover; background-position: center center;">Algarve</div>
                        <?php endif; ?>
                    </div> <!-- Aqui serão exibidas as localizações -->
                </div>
            </div>

            <div class="profile-quiz" style="display:none;">
                <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                    <h2 id="profile-text">Quem prefere?</h2>
                <?php else : ?>
                    <h2 id="profile-text">Who do you prefer?</h2>
                <?php endif; ?>

                <div class="profile-quiz-content">
                    <div id="profile1" data-id="" class="profile-quiz-container" style="display:none;"></div>
                    <div id="profile2" data-id="" class="profile-quiz-container" style="display:none;"></div>
                </div>

                <div class="buttons" id="buttons" style="display:none;">
                    <a href="#" id="view-profile" class="button bold pointer">
                        <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                            Ver perfil
                        <?php else : ?>
                            View Full Profile
                        <?php endif; ?>
                    </a>
                    <button id="do-again" class="button bold pointer">
                        <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                            Escolher de novo
                        <?php else : ?>
                            Choose again
                        <?php endif; ?>
                    </button>
                </div>
            </div>
        </div>

        <!-- Exemplo mínimo de UI -->
        <!-- <div id="area">
            <div id="atuais"></div>
            <div id="final" style="display:none; margin-top:12px; padding:10px; border:1px solid #ddd; border-radius:8px;">
            </div>
        </div> -->
    </div>

    <!-- Modal de Aviso -->
    <div class="modal fade" id="quizAlertModal" tabindex="-1" aria-labelledby="quizAlertModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quizAlertModalLabel">Warning</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <!-- Texto do alerta -->
                Não há itens suficientes para iniciar o quiz.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="quizAlertOkBtn">OK</button>
            </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
<script>
    var lang = "<?php echo function_exists('pll_current_language') ? pll_current_language() : 'en'; ?>";

    function showBootstrapModal(message) {
        // altera o texto do modal
        $('#quizAlertModal .modal-body').text(message);
        // abre o modal usando Bootstrap 5
        var myModal = new bootstrap.Modal(document.getElementById('quizAlertModal'));
        myModal.show();
    }

    $('#quizAlertOkBtn').on('click', function () {
        $('.location-selection').show();
    });

    // ---- Sampler em JS (usável com jQuery) ----
    function createSlidingUniqueSampler(items) {
        if (!Array.isArray(items) || items.length < 2) {
            if (lang === 'pt') {
                showBootstrapModal('Não há perfis suficientes para o quiz.');
            } else {
                showBootstrapModal('There are not enough profiles for the quiz.');
            }
            throw new Error('There are not enough profiles for the quiz.');
            return;
        }

        // 🟢 Caso só 1 item → já é o vencedor
        if (items.length === 1) {
            var current = [0];
            return {
                getCurrentIndexes: () => current.slice(),
                getCurrentItems: () => current.map(i => items[i]),
                eliminateAndDraw: () => null // não tem nada pra eliminar ou repor
            };
        }

        // Caso 2 itens → sem reposição, só elimina no clique
        if (items.length === 2) {
            var current = [0, 1];
            return {
                getCurrentIndexes: () => current.slice(),
                getCurrentItems: () => current.map(i => items[i]),
                eliminateAndDraw: (eliminatedIndex) => {
                    var pos = current.indexOf(eliminatedIndex);
                    if (pos !== -1) {
                        // remove o eliminado
                        current.splice(pos, 1);
                    }
                    return null;
                }
            };
        }

        // cria [0..n-1] e embaralha (Fisher–Yates)
        var bag = Array.from({ length: items.length }, (_, i) => i);
        for (var i = bag.length - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1));
            var tmp = bag[i]; bag[i] = bag[j]; bag[j] = tmp;
        }

        // dois índices únicos iniciais
        var current = [bag.pop(), bag.pop()];

        // ⬇️ Ajuste: retornar o tamanho real
        function getCurrentIndexes() { return current.slice(); }
        function getCurrentItems() { return current.map(i => items[i]); }

        function eliminateAndDraw(eliminatedIndex) {
            var pos = current.indexOf(eliminatedIndex);
            if (pos === -1) {
                throw new Error('O índice eliminado não está entre os 2 atuais.');
            }
            if (bag.length === 0) {
                // acabou a reposição: remove e não repõe
                current.splice(pos, 1);
                return null;
            }
            var next = bag.pop();
            current[pos] = next;
            return next;
        }

        return { getCurrentIndexes, getCurrentItems, eliminateAndDraw };
    }

    function launchConfetti() {
        var duration = 2 * 1000; // 2 segundos
        var animationEnd = Date.now() + duration;
        var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 9999 };

        function randomInRange(min, max) {
            return Math.random() * (max - min) + min;
        }

        var interval = setInterval(function() {
            var timeLeft = animationEnd - Date.now();

            if (timeLeft <= 0) {
            return clearInterval(interval);
            }

            var particleCount = 50 * (timeLeft / duration);
            // desde a esquerda
            confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } }));
            // desde a direita
            confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } }));
        }, 250);
    }

    jQuery(document).ready(function($) {
        var availables = []; // Contém todos os perfis disponíveis
        var sorted = []; // Contém os perfis sorteados (selecionados)
        var sampler = null;

        // Ao clicar no botão "Let's Begin"
        $('#begin-quiz-btn').on('click', function() {
            $('.quiz-intro').hide();  // Esconde a tela inicial
            $('.location-selection').show();  // Exibe a tela de localização
        });
        
        $('.location').on('click', function() {
            var selectedLocation = $(this).data('location');
            carregarPerfisPorLocalizacao(selectedLocation);  // Carrega perfis
        });

        // Função para carregar os perfis com base na localização
        function carregarPerfisPorLocalizacao(location) {
            $('.location-selection').hide();

            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'GET',
                data: {
                    action: 'buscar_perfis_por_localizacao',  // Ação para buscar perfis por localização
                    location: location,
                    lang: lang // Passa o idioma atual
                },
                success: function(response) {
                    if (response.success) {
                        availables = response.data; // Armazena os perfis disponíveis
                        sampler = createSlidingUniqueSampler(availables);
                        console.log(response.data);
                        render(); // Renderiza os perfis iniciais
                    } else {
                        if (lang === 'pt') {
                            showBootstrapModal('Não foram encontrados perfis para esta localização.');
                        } else {
                            showBootstrapModal('No profiles found for this location.');
                        }
                        $('.location-selection').show(); // Exibe a tela de localização novamente
                    }
                }
            });
        }

        function render() {
            $('.profile-quiz').show();

            var idx = sampler.getCurrentIndexes();
            var it = sampler.getCurrentItems();
            
            if (idx.length === 1) {
                // // Último item (vencedor)
                // $('#atuais').hide();
                // $('#final')
                //     .show()
                //     .text('Último que sobrou => índice: ' + idx[0] + ', item: ' + it[0]);
                // // desabilita os botões
                // $('#profile1, #profile2').hide();

                $('#buttons').show();

                $('#view-profile').attr('href', it[0].link);
                
                $('#do-again').on('click', function() {
                    // Reinicia o quiz
                    availables = []; // Limpa os perfis disponíveis
                    sorted = []; // Limpa os perfis sorteados
                    sampler = null; // Reseta o sampler
                    $('.profile-quiz').hide(); // Esconde a tela de quiz
                    $('#buttons').hide(); // Esconde os botões
                    $('#profile1, #profile2').removeClass('match').hide(); // Reseta os perfis
                    if (lang === 'pt') {
                        $('#profile-text').text('Quem prefere?'); // Reseta
                    } else {
                        $('#profile-text').text('Who do you prefer?'); // Reseta
                    }
                    $('.location-selection').show(); // Exibe a tela de localização novamente
                });
                
                // 🎉 Dispara o confete
                launchConfetti();
                
                if (lang === 'pt') {
                    $('#profile-text').text('Esta é a sua namorada');
                } else {
                    $('#profile-text').text('This Is Your Girl Next Door');
                }
                $('#profile1').html('<img src="' + it[0].image + '" alt="' + it[0].name + '"><h3>' + it[0].name + '</h3>').show();
                $('#profile2').hide(); // Esconde o segundo perfil
                $('#profile1').addClass('match'); // Adiciona classe para estilização
                $('#profile2').removeClass('match'); // Remove classe do segundo perfil
                return;
            }

            // Estado normal (2 itens)
            // $('#final').hide().empty();
            // $('#atuais').show().text(
            //     'Atuais => índices: [' + idx.join(', ') + '], itens: [' + it.join(', ') + ']'
            // );

            // Exibe os perfis atuais
            $('#profile1').html('<img src="' + it[0].image + '" alt="' + it[0].name + '"><h3>' + it[0].name + '</h3>').show();
            $('#profile2').html('<img src="' + it[1].image + '" alt="' + it[1].name + '"><h3>' + it[1].name + '</h3>').show();
        }

        $('#profile1').on('click', function () {
            var i = sampler.getCurrentIndexes()[1];
            sampler.eliminateAndDraw(i);
            render();
        });

        $('#profile2').on('click', function () {
            var i = sampler.getCurrentIndexes()[0];
            sampler.eliminateAndDraw(i);
            render();
        });
    });
</script>