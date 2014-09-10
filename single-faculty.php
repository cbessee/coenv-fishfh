<?php get_header(); ?>
<div class="row">
	<div class="columns large-12 section-title"><h1>Faculty</h1></div>
	<div class="breadcrumbs"><!-- Breadcrumb NavXT 5.1.1 -->
		<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" title="Go to School of Aquatic and Fishery Sciences." href="http://dev.fish.washington.edu" class="home">Home</a></span><a property="v:title" href="/faculty">Faculty</a></span><span typeof="v:Breadcrumb"><span property="v:title"><?php the_title(); ?></span></span>
	</div>
	<div class="small-12 large-8 columns" role="main">
	
	<?php do_action('foundationPress_before_content'); ?>
			<?php do_action('foundationPress_post_before_entry_content'); ?>
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
			<?php do_action('foundationPress_post_before_comments'); ?>
			<?php comments_template(); ?>
			<?php do_action('foundationPress_post_after_comments'); ?>
		</article>	
	<?php do_action('foundationPress_after_content'); ?>

	</div>
	<?php get_sidebar(); ?>
</div>	
<?php get_footer(); ?>