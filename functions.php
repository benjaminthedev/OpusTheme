<?php if ( ! defined( 'WP_DEBUG' ) ) {
	die( 'Direct access forbidden.' );
}

function the_core_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

add_action( 'wp_enqueue_scripts', 'the_core_theme_enqueue_styles' );

function schema_org_markup() {
    $schema = 'http://schema.org/';
    // Is single post
    if ( function_exists(is_woocommerce) && is_woocommerce() ) {
      $type = 'Product';
    }
    elseif ( is_single() ) {
        $type = "Article";
    } 
    else {
        if ( is_page( 644 ) ) { // Contact form page ID
            $type = 'ContactPage';
        } // Is author page
        elseif ( is_author() ) {
            $type = 'ProfilePage';
        } // Is search results page
        elseif ( is_search() ) {
            $type = 'SearchResultsPage';
        } // Is of movie post type
        elseif ( is_singular( 'movies' ) ) {
            $type = 'Movie';
        } // Is of book post type
        elseif ( is_singular( 'books' ) ) {
            $type = 'Book';
        }
        else {
            $type = 'WebPage';
        }
    }
    echo 'itemscope="itemscope" itemtype="' . $schema . $type . '"';
}

add_action( 'woocommerce_after_add_to_cart_button', 'add_content_after_addtocart_button_func' );

function add_content_after_addtocart_button_func() {

// Echo content.

echo '<button id="bookNow" class="button alt" style="display:none;">Enquire Now </button>';

}

//remove grey price under product title
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

//remove tags and sku (meta)
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

//remove price from thumbnails
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

//remove breadcrumbs
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

//remove category "face-to-face" from shop page
// add_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

// function custom_pre_get_posts_query( $q ) {

//     if ( ! $q->is_main_query() ) return;
//     if ( ! $q->is_post_type_archive() ) return;
    
//     if ( ! is_admin() && is_shop() ) {

//         $q->set( 'tax_query', array(array(
//             'taxonomy' => 'product_cat',
//             'field' => 'slug',
//             'terms' => array( 'face-to-face' ), // Don't display products in the knives category on the shop page
//             'operator' => 'NOT IN'
//         )));
    
//     }

//     remove_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

// }

/////////////////////////////////////
///////////robs changes//////////////
/////////////////////////////////////

// Setting Previous/Next labels here which will override the ones that would normally be set in the parent theme 
function _the_core_action_woocommerce_pagination_args()
{
	return array(
		'prev_next' => true,
		'prev_text' => '<i class="fa fa-angle-left"></i><strong>' . esc_html__('Previous', 'the-core') . '</strong>',
		'next_text' => '<strong>' . esc_html__('Next', 'the-core') . '</strong><i class="fa fa-angle-right"></i>',
	);
}

add_action( 'woocommerce_after_single_product_summary', 'opus_output_tabs_as_divs', 10 );
function opus_output_tabs_as_divs() {
	wc_get_template( 'single-product/course-content.php' );
	wc_get_template( 'single-product/pricing.php' );
	wc_get_template( 'single-product/faqs.php' );
	echo DISPLAY_ULTIMATE_PLUS();
}

// Remove product images on product pages
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );  // Andy
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );  // Andy
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );  // Andy
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 7 );  // Andy

// Remove tabs so that can display content in separate divs
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

//Remove Product Reviews
remove_action('woocommerce_product_tabs', 'woocommerce_product_reviews_tab', 30);
remove_action('woocommerce_product_tab_panels', 'woocommerce_product_reviews_panel', 30);

//Remove additional info and product description tabs
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] );
    unset( $tabs['description'] );
    return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'reordered_tabs', 98 );
function reordered_tabs( $tabs ) {
    $tabs['course-content']['priority'] = 5; 
    return $tabs;
}

//Set a heading for product short description

add_filter( 'woocommerce_short_description', 'short_description_heading' );
 
function short_description_heading($short_description) {
    return '<h2>About This Course</h2>' . $short_description;
}

/**
 * Show a shop page description on product archives.
 *
 * Overriding this function, as the one within the plugin seems to have a bug:
 * if shop page post_content is empty then the wc_format_content seems to return
 * spurious results, which then get displayed on the page.
 */
function woocommerce_product_archive_description() {
	// Don't display the description on search results page
	if ( is_search() ) {
		return;
	}

	if ( is_post_type_archive( 'product' ) && 0 === absint( get_query_var( 'paged' ) ) ) {
		$shop_page   = get_post( wc_get_page_id( 'shop' ) );
		if ( $shop_page ) {
			if ( $shop_page->post_content ) {
			    $description = wc_format_content( $shop_page->post_content );
				echo '<div class="page-description">' . $description . '</div>';
			}
		}
	}
}


// add handling fee
// add_action( 'woocommerce_cart_calculate_fees','endo_handling_fee' );
// function endo_handling_fee() {
//      global $woocommerce;
 
//      if ( is_admin() && ! defined( 'DOING_AJAX' ) )
//          return;
 
//      $fee = 2.50;
//      $woocommerce->cart->add_fee( 'Handling', $fee, false, 'standard' );
   
// }




//add handling fee
//add_action( 'woocommerce_cart_calculate_fees','endo_handling_fee' );
//function endo_handling_fee() {
     //global $woocommerce;
 
     //if ( is_admin() && ! defined( 'DOING_AJAX' ) )
       //   return;
 
     //$fee = 2.50;
     // $woocommerce->cart->add_fee( 'Handling', $fee, true, 'standard' );
     //Made it zero not working will remove this function now
     //$woocommerce->cart->add_fee( 'Handling', $fee, true, 'zero' );
//}

//add enquiry button to product detail
add_action( 'woocommerce_single_product_summary', 'my_extra_button_on_product_page', 30 );

function my_extra_button_on_product_page() {
  global $product;
  // echo '<p>If you would like additional information regarding our courses please contact us.</p>';
  // echo '<a href="/enquiries/" class="button product_type_simple add_to_cart_button ajax_add_to_cart">Enquire Now</a>';
}
//add to cart error redirect
function firefog_custom_add_to_cart_redirect( $url ) {
        $url = WC()->cart->get_cart_url();
        return $url;
    }
add_filter( 'woocommerce_cart_redirect_after_error', 'firefog_custom_add_to_cart_redirect' );

//enque plus minus js and css too
function add_my_scripts() {
    wp_enqueue_script( 'plusminus', get_stylesheet_directory_uri() . '/js/plusminus.js', array(), null, true );
    wp_enqueue_style( 'responsiveStyles', get_stylesheet_directory_uri() . '/css/responsive-styles.css', array(), null, true );
    wp_enqueue_style( 'customResponsiveStyles', get_stylesheet_directory_uri() . '/css/custom-responsive-styles.css', array(), null, true );
}
// Run this function during the wp_enqueue_scripts action
add_action('wp_enqueue_scripts', 'add_my_scripts');

/************************************
Custom fields
*************************************/
//add custom fields to checkout
add_action( 'woocommerce_before_order_notes', 'my_custom_checkout_field_1' );

function my_custom_checkout_field_1( $checkout ) {

    echo '<div id="my_custom_checkout_field_1"><h3>' . __('Face 2 Face training information') . '</h3>' . '<p>' . 'If you are purchasing Face to Face training, please fill in the fields below.' . '</p>';

    woocommerce_form_field( 'training_location_field', array(
        'type'          => 'textarea',
        'class'         => array('my-field-class form-row-narrow'),
        'label'         => __('Preferred Training Location'),
        'placeholder'   => __('Enter address'),
        ), $checkout->get_value( 'training_location_field' ));

    echo '</div>';

        echo '<div id="my_custom_checkout_field_1">';

    woocommerce_form_field( 'training_date_field', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('Preferred Training Date'),
        'placeholder'   => __('Enter date'),
        ), $checkout->get_value( 'training_date_field' ));

    echo '</div>';
}

//Update the order meta with field value
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['training_location_field'] ) ) {
        update_post_meta( $order_id, 'Training Location', sanitize_text_field( $_POST['training_location_field'] ) );
    }
    if ( ! empty( $_POST['training_date_field'] ) ) {
        update_post_meta( $order_id, 'Training Date', sanitize_text_field( $_POST['training_date_field'] ) );
    }
}

//Display field value on the order edit page
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<h3>' . __('Face 2 Face training information') . '</h3>';
    echo '<p><strong>'.__('Training location').':</strong> ' . get_post_meta( $order->id, 'Training Location', true ) . '</p>';
    echo '<p><strong>'.__('Training date').':</strong> ' . get_post_meta( $order->id, 'Training Date', true ) . '</p>';
}





/* GammaFX: Preventing Hidden WooCommerce products from showing up in WordPress search results */
if ( ! function_exists( 'gamma_search_query_fix' ) ){
  function gamma_search_query_fix( $query = false ) {
    if(!is_admin() && is_search()){
      $query->set( 'meta_query', array(
        'relation' => 'OR',
        array(
          'key' => '_visibility',
          'value' => 'hidden',
          'compare' => 'NOT EXISTS',
        ),
        array(
          'key' => '_visibility',
          'value' => 'hidden',
          'compare' => '!=',
        ),
      ));
    }
  }
}
add_action( 'pre_get_posts', 'gamma_search_query_fix' );

//remove shipping labels from basket
add_filter( 'woocommerce_cart_shipping_method_full_label', 'bbloomer_remove_shipping_label', 10, 2 );
  
function bbloomer_remove_shipping_label($label, $method) {
$new_label = preg_replace( '/^.+:/', '', $label );
return $new_label;
}

//change excerpt length for search results


function new_excerpt_length($length) {
  return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');


// Ship to a different address closed by default
add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );


// add_filter( 'get_product_search_form' , 'woo_custom_product_searchform' );

// /**
//  * woo_custom_product_searchform
//  *
//  * @access      public
//  * @since       1.0 
//  * @return      void
// */
// function woo_custom_product_searchform( $form ) {
  
//   $form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '" class="fw-search-form">
//     <div>
//       <label class="screen-reader-text" for="s">' . __( 'Search for:', 'woocommerce' ) . '</label>
//       <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'My Search form', 'woocommerce' ) . '" class="fw-input-search"/>
//       <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search', 'woocommerce' ) .'" />
//       <input type="hidden" name="post_type" value="product" />
//       <div class="fw-submit-wrap"></div>
//     </div>
//   </form>';
  
//   return $form;
  
// }