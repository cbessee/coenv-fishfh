<?php  
/**
 * Publication content
 */


?>
<article id="post-<?php the_ID() ?>" <?php post_class( 'article' ) ?>>

	<header class="article__header">
        <div class="article__meta">
   		<?php if ( is_single() ) : ?>
			<div class="blog-meta"><h5>
			<?php echo get_the_date('Y')?> | <?php echo get_the_term_list( $post->ID, 'publication_theme', '', ', ', '' ); ?>
			</h5></div>
			<div class="share clearfix right" data-article-id="<?php the_ID(); ?>" data-article-title="<?php echo get_the_title(); ?>"
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
		</div>
		<div class="article__categories"><?php coenv_base_fac_terms($post->ID); ?></div>

	</header>

	<section class="article__content">
		<?php
		$publication_link = get_the_permalink();
		$publication_citation = get_field('publication_citation');
		$rows = get_field('publication_link');
		echo '<div class="citation"><h3>Citation</h3>';
		echo $publication_citation . '</div>';
		echo '<div class="publication-links right">';
		if($rows) {
			foreach($rows as $row) {
				if($row['publication_link_type'] == 'upload') {
					echo '<a class="button" href="' . $row['publication_upload_file'] . '" target="_blank">Download PDF</a>';
				} elseif ($row['publication_link_type'] == 'link') {
					echo '<a class="button" href="' . $row['publication_link_url'] . '" target="_blank">Link to file</a>';
				} 
			}
		}
		echo '</div><hr />';
		echo '<div class="abstract"><h3>Abstract</h3>';
		echo get_field('publication_abstract');
		echo '</div>';
		?>
	</section>
    <?php
    remove_filter( 'the_title', 'wptexturize' );
    remove_filter( 'the_excerpt', 'wptexturize' );
	?>

</article><!-- .article -->