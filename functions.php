<?php
// Various clean up functions
//require_once('library/cleanup.php');

// Required for Foundation to work properly
require_once('library/breadcrumbs.php');

// Required for Foundation to work properly
require_once('library/foundation.php');

// Register all navigation menus
require_once('library/navigation.php');

// Add menu walker
require_once('library/menu-walker.php');
require_once('library/walker-top-menu.php');

// Second-level menus
require_once('library/navigation-lvl2.php');

// Add standard widgets
require_once('library/widgets.php');

// Return entry meta information for posts
require_once('library/entry-meta.php');

// Enqueue scripts
require_once('library/enqueue-scripts.php');

// Add theme support
require_once('library/theme-support.php');

// Photo functions
require_once('library/photos.php');

// Setting fields for address, phone, social media
require_once('library/admin-setting-fields.php');

// Custom content types
require_once('library/content-types.php');

// Faculty functions
require_once('library/faculty.php');

// Custom taxonomies functions
require_once('library/taxonomies.php');

// Publications functions
require_once('library/publications.php');

// Need to be sorted into includes




/**
 * Image sizes
 */

add_image_size( 'med_sq', '240', '240', true );
add_image_size( 'sm_sq', '120', '120', true );


/**
 * Gets the top-level ancestor for pages, posts and custom post types
 * Credit: https://github.com/elcontraption/wp-tools 
 * @param
 * - string
 * @return 
 * - array
 */
function coenv_base_get_ancestor($attr = 'ID') {
	
	$post = get_queried_object();

	// test for search
	if ( is_search() ) {
		return false;
	}

	if ( ($post->post_type == 'post' || is_archive() || is_search())) {

		$page_for_posts = get_option( 'page_for_posts' );

		if ( $page_for_posts == 0 ) {
			return false;
		}

		$ancestor = get_post( $page_for_posts );
		return $ancestor->$attr;
	}

	// test for pages
	if ( $post->post_type == 'page' ) {

		// test for top-level pages
		if ( $post->post_parent == 0 ) {
			return $post->$attr;
		}

		// must be a child page
		$ancestors = get_post_ancestors( $post->ID );
		$ancestor = get_post( array_pop( $ancestors ) );
		return $ancestor->$attr;
	}

	// test for custom post types
	$custom_post_types = get_post_types( array( '_builtin' => false ), 'object' );
	if ( !empty( $custom_post_types ) && array_key_exists( $post->post_type, $custom_post_types ) ) {

		// is parent_page slug defined?
		if ( isset( $custom_post_types[ $post->post_type ]->parent_page ) ) {

			// parent_page slug is defined.
			$parent = get_page_by_path( $custom_post_types[ $post->post_type ]->parent_page );

		} else {

			// parent_page slug is not defined
			// find custom slug
			$slug = $custom_post_types[ $post->post_type ]->rewrite[ 'slug' ];

			// if a page exists with the same slug, assume that's the parent page
			$parent = get_page_by_path( $slug );
		}

		// get ancestors of $parent
		$ancestors = get_post_ancestors( $parent->ID );

		// if ancestors is empty, just return $parent;
		if ( empty( $ancestors ) ) {
			return $parent->$attr;
		}

		$ancestor = get_post( array_pop( $ancestors ) );
		return $ancestor->$attr;
	}
}

// page/post ids to exclude from the main menu
function coenv_base_menu_exclude() {
	return array('20','44','14','27');
}

define( 'FACULTY_PAGE_PARENT_ID', '31' );
 
add_action( 'wp_insert_post_data', 'coenv_base_fac_parent', '99', 2  ); 
 
/**
 * saveStaffParent
 *
 * @author  Joe Sexton <joe@webtipblog.com>
 * @param   array $data
 * @param   array $postarr
 * @return  array
 */
function coenv_base_fac_parent( $data, $postarr ) {
    global $post;
 
 
    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $data;
 
    if ( $post->post_type == "faculty" ){
        $data['post_parent'] = FACULTY_PAGE_PARENT_ID;
    }
 
    return $data;
}
function coenv_base_num_pagination() {
         $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }

}