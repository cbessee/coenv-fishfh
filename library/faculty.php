<?php 

/* 
 * Return faculty taxonomy terms from research areas.
 */
function coenv_base_fac_terms($id) {
	$fac_terms = wp_get_post_terms( $id, 'research_areas' );
	if ($fac_terms) {
		echo '<ul class="fac-terms inline-list">';
		foreach ($fac_terms as $term) {

			echo '<li><a class="button" href="/faculty?fac-cat=' . $term->slug . '">' . $term->name . '</a></li>';
		}
		echo '</ul>';
	}
}
add_image_size( 'faculty_med', '240', '240' );
add_image_size( 'faculty_sm', '153', '153' );

/*
 * Return grammatically correct first names.
 */
function coenv_base_apostophe_fname($fname) {
	if (substr($fname,-1) == 's') {
		echo $fname . '\'';
	} else {
		echo $fname . '\'s';
	}
}