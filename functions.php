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

// Apply filter
add_filter('body_class', 'multisite_body_classes');

function multisite_body_classes($classes) {
    
	if( is_single() && is_property() && is_printable() )
	{
        $classes[] = 'printable';
    }
	
	return $classes;
}


add_action( 'wp_enqueue_scripts', 'my_scripts' );
function my_scripts() 
{
	// magnific-popup
	wp_enqueue_script( 'magnific-popup', get_stylesheet_directory_uri() . '/js/jquery.magnific-popup.min.js' );
	wp_enqueue_style( 'magnific-popup-css', get_stylesheet_directory_uri() . '/css/magnific-popup.css');
	wp_enqueue_style( 'x-custom-styles', get_stylesheet_directory_uri() . '/the-styles.css', array(), date('YmdHis') );
	wp_enqueue_script( 'app_code', get_stylesheet_directory_uri() . '/js/app.js', array(), date('YmdHis') );
	
	wp_localize_script( 'app_code', 'app', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));
	
	
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

function is_printable()
{
	
	if( isset($_REQUEST['printable']) && $_REQUEST['printable'] == 'yes' )
		return true;
	else
		return false;
		
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



function property_contact_information()
{
 // First footer widget area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => 'Property Contact Information',
        'id' => 'property-contact-information',
        'before_widget' => '<div id="%1$s" class="property-contact-information %2$s">',
        'after_widget' => '</div>',
        //'before_title' => '<h3 class="widget-title">',
        //'after_title' => '</h3>',
    ) );
}

add_action( 'widgets_init', 'property_contact_information' );



//Show popup product info
add_action( 'wp_ajax_nopriv_property_single_popup', 'property_single_popup' );
add_action( 'wp_ajax_property_single_popup', 'property_single_popup' );

function property_single_popup()
{
	global $post;
	// get the property id
	$id = $_REQUEST['property_id'];
	// assign post object
	$post = get_post( $id );
	// call the view
	x_get_view( 'custom', 'property-single' );
	
	
	die();
}

function test()
{
	global $post;
	
	$post = get_post( 49 );
	
	x_get_view( 'custom', 'property-single' );
}

//add_action( 'template_redirect', 'test' );
