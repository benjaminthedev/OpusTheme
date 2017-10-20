<?php
/**
 * Opus - Display Course Content
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( !empty( $tabs['course-content']['content'] ) ) : 
    $course_content = $tabs['course-content']; ?>
    <div class="course-content">
        <h2><?php echo $course_content['title'] ?></h2>
        <p><?php echo $course_content['content'] ?></p>
       

    </div>
<?php endif;
