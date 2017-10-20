<?php
/**
 * Opus - Display Pricing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( isset( $tabs['pricing'] ) ) : 
    $pricing = $tabs['pricing']; ?>
    <div class="pricing">
        <h2><?php echo $pricing['title'] ?></h2>
        <p><?php echo $pricing['content'] ?></p>
    </div>
<?php endif;
