<?php get_header(); ?>
<div class="row">
	<div class="columns large-12 section-title"><h1><?php echo the_title(); ?></h1></div>
	<?php if (!is_front_page() && function_exists('bcn_display')): ?>
	<div class="breadcrumbs"><?php bcn_display(); ?></div>
	<?php $fac_cat = get_term_by( 'slug', (string) $_GET['fac-cat'], 'research_areas' ); ?>
	<?php if ($fac_cat): ?>
	<div class="panel">Faculty members working in <strong><?php echo $fac_cat->name; ?></strong></div>
	<?php 
	endif;
	endif; 
	?>
	<div class="small-12 large-8 columns" role="main">
	
	<?php do_action('foundationPress_before_content'); ?>
	<?php dynamic_sidebar("before-content"); ?>
	<div class="faculty-list-teach clearfix">
		<h2>Teaching and research faculty</h2>
		<?php




		/**
		 * Loop for teaching and research faculty.
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
			'meta_query' => array(
				array(
					'key' => 'faculty_type',
					'value' => 'teaching-research',
					'compare' => '='
				)
			),
			);
		$teach_research_query = new WP_Query( $teach_research_args );

		# The Loop
		while ( $teach_research_query->have_posts() ) :
			$teach_research_query->the_post();
			$faculty_thumb = get_the_post_thumbnail(get_the_ID(),'thumbnail');
			$faculty_link = get_the_permalink();
			$faculty_phone_rows = get_field('phone_number' );
			$first_faculty_phone_row = $faculty_phone_rows[0];
			$first_faculty_phone = $first_faculty_phone_row['number' ];
			$faculty_title_rows = get_field('job_titles' );
			$first_faculty_title_row = $faculty_title_rows[0];
			$first_faculty_title = $first_faculty_title_row['job_title'];
			echo '<div class="faculty-list-item">';
				echo '<a href="' . $faculty_link . '">' . $faculty_thumb . '</a>';
				echo '<h3><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
				echo '<div class="faculty-title">' . $first_faculty_title . '</div>';
				echo '<div class="faculty-email"><a href="';
				the_field('email_address');
				echo '">';
				the_field('email_address');
				echo '</a></div>';
				echo '<div class="faculty-phone">' . $first_faculty_phone . '</div>';
			echo '</div>';
		endwhile;
	wp_reset_postdata();
	?>
</div>
<div class="faculty-list-research">
<h2>Research associates (post-docs)</h2>
<div class="faculty-list">
<?php
/**
 * Loop for research associates.
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
	'meta_query' => array(
		array(
			'key' => 'faculty_type',
			'value' => 'research-associates',
			'compare' => '='
		)
	),
	);
$style_classes = array('odd','even');
$styles_count = count($style_classes);
$style_index = 0;
$teach_research_query = new WP_Query( $teach_research_args );


# The Loop
while ( $teach_research_query->have_posts() ) :

	$teach_research_query->the_post();
	$faculty_phone_rows = get_field('phone_number' );
	$first_faculty_phone_row = $faculty_phone_rows[0];
	$first_faculty_phone = $first_faculty_phone_row['number' ];
	$faculty_title_rows = get_field('job_titles' );
	$first_faculty_title_row = $faculty_title_rows[0];
	$first_faculty_title = $first_faculty_title_row['job_title'];
?>

<div class="faculty-list-item <?php $k = $style_index % $styles_count; echo "$style_classes[$k]"; $style_index++; ?>">

<?php
		echo '<div class="faculty-name"><h3>' . get_the_title() . '</div>';
		echo '<div class="faculty-title">' . $first_faculty_title . '</div>';
		echo '<div class="faculty-email"><a href="';
		the_field('email_address');
		echo '">';
		the_field('email_address');
		echo '</a></div>';
		echo '<div class="faculty-phone">' . $first_faculty_phone . '</div>';
	echo '</div>';

endwhile;
wp_reset_postdata();
?>
</div>
</div>
<?php
/**
 * Loop for adjunct faculty.
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
	'meta_query' => array(
		array(
			'key' => 'faculty_type',
			'value' => 'adjunct',
			'compare' => '='
		)
	),
	);
$teach_research_query = new WP_Query( $teach_research_args );
if ($teach_research_query->have_posts()) {
?>
<div class="faculty-list-adjunct">
<h2>Adjunct faculty</h2>
<div class="faculty-list">
<?php
# The Loop
while ( $teach_research_query->have_posts() ) :
	$teach_research_query->the_post();
	$faculty_phone_rows = get_field('phone_number' );
	$first_faculty_phone_row = $faculty_phone_rows[0];
	$first_faculty_phone = $first_faculty_phone_row['number' ];
	$faculty_title_rows = get_field('job_titles' );
	$first_faculty_title_row = $faculty_title_rows[0];
	$first_faculty_title = $first_faculty_title_row['job_title'];
	echo '<div class="faculty-list-item">';
		echo '<h3><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
		echo '<div class="faculty-title">' . $first_faculty_title . '</div>';
		echo '<div class="faculty-email"><a href="';
		the_field('email_address');
		echo '">';
		the_field('email_address');
		echo '</a></div>';
		echo $first_faculty_phone;
	echo '</div>';

endwhile;
wp_reset_postdata();
?>
</div>
</div>
<?php } ?>
<div class="faculty-list-emeritus">
<h2>Emeritus faculty</h2>
<?php
/**
 * Loop for emeritus faculty.
 */
$teach_research_args = array(
	'post_type'	=> 'faculty',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'meta_key' => 'last_name',
	'orderby' => 'meta_value',
	'order' => 'ASC',
	'meta_query' => array(
		array(
			'key' => 'faculty_type',
			'value' => 'emeritus',
			'compare' => '='
		)
	),
	);
$teach_research_query = new WP_Query( $teach_research_args );

# The Loop
while ( $teach_research_query->have_posts() ) :
	$teach_research_query->the_post();
	$faculty_phone_rows = get_field('phone_number' );
	$first_faculty_phone_row = $faculty_phone_rows[0];
	$first_faculty_phone = $first_faculty_phone_row['number' ];
	$faculty_title_rows = get_field('job_titles' );
	$first_faculty_title_row = $faculty_title_rows[0];
	$first_faculty_title = $first_faculty_title_row['job_title'];

	echo '<div class="faculty-list-item">';
	echo '<h3><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
	echo '<div class="faculty-title">' . $first_faculty_title . '</div>';
	echo '<div class="faculty-email"><a href="';
	the_field('email_address');
	echo '">';
	the_field('email_address');
	echo '</a></div>';
	echo $first_faculty_phone;
	echo '</div>';

endwhile;
wp_reset_postdata();
?>
</div>
	<a href="#" class="back-to-top">Back to Top</a>
	<?php do_action('foundationPress_after_content'); ?>

	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>