<?php

namespace Inc;

final class Init
{
    
    private static function classes()
    {
        return [
            EnqueueScripts::class,
            Nav::class,
            ThemeSupports::class,
            DynamicCSS::class,
            Custom::class
        ];
    }

    public static function registerClasses()
    {
        
        foreach (self::classes() as $class) {
            $instant = self::instents( $class );

            if ( method_exists( $instant, 'register' ) ) {
                $instant->register();
            }
        }

    }

    private static function instents( $class )
    {
        return new $class();
    }

}
