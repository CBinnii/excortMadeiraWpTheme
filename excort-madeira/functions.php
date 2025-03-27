<?php 

/**
 * Template: Functions.php 
 */

// Thumbnail support
add_theme_support('post-thumbnails', array('page', 'post', 'service', 'profile'));
add_theme_support('widgets');

function remove_menus(){
	remove_menu_page( 'upload.php' ); //Media - imagens, vídeos, docs, etc...
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