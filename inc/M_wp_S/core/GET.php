<?php

namespace Core;

class GET
{
    public static function option(string $id, $defualt = null)
    {
        $data = $id;
        
        $key_split_pattren = '/[^\w]/';

        $splited_str = preg_split( $key_split_pattren, $data );

        $data = get_option( $splited_str[0] );

        array_shift( $splited_str );

        $sanatized_array = \Core\Helper::sanitizeArray( $splited_str );
        
        foreach ($sanatized_array as $key) {
            $data = $data[$key];
        }

        return $data ?? $defualt;
    }
}
