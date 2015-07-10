<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
<!-- /*--------------------------------------------------------------------------
	Things to go above the header go here! I want to insert a featured area.
/*--------------------------------------------------------------------------- -->
		<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>

		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>
			
<!-- /*--------------------------------------------------------------------------
	Things to go go here for under products.
/*--------------------------------------------------------------------------- -->
			<div class="featurette">
				<h3>Featured Reports</h3>
				<?php
					$args = array(
						'per_page' => '4',
						'columns' => '4',
						'orderby' => 'date',
						'order' => 'desc',
						'post_type' => 'product',  
						'meta_key' => '_featured',  
						'meta_value' => 'yes',  
					);				
					
					$featured_query = new WP_Query( $args );
					
						if ($featured_query->have_posts()) :
						echo "<ul class='products featured-products'>";
							while ($featured_query->have_posts()) :
								$featured_query->the_post();
								$product = get_product( $featured_query->post->ID );
								// Output product information here
								wc_get_template_part( 'content', 'product' );
							endwhile;  
						echo "</ul>";
						endif; 
					wp_reset_query(); // Remember to reset 
				?>
				<div class="featured-btn-box">
					<a href="/product-category/featured-reports/" class="woo-sc-button featured-btn">See more featured reports</a>
				</div>
			</div>
			
			
			
			
		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' ); ?>
