<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Footer Template
 *
 * Here we setup all logic and XHTML that is required for the footer section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
	global $woo_options;

	$settings = array(
				'homepage_enable_promo_message' => 'true'
				);
					
	$settings = woo_get_dynamic_values( $settings );

	$total = 4;
	if ( isset( $woo_options['woo_footer_sidebars'] ) && ( $woo_options['woo_footer_sidebars'] != '' ) ) {
		$total = $woo_options['woo_footer_sidebars'];
	}

?>

</div><!-- /.wrapper -->

<?php
if ( is_home() && 'true' == $settings['homepage_enable_promo_message'] ) {
	get_template_part( 'includes/promo-message' );
}
?>

<?php
if ( ( woo_active_sidebar( 'footer-1' ) ||
		   woo_active_sidebar( 'footer-2' ) ||
		   woo_active_sidebar( 'footer-3' ) ||
		   woo_active_sidebar( 'footer-4' ) ) && $total > 0 ) {
?>




<div class="wrapper">

	<?php woo_footer_before(); ?>

	<section id="footer-widgets" class="col-full col-<?php echo $total; ?> fix">

		<div class="fullwidth-widgets">

			<?php woo_sidebar( 'footer-fullwidth' ); ?>

		</div><!--/.fullwidth-widgets-->

		<hr />

		<?php $i = 0; while ( $i < $total ) { $i++; ?>
			<?php if ( woo_active_sidebar( 'footer-' . $i ) ) { ?>

		<div class="block footer-widget-<?php echo $i; ?>">
        	<?php woo_sidebar( 'footer-' . $i ); ?>
		</div>

	        <?php } ?>
		<?php } // End WHILE Loop ?>

	</section><!-- /#footer-widgets  -->
<?php } // End IF Statement ?>

</div><!-- /.wrapper -->
<footer id="footer" class="col-full">

	<div class="footer-inner">

		<div id="copyright" class="col-left">
		<?php if( isset( $woo_options['woo_footer_left'] ) && $woo_options['woo_footer_left'] == 'true' ) {
				echo stripslashes( $woo_options['woo_footer_left_text'] );
		} else { ?>
			<p><?php bloginfo(); ?> &copy; <?php echo date( 'Y' ); ?>. <?php _e( 'All Rights Reserved.', 'woothemes' ); ?> | <a href="/disclaimer/">Disclaimer</a></p>
		<?php } ?>
		</div>

		<div id="credit" class="col-right">
	    <?php if( isset( $woo_options['woo_footer_right'] ) && $woo_options['woo_footer_right'] == 'true' ) {
	    	echo stripslashes( $woo_options['woo_footer_right_text'] );
		} else { ?>
			<p><?php _e( 'Powered by', 'woothemes' ); ?> <a href="<?php echo esc_url( 'http://www.wordpress.org' ); ?>">WordPress</a>. <?php _e( 'Designed by', 'woothemes' ); ?> <a href="<?php echo ( isset( $woo_options['woo_footer_aff_link'] ) && ! empty( $woo_options['woo_footer_aff_link'] ) ? esc_url( $woo_options['woo_footer_aff_link'] ) : esc_url( 'http://www.woothemes.com/' ) ) ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/woothemes.png' ); ?>" width="74" height="19" alt="Woo Themes" /></a></p>
		<?php } ?>
		</div>

	</div><!--/.footer-inner-->

</footer><!-- /#footer  -->
<?php wp_footer(); ?>
<?php woo_foot(); ?>
</body>
</html>