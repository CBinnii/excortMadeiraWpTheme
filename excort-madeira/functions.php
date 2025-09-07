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
// 1) Permalink do profile: /{lang}/{location-traduzida}/{slug-do-profile}
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
// Link de 'location' sem base. Usa a base do Polylang:
//  - idioma padrão: "/" (sem prefixo)
//  - outros idiomas: "/pt/", etc.
add_filter('term_link', function ($url, $term, $taxonomy) {
    if ($taxonomy !== 'location') return $url;

    $term_lang = function_exists('pll_get_term_language') ? pll_get_term_language($term->term_id, 'slug') : '';

    // Base por idioma (respeita "Hide default language code")
    if (function_exists('pll_home_url') && $term_lang) {
        $base = rtrim(pll_home_url($term_lang), '/');
    } else {
        $base = rtrim(home_url('/'), '/');
    }

    return trailingslashit($base . '/' . $term->slug);
}, 99, 3);

// 4) Flush automático quando termos mudarem (evita “perder” regras após plugin mexer)
function tgnd_flush_on_location_change() { flush_rewrite_rules(); }
add_action('created_location', 'tgnd_flush_on_location_change');
add_action('edited_location',  'tgnd_flush_on_location_change');
add_action('delete_location',  'tgnd_flush_on_location_change');

// (Opcional) Flush ao ativar tema
add_action('after_switch_theme', function () { flush_rewrite_rules(); });

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

// Traduções dinâmicas de textos do plugin por idioma (sem mexer em arquivos .po)
add_filter('gettext', function ($translated, $text, $domain) {
    // Ajuste o text domain do seu plugin de membership, por ex.: 'simple-membership'
    if ($domain !== 'simple-membership') return $translated;

    $is_pt = function_exists('pll_current_language') && pll_current_language('slug') === 'pt';

    // Mapas mínimos de exemplo — adicione os que você precisa
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

    if ($is_pt && isset($map_pt[$text])) {
        return $map_pt[$text];
    }
    return $translated;
}, 10, 3);

// Regras de rewrite:
// - Idiomas com prefixo: /{lang}/{location} e /{lang}/{location}/{profile}
// - Idioma padrão (sem prefixo): /{location} e /{location}/{profile}
// Regras de rewrite específicas por SLUG de 'location' em cada idioma.
// Evita capturar /pt/{pagina} e /pt/{post}, deixando-os para o core do WP/Polylang.
add_filter('rewrite_rules_array', function ($rules) {
    $new = [];

    // Idiomas ativos e idioma padrão
    $langs        = function_exists('pll_languages_list') ? pll_languages_list(['fields' => 'slug']) : ['pt','en'];
    $default_lang = function_exists('pll_default_language') ? pll_default_language('slug') : ( $langs[0] ?? 'en' );
    $tax          = 'location';

    // Para cada idioma, criamos regras SÓ para os termos existentes
    foreach ($langs as $lang) {
        // pega todos os termos 'location' do idioma corrente
        $terms = get_terms([
            'taxonomy'   => $tax,
            'hide_empty' => false,
            'lang'       => $lang,
            'fields'     => 'all',
        ]);
        if (is_wp_error($terms) || empty($terms)) continue;

        // prefixo vazio para idioma padrão; /{lang}/ para os demais
        $prefix = ($lang === $default_lang) ? '' : ($lang . '/');

        foreach ($terms as $term) {
            $slug = $term->slug;

            // SINGLE do CPT 'profile': /{prefix}{location}/{profile}
            $new["{$prefix}{$slug}/([^/]+)/?$"]
                = "index.php?post_type=profile&name=\$matches[1]&lang={$lang}";

            // Arquivo da taxonomia: /{prefix}{location}
            $new["{$prefix}{$slug}/?$"]
                = "index.php?taxonomy={$tax}&term={$slug}&lang={$lang}";

            // Paginação do arquivo: /{prefix}{location}/page/2
            $new["{$prefix}{$slug}/page/([0-9]{1,})/?$"]
                = "index.php?taxonomy={$tax}&term={$slug}&lang={$lang}&paged=\$matches[1]";
        }

        // Fallback 'sem-local' para este idioma
        if ($lang === $default_lang) {
            $new["sem-local/([^/]+)/?$"]
                = "index.php?post_type=profile&name=\$matches[1]&lang={$lang}";
        } else {
            $new["{$prefix}sem-local/([^/]+)/?$"]
                = "index.php?post_type=profile&name=\$matches[1]&lang={$lang}";
        }
    }

    // PREPEND: nossas regras antes para garantir match em locations/profiles,
    // sem interferir nas páginas/posts pois não há pattern genérico.
    return $new + $rules;
}, 5);


// Permalink do profile: /{lang?}/{location-traduzida}/{profile}
//  - Sem {lang} quando o profile for do idioma padrão (ex.: EN)
//  - Com /pt/ quando o profile for PT
add_filter('post_type_link', function ($post_link, $post) {
    if ($post->post_type !== 'profile') return $post_link;

    // Idioma do post e idioma padrão
    $post_lang    = function_exists('pll_get_post_language') ? pll_get_post_language($post->ID, 'slug') : '';
    $default_lang = function_exists('pll_default_language')   ? pll_default_language('slug')              : $post_lang;

    // Descobre a location do próprio post e traduz o slug para o idioma do post
    $terms = get_the_terms($post->ID, 'location');
    $location_slug = 'sem-local';

    if (!is_wp_error($terms) && !empty($terms)) {
        $t = $terms[0];

        if (function_exists('pll_get_term') && $post_lang) {
            $tid = pll_get_term($t->term_id, $post_lang); // id da location na MESMA língua do post
            if ($tid) {
                $translated = get_term($tid, 'location');
                if ($translated && !is_wp_error($translated)) {
                    $location_slug = $translated->slug;
                }
            } else {
                $location_slug = $t->slug; // fallback
            }
        } else {
            $location_slug = $t->slug;
        }
    }

    // Prefixo vazio se o post for do idioma padrão; senão, /{lang}
    $prefix = ($post_lang && $post_lang !== $default_lang) ? '/' . $post_lang : '';
    $path   = $prefix . '/' . $location_slug . '/' . $post->post_name;

    return user_trailingslashit(home_url($path));
}, 10, 2);