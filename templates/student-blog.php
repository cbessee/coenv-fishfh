<?php
/*
Template Name: Student Blog
*/
?>

<?php get_header(); ?>
<?php $blog_slug->slug; ?>
<div class="row">
	<div class="columns large-12 section-title">
		<h1><a href="/students/student-blog">Students</a></h1>
	</div>
	<?php if (!is_front_page() && function_exists('bcn_display')): ?>
	<div class="breadcrumbs"><?php bcn_display(); ?></div>
	<?php endif; ?>
	<div class="small-12 medium-8 columns" role="main">
	<?php do_action('foundationPress_before_content'); ?>
	<?php dynamic_sidebar("before-content"); ?>
	<?php do_action('foundationPress_before_content'); ?>
	<ul class="widget-area before-content">
	<?php dynamic_sidebar("before-content"); ?>
	</ul>
	<?php
$blog_cat = get_term_by( 'slug', (string) $_GET['blog_slug'], 'blog_category' );
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$temp = $wp_query;
$wp_query = null;
$wp_query = new WP_Query();
$wp_query->query;

/**
* Blog Post loop
*/

$blog_args = array(
	'post_type'	=> 'student_blog',
	'posts_per_page' => 1,
	# 'taxonomy' => 'blog_category',
	'term' => $blog_slug->slug,
	'paged'=> $paged
);
$blog_query = new WP_Query( $blog_args );

?>
	<?php if ($blog_query->have_posts()): ?>
	<div class="news clearfix">

		<?php if ($blog_cat): ?>
		<div class="panel">Posts from category: <strong><?php echo $blog_cat->name; ?></strong></div>
		<?php endif; ?>
		<?php
		# The Loop
		while ( $blog_query->have_posts() ) :
		$blog_query->the_post();
		$rows = get_field('blog_link');
		echo '<div class="blog-list-item">';
		echo '<div class="blog-meta"><h5>';
		echo get_the_date('M j, Y');
		echo ' | ';
		echo get_the_term_list( $post->ID, 'blog_category', '', ', ', '' );
		echo '</h5></div>';
		echo '<h3><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
		echo '<div class="post">';
		echo the_excerpt();
		echo '<a class="button" href="' . get_the_permalink() . '">Read more</a>';
		'</div>';
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
		endwhile;
		?>
	</div>
	<div class="pager">
	<?php /* Display navigation to next/previous pages when applicable */ ?>
	<?php if ( function_exists('FoundationPress_pagination') ) { FoundationPress_pagination(); } else if ( is_paged() ) { ?>
		<nav id="post-nav">
			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'FoundationPress' ) ); ?></div>
			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'FoundationPress' ) ); ?></div>
		</nav>
	<?php } ?>
  </div>
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'after-content' ) ) : ?>
	<div id="after-content" class="after-content widget-area" role="complementary">
		<?php dynamic_sidebar( 'after-content' ); ?>
	</div><!-- #after-content -->
	<?php endif; ?>
	<a href="#" class="back-to-top">Back to Top</a>
	<?php do_action('foundationPress_after_content'); ?>

	</div>
<?php wp_reset_postdata(); wp_reset_query(); //roll back query vars to as per the request ?>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>