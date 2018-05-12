<?php

function objectToArray($d)
{
    if (is_object($d)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $d = get_object_vars($d);
    }

    if (is_array($d)) {
        /*
         * Return array converted to object
         * Using __FUNCTION__ (Magic constant)
         * for recursive call
         */
        return array_map(__FUNCTION__, $d);
    } else {
        // Return array
        return $d;
    }
}
// require_once 'instagram.php';

add_image_size('home_event_image', 600, 320, true);
if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
    acf_add_options_sub_page('Site Options');
    // acf_add_options_sub_page('Footer');

}

function buscemi_scripts()
{

    wp_register_script('lazyload', get_template_directory_uri() . '/app/vendors/lazyload.min.js', null, false, true);
    wp_enqueue_script('lazyload');
    wp_register_script('picturefill', get_template_directory_uri() . '/app/vendors/picturefill.min.js', null, false, true);
    wp_enqueue_script('picturefill');
    wp_register_script('flickity', get_template_directory_uri() . '/app/vendors/flickity/flickity.min.js',array('jquery'), false, true);
    wp_enqueue_script('flickity');
wp_register_script('flickityhash', get_template_directory_uri() . '/app/vendors/flickity/flickityhash.js', null, false, true);
    wp_enqueue_script('flickityhash');
   wp_register_script('flickitylazy', get_template_directory_uri() . '/app/vendors/flickity/bglazyload.min.js', null, false, true);
    wp_enqueue_script('flickitylazy');
    wp_enqueue_style('flickity_style', get_template_directory_uri() . '/app/vendors/flickity/flickity.min.css', null, null, null);

}
add_action('wp_enqueue_scripts', 'buscemi_scripts');
