<?php

/*
 * Register widget areas and define format
 */

function coenv_base_sidebar_widgets() {

  $before_widget  = '<div class="small-12 columns"><article id="%1$s" class="row widget %2$s">';
  $before_widget_two_columns  = '<div class="small-6 columns"><article id="%1$s" class="row widget %2$s">';
  $before_widget_three_columns  = '<div class="small-4 columns"><article id="%1$s" class="row widget %2$s">';
  $before_title   = '<h4>';
  $after_title  = '</h4>';
  $after_widget = '</div></article> <!-- end #%1$s -->';

  register_sidebar(array(
      'id' => 'sidebar-widgets',
      'name' => __('Sidebar / All', 'foundationpress'),
      'description' => __('Drag widgets to this container.', 'foundationpress'),
      'before_widget' => $before_widget,
      'after_widget' => $after_widget,
      'before_title' => $before_title,
      'after_title' => $after_title
  ));

  /**
   * Adds a widget area for each section.
   */

  // this will return only top-level pages
  $pages = get_pages('parent=0&sort_column=menu_order&sort_order=ASC');
  $pages_to_remove = coenv_base_menu_exclude();

  if ( empty( $pages ) ) {
    return false;
  }

  foreach( $pages as $page ) {
    // remove specific pages
    if( !in_array( $page->ID, $pages_to_remove ) ) {
      register_sidebar( array(
        'id' => 'sidebar-' . $page->ID,
        'name' => 'Sidebar / ' . $page->post_title,
        'description' => __('Drag widgets to this container.', 'foundationpress'),
        'before_widget' => $before_widget,
        'after_widget'  => $after_widget,
        'before_title'  => $before_title,
        'after_title' => $after_title
      ) );
    }
  }

  register_sidebar(array(
      'id' => 'before-content',
      'name' => __('Body / Before content', 'foundationpress'),
      'description' => __('Drag widgets to this container', 'foundationpress'),
      'before_widget' => $before_widget,
      'after_widget' => $after_widget,
      'before_title' => $before_title,
      'after_title' => $after_title   
  ));
  register_sidebar(array(
      'id' => 'after-content',
      'name' => __('Body / After content', 'foundationpress'),
      'description' => __('Drag widgets to this container', 'foundationpress'),
      'before_widget' => $before_widget,
      'after_widget' => $after_widget,
      'before_title' => $before_title,
      'after_title' => $after_title     
  ));
  register_sidebar(array(
      'id' => 'home-content',
      'name' => __('Home / Main Content after Feature', 'foundationpress'),
      'description' => __('Drag widgets to this container', 'foundationpress'),
      'before_widget' => $before_widget,
      'after_widget' => $after_widget,
      'before_title' => $before_title,
      'after_title' => $after_title     
  ));
  register_sidebar(array(
      'id' => 'home-columns',
      'name' => __('Home / After Main Content 3-Columns', 'foundationpress'),
      'description' => __('Drag widgets to this container', 'foundationpress'),
      'before_widget' => $before_widget_three_columns,
      'after_widget' => $after_widget,
      'before_title' => $before_title,
      'after_title' => $after_title     
  ));


}

add_action( 'widgets_init', 'coenv_base_sidebar_widgets' );


/*
 * Faculty research areas
 */

class coenv_base_fac_cats extends WP_Widget {

     /**
      * Register widget with WordPress.
      */
     function __construct() {
          parent::__construct(
               'coenv_base_fac_cats', // Base ID
               __('Faculty category filter (COENV)', 'text_domain'), // Name
               array( 'description' => __( 'Allows filtering of faculty based on research area', 'text_domain' ), ) // Args
          );
     }
     

     /**
      * Front-end display of widget.
      *
      * @see WP_Widget::widget()
      *
      * @param array $args     Widget arguments.
      * @param array $instance Saved values from database.
      */
     public function widget( $args, $instance ) {
          $fac_cat = get_term_by( 'slug', (string) $_GET['fac-cat'], 'research_areas' );
          $fac_cat = $fac_cat->slug;
     
          echo $args['before_widget'];
          
          if ( ! empty( $instance['title'] ) ) {
               echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
          }
          if ( ! empty( $instance['textarea'] ) ) {
               echo $args['before_text'] . apply_filters( 'widget_text', $instance['textarea'] ). $args['after_text'];
          }
                    $cats_args  = array(
                      'orderby' => 'name',
                      'order' => 'ASC',
                      'taxonomy' => 'research_areas'
                      );
                    $cats = get_categories($cats_args);
                    if ($cats) {
                         echo '<ul class="fac-cats">';
                         if ($fac_cat):
                              echo '<li><a class="button" href="/faculty">All Research Areas</a></li>';
                         endif;
                         foreach($cats as $cat) { 
                              echo '<li><a class="button" href="/faculty/?fac-cat=' . $cat->slug . '">' . $cat->name . '</a></li>';
                         }
                         echo '</ul>';
                    }
          echo $args['after_widget'];
     }

     /**
      * Back-end widget form.
      *
      * @see WP_Widget::form()
      *
      * @param array $instance Previously saved values from database.
      */
     public function form( $instance ) {
      //var_dump($instance);

          if ( isset( $instance[ 'title' ] ) ) {
               $title = $instance[ 'title' ];
          }
          else {
               $title = __( 'Sort faculty by research area', 'text_domain' );
          }
          if ( isset( $instance[ 'textarea' ] ) ) {
               $textarea = $instance[ 'textarea' ];
          }
          else {
               $textarea = __( '', 'text_domain' );
          }
          
          ?>
          <p>
          <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
          </p>
          <p>
          <label for="<?php echo $this->get_field_id( 'textarea' ); ?>"><?php _e( 'Description:' ); ?></label> 
          <textarea class="widefat" id="<?php echo $this->get_field_id( 'textarea' ); ?>" name="<?php echo $this->get_field_name( 'textarea' ); ?>" type="text"><?php echo $textarea; ?></textarea>
          </p>
         
          <?php 
     }

     /**
      * Sanitize widget form values as they are saved.
      *
      * @see WP_Widget::update()
      *
      * @param array $new_instance Values just sent to be saved.
      * @param array $old_instance Previously saved values from database.
      *
      * @return array Updated safe values to be saved.
      */
     public function update( $new_instance, $old_instance ) {
          $instance = array();
          $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
          $instance['textarea'] = ( ! empty( $new_instance['textarea'] ) ) ? strip_tags( $new_instance['textarea'] ) : '';


          return $instance;
     }

} // class coenv_base_fac_cats

// register coenv_base_fac_cats widget
function register_coenv_base_fac_cats() {
    register_widget( 'coenv_base_fac_cats' );
}
add_action( 'widgets_init', 'register_coenv_base_fac_cats' );

/*
 * Sub-navigation
 */

class coenv_base_subnav extends WP_Widget {

     /**
      * Register widget with WordPress.
      */
     function __construct() {
          parent::__construct(
               'coenv_base_subnav', // Base ID
               __('Sub-navigation (COENV)', 'text_domain'), // Name
               array( 'description' => __( 'Sub-navigation for each section, usually placed in the sidebar.', 'text_domain' ), ) // Args
          );
     }
     

     /**
      * Front-end display of widget.
      *
      * @see WP_Widget::widget()
      *
      * @param array $args     Widget arguments.
      * @param array $instance Saved values from database.
      */
     public function widget( $args, $instance ) {
     
          echo $args['before_widget'];
          echo coenv_base_hierarchical_submenu($GLOBALS['post']->ID);
          echo $args['after_widget'];
     }  
     /**
      * Back-end widget form.
      *
      * @see WP_Widget::form()
      *
      * @param array $instance Previously saved values from database.
      */
     public function form( $instance ) {
      //var_dump($instance);

      if ( isset( $instance[ 'title' ] ) ) {
           $title = $instance[ 'title' ];
      }
      ?>
      <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
      </p>
     
      <?php 
     } 

} 

function register_coenv_base_subnav() {
    register_widget( 'coenv_base_subnav' );
}
add_action( 'widgets_init', 'register_coenv_base_subnav' );


/**
 * Events Widget
 */
register_widget( 'CoEnv_Widget_Events' );
class CoEnv_Widget_Events extends WP_Widget {

	public function __construct() {
		$args = array(
			'classname' => 'widget widget-events',
			'description' => __( 'Display a short list of Trumba calendar events.', 'coenv' )
		);
 
		parent::__construct(
			'trumba_events', // base ID
			'Trumba Events', // name
			$args
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );
		$feed_url = apply_filters( 'feed_url', $instance['feed_url'] );
		$events_url = apply_filters( 'events_url', $instance['events_url'] );
		$posts_per_page = (int) $instance['posts_per_page'];

		if ( !isset( $feed_url ) || empty( $feed_url ) ) {
			return;
		}

		// get cached XML from WP transient API
		$events_xml = get_transient( 'trumba_events_xml' );
		if ( $events_xml === false || $events_xml === '' ) {
			$events_xml = file_get_contents( $feed_url );
			set_transient( 'trumba_events_xml', $events_xml, 1 * MINUTE_IN_SECONDS );
		}
		
		$xml = new SimpleXmlElement($events_xml);
		
		$events = array();

		foreach ($xml->channel->item as $item) {     
			$events[] = array(
				'title' => $item->title,
				'date'	=> $item->category,
				'url'	=> $item->link
			);
		}

		if ( empty( $events ) ) {
			return;
		}

		$events = array_slice( $events, 0, $posts_per_page );

		?>
			<?php echo $before_widget ?>
			
				<?php echo $before_title ?>

					<span><a href="<?php echo $events_url; ?>"><?php echo $title ?></a></span>

					<?php if ( $events_url != '' ) : ?>
                                   
						<a href="<?php echo $events_url; ?>" class="button right" title="View All Events">More &raquo;</a>
					<?php endif ?>

				<?php echo $after_title ?>

			<ul class="event-list">

			<?php if ( count( $events ) ) : ?>

				<?php foreach ( $events as $key => $event ) : ?>


						<li>
							<a href="<?php echo $event['url'] ?>">
							<p class="date"><i class="foundicon-calendar"></i> <?php echo $event['date'] ?></p>
							<p class="title"><?php echo $event['title'] ?></p>
							</a>
						</li>

			

				<?php endforeach ?>

			<?php else : ?>

				<li><p>No events found.</p></li>

			<?php endif ?>
				
			</ul>

			<?php echo $after_widget ?>
		
		<?php
	}

	public function form( $instance ) {

		$title = isset( $instance['title'] ) ? $instance['title'] : __( 'Events', 'coenv' );
		$feed_url = $instance['feed_url'];
		$events_url = $instance['events_url'];
		$posts_per_page = isset( $instance['posts_per_page'] ) ? (int) $instance['posts_per_page'] : 5;
 
		?>
			<p>
				<label for="<?php echo $this->get_field_name( 'title' ) ?>"><?php _e( 'Title:' ) ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ) ?>" name="<?php echo $this->get_field_name( 'title' ) ?>" value="<?php echo esc_attr( $title ) ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_name( 'feed_url' ) ?>"><?php _e( 'Feed URL:' ) ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'feed_url' ) ?>" name="<?php echo $this->get_field_name( 'feed_url' ) ?>" value="<?php echo esc_attr( $feed_url ) ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_name( 'events_url' ) ?>"><?php _e( 'More link (URL):' ) ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'events_url' ) ?>" name="<?php echo $this->get_field_name( 'events_url' ) ?>" value="<?php echo esc_attr( $events_url ) ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_name( 'posts_per_page' ) ?>">Number of events to show: </label>
				<input name="<?php echo $this->get_field_name( 'posts_per_page' ) ?>" type="text" size="3" value="<?php echo $posts_per_page ?>" />
			</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['feed_url'] = strip_tags( $new_instance['feed_url'] );
		$instance['posts_per_page'] = strip_tags( $new_instance['posts_per_page'] );
		$instance['events_url'] = strip_tags( $new_instance['events_url'] );
		 
		return $instance;
	}

}

/*
 * Faculty research areas
 */

class coenv_base_blog_cats extends WP_Widget {

     /**
      * Register widget with WordPress.
      */
     function __construct() {
          parent::__construct(
               'coenv_base_blog_cats', // Base ID
               __('Blog category filter (COENV)', 'text_domain'), // Name
               array( 'description' => __( 'Allows filtering of blog posts base on blog category', 'text_domain' ), ) // Args
          );
     }
     

     /**
      * Front-end display of widget.
      *
      * @see WP_Widget::widget()
      *
      * @param array $args     Widget arguments.
      * @param array $instance Saved values from database.
      */
     public function widget( $args, $instance ) {
          $blog_cat = get_term_by( 'slug', (string) $_GET['blog-cat'], 'blog_categories' );
          $blog_cat = $blog_cat->slug;
     
          echo $args['before_widget'];
          
          if ( ! empty( $instance['title'] ) ) {
               echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
          }
          if ( ! empty( $instance['textarea'] ) ) {
               echo $args['before_text'] . apply_filters( 'widget_text', $instance['textarea'] ). $args['after_text'];
          }
                    $cats_args  = array(
                      'orderby' => 'name',
                      'order' => 'ASC',
                      'taxonomy' => 'blog_category'
                      );
                    $cats = get_categories($cats_args);
                    if ($cats) {
                         echo '<ul class="blog-cats inline-list">';
                         foreach($cats as $cat) { 
                              echo '<li><a class="button" href="/students/student-blog/?blog-cat=' . $cat->slug . '">' . $cat->name . '</a></li>';
                         }
                         echo '</ul>';
                    }
          echo $args['after_widget'];
     }

     /**
      * Back-end widget form.
      *
      * @see WP_Widget::form()
      *
      * @param array $instance Previously saved values from database.
      */
     public function form( $instance ) {
      //var_dump($instance);

          if ( isset( $instance[ 'title' ] ) ) {
               $title = $instance[ 'title' ];
          }
          else {
               $title = __( 'Categories', 'text_domain' );
          }
          if ( isset( $instance[ 'textarea' ] ) ) {
               $textarea = $instance[ 'textarea' ];
          }
          else {
               $textarea = __( '', 'text_domain' );
          }
          
          ?>
          <p>
          <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
          </p>
          <p>
          <label for="<?php echo $this->get_field_id( 'textarea' ); ?>"><?php _e( 'Description:' ); ?></label> 
          <textarea class="widefat" id="<?php echo $this->get_field_id( 'textarea' ); ?>" name="<?php echo $this->get_field_name( 'textarea' ); ?>" type="text"><?php echo $textarea; ?></textarea>
          </p>
         
          <?php 
     }

     /**
      * Sanitize widget form values as they are saved.
      *
      * @see WP_Widget::update()
      *
      * @param array $new_instance Values just sent to be saved.
      * @param array $old_instance Previously saved values from database.
      *
      * @return array Updated safe values to be saved.
      */
     public function update( $new_instance, $old_instance ) {
          $instance = array();
          $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
          $instance['textarea'] = ( ! empty( $new_instance['textarea'] ) ) ? strip_tags( $new_instance['textarea'] ) : '';


          return $instance;
     }

} // class coenv_base_fac_cats

// register coenv_base_fac_cats widget
function register_coenv_base_blog_cats() {
    register_widget( 'coenv_base_blog_cats' );
}
add_action( 'widgets_init', 'register_coenv_base_blog_cats' );








$args = array(
  'type'                     => 'post',
  'child_of'                 => 0,
  'parent'                   => '',
  'orderby'                  => 'name',
  'order'                    => 'ASC',
  'hide_empty'               => 1,
  'hierarchical'             => 1,
  'exclude'                  => '',
  'include'                  => '',
  'number'                   => '',
  'taxonomy'                 => 'category',
  'pad_counts'               => false 

); 


