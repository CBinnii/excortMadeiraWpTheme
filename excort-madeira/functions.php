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

// 2) Regras de rewrite por idioma:
// /{lang}/{location}            -> arquivo da taxonomia 'location' (sem /location/)
// /{lang}/{location}/{profile}  -> single do CPT 'profile'
// /{lang}/{location}/page/2     -> paginação da taxonomia
function add_custom_profile_rewrite_rules($rules) {
    $new = [];

    // idiomas ativos no Polylang
    $langs = function_exists('pll_languages_list')
        ? pll_languages_list(['fields' => 'slug'])
        : ['pt', 'en']; // fallback

    $tax = 'location';

    foreach ($langs as $lang) {
        // Tax term (um nível). Se usar hierarquia, troque ([^/]+) por (.+) e trate no term_link.
        $term_pattern = '([^/]+)';

        // Arquivo da taxonomia: /pt/{term}
        $new["{$lang}/{$term_pattern}/?$"]
            = "index.php?taxonomy={$tax}&term=\$matches[1]&lang={$lang}";

        // Paginação do arquivo: /pt/{term}/page/2
        $new["{$lang}/{$term_pattern}/page/([0-9]{1,})/?$"]
            = "index.php?taxonomy={$tax}&term=\$matches[1]&lang={$lang}&paged=\$matches[2]";

        // Single profile: /pt/{term}/{profile}
        // Aqui usamos 'name' para resolver o post pelo slug
        $new["{$lang}/{$term_pattern}/([^/]+)/?$"]
            = "index.php?post_type=profile&name=\$matches[2]&lang={$lang}";
    }

    // Fallback para sem local: /{lang}/sem-local/{profile}
    foreach ($langs as $lang) {
        $new["{$lang}/sem-local/([^/]+)/?$"]
            = "index.php?post_type=profile&name=\$matches[1]&lang={$lang}";
    }

    // Mantém as regras do WP primeiro e adiciona as nossas depois (evita conflito com páginas)
    return $rules + $new;
}
add_filter('rewrite_rules_array', 'add_custom_profile_rewrite_rules', 20);

// 3) Gera o link de 'location' sem a base, respeitando /{lang}/
add_filter('term_link', function ($url, $term, $taxonomy) {
    if ($taxonomy !== 'location') return $url;

    $lang = function_exists('pll_get_term_language') ? pll_get_term_language($term->term_id, 'slug') : '';
    $lang_prefix = $lang ? '/' . $lang : '';

    // Apenas /{lang}/{slug-do-termo}
    return home_url(user_trailingslashit($lang_prefix . '/' . $term->slug));
}, 10, 3);

// 4) Flush automático quando termos mudarem (evita “perder” regras após plugin mexer)
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

// Função para buscar as localizações (apenas do idioma atual) + imagem destacada
function buscar_localizacoes() {
    $lang = function_exists('pll_current_language') ? pll_current_language('slug') : '';

    $terms = get_terms([
        'taxonomy'   => 'location',
        'orderby'    => 'term_id',
        'order'      => 'ASC',
        'hide_empty' => false,
        // Polylang: filtra por idioma
        'lang'       => $lang ? $lang : 'all',
    ]);

    if (!empty($terms) && !is_wp_error($terms)) {
        $locations = [];

        foreach ($terms as $term) {
            $featured_image_id = get_term_meta($term->term_id, 'featured_image_location', true);
            $featured_image_url = $featured_image_id
                ? wp_get_attachment_url($featured_image_id)
                : 'https://the-girl-next-door.com/wp-content/themes/excort-madeira/images/no-image.jpeg';

            $locations[] = [
                'name'           => $term->description ? $term->description : $term->name,
                'slug'           => $term->slug,
                'featured_image' => $featured_image_url,
                'link'           => get_term_link($term), // já sai como /{lang}/{slug}
            ];
        }

        wp_send_json_success($locations);
    } else {
        wp_send_json_error('Nenhuma localização encontrada');
    }

    wp_die();
}
add_action('wp_ajax_get_locations', 'buscar_localizacoes');
add_action('wp_ajax_nopriv_get_locations', 'buscar_localizacoes');

// Função para buscar perfis da localização (respeitando idioma atual)
function buscar_perfis_por_localizacao() {
    if (!isset($_GET['location'])) {
        wp_send_json_error('Parâmetro "location" é obrigatório.');
        wp_die();
    }

    $location_slug = sanitize_text_field($_GET['location']);
    $lang = function_exists('pll_current_language') ? pll_current_language('slug') : '';

    // Query para perfis da localização no idioma atual
    $args = [
        'post_type'      => 'profile',
        'post_status'    => 'publish',
        'posts_per_page' => 10,
        'orderby'        => 'rand',
        // Polylang: restringe posts ao idioma da tela
        'lang'           => $lang ?: 'all',
        'tax_query'      => [
            [
                'taxonomy' => 'location',
                'field'    => 'slug',
                'terms'    => $location_slug,
            ],
        ],
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $response = [];

        while ($query->have_posts()) {
            $query->the_post();
            $response[] = [
                'id'    => get_the_ID(),
                'name'  => get_the_title(),
                'image' => get_the_post_thumbnail_url(),
                'link'  => get_permalink(), // já vem como /{lang}/{location}/{profile}
            ];
        }

        wp_reset_postdata();
        wp_send_json_success($response);
    } else {
        wp_send_json_error('Nenhum perfil encontrado para essa localização.');
    }

    wp_die();
}
add_action('wp_ajax_buscar_perfis_por_localizacao', 'buscar_perfis_por_localizacao');
add_action('wp_ajax_nopriv_buscar_perfis_por_localizacao', 'buscar_perfis_por_localizacao');