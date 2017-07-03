<?php
/**
 * Template Name: Attend
 *
 */


get_header(); ?>

	<div id="primary" class="container c-white p-larger">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();
					the_title( '<h1 class="page-title t-centered">', '</h1>' ); ?>
				<div class="clearfix m-bottom">
					<div class="g-2_3">

							<?php the_content(); ?>

						<h3 id="upcoming-events" class="m-top">Upcoming Events</h3>

						<table class="m-bottom t-small">
							<tbody>
								<?php
								$current_date = date('Ymd', strtotime("now"));
								$the_future = date('Ymd', strtotime("+24 months"));
								$args = array( 'post_type' => 'event', 'meta_key' => 'event_date', 'meta_compare' => 'BETWEEN', 'meta_value' => array($current_date, $the_future), orderby => 'event_date', order=> 'ASC' );
								$loop = new WP_Query( $args );
								while ( $loop->have_posts() ) : $loop->the_post();
								?>
									<tr>
										<td style="width: 17%"><i class="fa fa-calendar"></i>  <?php $date = get_field('event_date', false, false); $date = new DateTime($date); echo $date->format('D M j'); ?></td>
										<td style="width: 35%"><?php the_field('event_title'); ?></td>
										<td style="width: 22%"><i class="fa fa-map-marker"></i> <?php the_field('event_city'); ?>, <?php the_field('event_state'); ?>
											<?php
												$country = get_field('event_country');
												if ($country != 'USA') {the_field('event_country');}
											?>
										</td>
										<td style="width: 13%">
											<i class="fa fa-clock-o"></i>
											<?php the_field('event_time');
												$value = get_field( "ampmgmt" );
												if ($value !='GMT') {the_field('ampmgmt');}
											?>
										</td>
									<td>
									<a href="<?php echo get_permalink(); ?>" class="no-hover"> <i class="fa fa-ticket"></i>
								Details</a>
								</td>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
					<div class="g-1_3">
						<div class="p c-grey m-bottom">
							<h2 class="t-large">Current Chapters</h2>
							<p><strong>Within the US:</strong> Austin, Boston, Chicago, DC/Baltimore, Denver, LA, NYC, Portland, San Fran Bay (SF, Oakland, North Bay)</p>
							<p class="m-bottom-none"><strong>Beyond the US:</strong> Amsterdam, Dublin, Helsinki, London, Malmo, Oslo, Paris, Trondheim</p>
						</div>

					<div class="clearfix">
					<img src="/img/live/image7.png" class="g-1_2 m-bottom-xs" style="margin-bottom: 2.35758%" />
					<img src="/img/live/image6.png" class="g-1_2 m-none m-bottom-xs" style="margin-bottom: 2.35758%"  />
					<img src="/img/live/image5.png" class="g-1_2 m-bottom-xs" style="margin-bottom: 2.35758%"  />
					<img src="/img/live/image41.png" class="g-1_2 m-none m-bottom-xs" style="margin-bottom: 2.35758%"  />
<!-- 					<img src="/img/live/image3.png" class="g-1_2 m-bottom-xs" style="margin-bottom: 2.35758%"  />
					<img src="/img/live/image2.png" class="g-1_2 m-none m-bottom-xs" style="margin-bottom: 2.35758%"  />
					<img src="/img/live/image1.png" class="g-1_2 m-bottom-xs" style="margin-bottom: 2.35758%"  />
					<img src="/img/live/image8.png" class="g-1_2 m-none m-bottom-xs" style="margin-bottom: 2.35758%"  /> -->
					</div>


					</div>
				</div>
			<?php endwhile ?>
		</main>
	</div>

<?php
get_footer();
