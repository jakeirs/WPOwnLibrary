<?php

add_action( 'init', 'our_offer_post_register' );

function our_offer_post_register() {

    register_post_type( 'our_offer', array(
        'labels' => array(
            'name'              => 'Nasza oferta',
            'singular_name'     => 'Oferta',
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
        'description'           => 'Oferta wyświetlona w sekcji 3ciej',
        'public'                => true,
        'menu_position'         => 20,
        'supports'              => array( 'title', 'editor', 'custom-fields', 'thumbnail'  ),
        'menu_icon'             => 'dashicons-images-alt'
    ));
}