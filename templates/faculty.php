<?php
/*
Template Name: Faculty Index
*/
?>

<?php get_header(); ?>
<?php echo $fac_cat->slug; ?>
<div class="row">
	<div class="columns large-12 section-title">
		<h1><a href="/faculty"><?php echo the_title(); ?></a></h1>
	</div>
	<?php //if (!is_front_page() && function_exists('bcn_display')): ?>
	<!--<div class="breadcrumbs"><?php //bcn_display(); ?></div>-->
	<?php //endif; ?>
	<div class="small-12 medium-8 columns" role="main">
	<?php if ( is_active_sidebar( 'before-content' ) ) : ?>
	<?php do_action('foundationPress_before_content'); ?>
	<ul class="widget-area before-content">
	<?php dynamic_sidebar("before-content"); ?>
	</ul>
	<?php endif; ?>
	<?php
$fac_cat = get_term_by( 'slug', (string) $_GET['fac-cat'], 'research_areas' );
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$temp = $wp_query;
$wp_query = null;
$wp_query = new WP_Query();
$wp_query->query;

/**
* Faculty loop
*/
$teach_research_args = array(
	'post_type'	=> 'faculty',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'taxonomy' => 'research_areas',
	'term' => $fac_cat->slug,
	'meta_key' => 'last_name',
	'orderby' => 'meta_value',
	'order' => 'ASC',
	'paged' => $paged,
	'meta_query' => array(
		array(
			'key'     => 'last_name',
			'compare' => 'IN',
		),
	),
);
$wp_query = new WP_Query( $teach_research_args );

?>
	<?php if ($wp_query->have_posts()): ?>
	<div class="faculty-list-teach clearfix">

		<?php if ($fac_cat): ?>
		<div class="panel">Faculty members working in <strong><?php echo $fac_cat->name; ?></strong></div>
		<?php endif; ?>
		<?php
		# The Loop
		while ( $wp_query->have_posts() ) :
		$wp_query->the_post();
		$faculty_thumb = get_the_post_thumbnail(get_the_ID(),'faculty_sm');
		$faculty_link = get_the_permalink();
		$faculty_phone_rows = get_field('phone_number');
		$faculty_email = str_replace('u.washington.edu','uw.edu',get_field('email_address'));
		$first_faculty_phone_row = $faculty_phone_rows[0];
		$first_faculty_phone = $first_faculty_phone_row['number' ];
		$faculty_title_rows = get_field('job_titles' );
		$first_faculty_title_row = $faculty_title_rows[0];
		$first_faculty_title = $first_faculty_title_row['job_title'];
		$faculty_img_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		if (!$faculty_img_src) {
		$faculty_img_src = get_template_directory_uri() . '/assets/img/blank-153x153.jpg';
		}
		echo '<div class="faculty-list-item">';
		echo '<a href="' . $faculty_link . '"><img src="' . $faculty_img_src . '"" alt="' . get_the_title() . '" /></a>';
		echo '<h3><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
		echo '</div>';
		endwhile;
		?>
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
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
