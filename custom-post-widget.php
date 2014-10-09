<?php
if ( !$apply_content_filters ) { // Don't apply the content filter if checkbox selected
	$content = apply_filters( 'the_content', $content);
}
$link_type = get_field( "link_type", $content_post -> ID );
$link_type_internal = get_field( "link_page", $content_post -> ID );
echo $before_widget;
echo do_shortcode( $content ); // This is where the actual content of the custom post is being displayed
if ( $show_custom_post_title ) {
	echo $before_title;
	echo apply_filters( 'widget_title',$content_post->post_title);
	if ( $show_featured_image ) {
		echo get_the_post_thumbnail( $content_post -> ID );
	}
	echo $after_title; // This is the line that displays the title (only if show title is set)
}
echo get_field('block_text', $content_post -> ID);
$rows = get_field('add_links', $content_post -> ID);
if($rows)
{
	echo '<ul class="links">';
	foreach($rows as $row)
	{
		if($row['link_type'] == 'internal') {
			$link_title =  $row['link_to_a_page_on_this_site'][0]['link_title_internal'];
			$link_url = get_permalink($row['link_to_a_page_on_this_site'][0]['select_page'][0]);
			$link_target = 'self';
			echo '<li><a  class="button" href="' . $link_url . '" target="_' . $link_target . '">' . $link_title . '</a></li>';
		} elseif ($row['link_type'] == 'external') {
			$link_title = $row['link_to_an_external_site'][0]['link_title'];
			$link_url = $row['link_to_an_external_site'][0]['link_url'];
			$link_target ='blank';
			echo '<li><a class="button" href="' . $link_url . '" target="_' . $link_target . '">' . $link_title . '</a></li>';
		} 
	}
	echo '</ul>';
}

echo $after_widget;