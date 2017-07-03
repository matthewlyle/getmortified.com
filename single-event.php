<?php
/**
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hyphen
 */

get_header(); ?>
	<div id="primary" class="container c-white p-larger">
		<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<a href="/live#upcoming-events">&laquo; More Upcoming Events</a></p>
			<h1 class="page-title"><?php the_field('event_title'); ?></h1>
			<div class="clearfix m-bottom-large">
				<div class="g-1_2">
					<p class="m-bottom-none"><?php $date = get_field('event_date', false, false); $date = new DateTime($date); echo $date->format('D M j'); ?> @ <?php the_field('event_time');
										$value = get_field( "ampmgmt" );
										if ($value !='GMT') {
											the_field('ampmgmt');
										}
									?></p>
					<p class="m-bottom-none"><?php the_field('event_city'); ?>, <?php the_field('event_state'); ?>, <?php the_field('event_country'); ?></p>
					<p class="m-bottom-none"><?php the_field('event_venue'); ?></p>
					<p class="m-bottom-none"><?php the_field('event_address'); ?></p>
					<p class="m-bottom-none"><?php the_field('event_cost'); ?></p>
					<p class="m-bottom-none"><?php the_field('event_ages'); ?></p>
					<p class="m-bottom-none"><?php the_field('event_seating'); ?></p>
			<p class="p-top"><a href="<?php the_field('event_tickets'); ?>" class="btn t-larger""><i class="fa fa-ticket"></i> Attend</a><br/>
				</div>
				<div class="g-1_2 c-grey p">
					<p class="m-bottom-none"><?php the_field('event_notes'); ?></p>
				</div>
			</div>
		<?php endwhile ?>
		</main>
	</div>

<?php get_footer();
