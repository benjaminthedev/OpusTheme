<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 */
?>
	</div><!-- /.site-main -->

	<!-- Footer -->
	<footer id="colophon" class="site-footer fw-footer <?php the_core_get_footer_class(); ?>" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
		<?php the_core_footer(); ?>
	</footer>
</div><!-- /#page -->

<script  type="text/javascript">

jQuery(document).ready(function() {


$(function() {
  $("#pa_course-type").change(function() {
    if ($("#pa_course-type option").filter(function(i, e) { return $(e).text() == "Face to Face"}).is(":selected")) {
      $("#bookNow").show();
      $(".single_add_to_cart_button").hide();
	console.log('show unique button');  
    } else {
      $("#bookNow").hide();
      $(".single_add_to_cart_button").show(); 
    }
  }).trigger('change');
});

});

</script>

<?php the_core_go_to_top_button(); ?>
<?php wp_footer(); ?>
</body>
</html>