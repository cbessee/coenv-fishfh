
<?php get_header(); ?>
<?php $blog_slug->slug; ?>
<div class="row">
	<div class="columns large-12 section-title">
		<h1><a href="/blog"><?php echo the_title(); ?></a></h1>
	</div>
	<?php if (!is_front_page() && function_exists('bcn_display')): ?>
	<div class="breadcrumbs"><?php bcn_display(); ?></div>
	<?php endif; ?>
	<div class="small-12 large-8 columns" role="main">

	<?php do_action('foundationPress_before_content'); ?>
	<ul class="widget-area before-content">
	<?php dynamic_sidebar("before-content"); ?>
	</ul>
	<?php
$blog_cat = get_term_by( 'slug', (string) $_GET['blog-slug'], 'blog_category' );
/**
* Publications loop
*/

$blog_args = array(
	'post_type'	=> 'blog',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'taxonomy' => 'blog_category',
	'meta_key' => 'date',
	'orderby' => 'meta_value',
	'order' => 'ASC',
);
$blog_query = new WP_Query( $blog_args );

?>
	<?php if ($blog_query->have_posts()): ?>
	<div class="blog clearfix">

		<?php if ($blog_cat): ?>
		<div class="panel">Publications written by <strong><?php echo $blog_cat->name; ?></strong></div>
		<?php endif; ?>
		<?php
		# The Loop
		while ( $blog_query->have_posts() ) :
		$blog_query->the_post();
		$rows = get_field('blog_link');
		echo '<div class="blog-list-item">';
		echo '<h4><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h4>';
		echo '<div class="post">' . get_the_content() . '</div>';
		echo '<div class="blog-links right">';
		if($rows) {
			foreach($rows as $row) {
				if($row['publication_link_type'] == 'upload') {
					echo '<a class="button" href="' . $row['publication_upload_file'] . '" target="_blank">Download PDF</a>';
				} elseif ($row['publication_link_type'] == 'link') {
					echo '<a class="button" href="' . $row['publication_link_url'] . '" target="_blank">Link to file</a>';
				} 
			}
		}
		echo '</div>';
		echo '</div>';
		endwhile;
		wp_reset_postdata();?>
	</div>
	<?php endif; ?>
	<?php if ( function_exists('FoundationPress_pagination') ) { FoundationPress_pagination(); } else if ( is_paged() ) { ?>
		<nav id="post-nav">
			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'FoundationPress' ) ); ?></div>
			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'FoundationPress' ) ); ?></div>
		</nav>
	<?php } ?>
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