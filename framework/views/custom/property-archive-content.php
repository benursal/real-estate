<?php

// =============================================================================
// VIEWS/RENEW/PROPERTY-ARCHIVE-CONTENT.PHP
// -----------------------------------------------------------------------------
// Display of the_content() for various entries.
// =============================================================================

?>

<?php do_action( 'x_before_the_content_begin' ); ?>

<div class="entry-content content">

<?php do_action( 'x_after_the_content_begin' ); ?>


	<?php 
	
		$map = '[advanced_map display="simple" limit="20" cluster="false" height="700" coords="37.75795851, -122.38683701"]';
		$search = '[listing_search post_type=commercial search_bed="off" search_bath="off" search_rooms="off" search_car="off" search_house_category="off" search_city="off" search_postcode="off" search_other="off" submit_label="Filter Search"]';
		$listing = '[listing post_type="commercial" template="slim" limit="10"][listing post_type="commercial" template="slim" limit="10"][listing post_type="commercial" template="slim" limit="10"]';
		$headline = '[custom_headline type="center" level="h2" looks_like="h3" accent="true" style="margin-bottom:30px"]Properties for Sale[/custom_headline]';
		
		
		// process the shortcode STRING here....
		// assign variables
	
	
		// output shortcodes here...
		//echo '<div class="property-search-form">' . do_shortcode($search) . '</div>'; 
		
		echo do_shortcode('[column type="1" id="column-map"]'.$map.'[/column]'); 
		echo '<div class="list-title">Properties for Sale</div>';
		echo do_shortcode('[column type="1" id="column-property-list"]'.$listing.'[/column]'); 
		
		//echo do_shortcode('[container style="padding-bottom:40px"][column type="1"]'.$headline.$listing.'[/column][/container]');
		
	?>

  
	<?php x_link_pages(); ?>

<?php do_action( 'x_before_the_content_end' ); ?>

</div>

<?php do_action( 'x_after_the_content_end' ); ?>