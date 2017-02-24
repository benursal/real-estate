<?php

// =============================================================================
// VIEWS/RENEW/PROPERTY-ARCHIVE-CONTENT.PHP
// -----------------------------------------------------------------------------
// Display of the_content() for various entries.
// =============================================================================

//echo get_post_type();

?>

<?php do_action( 'x_before_the_content_begin' ); ?>

<div id="property-popup" class="white-popup mfp-hide"><div class="body"></div></div>
<a href="#property-popup" class="popup-opener" style="display:none">Show inline popup</a>


<div class="entry-content content">

<?php do_action( 'x_after_the_content_begin' ); ?>


	<?php 
		
		
	
		// vars
		if( $post->post_name == 'buy' )
		{
			$list_headline = 'Properties for Sale';
			$post_type = 'commercial';
		}
		elseif( $post->post_name == 'rent' )
		{
			$list_headline = 'Properties for Rent';
			$post_type = 'rental';
		}
		
		
		$map = '[advanced_map display="simple" limit="20" cluster="false" height="700" coords="37.75795851, -122.38683701"]';
		$search = '[listing_search post_type='.$post_type.' search_bed="off" search_bath="off" search_rooms="off" search_car="off" search_house_category="off" search_city="off" search_postcode="off" search_other="off" submit_label="Filter Search"]';
		$listing = '[listing post_type="'.$post_type.'" template="slim" limit="10"]';
		//$headline = '[custom_headline type="center" level="h2" looks_like="h3" accent="true" style="margin-bottom:30px"][/custom_headline]';
		
		
		// process the shortcode STRING here....
		// assign variables
	
	
		// output shortcodes here...
		
		echo do_shortcode('[column type="1" id="column-map"]'.$map.'[/column]'); 
		echo '<div class="list-title">'.$list_headline.'</div>';
		echo do_shortcode('[column type="1" id="column-property-list"]'.$listing.'[/column]'); 
		
		
	?>

  
	<?php x_link_pages(); ?>

<?php do_action( 'x_before_the_content_end' ); ?>

</div>

<?php do_action( 'x_after_the_content_end' ); ?>