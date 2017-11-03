<?php

add_action( 'init', 'team_member_post_register' );

function team_member_post_register() {

    register_post_type( 'team', array(
        'labels' => array(
            'name'              => 'Załoga',
            'singular_name'     => 'Członek załogi',
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
        'description'           => 'Członkowie załogi wyświetlani na stronie głównej',
        'public'                => true,
        'menu_position'         => 20,
        'supports'              => array( 'title', 'editor', 'custom-fields', 'thumbnail'  ),
        'menu_icon'             => 'dashicons-businessman'
    ));
}