<?php

class NavbarWalker extends Walker_Nav_Menu {
        private $_style;
        function __construct($style='dropdown'){
            $this->_style = $style;
        }
	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            switch($this->_style){
                case 'dropdown':
                    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
                    break;
                case 'tabs':
                    $output .= "\n$indent<ul class=\"nav nav-tabs nav-stacked\">\n";
                    break;
                case 'pills':
                    $output .= "\n$indent<ul class=\"nav nav-pills nav-stacked\">\n";
                    break;
            }
            
	}
        

	/**
	 * @see Walker::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
                if($args->hasChildren && $this->_style === 'dropdown'){
                    $classes[] = 'dropdown';
                }
		$classes[] = 'menu-item-' . $item->ID;

                $classes = apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args );
		$active = array_search('current-menu-item', $classes);
                if(false !== $active){ $classes[$active] = 'active'; }
                $class_names = join( ' ',  $classes);
                $class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		if($args->hasChildren && $this->_style === 'dropdown'){
                    $attributes .= ' href="#" class="dropdown-toggle" data-toggle="dropdown"';
                }else{
                    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
                }
                
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
                if($args->hasChildren && $this->_style === 'dropdown'){
                    $item_output .= '<b class="caret"></b>';
                }
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * @see Walker::end_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Page data object. Not used.
	 * @param int $depth Depth of page. Not Used.
	 */
	function end_el( &$output, $object, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

	function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
	{
		// check, whether there are children for the given ID and append it to the element with a (new) ID
		$args[0]->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);

		return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}
}
