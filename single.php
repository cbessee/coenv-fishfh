<?php get_header(); ?>
<div class="row page-content">
	<div class="columns" role="main">
		<div class="article__content">
			<div class="blog clearfix">

			<?php 
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					$terms = wp_get_post_terms( get_the_ID(), 'category');
					$terms = wp_list_filter($terms, array('slug'=>'featured'),'NOT');
					$terms = wp_list_filter($terms, array('slug'=>'uncategorized'),'NOT');
					$attach_id = get_post_thumbnail_id();
					$attach_id = str_replace('attachment_', '', $attach_id);
					$photo_title = get_post_meta( $attach_id, '_wp_attachment_image_alt', true );
					$photo_alt = get_post_meta( $attach_id, '_wp_attachment_image_alt', true );
					$photo_post = get_post($attach_id);
					$photo_caption = $photo_post->post_excerpt;
					$photo_url = $photo_post->guid;
					$photo_source = get_post_meta( $attach_id, '_credit_text', true );
					$photo_source_url = get_post_meta( $attach_id, '_credit_link', true );

				?>

			<article class="blog-list-item post-<?php the_ID() ?> clearfix">
        		<header class="article__header">
        			<div class="columns small-12 article-meta">
	        			<p>
						<?php 
				        echo get_the_date('M j, Y');
						$termlist = '';
						foreach ($terms as $term) {
				            $termlist .= '<a href="/news-events/?tax='. $term->taxonomy . '&term=' . $term->slug . '">' . $term->name . '</a>, ';
						}
						$termlist = rtrim($termlist,', ');
						if ( !empty( $terms ) ) {
							echo ' / ' . $termlist;
						}
				        ?>
				        </p>
					</div>
					<!--<div class="small-2 right share" data-article-id="<?php the_ID(); ?>" data-article-title="<?php echo get_the_title(); ?>" data-article-shortlink="<?php echo wp_get_shortlink(); ?>" data-article-permalink="<?php echo the_permalink(); ?>"><a href="#"><i class="fi-share"></i>Share</a></div>-->
        			<h2 class="small-12 left article__title"><a href="<?=get_permalink();?>"><?php echo get_the_title(); ?></a></h2>
				</header>
				<div class="article__content">
					<?php 

					echo the_content();
					?>
				</div>
			</article>
			<?php
				}
			}
			?>
	</div>
	  </div>		
	<?php if ( is_active_sidebar( 'after-content' ) ) { ?>
	<?php do_action('foundationPress_after_content'); ?>
	<ul class="widget-area after-content">
	<?php dynamic_sidebar("after-content"); ?>
	</ul>
	<?php } ?>
	<a href="#" class="back-to-top">Back to Top</a>
	<?php do_action('foundationPress_after_content'); ?>
	</div>
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
