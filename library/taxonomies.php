<?php

/**
* Custom Taxonomies for Publications
**/

function pub_tax() {

	$labels = array(
		'name'                       => _x( 'Authors', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Author', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Authors', 'text_domain' ),
		'all_items'                  => __( 'All Authors', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Author', 'text_domain' ),
		'add_new_item'               => __( 'Add Author', 'text_domain' ),
		'edit_item'                  => __( 'Edit Author', 'text_domain' ),
		'update_item'                => __( 'Update Author', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove authors', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most cited authors', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'author', array( 'publications' ), $args );
	
	$labels_2 = array(
		'name'                       => _x( 'Publication Years', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Year', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Publication Years', 'text_domain' ),
		'all_items'                  => __( 'All Years', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Year', 'text_domain' ),
		'add_new_item'               => __( 'Add Year', 'text_domain' ),
		'edit_item'                  => __( 'Edit Year', 'text_domain' ),
		'update_item'                => __( 'Update Year', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate years with commas', 'text_domain' ),
		'search_items'               => __( 'Search Years', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove years', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most published years', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
	);
	$args_2 = array(
		'labels'                     => $labels_2,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'year', array( 'publications' ), $args_2 );
	
	$labels_3 = array(
		'name'                       => _x( 'Research Themes', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Research Theme', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Research Themes', 'text_domain' ),
		'all_items'                  => __( 'All Themes', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Theme', 'text_domain' ),
		'add_new_item'               => __( 'Add Theme', 'text_domain' ),
		'edit_item'                  => __( 'Edit Theme', 'text_domain' ),
		'update_item'                => __( 'Update Theme', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate themes with commas', 'text_domain' ),
		'search_items'               => __( 'Search Themes', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove themes', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used themes', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
	);
	$args_3 = array(
		'labels'                     => $labels_3,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'publication_theme', array( 'publications' ), $args_3 );
}
add_action( 'init', 'pub_tax' );