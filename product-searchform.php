<?php

$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '" class="fw-search-form">
	<div>
      <label class="screen-reader-text" for="s">' . __( 'Search for:', 'woocommerce' ) . '</label>
      <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'My Search form', 'woocommerce' ) . '" class="fw-input-search"/>
      <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search', 'woocommerce' ) .'" />
      <input type="hidden" name="post_type" value="product" />
      <div class="fw-submit-wrap"></div>
    </div>
</form>';

echo $form;
?>