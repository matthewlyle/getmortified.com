<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hyphen
 */

?>

</div><!-- #content -->

<footer class="container c-black-dark p-top t-centered">
	<div class="container">
		<?php dynamic_sidebar( 'footer-links' ); ?>
	</div>
</footer>

<?php require get_template_directory() . '/inc/podcast-player.php'; ?>

<?php wp_footer(); ?>

<div style="height: 130px; width: 100%;">
	<!-- space for podcast player -->
</div>

</body>
</html>
