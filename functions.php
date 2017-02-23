<?php

// =============================================================================
// FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Overwrite or add your own custom functions to X in this file.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Enqueue Parent Stylesheet
//   02. Additional Functions
// =============================================================================

// Enqueue Parent Stylesheet
// =============================================================================

add_filter( 'x_enqueue_parent_stylesheet', '__return_true' );



// Additional Functions
// =============================================================================

add_action( 'cornerstone_load_builder', function() {
	echo '<style>.ps-container>.ps-scrollbar-y-rail>.ps-scrollbar-y {width: 10px !important;}</style>';
});

function show_pre( $arr )
{
	echo '<pre>';
	print_r( $arr );
	echo '</pre>';
}


// Commercial Post Type
$archives = defined( 'EPL_COMMERCIAL_DISABLE_ARCHIVE' ) && EPL_COMMERCIAL_DISABLE_ARCHIVE ? false : true;
$slug     = defined( 'EPL_COMMERCIAL_SLUG' ) ? EPL_COMMERCIAL_SLUG : 'commercial';
$rewrite  = defined( 'EPL_COMMERCIAL_DISABLE_REWRITE' ) && EPL_COMMERCIAL_DISABLE_REWRITE ? false : array('slug' => $slug, 'with_front' => false);

define('EPL_COMMERCIAL_SLUG', 'for-sale');


// Rental Post Type
$archives = defined( 'EPL_RENTAL_DISABLE_ARCHIVE' ) && EPL_RENTAL_DISABLE_ARCHIVE ? false : true;
$slug     = defined( 'EPL_RENTAL_SLUG' ) ? EPL_RENTAL_SLUG : 'rental';
$rewrite  = defined( 'EPL_RENTAL_DISABLE_REWRITE' ) && EPL_RENTAL_DISABLE_REWRITE ? false : array('slug' => $slug, 'with_front' => false);

define('EPL_RENTAL_SLUG', 'for-rent');


add_action( 'wp_enqueue_scripts', 'my_scripts' );
function my_scripts() 
{
	wp_enqueue_style( 'x-custom-styles', get_stylesheet_directory_uri() . '/the-styles.css', array(), date('YmdHis') );
	wp_enqueue_script( 'app', get_stylesheet_directory_uri() . '/js/app.js', array(), date('YmdHis') );
}

function is_epl_search()
{
	if( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'epl_search' )
		return true;
	else
		return false;
}

function get_epl_search_query()
{
	$_REQUEST = array_map('sanitize_text_field',$_REQUEST);

	extract($_REQUEST);

	$args = array();
	if(!empty($property_type)) {
		$args['post_type']	=	$property_type;
	} else {
		$args['post_type']	=	array('property', 'rental', 'commercial' , 'land');
	}

	$meta_query = array();
	if(isset($property_security_system) && in_array($property_security_system, array('yes', '1')) ) {
		$meta_query[] = array(
			'key'		=>	'property_security_system',
			'value'		=>	array('yes', '1'),
			'compare'	=>	'IN'
		);
	}
	if(isset($property_air_conditioning) && in_array($property_air_conditioning, array('yes', '1')) ) {
		$meta_query[] = array(
			'key'		=>	'property_air_conditioning',
			'value'		=>	array('yes', '1'),
			'compare'	=>	'IN'
		);
	}
	if(isset($property_pool) && in_array($property_pool, array('yes', '1')) ) {
		$meta_query[] = array(
			'key'		=>	'property_pool',
			'value'		=>	array('yes', '1'),
			'compare'	=>	'IN'
		);
	}
	if(intval($property_bedrooms) > 0) {
		$meta_query[] = array(
			'key'		=>	'property_bedrooms',
			'value'		=>	intval($property_bedrooms),
			'compare'	=>	'>='
		);
	}
	if(intval($property_bathrooms) > 0) {
		$meta_query[] = array(
			'key'		=>	'property_bathrooms',
			'value'		=>	intval($property_bathrooms),
			'compare'	=>	'>='
		);
	}
	if(intval($property_rooms) > 0) {
		$meta_query[] = array(
			'key'		=>	'property_rooms',
			'value'		=>	intval($property_rooms),
			'compare'	=>	'>='
		);
	}
	if(intval($property_carport) > 0) {
		$meta_query[] = array(
			'key'		=>	'property_carport',
			'value'		=>	intval($property_carport),
			'compare'	=>	'>='
		);
	}
	if(!empty($meta_query)) {
		$args['meta_query'] = $meta_query;
	}

	if(!empty($args)) {
		$args['posts_per_page'] = get_option('posts_per_page');
	}

	//show_pre( $args );

	return query_posts($args);
}

function is_property()
{
	
	if( get_post_type() == 'commercial' || get_post_type() == 'rental' )
		return true;
	else
		return false;
		
}


function custom_epl_format_the_excerpt( $content ) {
	$content = '<div class="epl-excerpt-content">tae</div>';
	return $content;
}
//add_filter( 'epl_the_excerpt' , 'custom_epl_format_the_excerpt' );