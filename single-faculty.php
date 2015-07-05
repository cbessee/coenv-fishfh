<?php get_header(); ?>
<div class="row">
	<div class="small-12 medium-8 columns right" role="main">
	<?php do_action('foundationPress_before_content'); ?>
		<div class="entry-content">
			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post() ?>
			<?php get_template_part( 'partials/partial', 'faculty' ) ?>
			<?php endwhile ?>
			<?php endif ?>
		</div>
		<footer>
			<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'FoundationPress'), 'after' => '</p></nav>' )); ?>
			<p><?php the_tags(); ?></p>
		</footer>
		<?php if ( is_active_sidebar( 'after-content' ) ) : ?>
		<div id="after-content" class="after-content widget-area" role="complementary">
			<?php dynamic_sidebar( 'after-content' ); ?>
		</div><!-- #after-content -->
		<?php endif; ?>
		</article>	
	<?php do_action('foundationPress_after_content'); ?>
	</div>
	<?php get_sidebar(); ?>
</div>	
<?php get_footer(); ?>