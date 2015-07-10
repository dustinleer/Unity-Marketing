<?php
/**
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $wp_query, $wp;

if ( 1 == $wp_query->found_posts || ! woocommerce_products_will_display() )
	return;
?>

<form class="woocommerce-ordering" method="get">
	<ul>
		<?php
			$search_query = get_search_query();

			if ( $search_query ) {
				$search_string = '&s=' . $search_query . '&post_type=product';
			} else {
				$search_string = null;
			}

			$catalog_orderby = apply_filters( 'woocommerce_catalog_orderby', array(
				'menu_order' => __( 'Alphabetical', 'woocommerce' ),
				'date'       => __( 'Newest', 'woocommerce' ),
				'popularity' => __( 'Popularity', 'woocommerce' ),
				'rating'     => __( 'Rating', 'woocommerce' ),
				'price'      => __( 'Price', 'woocommerce' )
				//'price-desc' => __( 'Price: high to low', 'woocommerce' )
			) );

			if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' )
				unset( $catalog_orderby['rating'] );

			foreach ($catalog_orderby as $id => $name){
		  		$selected = str_replace( "='selected'", "", selected( $orderby, $id, false ));
		    	echo '<li class="' . $selected . '"><a href="?orderby=' . $id . $search_string . '">' . $name . '</a></li>';
		  	}
		?>
		
	<?php
		// Keep query string vars intact
		foreach ( $_GET as $key => $val ) {
			if ( 'orderby' == $key )
				continue;
			echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
		}
	?>
	</ul>
</form>
