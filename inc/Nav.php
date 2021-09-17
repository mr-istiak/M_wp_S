<?php

namespace Inc;

class Nav
{
    public function register()
    {
        add_action( 'init', [$this, 'registeringNavMenu'] );
    }

    public function registeringNavMenu()
    {
        add_theme_support( 'menus' );
        register_nav_menus( array(
            'main-menu'=> 'Main Menu',
        ) );
    }
}
