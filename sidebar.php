<?php
/**
 * The sidebar template
 *
 * Serves up sidebar widgets for individual top level pages
 */
?>
<aside id="sidebar" class="columns">
	<?php do_action('foundationPress_before_sidebar'); ?>
	<?php dynamic_sidebar("sidebar-widgets"); ?>
	<?php do_action('foundationPress_after_sidebar'); ?>
</aside>

