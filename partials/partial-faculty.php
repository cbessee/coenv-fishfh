<?php  
/**
 * An individual article
 */
$faculty_fields = get_fields();
$faculty_email_address = $faculty_fields["email_address"];
$faculty_website_url = $faculty_fields["website_url"];
$faculty_scival_url  = $faculty_fields["scival_url"];
$faculty_twitter_url = $faculty_fields["twitter_url"];
$faculty_advising = $faculty_fields["faculty_advising"];
$faculty_name = $faculty_fields["first_name"] . ' ' . $faculty_fields["last_name"];


?>
<article id="post-<?php the_ID() ?>" <?php post_class( 'article' ) ?>>

	<header class="article__header">
        <div class="article__meta">
   		<?php if ( !is_page() ) : ?>
			<div class="share" data-article-id="<?php the_ID(); ?>" data-article-title="<?php echo get_the_title(); ?>"
			data-article-shortlink="<?php echo wp_get_shortlink(); ?>"
			data-article-permalink="<?php echo the_permalink(); ?>"><a href="#"><i class="fi-share"></i>Share</a>
            </div>
			<div class="post-info"> 
				<?php $categories = get_the_category_list(' ') ?>
					<?php if ( $categories ) : ?>
						<div class="article__categories">
							 | <?php echo $categories ?>
						</div>
				</div>
 				<?php endif ?> 
            </div>
		<?php endif ?>
		<?php if ( is_page() || is_single()) : ?>
			<h1 class="article__title"><?php the_title() ?></h1>
		<?php else : ?>
			<h1 class="article__title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title() ?></a></h1>
		<?php endif ?>

	</header>

	<section class="article__content">
		<div class="faculty-info right">
			<?php echo get_the_post_thumbnail($page->ID, 'thumbnail'); ?>
			<p class="faculty-name"><?php echo $faculty_name; ?></p>
			<?php if( have_rows('job_titles') ) { ?>
				<ul class="job-titles">
				<?php
				while ( have_rows('job_titles') ) : the_row();
					echo '<li>';
					the_sub_field('job_title');
					echo '</li>';
				endwhile;
				?>
				</ul>
			<?php } ?>
			<?php if( have_rows('phone_number') ) { ?>
				<ul class="room-numbers">
				<?php
				while ( have_rows('phone_number') ) : the_row();
					echo '<li>';
					the_sub_field('number');
					echo '</li>';
				endwhile;
				?>
				</ul>
				<ul class="online-contacts">
					<?php }
					if ($faculty_email_address) {
						echo '<li class="faculty-email"><a href="' . $faculty_email_address . '">' .  $faculty_email_address . '</a></li>';
					}
					if ($faculty_scival_url) {
						echo '<li class="faculty-scival"><a href="' . $faculty_scival_url . '">SciVal</a></li>';
					}
					if ($faculty_twitter_url) {
						echo '<li class="faculty-twitter"><a href="' . $faculty_twitter_url . '">Twitter</a></li>';
					}
					?>
				</ul>
				<?php
					if ($faculty_website_url) {
						echo '<p class="faculty-website"><a class="button [radius round]" href="' . $faculty_website_url . '">Visit this faculty member\'s website</a></p>';
					}
				?>
		</div>
		<?php the_content() ?>
		<?php if ( get_field('story_link_url') ): ?> 
	 		<a href="<?php the_field('story_link_url'); ?>" class="button" target="_blank"><?php the_field('story_source_name'); ?> »</a> 
		<?php endif; ?>
		<div class="faculty-pubs">
			<h2>Selected publications</h3>
			<?php echo the_field('selected_publications'); ?>
		</div>
	</section>
	<pre>
		<?php //var_dump($faculty_fields); ?>
	</pre>
    <?php
    remove_filter( 'the_title', 'wptexturize' );
    remove_filter( 'the_excerpt', 'wptexturize' );
	?>

</article><!-- .article -->