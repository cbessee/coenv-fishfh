<?php
/*
Template Name: Publications Page
*/
?>

<?php get_header(); ?>
<?php $pub_slug->slug; ?>
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
	<h1 class="article__title"><?php the_title() . $_GET['blog-cat']; ?></h1>
	<hr>
	<?php
$auth_cat = get_term_by( 'slug', (string) $_GET['pub-slug'], 'author' );
$year_cat = get_term_by( 'slug', (string) $_GET['pub-slug'], 'year' );
$theme_cat = get_term_by( 'slug', (string) $_GET['pub-slug'], 'publication_theme' );

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$temp = $wp_query;
$wp_query = null;
$wp_query = new WP_Query();
$wp_query->query;

/**
* Publications filters
*/

$author_args = array(
	'orderby'            => 'ID', 
	'order'              => 'ASC',
	'hide_empty'         => 1, 
	'child_of'           => 0,
	'echo'               => 1,
	'name'               => 'author-cat',
	'id'                 => 'author',
	'class'              => 'author-cat-postform',
	'taxonomy'           => 'author',
	'hide_if_empty'      => false,
);

wp_dropdown_categories( $args );

/**
* Publications loop
*/
$year = get_term_by('id', $post_ID, 'year');

function alter_pub_order($order,$qry) {
  remove_filter('posts_orderby','alter_order',1,2);
  $order = explode(',',$order);
  $order = implode( ' DESC,',$order);
  return $order;
}
add_filter('posts_orderby','alter_pub_order',1,2);

$publication_args = array(
	'post_type'	=> 'publications',
	'post_status' => 'publish',
	'posts_per_page' => 20,
	# 'taxonomy' => 'research_areas',
	'term' => $pub_slug->slug,
	'meta_key' => $year,
	'orderby' => 'meta_value_number',
	'order' => 'ASC',
	'paged' => $paged
);
$wp_query = new WP_Query( $publication_args );

?>
	<?php if ($wp_query->have_posts()): ?>
	<div class="publication clearfix">

		<?php if ($auth_cat): ?>
		<div class="panel">Publications written by <strong><?php echo $auth_cat->name; ?></strong></div>
		<?php endif; ?>
		<?php if ($year_cat): ?>
		<div class="panel">Publications from <strong><?php echo $year_cat->name; ?></strong></div>
		<?php endif; ?>
		<?php if ($theme_cat): ?>
		<div class="panel">Publications about <strong><?php echo $theme_cat->name; ?></strong></div>
		<?php endif; ?>
		<?php
		# The Loop
		while ( $wp_query->have_posts() ) :
		$wp_query->the_post();
		$publication_link = get_the_permalink();
		$publication_citation = get_field('publication_citation');
		$rows = get_field('publication_link');
		echo '<div class="publication-list-item">';
		echo '<div class="blog-meta"><h5>';
		echo get_the_term_list( $post->ID, 'publication_theme', '', ', ', '' );
		echo '</h5></div>';
		echo '<h4><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h4>';
		echo '<div class="citation">' . $publication_citation . '</div>';
		echo '<div class="publication-links right">';
		if($rows) {
			foreach($rows as $row) {
				if($row['publication_link_type'] == 'upload') {
					echo '<a class="button" href="' . $row['publication_upload_file'] . '" target="_blank">Download PDF</a>';
				} elseif ($row['publication_link_type'] == 'link') {
					echo '<a class="button" href="' . $row['publication_link_url'] . '" target="_blank">' . $row['publication_link_text'] . '</a>';
				} 
			}
		}
		echo '</div>';
		echo '<div class="abstract"><a class="button" href="' . get_the_permalink() .'">View Abstract</a></div>';
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