<?php 

namespace Inc;

class DynamicCSS {
    public function register()
    {
        add_action( 'wp_head', [ $this, 'CSS' ] );
    }

    public function CSS()
    {
        echo \Core\Helper::dynamicCSS([
            'variables' => [
                
            ], 
            'selectors' => [

            ]
        ]);
    }
}