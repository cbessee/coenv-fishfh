<?php
/*
Template Name: Student Blog
*/
?>

<?php get_header(); ?>
<?php $blog_slug->slug; ?>
<div class="row">
	<div class="columns large-12 section-title">
		<h1><a href="/students">Students</a></h1>
	</div>
	<?php //if (!is_front_page() && function_exists('bcn_display')): ?>
	<!--<div class="breadcrumbs"><?php //bcn_display(); ?></div>-->
	<?php //endif; ?>
	<div class="small-12 medium-8 columns" role="main">
		<h1 class="article__title">Student Blog</h1>
	<?php do_action('foundationPress_before_content'); ?>
	<?php do_action('foundationPress_post_before_entry_content'); ?>
	</ul>
	<div class="news clearfix">
		<!--
		<div class="share right" data-article-id="<?php //the_ID(); ?>" data-article-title="<?php //echo get_the_title(); ?>"
			data-article-shortlink="<?php //echo wp_get_shortlink(); ?>"
			data-article-permalink="<?php //echo the_permalink(); ?>"><a href="#"><i class="fi-share"></i>Share</a>
		</div>
	-->
		<?php
		$rows = get_field('blog_link');
		echo '<div class="blog-list-item">';
		echo '<h3><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
		






		echo '<div class="blog-meta">';
		echo '<p>';
		echo get_the_date('M j, Y');
		echo ' / ';
		echo get_the_term_list( $post->ID, 'blog_category', '', ', ', '' );
		echo '</p>';
		echo '</div>';




		echo '<div class="post">';
		# The Loop
		while ( have_posts() ) : the_post();
		echo the_content();
		endwhile;
		echo '<div class="blog-links right">';
		if($rows) {
			foreach($rows as $row) {
				if($row['blog_link_type'] == 'upload') {
					echo '<a class="button" href="' . $row['blog_upload_file'] . '" target="_blank">' . $row['blog_file_link_text'] . '</a>';
				} elseif ($row['blog_link_type'] == 'link') {
					echo '<a class="button" href="' . $row['blog_link_url'] . '" target="_blank">' . $row['blog_link_text'] . '</a>';
				} 
			}
		}
		echo '</div>';
		echo '</div>';
		echo '</div>';

		wp_reset_postdata();?>
	</div>
	<?php if ( is_active_sidebar( 'after-content' ) ) : ?>
	<div id="after-content" class="after-content widget-area" role="complementary">
		<?php dynamic_sidebar( 'after-content' ); ?>
	</div><!-- #after-content -->
	<?php endif; ?>
	<a href="#" class="back-to-top">Back to Top</a>
	<?php do_action('foundationPress_after_content'); ?>

	</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>