<?php
/**
 * Opus - Display FAQs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( isset( $tabs['faqs'] ) ) : 
    $faqs = $tabs['faqs']; ?>
    <div class="faqs">
        <h2><?php echo $faqs['title'] ?></h2>
        <p><?php echo $faqs['content'] ?></p>
    </div>
<?php endif;
