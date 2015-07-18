<?php 
header('Content-type: text/css');
ob_start("compress");

    function compress( $minify ) 
    {
	/* remove comments */
    	$minify = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $minify );

        /* remove tabs, spaces, newlines, etc. */
    	$minify = str_replace( array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $minify );
    		
        return $minify;
    }

    /* css files for combining */
	include('reset.css');
    include('default.css');
	include('isotope.css');
    include('layout.css');
	include('prettyPhoto.css');
	include('supersized.css');
	include('light-style.css');
	include('googlemaps.css');
	include('slider-menu.css');
	include('custom.css');

ob_end_flush();


/* Source for the above code - https://ikreativ.com/combine-minify-css-with-php */
