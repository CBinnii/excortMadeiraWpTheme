<?php 

/**
 * Template: Functions.php 
 */

// Thumbnail support
add_theme_support('post-thumbnails', array('page', 'post', 'service', 'profile'));
add_theme_support('widgets');

function remove_menus(){
	// remove_menu_page( 'upload.php' ); //Media - imagens, vídeos, docs, etc...
 	// remove_menu_page( 'themes.php' ); //Appearance - aparência (recomendo!)
 	remove_menu_page( 'edit-comments.php' ); //Comments - comentários
}
add_action( 'admin_menu', 'remove_menus' );

// 1) Permalink do profile: /{location}/{slug-do-profile}
function custom_profile_permalink($post_link, $post) {
    if ($post->post_type !== 'profile') {
        return $post_link;
    }

    $terms = get_the_terms($post->ID, 'location');

    if (!is_wp_error($terms) && !empty($terms)) {
        $location = $terms[0]->slug;

        // respeita estrutura de links (com/sem barra no fim)
        $path = '/' . $location . '/' . $post->post_name;
        return user_trailingslashit(home_url($path));
    }

    // fallback se não tiver location
    $path = '/sem-local/' . $post->post_name;
    return user_trailingslashit(home_url($path));
}
add_filter('post_type_link', 'custom_profile_permalink', 10, 2);

// 2) Regras de rewrite para /{location}/{profile}
function add_custom_profile_rewrite_rules($rules) {
    $new_rules = [];

    $terms = get_terms([
        'taxonomy'   => 'location',
        'hide_empty' => false,
    ]);

    if (!is_wp_error($terms) && !empty($terms)) {
        foreach ($terms as $term) {
            $slug = $term->slug;

            // Single profile sob o termo: /{location}/{profile}
            // (resolve pelo slug do post: name=$matches[1])
            $new_rules[$slug . '/([^/]+)/?$'] = 'index.php?post_type=profile&name=$matches[1]';

            // (Opcional) Taxonomy term root: /{location}
            // Remova se você NÃO quer a listagem da taxonomy no root.
            $new_rules[$slug . '/?$'] = 'index.php?location=' . $slug;

            // (Opcional) Paginação da taxonomy: /{location}/page/2
            $new_rules[$slug . '/page/([0-9]{1,})/?$'] =
                'index.php?location=' . $slug . '&paged=$matches[1]';
        }
    }

    // Fallback profiles sem termo: /sem-local/{profile}
    $new_rules['sem-local/([^/]+)/?$'] = 'index.php?post_type=profile&name=$matches[1]';

    // ⭐ Páginas primeiro; NOSSAS regras depois (evita quebrar páginas)
    return $rules + $new_rules;
}
add_filter('rewrite_rules_array', 'add_custom_profile_rewrite_rules', 20);

// 3) Flush automático quando termos mudarem (evita “perder” regras após plugin mexer)
function tgnd_flush_on_location_change() { flush_rewrite_rules(); }
add_action('created_location', 'tgnd_flush_on_location_change');
add_action('edited_location',  'tgnd_flush_on_location_change');
add_action('delete_location',  'tgnd_flush_on_location_change');

// (Opcional) Flush ao ativar tema
add_action('after_switch_theme', function () { flush_rewrite_rules(); });

// Alterar o texto "Join Us" para "Be a Member"
function custom_swpm_join_us_text($text) {
    if (strpos($text, 'Join Us') !== false) {
        return str_replace('Join Us', 'Be a Member', $text);
    }
    if (strpos($text, 'Junte-se a nós') !== false) {
        return str_replace('Junte-se a nós', 'Seja membro', $text);
    }
    return $text;
}
add_filter('swpm_registration_button_text', 'custom_swpm_join_us_text');

// Função para buscar as localizações da taxonomia 'location' e a imagem de destaque (URL)
function buscar_localizacoes() {
    $terms = get_terms(array(
        'taxonomy' => 'location',
        'orderby' => 'term_id',
        'order' => 'ASC',
        'hide_empty' => false, // Mesmo que não haja posts associados, as localizações serão retornadas
    ));

    if (!empty($terms) && !is_wp_error($terms)) {
        $locations = array();

        foreach ($terms as $term) {
            // Recupera o ID da imagem de destaque associada à localização
            $featured_image_id = get_term_meta($term->term_id, 'featured_image_location', true);
            
            // Se a imagem de destaque foi encontrada, obtém o URL
            if ($featured_image_id) {
                $featured_image_url = wp_get_attachment_url($featured_image_id);  // Obtém o URL da imagem
            } else {
                // Caso não haja imagem, você pode definir um URL padrão
                $featured_image_url = 'https://the-girl-next-door.com/wp-content/themes/excort-madeira/images/no-image.jpeg';  // Substitua pelo URL de uma imagem padrão
            }

            $locations[] = array(
                'name' => $term->description ? $term->description : $term->name, // Usa a descrição se disponível, senão o nome
                'slug' => $term->slug,
                'featured_image' => $featured_image_url, // Inclui o URL da imagem de destaque
            );
        }

        wp_send_json_success($locations); // Retorna as localizações com o URL da imagem
    } else {
        wp_send_json_error('Nenhuma localização encontrada');
    }

    wp_die(); // Finaliza a execução
}
add_action('wp_ajax_get_locations', 'buscar_localizacoes');
add_action('wp_ajax_nopriv_get_locations', 'buscar_localizacoes');

// Função para buscar os perfis da localização
function buscar_perfis_por_localizacao() {
    if (isset($_GET['location'])) {
        $location_slug = sanitize_text_field($_GET['location']);

        // Query para buscar perfis da localização
        $args = array(
            'post_type' => 'profile',
            'posts_per_page' => 10,  // Alterado para pegar mais perfis
            'orderby' => 'rand',  // Aleatorizar os perfis
            'tax_query' => array(
                array(
                    'taxonomy' => 'location',
                    'field'    => 'slug',
                    'terms'    => $location_slug,
                ),
            ),
        );

        $query = new WP_Query($args);
        
        if ($query->have_posts()) :
            $response = [];
            
            while ($query->have_posts()) : $query->the_post();
                $profile = [
                    'id' => get_the_ID(),
                    'name' => get_the_title(),
                    'image' => get_the_post_thumbnail_url(),
                    'link' => get_permalink(), // Link para o perfil completo
                ];
                $response[] = $profile;
            endwhile;
            
            wp_send_json_success($response);  // Retorna os perfis encontrados
        else :
            wp_send_json_error('Nenhum perfil encontrado para essa localização.');
        endif;
    }

    wp_die();  // Finaliza a execução
}

add_action('wp_ajax_buscar_perfis_por_localizacao', 'buscar_perfis_por_localizacao');
add_action('wp_ajax_nopriv_buscar_perfis_por_localizacao', 'buscar_perfis_por_localizacao');
