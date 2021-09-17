<?php

namespace Inc;

use \Core\Helper;

class EnqueueScripts
{
    public function register()
    {       
        add_action( 'wp_enqueue_scripts', [$this, 'loadingFontEndScripts'] );
        add_action( 'admin_enqueue_scripts', [$this, 'loadingBackEndScripts'] );
        add_action( 'login_enqueue_scripts', [$this, 'loadingLoginScripts'] );
        add_action( 'wp_head', [ $this, 'loadingFonts' ] );
    }

    public function loadingFontEndScripts()
    {
        wp_enqueue_style( 'tailwind', Helper::distUri('css/M_wp_S/tailwindcss.css'), [], '1.0.0', 'all' );

        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'mwps-core', Helper::distUri('js/M_wp_S/Core.js'), [], '1.0.0', true );
    }

    public function loadingBackEndScripts()
    {
        // Enqueue Your Scripts and Styles
    }

    public function loadingLoginScripts()
    {
        // Enqueue Your Scripts and Styles
    }

    public function loadingFonts()
    {
        \Core\Fonts::enqueueFonts([ 
            'Poppins' => [
                'normal' => [ 300, 400, 500, 600 ]
            ]
        ]);
    }

}
