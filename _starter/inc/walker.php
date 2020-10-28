<?php

/**
 * Walker Classes
 * 
 * Reference:
 * <ul> // start_lvl()
 *   <li><a><span> // start_el()
 *   </a></span></li> // end_el()
 *   ...
 * >/ul> // emd_lvl()
 */

class Walker_Nav_Primary extends Walker_Nav_Menu {

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        //var_dump($item);
        $li_attributes = '';
		$class_names = $value = '';
		
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        
        $active = ( $item->current ) ? 'active' : '';
        array_push($classes, $active);
        array_push($classes, 'nav-item');

        //$class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = implode(' ' , $classes);
        $class_names = ' class="' . esc_attr($class_names) . '"';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        
        $output .= '<li' . $value . $class_names . $li_attributes . '>';

        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';
        
        $item_output = $args->before;
		$item_output .= '<a' . $attributes .  ' class="nav-link" >';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ( $depth == 0 && $args->walker->has_children ) ? ' <b class="caret"></b></a>' : '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

    }
}