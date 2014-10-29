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
                                   
						<a href="<?php echo $events_url; ?>" class="button right" title="View All Events">More</a>
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

/**
 * RSS widget class - copied from wp-includes
 *
 * @since 2.8.0
 */
class WP_Widget_RSS_coenv extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => __('Entries from any RSS or Atom feed.') );
		$control_ops = array( 'width' => 400, 'height' => 200 );
		parent::__construct( 'rss_coenv', __('RSS'), $widget_ops, $control_ops );
	}

	public function widget($args, $instance) {

		if ( isset($instance['error']) && $instance['error'] )
			return;

		$url = ! empty( $instance['url'] ) ? $instance['url'] : '';
		while ( stristr($url, 'http') != $url )
			$url = substr($url, 1);

		if ( empty($url) )
			return;

		// self-url destruction sequence
		if ( in_array( untrailingslashit( $url ), array( site_url(), home_url() ) ) )
			return;

		$rss = fetch_feed($url);
		$title = $instance['title'];
		$desc = '';
		$link = '';

		if ( ! is_wp_error($rss) ) {
			$desc = esc_attr(strip_tags(@html_entity_decode($rss->get_description(), ENT_QUOTES, get_option('blog_charset'))));
			if ( empty($title) )
				$title = esc_html(strip_tags($rss->get_title()));
			$link = esc_url(strip_tags($rss->get_permalink()));
			while ( stristr($link, 'http') != $link )
				$link = substr($link, 1);
		}

		if ( empty($title) )
			$title = empty($desc) ? __('Unknown Feed') : $desc;

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$url = esc_url(strip_tags($url));
		if ( $title )
			$title = "<a class='rsswidget' href='$url'><img style='border:0' width='14' height='14' src='$icon' alt='RSS' /></a> <a class='rsswidget' href='$link'>$title</a><a class='button rss right' href='$url'>More</a>";

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		wp_widget_rss_output( $rss, $instance );
		echo $args['after_widget'];

		if ( ! is_wp_error($rss) )
			$rss->__destruct();
		unset($rss);
	}

	public function update($new_instance, $old_instance) {
		$testurl = ( isset( $new_instance['url'] ) && ( !isset( $old_instance['url'] ) || ( $new_instance['url'] != $old_instance['url'] ) ) );
		return wp_widget_rss_process( $new_instance, $testurl );
	}

	public function form($instance) {

		if ( empty($instance) )
			$instance = array( 'title' => '', 'url' => '', 'items' => 10, 'error' => false, 'show_summary' => 0, 'show_author' => 0, 'show_date' => 0 );
		$instance['number'] = $this->number;

		wp_widget_rss_form_coenv( $instance );
	}
}

/**
 * Display the RSS entries in a list.
 *
 * @since 2.5.0
 *
 * @param string|array|object $rss RSS url.
 * @param array $args Widget arguments.
 */
function wp_widget_rss_output_coenv( $rss, $args = array() ) {
	if ( is_string( $rss ) ) {
		$rss = fetch_feed($rss);
	} elseif ( is_array($rss) && isset($rss['url']) ) {
		$args = $rss;
		$rss = fetch_feed($rss['url']);
	} elseif ( !is_object($rss) ) {
		return;
	}

	if ( is_wp_error($rss) ) {
		if ( is_admin() || current_user_can('manage_options') )
			echo '<p>' . sprintf( __('<strong>RSS Error</strong>: %s'), $rss->get_error_message() ) . '</p>';
		return;
	}

	$default_args = array( 'show_author' => 0, 'show_date' => 0, 'show_summary' => 0, 'items' => 0 );
	$args = wp_parse_args( $args, $default_args );

	$items = (int) $args['items'];
	if ( $items < 1 || 20 < $items )
		$items = 10;
	$show_summary  = (int) $args['show_summary'];
	$show_author   = (int) $args['show_author'];
	$show_date     = (int) $args['show_date'];

	if ( !$rss->get_item_quantity() ) {
		echo '<ul><li>' . __( 'An error has occurred, which probably means the feed is down. Try again later.' ) . '</li></ul>';
		$rss->__destruct();
		unset($rss);
		return;
	}

	echo '<ul>';
	foreach ( $rss->get_items( 0, $items ) as $item ) {
		$link = $item->get_link();
		while ( stristr( $link, 'http' ) != $link ) {
			$link = substr( $link, 1 );
		}
		$link = esc_url( strip_tags( $link ) );

		$title = esc_html( trim( strip_tags( $item->get_title() ) ) );
		if ( empty( $title ) ) {
			$title = __( 'Untitled' );
		}

		$desc = @html_entity_decode( $item->get_description(), ENT_QUOTES, get_option( 'blog_charset' ) );
		$desc = esc_attr( wp_trim_words( $desc, 55, ' [&hellip;]' ) );

		$summary = '';
		if ( $show_summary ) {
			$summary = $desc;

			// Change existing [...] to [&hellip;].
			if ( '[...]' == substr( $summary, -5 ) ) {
				$summary = substr( $summary, 0, -5 ) . '[&hellip;]';
			}

			$summary = '<div class="rssSummary">' . esc_html( $summary ) . '</div>';
		}

		$date = '';
		if ( $show_date ) {
			$date = $item->get_date( 'U' );

			if ( $date ) {
				$date = ' <span class="rss-date">' . date_i18n( get_option( 'date_format' ), $date ) . '</span>';
			}
		}

		$author = '';
		if ( $show_author ) {
			$author = $item->get_author();
			if ( is_object($author) ) {
				$author = $author->get_name();
				$author = ' <cite>' . esc_html( strip_tags( $author ) ) . '</cite>';
			}
		}

		if ( $link == '' ) {
			echo "<li>$title{$date}{$summary}{$author}</li>";
		} elseif ( $show_summary ) {
			echo "<li><a class='rsswidget' href='$link'>$title</a>{$date}{$summary}{$author}</li>";
		} else {
			echo "<li><a class='rsswidget' href='$link'>$title</a>{$date}{$author}</li>";
		}
	}
	echo '</ul>';
	$rss->__destruct();
	unset($rss);
}

/**
 * Display RSS widget options form.
 *
 * The options for what fields are displayed for the RSS form are all booleans
 * and are as follows: 'url', 'title', 'items', 'show_summary', 'show_author',
 * 'show_date'.
 *
 * @since 2.5.0
 *
 * @param array|string $args Values for input fields.
 * @param array $inputs Override default display options.
 */
function wp_widget_rss_form_coenv( $args, $inputs = null ) {
	$default_inputs = array( 'url' => true, 'title' => true, 'items' => true, 'show_summary' => true, 'show_author' => true, 'show_date' => true );
	$inputs = wp_parse_args( $inputs, $default_inputs );

	$args['number'] = esc_attr( $args['number'] );
	$args['title'] = isset( $args['title'] ) ? esc_attr( $args['title'] ) : '';
	$args['url'] = isset( $args['url'] ) ? esc_url( $args['url'] ) : '';
	$args['items'] = isset( $args['items'] ) ? (int) $args['items'] : 0;

	if ( $args['items'] < 1 || 20 < $args['items'] ) {
		$args['items'] = 10;
	}

	$args['show_summary']   = isset( $args['show_summary'] ) ? (int) $args['show_summary'] : (int) $inputs['show_summary'];
	$args['show_author']    = isset( $args['show_author'] ) ? (int) $args['show_author'] : (int) $inputs['show_author'];
	$args['show_date']      = isset( $args['show_date'] ) ? (int) $args['show_date'] : (int) $inputs['show_date'];

	if ( ! empty( $args['error'] ) ) {
		echo '<p class="widget-error"><strong>' . sprintf( __( 'RSS Error: %s' ), $args['error'] ) . '</strong></p>';
	}

	if ( $inputs['url'] ) :
?>
	<p><label for="rss-url-<?php echo $args['number']; ?>"><?php _e( 'Enter the RSS feed URL here:' ); ?></label>
	<input class="widefat" id="rss-url-<?php echo $args['number']; ?>" name="widget-rss[<?php echo $args['number']; ?>][url]" type="text" value="<?php echo $args['url']; ?>" /></p>
<?php endif; if ( $inputs['title'] ) : ?>
	<p><label for="rss-title-<?php echo $args['number']; ?>"><?php _e( 'Give the feed a title (optional):' ); ?></label>
	<input class="widefat" id="rss-title-<?php echo $args['number']; ?>" name="widget-rss[<?php echo $args['number']; ?>][title]" type="text" value="<?php echo $args['title']; ?>" /></p>
<?php endif; if ( $inputs['items'] ) : ?>
	<p><label for="rss-items-<?php echo $args['number']; ?>"><?php _e( 'How many items would you like to display?' ); ?></label>
	<select id="rss-items-<?php echo $args['number']; ?>" name="widget-rss[<?php echo $args['number']; ?>][items]">
<?php
		for ( $i = 1; $i <= 20; ++$i ) {
			echo "<option value='$i' " . selected( $args['items'], $i, false ) . ">$i</option>";
		}
?>
	</select></p>
<?php endif; if ( $inputs['show_summary'] ) : ?>
	<p><input id="rss-show-summary-<?php echo $args['number']; ?>" name="widget-rss[<?php echo $args['number']; ?>][show_summary]" type="checkbox" value="1" <?php checked( $args['show_summary'] ); ?> />
	<label for="rss-show-summary-<?php echo $args['number']; ?>"><?php _e( 'Display item content?' ); ?></label></p>
<?php endif; if ( $inputs['show_author'] ) : ?>
	<p><input id="rss-show-author-<?php echo $args['number']; ?>" name="widget-rss[<?php echo $args['number']; ?>][show_author]" type="checkbox" value="1" <?php checked( $args['show_author'] ); ?> />
	<label for="rss-show-author-<?php echo $args['number']; ?>"><?php _e( 'Display item author if available?' ); ?></label></p>
<?php endif; if ( $inputs['show_date'] ) : ?>
	<p><input id="rss-show-date-<?php echo $args['number']; ?>" name="widget-rss[<?php echo $args['number']; ?>][show_date]" type="checkbox" value="1" <?php checked( $args['show_date'] ); ?>/>
	<label for="rss-show-date-<?php echo $args['number']; ?>"><?php _e( 'Display item date?' ); ?></label></p>
<?php
	endif;
	foreach ( array_keys($default_inputs) as $input ) :
		if ( 'hidden' === $inputs[$input] ) :
			$id = str_replace( '_', '-', $input );
?>
	<input type="hidden" id="rss-<?php echo $id; ?>-<?php echo $args['number']; ?>" name="widget-rss[<?php echo $args['number']; ?>][<?php echo $input; ?>]" value="<?php echo $args[ $input ]; ?>" />
<?php
		endif;
	endforeach;
}

/**
 * Process RSS feed widget data and optionally retrieve feed items.
 *
 * The feed widget can not have more than 20 items or it will reset back to the
 * default, which is 10.
 *
 * The resulting array has the feed title, feed url, feed link (from channel),
 * feed items, error (if any), and whether to show summary, author, and date.
 * All respectively in the order of the array elements.
 *
 * @since 2.5.0
 *
 * @param array $widget_rss RSS widget feed data. Expects unescaped data.
 * @param bool $check_feed Optional, default is true. Whether to check feed for errors.
 * @return array
 */
function wp_widget_rss_process_coenv( $widget_rss, $check_feed = true ) {
	$items = (int) $widget_rss['items'];
	if ( $items < 1 || 20 < $items )
		$items = 10;
	$url           = esc_url_raw( strip_tags( $widget_rss['url'] ) );
	$title         = isset( $widget_rss['title'] ) ? trim( strip_tags( $widget_rss['title'] ) ) : '';
	$show_summary  = isset( $widget_rss['show_summary'] ) ? (int) $widget_rss['show_summary'] : 0;
	$show_author   = isset( $widget_rss['show_author'] ) ? (int) $widget_rss['show_author'] :0;
	$show_date     = isset( $widget_rss['show_date'] ) ? (int) $widget_rss['show_date'] : 0;

	if ( $check_feed ) {
		$rss = fetch_feed($url);
		$error = false;
		$link = '';
		if ( is_wp_error($rss) ) {
			$error = $rss->get_error_message();
		} else {
			$link = esc_url(strip_tags($rss->get_permalink()));
			while ( stristr($link, 'http') != $link )
				$link = substr($link, 1);

			$rss->__destruct();
			unset($rss);
		}
	}

	return compact( 'title', 'url', 'link', 'items', 'error', 'show_summary', 'show_author', 'show_date' );
}