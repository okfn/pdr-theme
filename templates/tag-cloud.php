<?php 
global $wp_query;

if ( $wp_query->query['post_type'] == 'collections' ) {
	$collections = get_posts(array(
		'post_type' => 'collections',
		'posts_per_page' => -1
	));

	if ( $collections ) {
		foreach ($collections as $collection) {
			if ( $item_tags = wp_get_post_terms($collection->ID, 'post_tag') ) {
				foreach ($item_tags as $tag) {
					$tags_arr[] = $tag->term_id;
				}
			}
		}
	}

	if ( $tags_arr )
		$tags_arr = array_unique( $tags_arr );
}

?>
<div class="collections-landing posts-tag-cloud">
	<h3><?php _e('Browse by Tag', 'roots'); ?></h3>
	<?php wp_tag_cloud( array('number' => 250, 'include' => $tags_arr) ); ?>
</div>