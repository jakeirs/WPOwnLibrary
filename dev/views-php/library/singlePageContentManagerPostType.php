<?php

add_action( 'init', 'single_page_content_post_register' );

function single_page_content_post_register() {

    register_post_type( 'home_page_content', array(
        'labels' => array(
            'name'              => 'Zarządzanie treścią strony głównej',
            'singular_name'     => 'Zarządzanie treścią strony głównej',
            'add_new'           => 'Dodaj',
            'edit_item'         => 'Edytuj',
            'view_item'         => 'Wyświetl',
            'view_items'        => 'Wyświetl',
            'search_items'      => 'Szukaj',
            'featured_image'    => 'Zdjęcie',
            'remove_featured_image' => 'Usuń Zdjęcie',
            'set_featured_image'    => 'Ustaw Zdjęcie',
            'use_featured_image'    => 'Użyj jako Zdjęcie',
        ),
        'description'           => 'Zarządzanie treścią strony głównej',
        'public'                => true,
        'menu_position'         => 19,
        'supports'              => array( 'title', 'editor', 'custom-fields', 'thumbnail'  ),
        'menu_icon'             => 'dashicons-format-aside'
    ));
}


add_action('admin_menu', 'wpdocs_register_my_custom_submenu_page');

function wpdocs_register_my_custom_submenu_page() {
    add_submenu_page(
        'edit.php',
        'My Custom Submenu Page',
        'My Custom Submenu Page',
        'manage_options',
        'my-custom-submenu-page',
        'wpdocs_my_custom_submenu_page_callback' );
}

function wpdocs_my_custom_submenu_page_callback() {
    echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
    echo '<h2>My Custom Submenu Page</h2>';
    echo '</div>';
}
