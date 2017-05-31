<?php

add_shortcode( 'restaurants', 'restaurants' );

add_shortcode( 'foodtours', 'food_tours' );

add_shortcode( 'farmtours', 'farm_tours' );


// Get all restaurants

function restaurants() {
				
	$args['pagination'] = 'false';
	$args['posts_per_page'] = '-1';
	$args['post_type'] = 'listing';
	$args['orderby'] = 'title';
	$args['order'] = 'ASC';
	$args['tax_query'][0] = array(
								'taxonomy' => 'listing_category',
								'field' => 'slug',
								'terms' => 'restaurant'
							); 					
	
	// The Query
	$query = new WP_Query( $args );
	
	// The Loop
	if ( $query->have_posts() ) {
		
		$restaurants .= '<ul>';
				
		while ( $query->have_posts() ) {
			
			$query->the_post();
			
			$restaurants .= '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
			
		}
		
		$restaurants .= '</ul>';
				
	}

	// Restore original Post Data
	wp_reset_postdata();

	return $restaurants;

}


// Get all food tours

function food_tours() {
				
	$args['pagination'] = 'false';
	$args['posts_per_page'] = '-1';
	$args['post_type'] = 'tour';
	$args['orderby'] = 'title';
	$args['order'] = 'ASC';
	$args['tax_query'][0] = array(
								'taxonomy' => 'tour_category',
								'field' => 'slug',
								'terms' => 'food-tours'
							); 					
	
	// The Query
	$query = new WP_Query( $args );
	
	// The Loop
	if ( $query->have_posts() ) {
				
		while ( $query->have_posts() ) {
			
			$query->the_post();
			
			if ($website = get_field('website')) {
				
				$tour_title = '<strong><a href="' . $website . '" target="_blank">' . get_the_title() . ': </a></strong>';
				
			} else {
				
				$tour_title = '<strong>' . get_the_title() . ': </strong>';
			
			}
			
			$food_tours .= '<li>' . $tour_title . get_the_content() . '</li>';
			
		}
		
		$food_tours  = '<ul>' . $food_tours . '</ul>';
		
	}

	// Restore original Post Data
	wp_reset_postdata();

	return $food_tours;

}


// Get all farm tours

function farm_tours() {
	
	$args['pagination'] = 'false';
	$args['posts_per_page'] = '-1';
	$args['post_type'] = 'tour';
	$args['orderby'] = 'title';
	$args['order'] = 'ASC';
	$args['tax_query'][0] = array(
								'taxonomy' => 'tour_category',
								'field' => 'slug',
								'terms' => 'farm-tours'
							); 					
	
	// The Query
	$query = new WP_Query( $args );
	
	// The Loop
	if ( $query->have_posts() ) {
				
		while ( $query->have_posts() ) {
			
			$query->the_post();
			
			$category = get_the_terms($post->ID, 'region');
			
			$tour_cat_name = $category[0]->name;
			$tour_cat_slug = $category[0]->slug;
			
			if($tour_cat_slug) {

				if ($website = get_field('website')) {
					
					$tour_title = '<strong><a href="' . $website . '" target="_blank">' . get_the_title() . ': </a></strong>';
					
				} else {
					
					$tour_title = '<strong>' . get_the_title() . ': </strong>';
				
				}
				
				$tours_by_region[$tour_cat_slug]['name'] = $tour_cat_name;
				$tours_by_region[$tour_cat_slug]['content'] .= '<li>' . $tour_title . get_the_content() . '</li>';
			
			}
			
		}
		
		array_multisort($tours_by_region, SORT_ASC);
		
		foreach($tours_by_region as $region) {
					
			$farm_tours .= '<h3>' . $region['name'] . '</h3>';
			$farm_tours .= '<ul>';
		
			$farm_tours .= $region['content'];
			
			$farm_tours .= '</ul>';
			
		}
				
	}

	// Restore original Post Data
	wp_reset_postdata();


	return $farm_tours;

}


// Set URL for imports for Tours

function set_tour_url($website) {
    
	if($website) {
		
		if (strpos($website, 'http') !== false) {
			
			$pre_url = '';
			
		} else {
			
			$pre_url = 'http://';
		}
		
		$website = $pre_url . $website;
	
	} else {
		
		$website = '';
		
	}
	
    return $website;
}



// Set URL for imports for Farmers Markets

function set_market_url($website) {
    
	if($website) {
		
		if (strpos($website, 'http') !== false) {
			
			$pre_url = '';
			
		} else {
			
			$pre_url = 'http://';
		}
		
		$website = '<a href="'. $pre_url . $website . '" target="_blank">Website</a>';
	
	} else {
		
		$website = '';
		
	}
	
    return $website;
}



// Set event date for imports from sac365
function set_event_date($eventDateBegin, $date) {
	
    if($date) {
		$eventdate = $date;
	} else {
		$parts = explode("-", $eventDateBegin);	
		$eventdate = $parts[2].$parts[0].$parts[1];
	}
	
	return $eventdate;

}


// Combine event types and remove duplicates
function set_event_type($eventType, $secondaryType) {
	
	if($eventType && $secondaryType) { // If both type and secondary type
		
		$secondaryType .= ', ' . $eventType;
		
		$types = explode(", ", $secondaryType);	
		
	} elseif ($eventType && !$secondaryType) { // If only type and no secondary type
		
		$types[] = $eventType;
		
	} else { // In case there is not type at all
				
		$types[] = 'Misc';
	}
	
	$finalTypes = array_unique($types);

	
	return implode(",", $finalTypes);

}


function my_scripts_method() {
	wp_enqueue_script(
		'custom-script',
		get_stylesheet_directory_uri() . '/js/jquery.main.js',
		array( 'jquery' )
	);
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );


function my_custom_init() {
	add_post_type_support( 'page', 'excerpt' );
	add_post_type_support( 'event', 'excerpt' );
}

add_action('init', 'my_custom_init');

function add_query_vars_filter( $vars ){
  $vars[] = "start";
  $vars[] = "end";
  $vars[] = "category";
  $vars[] = "region";
  $vars[] = "wday";
  $vars[] = "email";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );


add_theme_support( 'post-thumbnails' );


function get_excerpt_by_id($post_id, $class, $nolink, $length){
    $the_post = get_post($post_id); //Gets post ID
	
	if(!$the_excerpt = $the_post->post_excerpt) {
		
		
		if(get_post_type($post_id) == 'event')
		{
			$the_excerpt = get_field('eventDescription', $post_id);
		} else {
			$the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
		}
		
		if($length) {
			$excerpt_length = $length;
		} else {
			$excerpt_length = 20; //Sets excerpt length by word count
		}
		
		$the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
		$words = explode(' ', $the_excerpt, $excerpt_length + 1);
	
		if(count($words) > $excerpt_length) :
			array_pop($words);
			array_push($words, '…');
			$the_excerpt = implode(' ', $words);
		endif;
	
	}

	$url = get_the_permalink();
	
	if($nolink) {
		$link_html = '';
	} else {
		$link_html = ' <a href="' . $url . '" class="' . $class . '">READ MORE</a>';
	}
	
	$the_excerpt = '<p>' . $the_excerpt . $link_html . '</p>';

    return $the_excerpt;
}

add_action('admin_head', 'hide_menu');

function hide_menu() {
	
	if( !current_user_can('administrator') ) {
    // true if user is not admin
		remove_menu_page('edit-comments.php'); // Comments
		remove_submenu_page( 'themes.php', 'themes.php' ); // hide the theme selection submenu
    	remove_submenu_page( 'themes.php', 'widgets.php' ); // hide the widgets submenu
	}

}

add_action( 'init', 'my_custom_menus' );
 
function my_custom_menus() {
    register_nav_menus(
        array(
            'top-menu' => __( 'Top Menu' )
        )
    );
}

function sidebar_widgets_init() {

	register_sidebar( array(
		'name' => 'Sidebar',
		'id' => 'right_sidebar',
		'before_widget' => '<article>',
		'after_widget' => '</article>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	) );
}
add_action( 'widgets_init', 'sidebar_widgets_init' );




class sidebar_walker extends Walker_Page {
    // start level..
    function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class='side-drop'>\n";
	}
	
	function end_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
	}
	
	
	function start_el( &$output, $page, $depth, $args, $current_page = 0 ) {

                if ( $depth )

                        $indent = str_repeat("\t", $depth);

                else

                        $indent = '';



                extract($args, EXTR_SKIP);

                $css_class = array('page_item', 'page-item-'.$page->ID);

                if ( !empty($current_page) ) {

                        $_current_page = get_post( $current_page );

                        if ( in_array( $page->ID, $_current_page->ancestors ) )

                                $css_class[] = 'current_page_ancestor';

                        if ( $page->ID == $current_page )

                                $css_class[] = 'current_page_item';

                        elseif ( $_current_page && $page->ID == $_current_page->post_parent )

                                $css_class[] = 'current_page_parent';

                } elseif ( $page->ID == get_option('page_for_posts') ) {

                        $css_class[] = 'current_page_parent';

                }



				$link_css="";		

				if($args['has_children']>0){

					$link_css="class=\"side-opener\"";

				}

				

                $css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );



                $output .= $indent . '<li class="' . $css_class . '"><a href="' . get_permalink($page->ID) . '" '.$link_css.'>' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';



                if ( !empty($show_date) ) {

                        if ( 'modified' == $show_date )

                                $time = $page->post_modified;

                        else

                                $time = $page->post_date;



                        $output .= " " . mysql2date($date_format, $time);

                }

        }
	
}






class themeslug_walker_nav_menu extends Walker_Nav_Menu {
  
function start_lvl( &$output, $depth ) {
    // depth dependent classes
    $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
    $display_depth = ( $depth + 1); // because it counts the first submenu as 0
    
    // build html
    $output .= "\n" . $indent . '<ul class="side-drop">';
}

function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

}



function custom_wp_nav_menu($var) {
	return is_array($var) ? array_intersect($var, array(
		//List of allowed menu classes
		'current_page_item',
		'current_page_parent',
		'current_page_ancestor',
		'first',
		'last',
		'vertical',
		'horizontal'
		)
	) : '';
}
add_filter('nav_menu_css_class', 'custom_wp_nav_menu');
add_filter('nav_menu_item_id', 'custom_wp_nav_menu');
add_filter('page_css_class', 'custom_wp_nav_menu');

//Replaces "current-menu-item" with "active"
function current_to_active($text){
	$replace = array(
		//List of menu item classes that should be changed to "active"
		'current-menu-item' => 'active',
		'current_page_parent' => 'active',
		'current_page_ancestor' => 'active',
		'current_page_item' => 'active'
	);
	$text = str_replace(array_keys($replace), $replace, $text);
		return $text;
	}
add_filter('nav_menu_css_class', 'current_to_active');
add_filter('nav_menu_item_id', 'current_to_active');
add_filter('page_css_class', 'current_to_active');

//Deletes empty classes and removes the sub menu class
function strip_empty_classes($menu) {
    $menu = preg_replace('/ class=""| class="sub-menu"/','',$menu);
    return $menu;
}
add_filter ('wp_nav_menu','strip_empty_classes');

/*
Plugin Name: Breadcrumb Functions
Description: Functions for displaying breadcrumbs when working with hierarchical post types. Does nothing out-of-the-box, functions must be added to theme (directly or via hooks, your discretion).
Author: Kailey Lampert
Author URI: http://kaileylampert.com/
*/
/*
	Basic:
		echo get_breadcrumbs( $post );
		//returns: <p><a href='{post_url}'>{post_title}</a> &gt; <a href='{post_url}'>{post_title}</a></p>
 
	Advanced:
		echo get_breadcrumbs( $post, array( 'before_all' => '<ol>', 'after_all' => '</ol>', 'before_each' => '<li>', 'after_each' => '</li>', 'separator' => '' ) );
		//returns: <ol><li><a href='{post_url}'>{post_title}</a></li><li><a href='{post_url}'>{post_title}</a></li></ol>
*/
 
function get_breadcrumbs( $starting_page, $deco = array( 'before_all' => '<p>', 'after_all' => '</p>', 'before_each' => '', 'after_each' => '', 'separator' => '' ) ) {
	//get our "decorations"
	extract( $deco );
	//reverse it so the highest (most-parent?) page is first
	$ids = array_reverse( _get_breadcrumbs( $post ) );
	//if only one id, there are no parents. show nothing
	if ( count( $ids ) <= 0 ) return '';
	//loop through each, create decorated links
	$links = array();
	
	
	$len = count($ids);
	
	foreach ( $ids as $url => $title ) {
		if($len > 1) {
			$links[] = "$before_each<a href='$url'>$title</a>$after_each";
		} else {
			$links[] = "$before_each$title$after_each";
		}
		$len--;
	}
	//
	//return it all together
	return $before_all . implode( $separator, $links ) . $after_all;
}
 
//recursive function for getting all parent, grandparent, etc. IDs
//not intended for direct use
function _get_breadcrumbs( $starting_page, $container = array() ) {
 
	//make sure you're working with an object
	$sp = ( ! is_object( $starting_page ) ) ? get_post( $starting_page ) : $starting_page;
	
	//make sure to insert starting page only once
	if ( ! in_array( get_permalink( $sp->ID ), $container ) )
		$container[ get_permalink( $sp->ID ) ] = get_the_title( $sp->ID );
	
	//if parent, recursion!
	if ( $sp->post_parent > 0 ) {
		$container[ get_permalink( $sp->post_parent ) ] = get_the_title( $sp->post_parent );
		$container = _get_breadcrumbs( $sp->post_parent, $container );
	}
	
	return $container;
}


/**
 * Create HTML list of pages.
 *
 * @package Razorback
 * @subpackage Walker
 * @author Michael Fields <michael@mfields.org>
 * @copyright Copyright (c) 2010, Michael Fields
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @uses Walker_Page
 *
 * @since 2010-05-28
 * @alter 2010-10-09
 */
class Razorback_Walker_Page_Selective_Children extends Walker_Page {
    /**
     * Walk the Page Tree.
     *
     * @global stdClass WordPress post object.
     * @uses Walker_Page::$db_fields
     * @uses Walker_Page::display_element()
     *
     * @since 2010-05-28
     * @alter 2010-10-09
     */
    function walk( $elements, $max_depth ) {
        global $post;
        $args = array_slice( func_get_args(), 2 );
        $output = '';
 
        /* invalid parameter */
        if ( $max_depth < -1 ) {
            return $output;
        }
 
        /* Nothing to walk */
        if ( empty( $elements ) ) {
            return $output;
        }
 
        /* Set up variables. */
        $top_level_elements = array();
        $children_elements  = array();
        $parent_field = $this->db_fields['parent'];
        $child_of = ( isset( $args[0]['child_of'] ) ) ? (int) $args[0]['child_of'] : 0;
 
        /* Loop elements */
        foreach ( (array) $elements as $e ) {
            $parent_id = $e->$parent_field;
            if ( isset( $parent_id ) ) {
                /* Top level pages. */
                if( $child_of === $parent_id ) {
                    $top_level_elements[] = $e;
                }
                /* Only display children of the current hierarchy. */
                else if (
                    ( isset( $post->ID ) && $parent_id == $post->ID ) ||
                    ( isset( $post->post_parent ) && $parent_id == $post->post_parent ) ||
                    ( isset( $post->ancestors ) && in_array( $parent_id, (array) $post->ancestors ) )
                ) {
                    $children_elements[ $e->$parent_field ][] = $e;
                }
            }
        }
 
        /* Define output. */
        foreach ( $top_level_elements as $e ) {
            $this->display_element( $e, $children_elements, $max_depth, 0, $args, $output );
        }
        return $output;
    }
}

?>