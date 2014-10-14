<?php get_header(); ?>
<div class="row">
	<div class="small-12 large-12 columns" role="main">
	
	<?php do_action('foundationPress_before_content'); ?>
	<?php dynamic_sidebar("before-content"); ?>
		<?php

		/**
		 * Loop for homepage features.
		 */
		$feature_args = array(
			'post_type'	=> 'features',
			'post_status' => 'publish',
			'posts_per_page' => 4,
			);
		$feature_query = new WP_Query( $feature_args ); ?>
		<?php //if ($feature_query->have_posts()) { ?>
			<div class="homepage-features">
			<?php
			# The Loop
			while ( $feature_query->have_posts() ) :
				$feature_query->the_post();
			if (get_field('feature_add_links')) {
				$feature_link_type = get_field('feature_link_type');
				$feature_link_type_internal = get_field('feature_link_page');
			}
			if (get_field('feature_color')) {
				$feature_color = get_field('feature_color');
			}
			if (get_field('feature_excerpt')) {
				$feature_excerpt = get_field('feature_excerpt');
			}
			if (get_the_post_thumbnail()) {
				$feature_image = get_the_post_thumbnail();
				$feature_caption = get_post(get_post_thumbnail_id());
				$feature_caption = $feature_caption->post_excerpt;
			}
			$rows = get_field('feature_add_links');
			?>
<div class="feature">

	<div class="feature-image">
		<?php echo $feature_image ?>
		<p class="feature-image-caption"><?php echo $feature_caption ?></p>
	</div>

	<div class="feature-info-container">

		<div class="feature-info" style="background-color: <?php echo $feature_color ?>">

			<div class="feature-content">
				
				<h2><?php echo get_the_title(); ?> </h2>
				
				<p><?php echo $feature_excerpt ?> </p>
				
				<?php
					if($rows)
					{
						echo '<ul class="links">';
						foreach($rows as $row)
						{
							if($row['feature_link_type'] == 'internal') {
								$link_title =  $row['feature_link_to_a_page_on_this_site'][0]['feature_link_title_internal'];
								$link_url = get_permalink($row['feature_link_to_a_page_on_this_site'][0]['feature_select_page'][0]);
								$link_target = 'self';
								echo '<li><a  class="button" href="' . $link_url . '" target="_' . $link_target . '">' . $link_title . '</a></li>';
							} elseif ($row['feature_link_type'] == 'external') {
								$link_title = $row['feature_link_to_an_external_site'][0]['feature_link_title'];
								$link_url = $row['feature_link_to_an_external_site'][0]['feature_link_url'];
								$link_target ='blank';
								echo '<li><a class="button" href="' . $link_url . '" target="_' . $link_target . '">' . $link_title . '</a></li>';
							} 
						}
						echo '</ul>';
					}
				?>

			</div><!-- .feature-content -->

		</div><!-- .feature-info -->

	</div><!-- .feature-info-container -->

</div><!-- .feature -->
<?php
			endwhile;
			wp_reset_postdata(); ?>
			</div>

	<?php if ( is_active_sidebar( 'after-content' ) ) : ?>
		<div id="after-content" class="after-content widget-area" role="complementary">
			<?php dynamic_sidebar( 'after-content' ); ?>
		</div><!-- #after-content -->
	<?php endif; ?>
	<a href="#" class="back-to-top">Back to Top</a>
	<?php do_action('foundationPress_after_content'); ?>

	</div>
</div>
<?php get_footer(); ?>