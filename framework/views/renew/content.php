<?php

// =============================================================================
// VIEWS/RENEW/CONTENT.PHP
// -----------------------------------------------------------------------------
// Standard post output for Renew.
// =============================================================================

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php //$entry_wrap_class = ( !is_single() ) ? 'entry-wrap-list' : ''; ?>
	
	<?php if( is_single() ) : ?>
	<div class="entry-wrap">
		<?php x_get_view( 'renew', '_content', 'post-header' ); ?>
		<?php if ( has_post_thumbnail() ) : ?>
		  <div class="entry-featured">
			<?php x_featured_image(); ?>
		  </div>
		<?php endif; ?>
		<?php x_get_view( 'global', '_content' ); ?>
	</div>
	<?php else : ?>
	<div class="entry-wrap entry-wrap-list">
		<div class="entry-featured entry-column-left">
			<?php x_featured_image(); ?>
		</div>
		<div class="entry-column-right">
			<?php x_get_view( 'renew', '_content', 'post-header' ); ?>
			<?php x_get_view( 'global', '_content' ); ?>
			<?php x_renew_entry_meta(); ?>
		</div>
	</div>
	<?php endif; ?>
	
</article>