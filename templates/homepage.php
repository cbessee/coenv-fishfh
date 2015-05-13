<?php
/*
Template Name: Homepage
*/
?>
<?php get_header(); ?>
<div class="full-feature">



<?php

		/**
		 * Loop for homepage features.
		 */
		$feature_args = array(
			'post_type'	=> 'features',
			'post_status' => 'publish',
			'posts_per_page' => 4,
			'orderby' => 'menu_order',
			);
		$feature_query = new WP_Query( $feature_args ); ?>
		<?php //if ($feature_query->have_posts()) { ?>
		<div class="playpause"></div>


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
				$feature_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail-size', true);
				$feature_caption = get_post(get_post_thumbnail_id());
				$feature_caption = $feature_caption->post_excerpt;
			}
			$rows = get_field('feature_add_links');
			?>
			
	<div class="feature">

		<div class="feature-image" style="background-image:url('<?php echo $feature_image[0]; ?>')">

			<div class="feature-info-container">
				<p class="feature-image-caption right"><?php echo $feature_caption; ?></p>
				<div class="feature-info row" style="background-color:<?php $feature_color; ?>">
					<div class="feature-content">
						<h2><?php echo get_the_title(); ?></h2>
						<p class="feature-excerpt"><?php echo $feature_excerpt; ?></p>
						<?php 

						if($rows) {
							foreach($rows as $row) {
								if($row['feature_link_type'] == 'internal') {
									$link_title =  $row['feature_link_to_a_page_on_this_site'][0]['feature_link_title_internal'];
									$link_url = get_permalink($row['feature_link_to_a_page_on_this_site'][0]['feature_select_page'][0]);
									$link_target = 'self';
									echo '<a class="button" href="' . $link_url . '" target="_' . $link_target . '">' . $link_title . '</a>';
								} elseif ($row['feature_link_type'] == 'external') {
									$link_title = $row['feature_link_to_an_external_site'][0]['feature_link_title'];
									$link_url = $row['feature_link_to_an_external_site'][0]['feature_link_url'];
									$link_target ='blank';
									echo '<a class="button" href="' . $link_url . '" target="_' . $link_target . '">' . $link_title . '</a>';
								} 
							}
						}

						?>
						
					</div><!-- .feature-content -->
					<div class="feature-controls">
						<a class="slick-p button" href="#">Previous</a>
						<a class="slick-n button" href="#">Next</a>
					</div>
				</div><!-- .feature-info -->
			</div><!-- .feature-info-container -->
	</div>
</div><!-- .feature -->
<?php 

endwhile;
wp_reset_postdata();

?>
</div>











































</div>
<div class="row">				
<?php if ( is_active_sidebar( 'home-content' ) ) : ?>
<div class="large-12 columns programs">
	<div class="widget-area home-content" role="complementary">
		<?php dynamic_sidebar( 'home-content' ); ?>
	</div><!-- .widget-area -->
</div>
<?php endif; ?>
<?php 
# Widget area for content blocks
if ( is_active_sidebar( 'home-columns' ) ) : 
?>

<?php dynamic_sidebar( 'home-columns' ); ?>


<?php endif; ?>
<?php if ( is_active_sidebar( 'after-content' ) ) : ?>
	<?php do_action('foundationPress_after_content'); ?>
	<ul class="widget-area after-content">
	<?php dynamic_sidebar("after-content"); ?>
	</ul>
<?php endif; ?>
<?php
# News with featured news

$sticky = get_option( 'sticky_posts' );
$sticky_count = count($sticky);
$posts_on_home = 3; //set posts_per_page here

if( $sticky ) {
    $home_args = array(
        'post_type' => 'post',
        'posts_per_page' => $posts_on_home - $sticky_count,
        'post_status' => 'publish',
    );
}
else {
    $home_args = array(
        'post_type' => 'post',
        'posts_per_page' => $posts_on_home - $sticky_count,
        'post_status' => 'publish',
    );
}

$wp_query = new WP_Query( $home_args );
?>
	<?php if ($wp_query->have_posts()): ?>
	<hr />
	<div class="home-news-section large-12 clearfix">
		
		<div class="row">
			<div class="large-8 columns">
				<div class="row">
			<h2 class="columns large-9 left" style="margin-top: 0; padding-top: 0; text-align: center; ">News</h2>
			
		</div>
		<?php
		# The Loop
		while ( $wp_query->have_posts() ) :
		
					// Get field vars
					$wp_query->the_post();
					if (get_field('story_link_url')) {
						$post_link_url = get_field('story_link_url');
						$post_link_target = ' target="_blank" ';
			            $post_link = '<p><a class="button" href="' . $post_link_url . '"' . $post_link_target . '>' . get_field('story_source_name') . '</a></p>';
			        } else {
			        	$post_link_url = get_the_permalink();
			            $post_link = '<a class="button left" href="' . $post_link_url . '">Read more</a>';
			        }

		    	    // Get categories
		            $terms = wp_get_post_terms(get_the_id(), 'category');
					if (!empty($terms)) {
						$terms_arr = array();
						
						foreach ($terms as &$term) {
							if ($term->slug != 'uncategorized') {
								$terms_arr[] = '<a href="/news-and-events/?tax=category&amp;term=' . $term->slug . '">' . $term->name . '</a>';
							}
						}
						$terms_str = ' / ' . implode(', ', $terms_arr);

					} else {
						$terms_str = '';
					}

					// Build news divs
					if ( $wp_query->current_post == 0 ) {
			            if ( has_post_thumbnail()) {
			                echo '<div class="featured-news" style="width: 50%; float: left; padding-right: 30px;">';
								echo '<div class="featured-thumbnail" >';
									echo '<a href="' . $post_link_url . '" class="img"' . $post_link_target . '>' . the_post_thumbnail( 'large' ) . '</a>';
								echo '</div>';
								echo '<div class="post-meta">';
			                		echo '<time class="article__time" datetime="' . get_the_date('Y-m-d h:i:s') . '">' . get_the_date('M j, Y') . '</time>';
									echo $terms_str;
				            	echo '</div>';
			                	echo '<a href="' . $post_link_url . '"' . $post_link_target . '><h4>' . get_the_title() . '</h4></a>';
				            	echo '<p>' . the_advanced_excerpt('length=30&finish=sentence') . '</p>';
				            	echo $post_link;
				            echo '</div>';
						} else {
			                echo '<div class="small-news" style="width: 50%; float: left;">';
			                	echo '<div class="post-meta">';
			                		echo '<time class="article__time" datetime="' . get_the_date('Y-m-d h:i:s') . '">' . get_the_date('M j, Y') . '</time>';
			                	echo '</div>';
			                	echo '<a href="' . $post_link_url . '"><h4>' . get_the_title() . '</h4></a>';
			                echo '</div>';
			            }
					} else {
						
						echo '<div class="small-news" style="width: 50%; float: left;">';
							echo '<div class="post-meta">';
								echo '<time class="article__time" datetime="' . get_the_date('Y-m-d h:i:s') . '">' . get_the_date('M j, Y') . '</time>';
								echo $terms_str;
							echo '</div>';
							echo '<a href="' . $post_link_url . '"><h4>' . get_the_title() . '</h4></a>';
							echo '<p>' . the_advanced_excerpt('length=30&finish=sentence') . '</p>';
			       		echo '</div>';
					}
				
?>
<?php endwhile;?>
<a class="button columns large-3 right" href="/news-and-events">More News</a>
</div>
<div class="large-4 columns">
	<h2>Events</h2>
	<?php the_widget('CoEnv_Widget_Events', 'feed_url=http://www.trumba.com/calendars/coenveventscalendar.rss&posts_per_page=3'); ?>
	<a class="button columns large-3 right" href="/news-events/events/">More Events</a>
</div>

</div>
<?php endif; ?>
</div>
<a href="#" class="back-to-top">Back to Top</a>
<?php do_action('foundationPress_after_content'); ?>
</div>
<?php wp_reset_postdata(); wp_reset_query(); //roll back query vars to as per the request ?>
</div>
</div>
<?php get_footer(); ?>