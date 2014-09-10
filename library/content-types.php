<?php


/*
 * Register custom content types
 */

function coenv_base_post_types_init() {
  register_post_type( 'faculty',
    array(
      'labels' => array(    
      'name' => __( 'Faculty' ),
      'singular_name' => __( 'Faculty' ),
      'add_new_item' => __( 'Add New Faculty' ),
      ),
    'hierarchical' => true,
    'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
    'public' => true,
    'has_archive' => false,
    'show_ui' => true,
    'rewrite' => array('slug' => 'faculty'),
    )
  );
}

add_action( 'init', 'coenv_base_post_types_init' );