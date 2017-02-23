<?php
global $property;
global $post;

$post = $property->post;
setup_postdata( $post );

$brochure_button = '[button class="x-btn-blue" type="flat" shape="pill" size="regular" href="'.site_url('wp-content/files/'.$post->post_name.'.pdf').'" target="blank"]Get the brochure[/button]';
?>

<?php if( is_printable() ) : ?>
	<p style="text-align:center">
		<img src="<?php echo site_url();?>/wp-content/uploads/2017/01/rockwell-properties-logo_360.png" style="height:100px">
	</p>
<?php endif; ?>

<div class="property-single-container">
	<?php
		// the arguments
		$args = array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image');
		
		
		if( is_printable() )
		{
			$args['numberposts'] = 1;
			$attachments = get_children( $args );
			
			foreach( $attachments as $image )
			{
				$featured_image = '[image type="rounded" src="'. $image->guid .'" style="width:100%;height:400px;object-fit:cover;"]';
			}
		}
		else
		{
			$attachments = get_children( $args );
			
			$featured_image = '[slider class="property-slider" animation="slide" slide_time="5000" slide_speed="600" slideshow="true" random="false" control_nav="true" prev_next_nav="true"]';

			foreach( $attachments as $image )
			{
				$featured_image .= '[slide]<img src="'.$image->guid.'" />[/slide]';
			}

			$featured_image .= '[/slider]';	
		}
	?>
	
	<div class="property-featured-image"><?php echo do_shortcode($featured_image); ?></div>
	
	<div class="x-column x-sm x-2-3 property-details">
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
		
		<?php if( !is_printable() ) : ?>
		<?php echo '<p style="text-align:center">'.do_shortcode($brochure_button).'</p>'; ?>
		<?php endif; ?>
		
	</div>
		
	<?php if( is_printable() ) : ?>
	<div class="image-gallery">
		<?php unset( $args['numberposts'] ); $attachments = get_children( $args ); ?>
		<?php foreach( $attachments as $image ) : ?>
		
			<div class="image-gallery-item"><img src="<?php echo $image->guid;?>" /></div>
		
		<?php endforeach; ?>
		<?php echo do_shortcode('[clear]'); ?>
	</div>
	<?php endif; ?>
	
	<div class="x-column x-sm x-1-3 property-contact-sidebar">
		
		<?php if( !is_printable() ) : ?>
		<?php echo '<p style="text-align:center">'.do_shortcode($brochure_button).'</p>'; ?>
		<hr />
		<?php endif; ?>
		
		<?php if ( is_active_sidebar( 'property-contact-information'  ) ) : ?>
			<?php dynamic_sidebar( 'property-contact-information' ); ?>
		<?php endif; ?>
	</div>
</div>