
<?php get_header(); ?>
<?php $pub_slug->slug; ?>
<div class="row">
	<div class="columns large-12 section-title">
		<h1><a href="/publications"><?php echo the_title(); ?></a></h1>
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
$auth_cat = get_term_by( 'slug', (string) $_GET['pub-slug'], 'author' );
$year_cat = get_term_by( 'slug', (string) $_GET['pub-slug'], 'year' );
$theme_cat = get_term_by( 'slug', (string) $_GET['pub-slug'], 'publication_theme' );
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
	'posts_per_page' => -1,
	# 'taxonomy' => 'research_areas',
	'term' => $pub_slug->slug,
	'meta_key' => $year,
	'orderby' => 'meta_value_number title',
	'order' => 'ASC',
);
$publication_query = new WP_Query( $publication_args );

?>
	<?php if ($publication_query->have_posts()): ?>
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
		while ( $publication_query->have_posts() ) :
		$publication_query->the_post();
		$publication_link = get_the_permalink();
		$publication_citation = get_field('publication_citation');
		$rows = get_field('publication_link_type')
		echo '<div class="publication-list-item">';
		echo '<h3><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
		echo '<div class="citation">' . $publication_citation . '</div>';
		echo '<div class="abstract"><a href="' . get_the_permalink() . '">' . View Abstract . '</a></div>';
		if($rows) {
			foreach($rows as $row) {
				if($row['publication_link_type'] == 'upload') {
					$link_url = $row['publiation_upload_file'][0];
					echo '<a class="button" href="' . $link_url . '" target="_blank">Download PDF</a>';
				} elseif ($row['publication_link_type'] == 'link') {
					$link_url = $row['publiation_upload_file'][0];
					echo '<a class="button" href="' . $link_url . '" target="_blank">Link to file</a>';
				} 
			}
		}
		echo '</div>';
		endwhile;
		wp_reset_postdata();?>
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
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
