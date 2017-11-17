<?php
/**
 * Single Product title
 *
 * Being overridden here for the Opus theme.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="title-container niceTitle">
    <?php the_title( '<h1 class="product_title entry-title">', '</h1>' ); ?>
    <?php echo the_content(); ?>
</div>
