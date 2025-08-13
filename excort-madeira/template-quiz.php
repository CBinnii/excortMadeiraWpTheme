<?php
/* Template Name: Quiz Your Girl */

get_header();
?>
    <div class="quiz-template">
        <div class="container">
            <div class="quiz-intro">
                <div class="quiz-intro-content">
                    <h1>Find Your Girl Next Door</h1>
                    <p>Tap an image to choose your location. Then keep picking the girl who catches your eye untill one remains. Your Girl Next Door</p>

                    <div class="buttons">
                        <button id="begin-quiz-btn" class="button bold pointer">Let's Begin</button>
                    </div>
                </div>
            </div>

            <div class="location-selection" style="display:none;">
                <div class="location-selection-content">
                    <h2>Where are you looking for Your Girl Next Door?</h2>
                    <div id="location-list" class="row"></div> <!-- Aqui serão exibidas as localizações -->
                </div>
            </div>

            <div class="profile-quiz" style="display:none;">
                <h2 id="profile-text">Who do you prefer?</h2>

                <div class="profile-quiz-content">
                    <div id="profile1" data-id="" class="profile-quiz-container" style="display:none;"></div>
                    <div id="profile2" data-id="" class="profile-quiz-container" style="display:none;"></div>
                </div>

                <div class="buttons" id="buttons" style="display:none;">
                    <a href="#" id="view-profile" class="button bold pointer">View Full Profile</a>
                    <button id="do-again" class="button bold pointer">Choose again</button>
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
            showBootstrapModal('There are not enough profiles for the quiz.');
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
            carregarLocalizacoes();  // Carrega as localizações
        });

        // Função para carregar as localizações via AJAX
        function carregarLocalizacoes() {
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'GET',
                data: {
                    action: 'get_locations',  // Ação para buscar localizações
                },
                success: function(response) {
                    if (response.success) {
                        // Cria a lista de localizações
                        var locations = response.data;
                        console.log(locations);
                        var locationList = $('#location-list');
                        locationList.empty();
                        locations.forEach(function(location) {
                            var locationItem = $('<div class="col-12 col-md-5 location button bold medium pointer">')
                                .text(location.name)
                                .attr('data-location', location.slug)
                                .css('background-image', 'url(' + location.featured_image + ')') // Define o background com a imagem
                                .css('background-size', 'cover') // Ajusta o tamanho da imagem
                                .css('background-position', 'center'); // Centraliza a imagem
                            locationList.append(locationItem);
                        });

                        // Evento de clique nas localizações
                        $('.location').on('click', function() {
                            var selectedLocation = $(this).data('location');
                            carregarPerfisPorLocalizacao(selectedLocation);  // Carrega perfis
                        });
                    }
                }
            });
        }

        // Função para carregar os perfis com base na localização
        function carregarPerfisPorLocalizacao(location) {
            $('.location-selection').hide();

            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'GET',
                data: {
                    action: 'buscar_perfis_por_localizacao',  // Ação para buscar perfis por localização
                    location: location
                },
                success: function(response) {
                    if (response.success) {
                        availables = response.data; // Armazena os perfis disponíveis
                        sampler = createSlidingUniqueSampler(availables);
                        console.log(response.data);
                        render(); // Renderiza os perfis iniciais
                    } else {
                        showBootstrapModal('No profiles found for this location.');
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
                    $('#profile-text').text('Who do you prefer?'); // Reseta
                    carregarLocalizacoes();  // Carrega as localizações
                    $('.location-selection').show(); // Exibe a tela de localização novamente
                });
                
                // 🎉 Dispara o confete
                launchConfetti();
                
                $('#profile-text').text('Your Perfect Match');
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