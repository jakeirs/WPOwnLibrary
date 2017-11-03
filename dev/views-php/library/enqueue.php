<?php

function ssh_enqueue() {

    // delete register and enqueue style functions if CSS styles are loaded dynamically by JS
    wp_register_style( 'ssh_style', get_template_directory_uri() . '/assets/stylesheets/style.css' );
    wp_enqueue_style( 'ssh_style' );

    wp_register_script( 'ssh_js_platform', get_template_directory_uri() . '/assets/javascript/platform/platform.js', array(), false, true );
    wp_register_script( 'ssh_js_app', get_template_directory_uri() . '/assets/javascript/app.js', array(), false, true );

    wp_enqueue_script( 'ssh_js_platform' );
    wp_enqueue_script( 'ssh_js_app' );

}

add_action(  'wp_enqueue_scripts', 'ssh_enqueue' );

function add_async_attribute($tag, $handle) {
    // add script handles to the array below
    $scripts_to_async = array( 'ssh_js_app' );

    foreach($scripts_to_async as $async_script) {
        if ($async_script === $handle) {
            return str_replace(' src', ' async="async" src', $tag);
        }
    }
    return $tag;
}

add_filter('script_loader_tag', 'add_async_attribute', 10, 2);
