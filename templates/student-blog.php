<?php
/*
Template Name: Student Blog
*/

/*
 * Blog query variables
 */
$blog_cat = get_term_by( 'slug', (string) $_GET['blog-cat'], 'blog_category' );
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$temp = $wp_query;
$wp_query = null;
$wp_query = new WP_Query();
$wp_query->query;
$blog_args = array(
	'post_type'	=> 'student_blog',
	'post_status' => 'publish',
	'posts_per_page' => 5,
    'taxonomy' => 'blog_category',
	'term' => $blog_cat->slug,
	'paged'=> $paged
);
$wp_query = new WP_Query( $blog_args );
?>

<?php get_header(); ?>
<?php $blog_slug->slug; ?>
<div class="row">
	<?php coenv_base_section_title($post->ID); ?>
	<?php //if (!is_front_page() && function_exists('bcn_display')): ?>
	<!--<div class="breadcrumbs"><?php //bcn_display(); ?></div>-->
	<?php //endif; ?>
	<div class="small-12 medium-8 columns" role="main">
		<div class="entry-content">
		<?php if ( is_active_sidebar( 'before-content' ) ) : ?>
		<?php do_action('foundationPress_before_content'); ?>
			<ul class="widget-area before-content">
				<?php dynamic_sidebar("before-content"); ?>
			</ul>
		<?php endif; ?>
		<div class="share right" data-article-id="<?php the_ID(); ?>" data-article-title="<?php echo get_the_title(); ?>"
		data-article-shortlink="<?php echo wp_get_shortlink(); ?>"
		data-article-permalink="<?php echo the_permalink(); ?>"><a href="#"><i class="fi-share"></i>Share</a>
        </div>
		<h1 class="article__title"><?php the_title(); ?></h1>

		<hr />
		<?php if ($wp_query->have_posts()): ?>
		<div class="news clearfix">
			<?php if ($blog_cat): ?>
			<div class="panel">
				<p>Posts from category: <strong><?php echo $blog_cat->name; ?></strong></p>
				<p><a class="button" href="/students/student_blog/">Back to all posts</a></p>
			</div>
			<?php endif; ?>
			<?php
			# The Loop
			while ( $wp_query->have_posts() ) :
			$wp_query->the_post();
			$rows = get_field('blog_link');
			$terms = wp_get_post_terms( get_the_ID(), 'blog_category');
			
			
			echo '<div class="blog-list-item right">';
			echo '<h3><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
			echo '<div class="blog-meta">';
			echo '<p>' . get_the_date('M j, Y') .' / ';
			$termlist = '';
			foreach ($terms as $term) {
			 $termlist .= '<a href="/students/student-blog/?blog-cat=' . $term->slug . '">' . $term->name . '</a>, ';
			}
			$termlist = rtrim($termlist,', ');
			echo $termlist;
			 echo '</p>';
			
			echo '</div>';
			echo '<div class="post">';
			echo '<a class="left" style="margin-right: 2rem;" href="' . get_the_permalink() . '">';
			the_post_thumbnail( 'med_sq' );
			echo '</a>';
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
  </div>
	<?php endif; ?>
		
<?php if ( is_active_sidebar( 'after-content' ) ) : ?>
	<?php do_action('foundationPress_after_content'); ?>
	<ul class="widget-area after-content">
	<?php dynamic_sidebar("after-content"); ?>
	</ul>
	<?php endif; ?>
	<a href="#" class="back-to-top">Back to Top</a>
	<?php do_action('foundationPress_after_content'); ?>
	</div>
	    <?php wp_reset_postdata(); wp_reset_query(); //roll back query vars to as per the request ?>
	    	    <?php wp_reset_postdata(); wp_reset_query(); //roll back query vars to as per the request ?>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
