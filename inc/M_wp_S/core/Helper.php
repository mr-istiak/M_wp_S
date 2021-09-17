<?php

namespace Core;

class Helper
{
    public static function joinAssoc( string $gule, string $key_values_gule, array $array, string $after_value = '')
    {
        $joined = '';
        foreach ($array as $key => $value) {
            if ($key === $array[0]) {
                $joined .= $key . $key_values_gule . $value. $after_value;
            } else {
                $joined .= $gule . $key . $key_values_gule . $value . $after_value;
            }
        }
        return $joined;
    }

    public static function attrs( array $array )
    {
        return self::joinAssoc( ' ', '="', $array, '"' );
    }

    public static function dynamicCSS( array $array )
    {
        $css = '<style>';
        if (isset($array['variables'])) {
            $css .= ':root {
                '. self::joinAssoc( ' ', ':', $array['variables'], ';' ) .'
            }';
        }


        foreach ($array['selectors'] ?? [] as $key => $utility) {          
            $css .= ' '.$key . '{'.self::joinAssoc(' ', ':', $utility, ';' ).'}';
        }

        return $css.'</style>';
    }

    public static function input( array $attrs = [], array $label = [], bool $flip = false )
    {
        $output = '';
        
        if ( isset($label['content']) ) {
            $output .= '<label '. (self::attrs($label['attrs'] ?? [])) .'>';
            if (! $flip) {
                $output .= $label['content'];
            }
        }    

        $output .= "<input ". ( ! isset($attrs['class']) ? "class=\"border-solid border-2 border-black\"" : "" ) . " " . self::attrs($attrs) ."/>";
        
        if ( isset($label['content']) ) {
            if ($flip) {
                $output .= $label['content'];
            }
            $output .= '</label>';
        }

        echo $output;
    }

    public static function distUri($path)
    {
        return get_template_directory_uri(  ) . '/dist/' . $path;
    }

    public static function require($path)
    {
        return get_template_directory() . $path;
    }

    public static function requireUri($path)
    {
        return get_template_directory_uri() . $path;
    }

    public static function explodeMarge( string $delemeter, string $string, array $margeNo, string $gule )
    {
        $array = explode( $delemeter, $string );

        $str = '';

        foreach ($margeNo as $NO ) {
            if ($marge == $NO) {
                $str .= $array[$NO];
            } else {
                $str .= '/'.$array[$NO];
            }
        }

        return $str;
    }

    public static function sanitizeArray(array $array)
    {
        $sanatized_array = '';
        foreach ($array as $key) {
            if ($key) {
                if ( $key == $array[0] ) {
                    $sanatized_array .= $key;
                } else {
                    $sanatized_array .= '|' . $key;
                }               
            }
        }
        return $sanatized_array = explode( '|', $sanatized_array );
    }

    public static function rand(int $min, int $max, int $length)
    {
        $string_qoute = '';
        for ($i=0; $i < $length; $i++) { 
            $string_qoute .= rand($min, $max);
        }

        return $string_qoute;
    }
}
