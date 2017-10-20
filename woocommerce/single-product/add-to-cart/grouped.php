<?php
/**
 * Grouped product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/grouped.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $post;

$parent_product_post = $post;

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<?php 

//
// Pre-process and sort products so that we have all the face-to-face products first (if there are any),
// followed by any e-learning or distance products. We then use this product collection for the main products loop.
//

$sort_products = array();
$count_face_to_face = 0;
foreach ( $grouped_products as $product_id ) {
	if ( ! $product = wc_get_product( $product_id ) ) {
		continue;
	}
	if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) && ! $product->is_in_stock() ) {
		continue;
	}
	$sort_products[] = $product;
	if ( is_face_to_face($product) ) {
		$count_face_to_face++;
	}
}

usort( $sort_products, 'compare' );

$first_face_to_face = true; 

$prod_types = $count_face_to_face == 2 ? count($sort_products) - 1 : count($sort_products);
?>

<div class="grouped-product-shizzle">
	<form class="cart" method="post" enctype='multipart/form-data'>
	    <div class="prod-type-container">
		<?php
			$count = 0; //rob
			foreach ( $sort_products as $product ) :
			
				$product_id = $product->get_id();
			
				$count++;

				if ( is_face_to_face($product) && $first_face_to_face ) {
						$first_face_to_face = false; ?>
				<?php if ( $count > 1 ) echo ">" ?><div class="product-type cols-<?php echo $prod_types ?>">
    					<h4>Face to Face</h4><!--rob-->
    					<p class="product-medium">At Your Venue</p>
    					<p>Simply add to basket, provide your details and we will be in touch within 24 hours to finalise your booking and issue an invoice – book now, pay later!</p><!--rob-->
				<?php } ?>
				
				<?php if ( !is_face_to_face($product) ) { ?>
				    <?php if ( $count > 1 ) echo ">" ?><div class="product-type cols-<?php echo $prod_types ?>">
				        <?php if ( is_e_learning($product) ) { ?>
    					    <h4 style="clear:both;">e-Learning</h4>
    					    <p class="product-medium">Online Courses</p>
        					<p>Simply select the number of e-Learning licences you require, add to basket and purchase today through our shop! Licences will be set up within a few hours.</p>
                        <?php } else { ?>
    					    <h4 style="clear:both;">Distance Learning</h4>
    					    <p class="product-medium">Self-Study Workbook</p>
        					<p>Simply select the number of workbook packs you require, add to basket and purchase today through our shop! Distance learning workbooks will be posted within 24 hours!</p>
                        <?php } ?>
				<?php } ?>
				
				<div class="add-to-cart-container<?php if ( is_face_to_face( $product ) && $count_face_to_face == 2 ) echo " f2f-2" ?>  ">

    				<?php $post = $product->post;
    				setup_postdata( $post );
    				
    				do_action ( 'woocommerce_grouped_product_list_before_price', $product ); ?>
    				<?php
    					echo $product->get_price_html();
    
    					if ( $availability = $product->get_availability() ) {
    						$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';
    						echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
    					}
    				?>
    

    				<?php if ( is_face_to_face( $product ) ) : ?> 
    					<label for="product-<?php echo $product_id; ?>"> 

    							<?php echo $product->is_visible() ? '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', get_permalink(), $product_id ) ) . '" class="test">' . get_the_title() . '</a>' : get_the_title(); ?>					 
						</label> 				
        			<?php endif; ?>

    
    				<?php if ( $product->is_sold_individually() || ! $product->is_purchasable() ) : ?>
    					<p><a href="/enquiries/" class="enquiresBtn <?php echo (++$j % 2 == 0) ? 'evenpost' : 'oddpost'; ?>">Enquire Now</a></p>
    				
    				<div class="aintits-zbb">
    				<!-- This is now hidden as asked by Rachel.  -->
    					<?php woocommerce_template_loop_add_to_cart(); ?>
    				</div>
    				<style>
    					.aintits-zbb{
    						display: none;
    					}

    					.product-type.cols-3 p.lastEnq,
    					.product-type.cols-2 p.lastEnq,
    					.product-type.cols-1 p.lastEnq {
						    display: none;
						}

    				</style>

    				<?php else : ?>
    					<?php
    						$quantites_required = true;
    						woocommerce_quantity_input( array(
    							'input_name'  => 'quantity[' . $product_id . ']',
    							'input_value' => ( isset( $_POST['quantity'][$product_id] ) ? wc_stock_amount( $_POST['quantity'][$product_id] ) : 0 ),
    							'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $product ),
    							'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
    						) );
    					?>
    
    				<?php endif; ?>
    
    				<?php if ( $count > $count_face_to_face ) : ?>
        				<?php if ( $quantites_required ) : ?>
                    		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
                            <button type="submit" class="single_add_to_cart_button button alt d5r6ft7gy8bu9nim0o9n8bytv76r"><?php echo esc_html( opus_add_to_cart_text($product) ); ?></button>
                			<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                </div>

				<?php if ( $count == $count_face_to_face || $count > $count_face_to_face ) { ?>
					    <p class="lastEnq">or <a href="/enquiries/" >Enquire Now</a></p>
					</div  <?php // N.B. DIV deliberately not closed to prevent the Space Between Inline Block Elements issue ?>
				<?php }

			endforeach;
			
			echo ">";

			// Reset to parent grouped product
			$post    = $parent_product_post;
			$product = wc_get_product( $parent_product_post->ID );
			setup_postdata( $parent_product_post );
		?>
		
        </div>
        
		<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

    	<p class="discounts-msg">All discounts for bulk purchases are added at checkout. Prices above are per licence, there is a card handling fee for online purchases and VAT will be applied. See pricing information below to find out how you can save!</p>
	</form>
</div><!--rob-->

<?php do_action( 'woocommerce_after_add_to_cart_form' ); 

function compare ( $prod_1, $prod_2 ) {
	$x = is_face_to_face( $prod_1 ) ? 1 : 2;
	$y = is_face_to_face( $prod_2 ) ? 1 : 2;
	if ( $x == $y ) {
		return 0;
	} else if ( $x > $y ) {
		return 1;
	} else {
		return -1;
	}
}

function is_face_to_face( $product ) {
	$re = '/.*face.*to.*face/i';
	return preg_match( $re, $product->get_name(), $matches, PREG_OFFSET_CAPTURE, 0 );
}

function is_e_learning( $product ) {
	$re = '/.*e-learning.*/i';
	return preg_match( $re, $product->get_name(), $matches, PREG_OFFSET_CAPTURE, 0 );
}

function opus_add_to_cart_text( $product ) {
    if ( is_face_to_face($product) ) {
        return "Request Now";
    } else if ( is_e_learning($product) ) {
        return "Buy Licenses";
    } else {
        return "Buy Workbooks";
    }
}

?>