<?php

add_filter('nav_menu_css_class', 'nav_css_filter', 10, 1);
add_filter('nav_menu_item_id', 'nav_css_filter', 10, 1);
add_filter('page_css_class', 'nav_css_filter', 10, 1);

function nav_css_filter($classes) {
    $current = array('current-menu-item', 'current-menu-parent', 'current-menu-ancestor', 'current-page-ancestor');
    if (is_array($classes)) {
        $classes = array_intersect($classes, $current);
    } else {
        $classes = '';
    }
    return $classes;
}


function ssh_register_nav_menu() {
    add_theme_support('menus');

    register_nav_menus(
        array(
            'primary-menu' => __( 'Header Menu', 'sequencesh' ),
            'secondary-menu' => __( 'Footer Menu', 'sequencesh' ),
            'categories-tabs' => __( 'Category Menu', 'sequencesh' )
        )
       );
}

add_action('after_setup_theme', 'ssh_register_nav_menu');


class SSH_Walker_Nav_Menu_Primary extends Walker_Nav_Menu {

// add classes to ul sub-menus
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // depth dependent classes
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'nav__list menu vertical submenu nav__list--arrow'
        );
        $class_names = implode( ' ', $classes );

        // build html
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }

// add main/sub classes to li's and links
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
//        echo '<pre>';
//        print_r($item);
//        echo '</pre>';
        // depth dependent classes
        $depth_classes = array(
            ( $args->walker->has_children ? 'nav__item has-submenu nav__item--has-children' : 'nav__item' )
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

        // passed classes
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // build html
        $output .= $indent . '<li class="' . $depth_class_names    . ' ' . $class_names . '">';

        // link attributes
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        if (! empty( $item->url ) ) {
            if ( $args->walker->has_children ) {
                $attributes .= '';
            } else {
                $attributes .= ' href="'   . esc_attr( $item->url ) .'"'  ;
            }
        } else {
            $attributes .= '';
        }
        $attributes .= ' class="nav__link "';

        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );

        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}



class SSH_Walker_Nav_Category_Tabs extends Walker_Nav_Menu {

// add classes to ul sub-menus
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // depth dependent classes
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'nav__list menu vertical submenu nav__list--arrow'
        );
        $class_names = implode( ' ', $classes );

        // build html
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }

// add main/sub classes to li's and links
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
//        echo '<pre>';
//        print_r($item->title);
//        print_r($item->current);
//        echo '</pre>';
        // depth dependent classes
        $depth_classes = array(
            ( $item->current ? 'bar-tabs__item--is-active bar-tabs__item' : 'bar-tabs__item' )
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

        // passed classes
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // build html
        $output .= $indent . '<li class="' . $depth_class_names    . ' ' . $class_names . '">';

        // link attributes
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        if (! empty( $item->url ) ) {
            if ( $args->walker->has_children ) {
                $attributes .= '';
            } else {
                $attributes .= ' href="'   . esc_attr( $item->url ) .'"'  ;
            }
        } else {
            $attributes .= '';
        }
        $attributes .= ' class="bar-tabs__link "';

        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );

        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

