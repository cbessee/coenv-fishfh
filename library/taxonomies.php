<?php
function coenv_base_taxonomies_init() {

	register_taxonomy(
		'buildings',
		'coenv_base_faculty',
		array(
			'label' => __( 'Buildings' ),
			'rewrite' => array( 'slug' => 'building' ),
		)
	);
}
add_action( 'init', 'coenv_base_taxonomies_init' );