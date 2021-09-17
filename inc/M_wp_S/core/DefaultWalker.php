<?php

namespace Core;


class DefaultWalker extends \Walker_Nav_Menu
{
    private $start_lvl;
    private $start_el;

    public function __construct( array $codes = [] )
    {
        if ( isset($codes['start_lvl']) ) $this->startLvl( $codes['start_lvl'] );

        if ( isset($codes['start_el']) ) $this->startEl( $codes['start_el'] );
    }
    
    private function startLvl( $lvl )
    {
        $class = $lvl['class'] ?? '';

        if ( isset( $lvl['id'] ) ) {
            $id = $lvl['id'];
        }

        $attr = '';
        if ( isset( $lvl['attrs'] ) ) {
            $attr = ' '. Helper::attrs( $lvl['attrs'] );
        }

        $this->start_lvl = [ $class, $id, $attr ];
    }

    private function startEl( $el )
    {
        
        $li_class = $el['li']['class'] ?? '';
        
        $li_id = $el['li']['id'] ?? '';

        $li_attr = '';
        if ( isset( $el['li']['attrs'] ) ) {
            $li_attr = ' '. Helper::attrs( $el['li']['attrs'] );
        }

        $a_class = $el['a']['class'] ?? '';
        
        $a_id = $el['a']['id'] ?? '';

        $a_attr = '';
        if ( isset( $el['a']['attrs'] ) ) {
            $a_attr = ' '. Helper::attrs( $el['a']['attrs'] );
        }

        $indented_submenus = $el['indented-submenus'] ?? '';
        
        $this->start_el = [
            'li' => [
                'class' => $li_class,
                'id' => $li_id,
                'attrs' => $li_attr
            ],
            'a' => [
                'class' => $a_class,
                'id' => $a_id,
                'attrs' => $a_attr
            ],
            'indented-submenus' => $indented_submenus
        ];
    }
    
    
    public function start_lvl( &$output, $depth = 0, $args = [] ) 
    {
        $indent = str_repeat("\t", $depth);

        $defult_class = ' absolute bg-gray-800 border-b-[3px] border-solid border-[#069cff] min-w-[210px] hidden';

        $class_fuction = is_string( $this->start_lvl[0] ?? '' ) ? $this->start_lvl[0] : $this->start_lvl[0]( $depth, $args );
       
        $class = ($depth >= 0) ? ( isset( $this->start_lvl[0] ) ? $class_fuction : $defult_class ) : '';
        
        $id = ($depth >= 0) ? ( $this->start_lvl[1] ?? '' ) : '';
        
        $attrs = ($depth >= 0) ? ( $this->start_lvl[2] ?? '' ) : '';

        $output .= "\n$indent<ul id=\"$id\" class=\"sub-menu $class\"$attrs >\n";
    }

    public function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 )
    {

        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';
 
        $classes   = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = 'wp_nav_menu';
        $classes[] = ( $args->walker->has_children ) ? 'has_children': '';

        if ( isset( $this->start_el['li']['class'] ) ) {

            $classes[] = is_string( $this->start_el['li']['class'] ) ? $this->start_el['li']['class'] : $this->start_el['li']['class']( $item, $depth, $args, $id );

        } else {
            $classes[] = 'text-gray-400 font-Poppins font-semibold text-lg tracking-widest';
            $classes[] = ( $depth > 0 ) ? 'flex' : 'my-2';
        }

        if ( isset( $this->start_el['indented-submenus'] ) ) {
            if ( $this->start_el['indented-submenus'] === true ) {
                $classes[] = ( $depth > 0 ) ? 'indented-sub-submenu' : '';
            }
        } else {
            $classes[] = ( $depth > 0 ) ? 'indented-sub-submenu' : '';
        }


        $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

        $class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
 

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) .' '. ( $this->start_el['li']['id'] ?? '' ) . '"' : '';
 
        $output .= $indent . '<li' . $id . $class_names . ' ' . ( $this->start_el['li']['attrs'] ?? '' ) . '>';


        $atts           = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        if ( '_blank' === $item->target && empty( $item->xfn ) ) {
            $atts['rel'] = 'noopener';
        } else {
            $atts['rel'] = $item->xfn;
        }
        $atts['href']         = ! empty( $item->url ) ? $item->url : '';
        $atts['aria-current'] = $item->current ? 'page' : '';


        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
 
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $a_classes = [];

        if ( isset( $this->start_el['a']['class'] ) ) {

            $a_classes[] = is_string( $this->start_el['a']['class'] ) ? $this->start_el['a']['class'] : $this->start_el['a']['class']( $item, $depth, $args, $id );

        } else {
            $a_classes[] = 'mx-3 my-1.5';
            $a_classes[] = ( $item->current ) ? 'text-white': 'transition-all duration-300 hover:text-white focus:text-white';
        }

        $attributes .= ' class="'.implode( ' ', $a_classes ).'"';
 
        $title = apply_filters( 'the_title', $item->title, $item->ID );

        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
 
        $item_output  = $args->before;
        $item_output .= '<a id="' . ( $this->start_el['a']['id'] ?? '' ) . '"' . $attributes .' ' . ( $this->start_el['a']['attrs'] ?? '' ) . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
 

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    
    }
}
