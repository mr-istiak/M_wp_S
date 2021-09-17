jQuery( document ).ready( Nav => {
    Nav('.wp_nav_menu.has_children').mouseenter( function() {

        Nav(this).children('ul.hidden').slideDown(320);

    } );

    Nav('.wp_nav_menu.has_children').mouseleave( function() {
        Nav(this).children('ul.hidden').slideUp(320);
    } );

    Nav('.wp_nav_menu.indented-sub-submenu').mouseenter( function() {
        var sub_submenu = Nav(this);
        var width = sub_submenu.width();
        var window_width = Nav( window ).width();
        var minase = '';
        var right_width = (window_width - sub_submenu.offset().left) - width;

        if ( right_width < width ) {
            minase = '-'
        }

        sub_submenu.children('ul.hidden').css('margin-left', (minase + width + 'px') );
    } );
} );