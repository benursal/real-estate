<?php
global $property;
global $post;
//show_pre( $property );

//show_pre( $property->post );//->post->the_title();
//epl_property_gallery();
//show_pre( $gallery );


$post = $property->post;
   
setup_postdata( $post );

echo get_the_post_thumbnail( $post );

//echo 'tae' . get_the_post_thumbnail( get_the_ID() );

//echo epl_get_property_heading();
//echo epl_property_featured_image();

// price
//echo $property->get_property_meta( 'property_price_view' , true );

///the_content();
//epl_property_archive_featured_image();
?>


<div class="property-single-container">
	<div class="property-featured-image"><?php epl_property_featured_image(); ?></div>
	<h1 class="property-title"><?php echo get_the_title(); ?></h1>
	<h3 class="property-display-price"><?php echo epl_get_property_price(); ?></h3>
	<div class="property-address"><?php epl_property_the_address(); ?></div>
	<div class="property-status"><?php echo ucwords($property->get_property_meta( 'property_status' , true ));?></div>
	<div class="property-category"><?php epl_property_commercial_category(); ?></div>
	
	<div class="property-introduction">
		
		<p>
			<?php echo $property->get_property_meta( 'property_introduction' , true );?>
		</p>
	</div>
	
	<div class="property-features">
		<h3>Features:</h3>
		<?php epl_the_content(); ?>
	</div>
</div>