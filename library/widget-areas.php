<?php

function foundationpress_sidebar_widgets() {
  register_sidebar(array(
      'id' => 'sidebar-widgets',
      'name' => __('Sidebar widgets', 'foundationpress'),
      'description' => __('Drag widgets to this container.', 'foundationpress'),
      'before_widget' => '<article id="%1$s" class="row widget %2$s"><div class="small-12 columns">',
      'after_widget' => '</div></article>',
      'before_title' => '<h4>',
      'after_title' => '</h4>'
  ));

  register_sidebar(array(
      'id' => 'footer-widgets',
      'name' => __('Footer widgets', 'foundationpress'),
      'description' => __('Drag widgets to this container', 'foundationpress'),
      'before_widget' => '<article id="%1$s" class="large-4 columns widget %2$s">',
      'after_widget' => '</article>',
      'before_title' => '<h4>',
      'after_title' => '</h4>'      
  ));

  register_sidebar(array(
      'id' => 'before-content',
      'name' => __('Before content', 'foundationpress'),
      'description' => __('Drag widgets to this container', 'foundationpress')     
  ));


}

add_action( 'widgets_init', 'foundationpress_sidebar_widgets' );

?>