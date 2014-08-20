<?php
class coenv_base_subnav extends WP_Widget {
          function coenv_base_subnav() {
                    $widget_ops = array(
                    'classname' => 'coenv_base_subnav',
                    'description' => 'Second-level navigation'
          );

          $this->WP_Widget(
                    'coenv_base_subnav',
                    'Second-level navigation',
                    $widget_ops
          );
}

          function widget($args, $instance) { // widget sidebar output
                    extract($args, EXTR_SKIP);
                    echo $before_widget; // pre-widget code from theme

                    echo 'This is a work in progress.';

                    echo $after_widget; // post-widget code from theme
          }
}

add_action(
          'widgets_init',
          create_function('','return register_widget("coenv_base_subnav");')
);