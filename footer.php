</section>
	<footer id="footer" role="contentinfo" class="site-footer">
		<?php do_action('foundationPress_before_footer'); ?>
		<div class="row">
			<div class="medium-6 columns">				
				<header class="site-footer__header">
						<h1><span><?php bloginfo('name') ?></span></h1>
					<?php if (get_option('mail_address')) { ?><a href="http://maps.google.com/?q=<?php echo get_option('mail_address'); ?>" title="Google Maps link"><p><?php echo get_option('mail_address'); ?></p></a><?php } ?>
					<?php if (get_option('public_email_address')) { ?><a href="mailto:<?php echo get_option('public_email_address'); ?>" title="Send us an Email"><p><?php echo get_option('public_email_address'); } ?></a>
					<?php if (get_option('phone')) { ?> | <?php echo get_option('phone'); ?></p><?php } ?>
				</header>
				<div class="footer__info">
					<?php get_search_form() ?>
					<div class="social-buttons">
					<?php if (get_option('facebook')) { ?>
						<a class="button" href="<?php echo get_option('facebook'); ?>" title="Join us on Facebook">
							<i class="fi-social-facebook"></i>
						</a><?php } ?>
					<?php if (get_option('twitter')) { ?>
						<a class="button" href="<?php echo get_option('twitter'); ?>" title="Join us on Twitter">
								<i class="fi-social-twitter"></i>
						</a><?php } ?>
					<?php if (get_option('youtube')) { ?>
						<a class="button" href="<?php echo get_option('youtube'); ?>" title="Join us on YouTube">
								<i class="fi-social-youtube"></i>
						</a><?php } ?>
					</div>
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
							<p class="copyright">&copy; <?php echo date('Y') ?> <a href="http://www.washington.edu/">University of Washington</a> | <a href="/wp-admin" name="Staff Login">Staff Login</a></p>
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