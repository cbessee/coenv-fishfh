<?php

/**
* Custom Taxonomies for Publications
**/

function pub_tax() {
	register_taxonomy(
		'authors',
		'publications',
		array(
			'label' => __( 'Authors' ),
			'rewrite' => array( 'slug' => 'author' ),
			'capabilities' => array(
				'assign_terms' => 'edit_guides',
				'edit_terms' => 'publish_guides'
			)
		)
	);
	register_taxonomy(
		'publication_date',
		'publications',
		array(
			'label' => __( 'Publication Date' ),
			'rewrite' => array( 'slug' => 'year' ),
			'capabilities' => array(
				'assign_terms' => 'edit_guides',
				'edit_terms' => 'publish_guides'
			)
		)
	);
	register_taxonomy(
		'publication_research_themes',
		'publications',
		array(
			'label' => __( 'Research Theme' ),
			'rewrite' => array( 'slug' => 'theme' ),
			'capabilities' => array(
				'assign_terms' => 'edit_guides',
				'edit_terms' => 'publish_guides'
			)
		)
	);
}
add_action( 'init', 'pub_tax' );