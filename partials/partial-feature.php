<?php
$feature_link_type = get_field( "feature_link_type", $content_post -> ID );
$feature_link_type_internal = get_field( "feature_link_page", $content_post -> ID );
if ( get_the_post_thumbnail() ) {
		$feature_image = get_the_post_thumbnail( $content_post -> ID );
		$feature_caption = get_post(get_post_thumbnail_id())->post_content;
	}
if (get_field('feature_color', $content_post -> ID)) {
	$feature_color = get_field('feature_color', $content_post -> ID);
}
echo get_field('block_text', $content_post -> ID);
$rows = get_field('feature_add_links', $content_post -> ID);
?>
<article class="feature loading">

	<div class="feature-image">
		<?php echo $feature_image ?>
		<p class="feature-image-caption"><?php echo $feature_caption ?></p>
	</div>

	<div class="feature-info-container">

		<div class="feature-info" style="background-color: <?php echo $feature_color ?>">

			<div class="feature-content">
				
				<h2><?php echo get_the_title( $content_post -> ID ); ?> </h2>
				
				<p><?php echo get_field('feature_excerpt'); ?> </p>
				
				<?php
					if($rows)
					{
						echo '<ul class="links">';
						foreach($rows as $row)
						{
							if($row['feature_link_type'] == 'internal') {
								$link_title =  $row['feature_link_to_a_page_on_this_site'][0]['feature_link_title_internal'];
								$link_url = get_permalink($row['feature_link_to_a_page_on_this_site'][0]['feature_select_page'][0]);
								$link_target = 'self';
								echo '<li><a  class="button" href="' . $link_url . '" target="_' . $link_target . '">' . $link_title . '</a></li>';
							} elseif ($row['feature_link_type'] == 'external') {
								$link_title = $row['feature_link_to_an_external_site'][0]['feature_link_title'];
								$link_url = $row['feature_link_to_an_external_site'][0]['feature_link_url'];
								$link_target ='blank';
								echo '<li><a class="button" href="' . $link_url . '" target="_' . $link_target . '">' . $link_title . '</a></li>';
							} 
						}
						echo '</ul>';
					}
				?>

			</div><!-- .feature-content -->

		</div><!-- .feature-info -->

	</div><!-- .feature-info-container -->

</article><!-- .feature -->
