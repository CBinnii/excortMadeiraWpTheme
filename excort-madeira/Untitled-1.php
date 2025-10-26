<?php
/**
 * Template: Functions.php 
 */

// ---------------------------------------------------------
// 📸 Theme Supports
// ---------------------------------------------------------
add_theme_support('post-thumbnails', array('page', 'post', 'service', 'profile'));
add_theme_support('widgets');

// ---------------------------------------------------------
// 🧭 Admin Menu Cleanup
// ---------------------------------------------------------
function remove_menus() {
    // remove_menu_page( 'upload.php' ); // Media
    // remove_menu_page( 'themes.php' ); // Appearance
    remove_menu_page( 'edit-comments.php' ); // Comments
}
add_action('admin_menu', 'remove_menus');

add_action('after_setup_theme', function () {
  // Remova o gerenciador automático de <title> para evitar duplicação
  remove_theme_support('title-tag');
});

// ---------------------------------------------------------
// 🔗 Custom Profile Permalink Structure
// ---------------------------------------------------------
function custom_profile_permalink($post_link, $post) {
    if ($post->post_type !== 'profile') return $post_link;

    $lang = function_exists('pll_current_language') ? pll_current_language('slug') : '';
    $terms = get_the_terms($post->ID, 'location');
    $location_slug = 'sem-local';

    if (!is_wp_error($terms) && !empty($terms)) {
        $t = $terms[0];
        if (function_exists('pll_get_term') && $lang) {
            $translated_id = pll_get_term($t->term_id, $lang);
            if ($translated_id) {
                $translated = get_term($translated_id, 'location');
                if ($translated && !is_wp_error($translated)) {
                    $location_slug = $translated->slug;
                }
            } else {
                $location_slug = $t->slug;
            }
        } else {
            $location_slug = $t->slug;
        }
    }

    $prefix = $lang ? '/' . $lang : '';
    $path   = $prefix . '/' . $location_slug . '/' . $post->post_name;

    return user_trailingslashit(home_url($path));
}
add_filter('post_type_link', 'custom_profile_permalink', 10, 2);

// ---------------------------------------------------------
// 🔁 Custom Rewrite Rules for Polylang
// ---------------------------------------------------------
function add_custom_profile_rewrite_rules($rules) {
    $new = [];
    $langs = function_exists('pll_languages_list') ? pll_languages_list(['fields' => 'slug']) : ['pt', 'en'];
    $tax = 'location';

    foreach ($langs as $lang) {
        $term_pattern = '([^/]+)';
        $new["{$lang}/{$term_pattern}/?$"] = "index.php?taxonomy={$tax}&term=\$matches[1]&lang={$lang}";
        $new["{$lang}/{$term_pattern}/page/([0-9]{1,})/?$"] = "index.php?taxonomy={$tax}&term=\$matches[1]&lang={$lang}&paged=\$matches[2]";
        $new["{$lang}/{$term_pattern}/([^/]+)/?$"] = "index.php?post_type=profile&name=\$matches[2]&lang={$lang}";
    }

    foreach ($langs as $lang) {
        $new["{$lang}/sem-local/([^/]+)/?$"] = "index.php?post_type=profile&name=\$matches[1]&lang={$lang}";
    }

    return $rules + $new;
}
add_filter('rewrite_rules_array', 'add_custom_profile_rewrite_rules', 20);

// ---------------------------------------------------------
// 🌍 Term Links without Base (respect Polylang)
// ---------------------------------------------------------
add_filter('term_link', function ($url, $term, $taxonomy) {
    if ($taxonomy !== 'location') return $url;

    $term_lang = function_exists('pll_get_term_language') ? pll_get_term_language($term->term_id, 'slug') : '';

    if (function_exists('pll_home_url') && $term_lang) {
        $base = rtrim(pll_home_url($term_lang), '/');
    } else {
        $base = rtrim(home_url('/'), '/');
    }

    return trailingslashit($base . '/' . $term->slug);
}, 99, 3);

// ---------------------------------------------------------
// 🧹 Auto Flush Rewrite on Term Changes
// ---------------------------------------------------------
function tgnd_flush_on_location_change() { flush_rewrite_rules(); }
add_action('created_location', 'tgnd_flush_on_location_change');
add_action('edited_location',  'tgnd_flush_on_location_change');
add_action('delete_location',  'tgnd_flush_on_location_change');
add_action('after_switch_theme', function () { flush_rewrite_rules(); });

// ---------------------------------------------------------
// 🌐 Language Helper Functions
// ---------------------------------------------------------
function tgnd_get_requested_lang() {
    $req = isset($_REQUEST['lang']) ? sanitize_text_field($_REQUEST['lang']) : '';
    if (function_exists('pll_languages_list')) {
        $allowed = pll_languages_list(['fields' => 'slug']);
        if ($req && in_array($req, $allowed, true)) return $req;
        $cur = function_exists('pll_current_language') ? pll_current_language('slug') : '';
        if ($cur && in_array($cur, $allowed, true)) return $cur;
        $def = function_exists('pll_default_language') ? pll_default_language('slug') : '';
        if ($def && in_array($def, $allowed, true)) return $def;
    }
    return $req ?: 'en';
}

function tgnd_resolve_location_term_id_by_slug($slug, $lang) {
    $ids = get_terms([
        'taxonomy'   => 'location',
        'slug'       => $slug,
        'lang'       => $lang,
        'hide_empty' => false,
        'fields'     => 'ids',
    ]);
    if (!is_wp_error($ids) && !empty($ids)) return (int) $ids[0];

    $term = get_term_by('slug', $slug, 'location');
    if ($term && !is_wp_error($term) && function_exists('pll_get_term') && $lang) {
        $translated_id = pll_get_term($term->term_id, $lang);
        if ($translated_id) return (int) $translated_id;
    }
    return 0;
}

// ---------------------------------------------------------
// 📍 AJAX — Locations & Profiles per Language
// ---------------------------------------------------------
function buscar_localizacoes() {
    $lang = tgnd_get_requested_lang();
    $terms = get_terms([
        'taxonomy'   => 'location',
        'orderby'    => 'term_id',
        'order'      => 'ASC',
        'hide_empty' => false,
        'lang'       => $lang,
    ]);

    if (!empty($terms) && !is_wp_error($terms)) {
        $locations = [];
        foreach ($terms as $term) {
            $featured_image_id  = get_term_meta($term->term_id, 'featured_image_location', true);
            $featured_image_url = $featured_image_id ? wp_get_attachment_url($featured_image_id)
                                                     : 'https://the-girl-next-door.com/wp-content/themes/excort-madeira/images/no-image.jpeg';
            $locations[] = [
                'name'           => $term->description ? $term->description : $term->name,
                'slug'           => $term->slug,
                'featured_image' => $featured_image_url,
                'link'           => get_term_link($term),
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

function buscar_perfis_por_localizacao() {
    if (!isset($_GET['location'])) {
        wp_send_json_error('Parâmetro "location" é obrigatório.');
        wp_die();
    }

    $location_slug = sanitize_text_field($_GET['location']);
    $lang = tgnd_get_requested_lang();
    $term_id = tgnd_resolve_location_term_id_by_slug($location_slug, $lang);

    if (!$term_id) {
        wp_send_json_error('Localização não encontrada neste idioma.');
        wp_die();
    }

    $args = [
        'post_type'           => 'profile',
        'post_status'         => 'publish',
        'posts_per_page'      => 10,
        'orderby'             => 'rand',
        'lang'                => $lang,
        'no_found_rows'       => true,
        'ignore_sticky_posts' => true,
        'tax_query'           => [[
            'taxonomy'         => 'location',
            'field'            => 'term_id',
            'terms'            => [$term_id],
            'include_children' => false,
        ]],
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
                'link'  => get_permalink(),
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

// ---------------------------------------------------------
// 🌐 Translations (Simple Membership plugin)
// ---------------------------------------------------------
add_filter('gettext', function ($translated, $text, $domain) {
    if ($domain !== 'simple-membership') return $translated;
    $is_pt = function_exists('pll_current_language') && pll_current_language('slug') === 'pt';
    $map_pt = [
        'Register' => 'Cadastrar',
        'Login' => 'Entrar',
        'Username' => 'Usuário',
        'Password' => 'Senha',
        'Username or Email' => 'Usuário ou Email',
        'Confirm Password' => 'Confirmar senha',
        'Email' => 'E-mail',
        'Remember Me' => 'Lembrar-me',
        'Forgot Password?' => 'Esqueceu a senha?',
        'Be a member' => 'Seja membro',
        'Log In' => 'Entrar',
        'There was a problem with your submission.' => 'Houve um problema com o seu envio.',
    ];
    if ($is_pt && isset($map_pt[$text])) return $map_pt[$text];
    return $translated;
}, 10, 3);

// ---------------------------------------------------------
// 🔗 Hreflang Tags (Dynamic Polylang Integration)
// ---------------------------------------------------------
add_action('wp_head', function () {
    if (!function_exists('pll_the_languages')) return;
    $langs = pll_the_languages([
        'raw'                   => 1,
        'hide_if_no_translation'=> 0,
    ]);
    if (empty($langs)) return;

    foreach ($langs as $code => $data) {
        $hreflang = !empty($data['locale']) ? str_replace('_', '-', $data['locale']) : $code;
        $url = isset($data['url']) ? $data['url'] : '';
        if ($url) {
            echo '<link rel="alternate" hreflang="' . esc_attr($hreflang) . '" href="' . esc_url($url) . "\" />\n";
        }
    }
    $x_default = home_url('/');
    echo '<link rel="alternate" hreflang="x-default" href="' . esc_url($x_default) . "\" />\n";
}, 5);

// ---------------------------------------------------------
// 🧱 Disable default canonical (Yoast handles it)
// ---------------------------------------------------------
remove_action('wp_head', 'rel_canonical');

// ---------------------------------------------------------
// ✨ Local Fonts (Rufina) — works for all languages
// ---------------------------------------------------------
function mufasa_local_fonts() {
    wp_enqueue_style(
        'rufina-fonts',
        home_url('/wp-content/uploads/fonts/fonts.css'), // ✅ root-relative path
        array(),
        null,
        'all'
    );
}
add_action('wp_enqueue_scripts', 'mufasa_local_fonts', 1); // Load early before theme styles

// Preload font files to prevent flash
add_action('wp_head', function () {
    ?>
    <!-- 🚀 Preload local Rufina fonts -->
    <link rel="preload" href="/wp-content/uploads/fonts/rufina/rufina-v17-latin-regular.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/wp-content/uploads/fonts/rufina/rufina-v17-latin-700.woff2" as="font" type="font/woff2" crossorigin>
    <?php
}, 1);
