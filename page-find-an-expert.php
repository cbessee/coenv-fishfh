
<?php get_header(); ?>




















<div class="row">
	<?php coenv_base_section_title($post->ID); ?>
	<?php if (!is_front_page() && function_exists('bcn_display')): ?>
	<div class="breadcrumbs"><?php bcn_display(); ?></div>
	<?php endif; ?>
	<div class="small-12 large-8 columns" role="main">

	<?php do_action('foundationPress_before_content'); ?>
	<ul class="widget-area before-content">
	<?php dynamic_sidebar("before-content"); ?>
	</ul>
	<div class="entry-content">
	<?php if ( coenv_base_post_parent(get_the_id())): ?>
		<?php if ( is_page() || is_single()) : ?>
			<h1 class="article__title"><?php the_title() ?></h1>
		<?php else : ?>
			<h1 class="article__title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title() ?></a></h1>
		<?php endif ?>
		<?php endif ?>
<?php
	if (have_posts()) : while (have_posts()) : the_post();

the_content();

endwhile; endif;
?>

			</div>	
	<?php
	$catargs = array(
		'orderby'                  => 'name',
		'order'                    => 'ASC',
		'taxonomy'                 => 'research_areas',
	); 
	$categories = get_categories( $catargs );

foreach ($categories as $category) {?>
<?php //print_r($category); ?>
<h3><?php echo $category->name;// Category title ?></h3>
<p><?php echo $category->category_description; ?></p>

<?php

    // WP_Query arguments

    $args = array (

        'post_type'              => 'faculty',

        'posts_per_page'         => '-1',

        'order'                  => 'ASC',

		'orderby'                => 'title',

		'tax_query' => array(
		array(
			'taxonomy' => 'research_areas',
			'field'    => 'slug',
			'terms'    => $category->slug,
		),
	),



    );

    

    // The Query

    $query = new WP_Query( $args );

    

    // The Loop

    if ( $query->have_posts() ) { ?>
    	<div class="faculty-list-teach clearfix">
       <?php


        while ( $query->have_posts() ) {

            $query->the_post();
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
			?>
			<div class="faculty-list-item">
            <?php 
            echo '<a href="' . $faculty_link . '"><img src="' . $faculty_img_src . '"" alt="' . get_the_title() . '" /></a>';
			echo '<h3><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';


            ?>
        	</div>

            <?php 

			// You can all phone/ email here

        }
        ?>
    </div>
        <?php
    } else {

        echo 'derp!';

    }

    

    // Restore original Post Data

    wp_reset_postdata();

}

?>







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
