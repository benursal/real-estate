<?php

// =============================================================================
// VIEWS/RENEW/WP-INDEX.PHP
// -----------------------------------------------------------------------------
// Index page output for Renew.
// =============================================================================

?>

<?php get_header(); ?>

	<?php if( is_epl_search() ) : ?>
		<?php $page = get_page_by_path('buy'); ?>
		
		<div class="x-main full" role="main">
			<?php setup_postdata($page); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php x_get_view( 'custom', 'property-archive-content' ); ?>
			</article>

		</div>
	
	<?php else : ?>
	
	<div class="x-container max width offset">

		<div class="<?php x_main_content_class(); ?>" role="main">

			<?php x_get_view( 'global', '_index' ); ?>

		</div>

		<?php get_sidebar(); ?>

	</div>
	
	<?php endif; ?>

<?php get_footer(); ?>