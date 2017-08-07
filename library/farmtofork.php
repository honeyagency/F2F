<?php

class StarterSite extends TimberSite
{

    public function __construct()
    {
        add_theme_support('post-formats');
        add_theme_support('post-thumbnails');
        add_theme_support('menus');
        add_filter('timber_context', array($this, 'add_to_context'));
        add_filter('get_twig', array($this, 'add_to_twig'));
        add_action('init', array($this, 'register_post_types'));
        add_action('init', array($this, 'register_taxonomies'));
        parent::__construct();
    }

    public function register_post_types()
    {

        //this is where you can register custom post types

    }

    public function register_taxonomies()
    {

        //this is where you can register custom taxonomies

    }

    public function add_to_context($context)
    {

        $context['site']     = $this;
        return $context;
    }

    public function add_to_twig($twig)
    {

        /* this is where you can add your own fuctions to twig */
        $twig->addExtension(new Twig_Extension_StringLoader());
        $twig->addFilter('myfoo', new Twig_Filter_Function('myfoo'));

        $twig->addFilter('fraction', new Twig_Filter_Function('convertDecimalToFraction'));

        return $twig;
    }
}
add_filter('timber/post/content/show_password_form_for_protected', function($maybe_show) {
    return true;
});
add_filter('timber/post/content/password_form', function($form, $post){
    return Timber::compile('assets/password-form.twig', array('post' => $post));
 }, 10, 2);


new StarterSite();

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
