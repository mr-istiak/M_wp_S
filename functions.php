<?php
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) :
	require_once __DIR__ . '/vendor/autoload.php';
endif;

if ( class_exists( 'Inc\\Init' ) ) {
    Inc\Init::registerClasses();
}