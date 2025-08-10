jQuery(document).ready(function($) {
    alert('Bem-vindo ao Quiz de Perfis!');
    
    // Ao clicar no botão "Let's Begin"
    $('#begin-quiz-btn').on('click', function() {
        // Esconde a tela inicial e mostra a tela de localização
        $('.quiz-intro').hide();
        $('.location-selection').show();

        // Carregar as localizações cadastradas via AJAX
        carregarLocalizacoes();
    });

    // Função para carregar as localizações via AJAX
    function carregarLocalizacoes() {
        $.ajax({
            url: perfis_ajax_obj.ajaxurl,
            type: 'GET',
            data: {
                action: 'buscar_localizacoes', // Ação para buscar as localizações da taxonomia
            },
            success: function(response) {
                if (response.success) {
                    // Preenche a lista de localizações
                    var locations = response.data;
                    var locationList = $('#location-list');
                    locationList.empty(); // Limpa o conteúdo anterior

                    // Exibe as localizações na tela
                    locations.forEach(function(location) {
                        var locationItem = $('<div class="location">')
                            .text(location.name)
                            .attr('data-location', location.slug);
                        locationList.append(locationItem);
                    });

                    // Adiciona o evento de clique nas localizações
                    $('.location').on('click', function() {
                        var selectedLocation = $(this).data('location');
                        carregarPerfisPorLocalizacao(selectedLocation); // Carrega perfis da localização
                    });
                }
            },
            error: function() {
                alert('Erro ao carregar as localizações.');
            }
        });
    }

    // Função para carregar os perfis com base na localização
    function carregarPerfisPorLocalizacao(location) {
        $.ajax({
            url: perfis_ajax_obj.ajaxurl,
            type: 'GET',
            data: {
                action: 'buscar_perfis_aleatorios_por_localizacao', // Ação para buscar perfis por localização
                location: location
            },
            success: function(response) {
                if (response.success) {
                    // Exibe os perfis de acordo com a localização
                    var profiles = response.data;
                    $('#profile1').html('<img src="' + profiles[0].image + '" alt="' + profiles[0].name + '"><h3>' + profiles[0].name + '</h3>');
                    $('#profile2').html('<img src="' + profiles[1].image + '" alt="' + profiles[1].name + '"><h3>' + profiles[1].name + '</h3>');

                    // Exibe os perfis e esconde a tela de localização
                    $('.location-selection').hide();
                    $('#profile1').show();
                    $('#profile2').show();
                }
            },
            error: function() {
                alert('Erro ao carregar os perfis.');
            }
        });
    }
});
