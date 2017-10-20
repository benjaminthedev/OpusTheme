<?php
/**
 * Product quantity inputs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.7
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
global $product;
 
$defaults = array(
    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', '', $product ),
    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', '', $product ),
    'step'        => apply_filters( 'woocommerce_quantity_input_step', '1', $product ),
);
 
if ( ! empty( $defaults['min_value'] ) )
    $min = $defaults['min_value'];
else $min = 1;
 
if ( ! empty( $defaults['max_value'] ) )
    $max = $defaults['max_value'];
else $max = 10;
 
if ( ! empty( $defaults['step'] ) )
    $step = $defaults['step'];
else $step = 1;
 
?>
<!-- <div class="quantity_select">
    <select name="<?php echo esc_attr( $input_name ); ?>" title="<?php _ex( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) ?>" class="qty">
    <?php
        // echo '<option value="">Select quantity</option>';
    for ( $count = $min; $count <= $max; $count = $count+$step ) {
        if ( $count == $input_value )
            $selected = ' selected';
        else $selected = '';
        echo '<option value="' . $count . '"' . $selected . '>' . $count . '</option>';
    }
    ?>
    </select>
</div> -->


<div class="quantity">
  <input class="minus" type="button" value="-">
  <input type="number" step="<?php echo esc_attr( $step ); ?>" min="<?php echo esc_attr( $min_value ); ?>" max="<?php echo esc_attr( $max_value ); ?>" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) ?>" class="input-text qty text" size="4" />
  <input class="plus" type="button" value="+">
</div>