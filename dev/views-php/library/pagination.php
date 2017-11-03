<?php

/**
 * Numeric Pagination Class
 * @author Alexandre Plennevaux https://pixeline.be
 *
 * This class returns a list of LI > A. It is up to you to set the wrapping NAV > UL around your function call.
 *
 * @usage (setting specific classes)
 *
 * // Sets the css classes you want to be used for the output
 *
 * $li_classes = array('ends' => 'arrow', 'default' => '' );
 * $a_classes = array('default'=>'page-numbers', 'prev'=>'prev', 'next'=>'next', 'current'=>'current' );
 * $prevnext_text = array('prev' => '<i class="icon-arrow2"></i>', 'next'=> '<i class="icon-arrow2"></i>');
 *
 * // Call the function
 * echo new Numeric_Pagination($a_classes, $li_classes, $prevnext_text);
 *
 *
 */

if ( ! class_exists( 'Numeric_Pagination' ) ) {
    class Numeric_Pagination
    {
        public $li_classes = array('next' => 'pagination-next', 'prev' => 'pagination-previous', 'default' => '');
        public $a_classes = array('default' => 'pagination-item', 'prev' => 'prev', 'next' => 'next', 'current' => 'current');
        public $prevnext_text = array('prev' => 'prev', 'next' => 'next');

        public function __construct($a_classes = null, $li_classes = null, $prevnext_text = null)
        {
            global $wp_query;
            // Exit early if no need for pagination.
            if ($wp_query->max_num_pages <= 1)
                return;
            // Set defaults
            if (null !== $a_classes) {
                $this->a_classes = $a_classes;
            }
            if (null !== $li_classes) {
                $this->li_classes = $li_classes;
            }
            if (null !== $prevnext_text) {
                $this->prevnext_text = $prevnext_text;
            }
        }

        public function __toString()
        {
            global $wp_query;

            $big = 999999999; // need an unlikely integer
            $pages = paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $wp_query->max_num_pages,
                'type' => 'array',
                'end_size' => 2,
                'mid_size' => 3,
                'prev_next' => true,
                'prev_text'  => $this->prevnext_text['prev'],
                'next_text'  => $this->prevnext_text['next']
            ));

            $output = '';
            if (is_array($pages) && count($pages) > 0) {
                $paged = (0 === get_query_var('paged')) ? 1 : get_query_var('paged');
                foreach ($pages as $k => $page) {
                    // take first item or the last one (next and previous)
                    if ( 0 === $k && !(get_query_var('paged') == 0 || get_query_var('paged') == 1 ) ) {
                        $li_class = $this->li_classes['prev'];
                    } elseif ( (count($pages) - 1) === $k && !(get_query_var('paged') == (count($pages) - 1)) ) {
                        $li_class = $this->li_classes['next'];
                    } else {
                        $li_class = $this->li_classes['default'];
                    }
                    $output .= '<li class="' . $li_class . '">' . $this->replace_anchor_classes($page) . '</li>';
                }
            }
            return $output;
        }

        function replace_anchor_classes($anchor)
        {

            $anchor = preg_replace('/page-numbers/', $this->a_classes['default'], $anchor);
            $anchor = preg_replace('/prev/', $this->a_classes['prev'], $anchor);
            $anchor = preg_replace('/next/', $this->a_classes['next'], $anchor);
            $anchor = preg_replace('/current/', $this->a_classes['current'], $anchor);
            return $anchor;
        }
    }
}
