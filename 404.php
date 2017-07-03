<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package hyphen
 */

get_header(); ?>

	<div id="primary" class="container c-white p-larger">
		<main id="main" role="main">

			<section>
				<header>
					<h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'hyphen' ); ?></h1>
				</header><!-- .page-header -->
			</section>

		</main>
	</div>

<?php
get_footer();
