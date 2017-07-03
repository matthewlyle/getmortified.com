<?php
/**
 * Template Name: Page with sidebar
 *
 */

get_header(); ?>

	<div id="primary" class="container c-white p-larger">

		<div class="sidebar-nav g-1_4 p-right m-bottom-large">

			<h3 class="is-visible-on-small-screens">
				<?php
					if (is_tree(12)) {echo 'Video Projects';}
					elseif (is_tree(18)) {echo 'Available Books';}
				?>
			</h3>

			<?php
			if ( $post->post_parent ) {
			    $children = wp_list_pages( array(
			        'title_li' => '',
			        'child_of' => $post->post_parent,
			        'echo'     => 0
			    ) );
			} else {
			    $children = wp_list_pages( array(
			        'title_li' => '',
			        'child_of' => $post->ID,
			        'echo'     => 0
			    ) );
			}

			if ( $children ) : ?>
			    <ul class="p-none">
			        <?php echo $children; ?>
			    </ul>
			<?php endif; ?>



		</div>

		<main id="main" class="g-3_4 site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				if( !is_page('Attend') && !is_page('Listen') && !is_page('Participate') && !is_page('Watch') && !is_page('Books')):
					the_title( '<h1 class="page-title">', '</h1>' );
				endif;

			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'hyphen' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )

			) );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
