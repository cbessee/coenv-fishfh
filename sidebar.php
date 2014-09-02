<aside id="sidebar" class="small-12 large-4 columns">
	<?php do_action('foundationPress_before_sidebar'); ?>
	<?php 
		if (!is_front_page() && !is_search()) {
			echo coenv_base_hierarchical_submenu($post); 
		}
	?>
	<?php dynamic_sidebar("sidebar-widgets"); ?>
	<?php do_action('foundationPress_after_sidebar'); ?>
</aside>