<?php 

/**
 * Template: Functions.php 
 */

// Thumbnail support
add_theme_support('post-thumbnails', array('page', 'post', 'service', 'profile'));
add_theme_support('widgets');

function custom_location_taxonomy_rewrite() {
    global $wp_rewrite;
    $location_terms = get_terms([
        'taxonomy' => 'location',
        'hide_empty' => false,
    ]);

    if (!empty($location_terms) && !is_wp_error($location_terms)) {
        foreach ($location_terms as $term) {
            add_rewrite_rule(
                '^' . $term->slug . '/?$',
                'index.php?location=' . $term->slug,
                'top'
            );
        }
    }
}
add_action('init', 'custom_location_taxonomy_rewrite');

function custom_profile_permalink($post_link, $post) {
    if ($post->post_type == 'profile') {
        $terms = get_the_terms($post->ID, 'location');
        if (!empty($terms) && !is_wp_error($terms)) {
            return home_url('/' . $terms[0]->slug . '/' . $post->post_name);
        }
    }
    return $post_link;
}
add_filter('post_type_link', 'custom_profile_permalink', 10, 2);

function add_custom_profile_rewrite_rules($rules) {
    $terms = get_terms([
        'taxonomy' => 'location',
        'hide_empty' => false,
    ]);

    $new_rules = [];
    foreach ($terms as $term) {
        $new_rules[$term->slug . '/([^/]+)/?$'] = 'index.php?profile=$matches[1]';
    }

    return $new_rules + $rules;
}
add_filter('rewrite_rules_array', 'add_custom_profile_rewrite_rules');

function remove_menus(){
	// remove_menu_page( 'upload.php' ); //Media - imagens, vídeos, docs, etc...
 	// remove_menu_page( 'themes.php' ); //Appearance - aparência (recomendo!)
 	remove_menu_page( 'edit-comments.php' ); //Comments - comentários
}
add_action( 'admin_menu', 'remove_menus' );

function cf7_popular_dropdown_profiles($tag) {
    if ($tag['name'] != 'profile-list') { 
        return $tag; // Retorna o campo original se não for o select correto
    }

    $args = array(
        'post_type'      => 'profile', // Substitua pelo nome correto do CPT
        'posts_per_page' => -1, // Pega todos os posts
        'orderby'        => 'title',
        'order'          => 'ASC',
    );

    $query = new WP_Query($args);
    $values = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $values[] = get_the_title(); // Título visível
        }
        wp_reset_postdata();
    } else {
        $values[] = 'Nenhum perfil encontrado|';
    }

    $tag['raw_values'] = $values;
    $tag['values'] = $values;

    return $tag;
}

add_filter('wpcf7_form_tag', 'cf7_popular_dropdown_profiles', 10, 1);

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