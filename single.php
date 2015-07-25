<?php get_header(); ?>
<div class="row page-content">
	<div class="small-12 medium-9 columns right" role="main">
		<div class="article__header news__header">
			<h1 class="article__title"><?php the_title(); ?></h1>
		</div>
		<div class="entry-content">

			



			<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post() ?>
					
						<?php get_template_part( 'partials/partial', 'article' ) ?>

					<?php endwhile ?>
					<?php if ( get_field('story_link_url') ) : echo '<p><a class="button" href="' . get_field('story_link_url') . '" target="_blank">' . get_field('story_source_name') . '</a></p>'; endif; ?>

			<?php endif ?>
			</div>
			<?php if ( is_active_sidebar( 'after-content' ) ) : ?>
				<div id="after-content" class="after-content widget-area" role="complementary">
					<?php dynamic_sidebar( 'after-content' ); ?>
				</div><!-- #after-content -->
			<?php endif; ?>
			<footer>
				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'FoundationPress'), 'after' => '</p></nav>' )); ?>
				<p><?php the_tags(); ?></p>
			</footer>
			<?php do_action('foundationPress_post_before_comments'); ?>
			<?php comments_template(); ?>
			<?php do_action('foundationPress_post_after_comments'); ?>
		</article>
	<?php do_action('foundationPress_after_content'); ?>

	</div>
	<aside id="sidebar" class="small-12 medium-3 columns left">
	<?php
	if (!is_front_page()) {
		echo '<div class="coenv_base_subnav">';
		//if ($GLOBALS['post']->post_parent) {
		echo '<div class="section-title">';
		echo coenv_base_section_title($GLOBALS['post']->ID);
		echo '</div>';
		//}
		echo coenv_base_hierarchical_submenu($GLOBALS['post']->ID);
		echo '</div>';
		
	}
	?>
	<?php dynamic_sidebar('sidebar-widgets'); ?>
	<?php
	$ancestor_id = coenv_base_get_ancestor('ID');
	if (!function_exists('dynamic_sidebar') || !dynamic_sidebar( $ancestor_id )):
		dynamic_sidebar( $ancestor_id );
	endif;
	?>
	</aside>
</div>	
<?php get_footer(); ?>