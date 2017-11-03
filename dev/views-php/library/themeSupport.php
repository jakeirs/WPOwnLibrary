<?php

if ( ! function_exists( 'ssh_theme_support' ) ) :
    function ssh_theme_support() {
        // Add language support
        load_theme_textdomain( 'sequencesh', get_template_directory() . '/custom-library/lang' );


        // Switch default core markup for search form, comment form, and comments to output valid HTML5
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Add menu support
        add_theme_support( 'menus' );

        // Let WordPress manage the document title
        add_theme_support( 'title-tag' );

        // Add post thumbnail support: http://codex.wordpress.org/Post_Thumbnails
        add_theme_support( 'post-thumbnails' );

        // RSS thingy
        add_theme_support( 'automatic-feed-links' );

        // Add post formats support: http://codex.wordpress.org/Post_Formats
        add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat') );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

    }

    add_action( 'after_setup_theme', 'ssh_theme_support' );

    // Allow to upload SVG files
    function ssh_mime_types($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
    add_filter('upload_mimes', 'ssh_mime_types');

endif;