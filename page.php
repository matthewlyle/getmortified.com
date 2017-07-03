<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package hyphen
 */

get_header(); ?>

	<div id="primary" class="container c-white p-larger">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				// if( !is_page('Attend') && !is_page('Listen') && !is_page('Participate') && !is_page('Watch') && !is_page('Books')):
					the_title( '<h1 class="page-title t-centered">', '</h1>' );
				// endif;

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
