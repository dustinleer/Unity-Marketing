<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: White Papers Sidebar Page for Downloads
 *
 *
 * @package WooFramework
 * @subpackage Template
 */
	get_header();
	global $woo_options;
?>
       
    <div id="content" class="page col-full">

    	<?php woo_main_before(); ?>
    	
		<section id="main" class="col-left"> 			

        <?php
        	if ( have_posts() ) { $count = 0;
        		while ( have_posts() ) { the_post(); $count++;
        ?>                                                           
            <article <?php post_class(); ?>>
				
				<header>
			    	<h1><?php the_title(); ?></h1>
				</header>
				
                <section class="entry">
                	<?php the_content(); ?>
                	
 
 
                <!--ACF-->
				<?php
		
					if( have_rows('white_paper_entries_downloads') ):
					
					    while ( have_rows('white_paper_entries_downloads') ) : the_row(); ?>
					        <h3><?php the_sub_field('product_title'); ?></h3>

							<div class="fivecol-four">		
						    <?php
						        the_sub_field('product_description'); ?>
							</div>
							
							<div class="fivecol-one last">    
						        <a class="woo-sc-button access-btn custom" href="<?php the_sub_field('downloadable_file'); ?>" ><?php the_sub_field('download_link_title'); ?></a>
							</div>
							
							<div class="clear"></div>
						    
						    <br/>
						    <div class="woo-sc-hr"></div>
						    <br/>   

						    <?php
					
					    endwhile;
					
					else :
					
					    // no rows found
					
					endif;
				
				?>

					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) ); ?>
               	</section><!-- /.entry -->

				<?php edit_post_link( __( '{ Edit }', 'woothemes' ), '<span class="small">', '</span>' ); ?>
                
            </article><!-- /.post -->
            
            <?php
            	// Determine wether or not to display comments here, based on "Theme Options".
            	if ( isset( $woo_options['woo_comments'] ) && in_array( $woo_options['woo_comments'], array( 'page', 'both' ) ) ) {
            		comments_template();
            	}

				} // End WHILE Loop
			} else {
		?>
			<article <?php post_class(); ?>>
            	<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
            </article><!-- /.post -->
        <?php } // End IF Statement ?>  
        
		</section><!-- /#main -->
		
		<?php woo_main_after(); ?>

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>