<?php  
/**
 * Faculty content
 */
$faculty_fields = get_fields();
$faculty_email_address = str_replace('u.washington.edu','uw.edu',$faculty_fields["email_address"]);
$faculty_website_url = $faculty_fields["website_url"];
$faculty_scival_url  = $faculty_fields["scival_url"];
$faculty_twitter_url = $faculty_fields["twitter_url"];
$faculty_advising = $faculty_fields["faculty_advising"];
$faculty_fname = $faculty_fields["first_name"];
$faculty_lname = $faculty_fields["last_name"];
$faculty_name = $faculty_fname . ' ' . $faculty_lname;
$faculty_cv = $faculty_fields["curriculum_vitae"];

?>
<article id="post-<?php the_ID() ?>" <?php post_class( 'article' ) ?>>

	<header class="article__header">
        <div class="article__meta">
   		<?php if ( is_single() ) : ?>
			<div class="share clearfix" data-article-id="<?php the_ID(); ?>" data-article-title="<?php echo get_the_title(); ?>"
			data-article-shortlink="<?php echo wp_get_shortlink(); ?>"
			data-article-permalink="<?php echo the_permalink(); ?>"><a href="#"><i class="fi-share"></i>Share</a>
            </div>
        <?php endif ?>
        </div>
        <div class="faculty-title clearfix">
			<h1 class="article__title left">
			<?php if ( is_page() || is_single()) : ?>
				<?php the_title() ?>
			<?php else : ?>
				<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title() ?></a>
			<?php endif ?>
			</h1>
			<div class="faculty-website right"><a class="button" href="#" target="_blank">Visit <?php echo coenv_base_apostophe_fname($faculty_fname); ?> website</a></div>
		</div>
		<div class="article__categories"><?php coenv_base_fac_terms($post->ID); ?></div>

	</header>

	<section class="article__content">
		<div class="faculty-info right">
			<?php echo get_the_post_thumbnail($page->ID, 'faculty_med'); ?>
			<p class="faculty-name"><?php echo $faculty_name; ?></p>
			<?php echo '<ul class="faculty_contact_fields">';
			if( have_rows('job_titles') ) {
				echo '<li class="job-titles">';
				echo '<ul>';
				while ( have_rows('job_titles') ) : the_row();
					echo '<li>';
					the_sub_field('job_title');
					echo '</li>';
				endwhile;
				echo '</ul>';
			}
			if ($faculty_email_address) {
				echo '<li class="email"><a href="' . $faculty_email_address . '">' .  $faculty_email_address . '</a></li>';
			}
			if( have_rows('phone_number') ) {
				echo '<li class="phone-numbers">';
				echo '<ul>';
				while ( have_rows('phone_number') ) : the_row();
					echo '<li>';
					the_sub_field('number');
					echo '</li>';
				endwhile;
				echo '</ul>';
				echo '</li>';
			}
			if( have_rows('locations') ) {
				echo '<li class="locations">';
				echo '<ul>';
				while ( have_rows('locations') ) : the_row();
					echo '<li class="location"><a href="http://washington.edu/maps/?';
					the_sub_field('building');
					echo  '" target="_blank">';
					the_sub_field('building');
					echo '</a> ';
					the_sub_field('room_number');
					echo '</li>';
				endwhile;
				echo '</ul>';
				echo '</li>';
			}
			if ($faculty_twitter_url) {
				echo '<li class="faculty-twitter"><a href="' . $faculty_twitter_url . '">Twitter</a></li>';
			}
			if ($faculty_scival_url) {
				echo '<li class="faculty-scival"><a href="' . $faculty_scival_url . '">SciVal</a></li>';
			}
			if ($faculty_cv) {
				echo '<li class="cv"><a href="' . $faculty_cv . '">Curriculum Vitae (CV)</a></li>';
			}
			if ($faculty_website_url) {
				echo '<li class="faculty-website"><a class="button [radius round]" href="' . $faculty_website_url . '">Visit this faculty member\'s website</a></li>';
			}
			echo '</ul>';
			?>	
		</div>
		<?php the_content() ?>
		<div class="faculty-pubs">
			<h2>Selected publications</h3>
			<?php echo the_field('selected_publications'); ?>
		</div>
	</section>
    <?php
    remove_filter( 'the_title', 'wptexturize' );
    remove_filter( 'the_excerpt', 'wptexturize' );
	?>

</article><!-- .article -->