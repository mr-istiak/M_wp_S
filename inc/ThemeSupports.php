<?php

namespace Inc;

class ThemeSupports
{
    public function register()
    {
        add_theme_support( 'custom-logo' );
        add_theme_support( 'html5', array('search-form') );
        add_theme_support( 'post-thumbnails' );
    }
}