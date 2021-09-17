<?php

namespace Core;

class WP
{

    public static function navMenu(array $args)
    {
        $default_class = 'flex flex-row flex-wrap mx-3 min-h-[1.6em] bg-gray-800 border-b-[3px] border-solid border-[#069cff]';
        $args_varification = [
            'menu'                 => $args['menu'] ?? '',
            'container'            => $args['container'] ?? false,
            'container_class'      => $args['container_class'] ?? '',
            'container_id'         => $args['container_id'] ?? '',
            'container_aria_label' => $args['container_aria_label'] ?? '',
            'menu_class'           => $args['menu_class'] ?? $default_class,
            'menu_id'              => $args['menu_id'] ?? '',
            'echo'                 => $args['echo'] ?? true,
            'before'               => $args['before'] ?? '',
            'after'                => $args['after'] ?? '',
            'link_before'          => $args['link_before'] ?? '',
            'link_after'           => $args['link_after'] ?? '',
            'items_wrap'           => $args['items_wrap'] ?? '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'item_spacing'         => $args['item_spacing'] ?? 'preserve',
            'depth'                => $args['depth'] ?? 0,
            'walker'               => $args['walker'] ?? new DefaultWalker(),
        ];

        if ( isset($args['theme_location']) ) {
            $args_varification['theme_location'] = '__no_such_loaction';
            $args_varification['theme_location'] = $args['theme_location'];
            $args_varification['fallback_cb'] = $args['fallback_cb'] ?? false;
        } else {
            $args_varification['fallback_cb'] = $args['fallback_cb'] ?? 'wp_page_menu';
        }

        wp_nav_menu( $args_varification );
    }
}
