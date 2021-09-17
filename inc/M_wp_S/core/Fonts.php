<?php

namespace Core;

class Fonts
{
    public static function enqueueFonts( $args )
    {
        $url = 'https://fonts.googleapis.com/css2?';
        foreach ($args as $key => $value) {
            $name = implode( '+', explode(' ', $key));

            $if = '';
            if ( (count($value) === 1) && isset($value['normal']) && (count($value['normal']) === 1) && ($value['normal'][0] === 400) ) { /**/ } else {

                $ital = isset($value['ital']) ? ':ital' :'';
                $wght = isset($value['ital']) ? ( ( in_array( 400, $value['normal'] ) && (count($value['normal']) === 1) ) ? (  ( in_array( 400, $value['ital'] ) && (count($value['ital']) > 1) ? ',wght@' :'@')) : ',wght@') : ':wght@';

                $ital_wght_array = [];
                if ( isset($value['ital']) ) {
                    if ( ( (count($value['ital']) === 1) && $value['ital'][0] === 400) && ((count($value['normal']) === 1) && $value['normal'][0] === 400) ) {
                        $wghts = '0;1';
                    } else {
                        $ital_wght_array = [];
                        foreach ($value['normal'] as $Wghtts) {
                            $ital_wght_array[] = "0,$Wghtts";
                        }
                        foreach ($value['ital'] as $Itals) {
                            $ital_wght_array[] = "1,$Itals";
                        }
                        $wghts = implode(';', $ital_wght_array);
                    }
                } else {
                    $wghts = implode(';', $value['normal']);
                }

                $if = "$ital$wght$wghts";
            }

            $url .= "family=$name$if&";
        }
        ?> <link rel="stylesheet" href="<?php echo $url . 'display=swap' ?>"> <?php
    }
}
