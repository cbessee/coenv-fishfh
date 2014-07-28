</section>
	<footer id="footer" role="contentinfo" class="site-footer">
		<?php do_action('foundationPress_before_footer'); ?>
		<div class="row">
			<div class="medium-6 columns">				
				<header class="site-footer__header">
						<h1><span><?php bloginfo('name') ?></span></h1>
				</header>

					<div class="footer__info">
							<?php get_search_form() ?>
							<?php wp_nav_menu(array(
									'theme_location' => 'footer-top-links', 
									'depth' => 1,
									'menu_class' => 'top-links',
									'container' => false, 
									'walker' => new CoEnv_Top_Menu_Walker(),
									'fallback_cb' => false
							)); ?>
					</div>
				</div>
			<div class="medium-6 columns right">
				<nav class="footer-nav">
							<h1 id="logo">
									<a href="http://coenv.washington.edu/" rel="home" title="UW College of the Environment">
											<span>UW College of the Environment</span>
											<!--[if lt IE 9]>
													<img src="<?php echo get_template_directory_uri() ?>/assets/img/uw-footer.png" alt="UW College of the Environment" />
											<![endif]-->
											<!--[if gt IE 8]><!-->
													<img src="<?php echo get_template_directory_uri() ?>/assets/img/uw-footer.svg" alt="UW College of the Environment" />
											<!--<![endif]-->
									</a>
							</h1>
							<?php wp_nav_menu( array(
									'theme_location' => 'footer-units',
									'depth' => 1,
									'menu_class' => 'menu-footer-units',
									'container' => false,
									'fallback_cb' => false
							) ) ?>
					</nav>
				</div>
			
				<div class="medium-12 columns">
					<div class="uw-footer">
							<p class="copyright">&copy; <?php echo date('Y') ?> <a href="http://www.washington.edu/">University of Washington</a></p>

							<?php wp_nav_menu( array(
									'theme_location' => 'footer-links',
									'depth' => 1,
									'menu_class' => 'menu-footer-links',
									'container' => false,
									'fallback_cb' => false
							) ) ?>
					</div>
				</div>
			</div>
		</div><!-- .container -->
	</footer><!-- #footer -->
</row>

	<?php dynamic_sidebar("footer-widgets"); ?>
	<?php do_action('foundationPress_after_footer'); ?>
</footer>
<a class="exit-off-canvas"></a>
	
  <?php do_action('foundationPress_layout_end'); ?>
  </div>
</div>
<?php wp_footer(); ?>
<?php do_action('foundationPress_before_closing_body'); ?>
</body>
</html>