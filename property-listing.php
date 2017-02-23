<?php

// =============================================================================
// TEMPLATE NAME: Property Listing
// -----------------------------------------------------------------------------
// A template for archives page of property listings
// =============================================================================

?>

<?php get_header(); ?>

  <div class="full" role="main">
    <?php while ( have_posts() ) : the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php x_get_view( 'custom', 'property-archive-content' ); ?>
      </article>

    <?php endwhile; ?>

  </div>

<?php get_footer(); ?>