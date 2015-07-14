<?php
/*
Template Name: Homepage
*/
?>
<?php get_header(); ?>
<?php



/**
 * Check for events
 */


	$events_xml = file_get_contents( 'http://www.trumba.com/calendars/sea_fish.rss' );
	$xml = new SimpleXmlElement($events_xml);
    $events = array();

    foreach ($xml->channel->item as $item) {     
      $events[] = array(
        'title' => $item->title,
        'date'  => $item->category,
        'url' => $item->link
      );
    }

    $events_count = count($events);















/**
* Loop for homepage features.
*/
$feature_args = array(
'post_type'	=> 'features',
'post_status' => 'publish',
'posts_per_page' => 4,
'orderby' => 'menu_order',
);
$feature_query = new WP_Query( $feature_args ); 

?>
<div class="full-feature">

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
				<div class="feature-controls hide-for-large-up">
							<a class="slick-p" href="#">Previous</a>
							<a class="slick-n" href="#">Next</a>
						</div>
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
						<div class="feature-controls show-for-large-up">
							<a class="slick-p" href="#">Previous</a>
							<a class="slick-n" href="#">Next</a>
						</div>
					</div><!-- .feature-info -->
				</div><!-- .feature-info-container -->
				<div style="position: absolute; bottom: 0; text-align: center; width: 100%;">
					<ul class="my-slick-dots here show-for-large-up" style="display: block;">
					</ul>
				</div>
			</div><!-- .feature -->
		</div>

	<?php 
	endwhile;
	wp_reset_postdata();
	?>

	</div><!-- homepage-features -->
<div id="feature-mask"></div>
</div> <!-- end .full-feature -->



<div class="full-intro clearfix">
	<div class="row">				
		<?php if ( is_active_sidebar( 'home-content' ) ) : ?>
		<div class="large-12 columns programs">
		<div class="widget-area home-content" role="complementary">
			<?php dynamic_sidebar( 'home-content' ); ?>
		</div><!-- .widget-area -->
		</div>
		<?php endif; ?>
	</div>
</div> <!-- end full-intro -->


<div class="full-student-faculty clearfix">

	<div class="student-container">
		<div class="student-wrapper" style="position: relative;">

			<h2 style="background-position: center bottom;">Explore our Programs</h2>
				<div class="student-content">
					<p>SAFS students work alongside talented peers and faculty to engage in a rigorous and inclusive learning environment. Join us to connect with some of the best minds and immerse yourself in cutting-edge scientific research.</p>
					<p><a class="button" href="/students">Learn more</a></p>
				</div>

		</div>

	</div>


	<div class="faculty-container">
		<div class="faculty-wrapper" style="position: relative;">

		<h2 style="background-position: center bottom;">Meet Our Faculty</h2>
			<div class="faculty-content">
				<p>Our faculty are committed leaders with broad academic expertise and interests. With access to a network of local, national and international leaders, we contribute influential research on topics ranging from organisms, populations, ecosystems, to human users of aquatic ecosystems.</p>
				<p><a class="button" href="/faculty-research">Learn more</a></p>
			</div>

		</div>

	</div>

</div>


					<?php if( get_field('social_media', 'option') ) { ?>

					<div class="full-connect">
						<h2 style="background-position: bottom center;">Connect With Us</h2>
						<div class="social-buttons">
						<?php while( has_sub_field('social_media', 'option') ) { ?>
							<a class="<?php the_sub_field('service_name'); ?> icon" href="<?php the_sub_field('url'); ?>" title="<?php the_sub_field('service_name'); ?>">
								<i class="fi-social-<?php the_sub_field('service_name'); ?>"></i>
							</a>
						<?php } ?>
						</div>
					</div>

					<?php } ?>


















<?php
# News with featured news

$sticky = get_option( 'sticky_posts' );
$sticky_count = count($sticky);
$posts_on_home = $news_count; //set posts_per_page here
$posted = array();

 $home_col_1_args = array(
        'post_type' => 'post',
        'post__not_in' => $sticky,
        'posts_per_page' => 2,
        'post_status' => 'publish',
    );

 $home_col_2_args = array(
        'post_type' => 'post',
        'post__in' => $sticky,
        'posts_per_page' => 1,
        'post_status' => 'publish',
    );



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


?>
	<?php if ($wp_query->have_posts()): ?>
	<div class="full-news-events">
		<div class="row">
			<div class="columns large-12">
			<h2 style="background-position: bottom center;">Latest News</h2>
			<a class="more-news" href="/news-events">More News</a>
			</div>
		</div>
		<div class="home-news-section large-12 clearfix">
			<div class="row">
				<div class="columns large-4">

				<?php
				$wp_query = new WP_Query( $home_col_1_args );
				# The Loop
				while ( $wp_query->have_posts() ) :
		
					// Get field vars
					$wp_query->the_post();
					$posted[] = get_the_id();
					if (get_field('story_link_url')) {
						$post_link_url = get_field('story_link_url');
						$post_link_target = 'target="_blank"';
			            $post_link = '<p><a class="button" href="' . $post_link_url . '"' . $post_link_target . '>' . get_field('story_source_name') . '</a></p>';
			        } else {
			        	$post_link_url = get_the_permalink();
			            $post_link = '<a class="button left" href="' . $post_link_url . '">Read more</a>';
			        }

		    	    // Get categories
		            $terms = wp_get_post_terms(get_the_id(), 'category');
					if (!empty($terms)) {

						$terms_list = '';
						foreach ($terms as &$term) {
							if ($term->slug != 'uncategorized') {
								$terms_list .= '<li><a href="/news-and-events/?tax=category&amp;term=' . $term->slug . '">' . $term->name . '</a></li>';
							}
						}

					} else {
						$terms_list = '';
					}
					?>
					<div class="small-news dontsplit">
						<h3><a href="<?php echo $post_link_url; ?>" <?php echo $post_link_target; ?>><?php echo get_the_title(); ?></a></h3>
				        <?php strip_tags(the_advanced_excerpt('length=30&finish=sentence'),''); ?>
				        <div class="post-meta">
			                <time class="article__time left" datetime="<?php echo get_the_date('Y-m-d h:i:s'); ?>"><?php echo get_the_date('M j, Y'); ?></time>
			               	<?php if (!empty($terms)) { ?> 
							<ul class="terms right">
								<?php echo $terms_list; ?>
				            </ul>
				            <?php } ?>
				        </div>
				    </div>
						
				
			<?php endwhile;?>
			<?php wp_reset_postdata(); ?>















				</div>
				<div class="columns large-4">



				<?php
				$wp_query = new WP_Query( $home_col_2_args );
				# The Loop
				while ( $wp_query->have_posts() ) :
		
					// Get field vars
					$wp_query->the_post();
					$posted[] = get_the_id();
					if (get_field('story_link_url')) {
						$post_link_url = get_field('story_link_url');
						$post_link_target = 'target="_blank"';
			            $post_link = '<p><a class="button" href="' . $post_link_url . '"' . $post_link_target . '>' . get_field('story_source_name') . '</a></p>';
			        } else {
			        	$post_link_url = get_the_permalink();
			            $post_link = '<a class="button left" href="' . $post_link_url . '">Read more</a>';
			        }

		    	    // Get categories
		            $terms = wp_get_post_terms(get_the_id(), 'category');
					if (!empty($terms)) {

						$terms_list = '';
						foreach ($terms as &$term) {
							if ($term->slug != 'uncategorized') {
								$terms_list .= '<li><a href="/news-and-events/?tax=category&amp;term=' . $term->slug . '">' . $term->name . '</a></li>';
							}
						}

					} else {
						$terms_list = '';
					}
					?>
					<div class="small-news dontsplit">
						<?php if ( has_post_thumbnail()) { ?>
						<div class="featured-thumbnail" >
							<a href="<?php echo $post_link_url; ?>" class="img" <?php echo $post_link_target; ?>><?php echo the_post_thumbnail( 'large' ); ?></a>
						</div>
						<?php } ?>
						<h3><a href="<?php echo $post_link_url; ?>" <?php echo $post_link_target; ?>><?php echo get_the_title(); ?></a></h3>
				        <?php strip_tags(the_advanced_excerpt('length=30&finish=sentence'),''); ?>
				        <div class="post-meta">
			                <time class="article__time left" datetime="<?php echo get_the_date('Y-m-d h:i:s'); ?>"><?php echo get_the_date('M j, Y'); ?></time>
			               	<?php if (!empty($terms)) { ?> 
							<ul class="terms right">
								<?php echo $terms_list; ?>
				            </ul>
				            <?php } ?>
				        </div>
				    </div>
						
				
			<?php endwhile;?>
			<?php wp_reset_postdata(); ?>



















				</div>
				<div class="columns large-4">



				<?php
				if ($events_count < 4) {
				$posted_exclude = implode(',',$posted);
				$home_col_3_args = array(
					'offset' => 1,
        			'post_type' => 'post',
        			'post__not_in' => $posted,//$posted,
        			'posts_per_page' => 1,
        			'post_status' => 'publish',
    			);
				$wp_query = new WP_Query( $home_col_3_args );
				# The Loop
				while ( $wp_query->have_posts() ) :
		
					// Get field vars
					$wp_query->the_post();
					if (get_field('story_link_url')) {
						$post_link_url = get_field('story_link_url');
						$post_link_target = 'target="_blank"';
			            $post_link = '<p><a class="button" href="' . $post_link_url . '"' . $post_link_target . '>' . get_field('story_source_name') . '</a></p>';
			        } else {
			        	$post_link_url = get_the_permalink();
			            $post_link = '<a class="button left" href="' . $post_link_url . '">Read more</a>';
			        }

		    	    // Get categories
		            $terms = wp_get_post_terms(get_the_id(), 'category');
					if (!empty($terms)) {

						$terms_list = '';
						foreach ($terms as &$term) {
							if ($term->slug != 'uncategorized') {
								$terms_list .= '<li><a href="/news-and-events/?tax=category&amp;term=' . $term->slug . '">' . $term->name . '</a></li>';
							}
						}

					} else {
						$terms_list = '';
					}
					?>
					<?php if ( !empty( $events ) ) { ?>
<section class="events">
	<header>
		<h3><a href="/news-events/events/">Events</a></h3>
	</header>






	<?php the_widget('CoEnv_Widget_Events', 'feed_url=http://www.trumba.com/calendars/sea_fish.rss&posts_per_page=4'); ?>
	<a class="button columns large-3 right" href="/news-events/events/">More Events</a>
</section>
<?php } ?>
					<div class="small-news dontsplit">
						<h3><a href="<?php echo $post_link_url; ?>" <?php echo $post_link_target; ?>><?php echo get_the_title(); ?></a></h3>
				        <?php strip_tags(the_advanced_excerpt('length=30&finish=sentence'),''); ?>
				        <div class="post-meta">
			                <time class="article__time left" datetime="<?php echo get_the_date('Y-m-d h:i:s'); ?>"><?php echo get_the_date('M j, Y'); ?></time>
			               	<?php if (!empty($terms)) { ?> 
							<ul class="terms right">
								<?php echo $terms_list; ?>
				            </ul>
				            <?php } ?>
				        </div>
				    </div>
						
				
			<?php endwhile;?>










<?php wp_reset_postdata(); ?>

<?php } ?>



</div>
<?php endif; ?>








				</div>






			</div>
		</div>







</div>
</div>
<a href="#" class="back-to-top">Back to Top</a>
<?php do_action('foundationPress_after_content'); ?>
</div>
<?php wp_reset_postdata(); wp_reset_query(); //roll back query vars to as per the request ?>
</div>
</div>
<?php get_footer(); ?>
