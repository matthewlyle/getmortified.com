<?php
/**
 * Template Name: Mortified Producer's Guide
 *
 */

?>

<?php get_header(); ?>

	<div id="primary" class="container c-white p-larger">

		<div class="g-1_3 p-right m-bottom-large">
		<h1><a href="/guide" class="t-black">The Mortified Guide</a></h1>
		<?php wp_nav_menu( array( 'menu' => 'guide', 'container_class' => 'guide-nav' ) ); ?>

		</div>

		<main id="main" class="g-2_3 site-main" role="main">

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

<?php get_footer(); ?>


