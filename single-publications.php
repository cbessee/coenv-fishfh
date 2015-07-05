<?php get_header(); ?>
<div class="row">
	<div class="columns large-12 section-title">
		<h1><a href="/research/publications">Publications</a></h1>
	</div>
	<div class="small-12 medium-9 columns right" role="main">
		<div class="entry-content">
		<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post() ?>
			<?php get_template_part( 'partials/partial', 'publications' ) ?>
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
	</div>
	<?php get_sidebar(); ?>
</div>	
<?php get_footer(); ?>