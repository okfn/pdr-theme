<?php 

if ( in_array( $post_type = get_query_var('post_type'), get_post_types( array('_builtin' => false) ) ) ) :
	$post_type = get_post_type_object($post_type);
	?>
	<div class="collection-header">
		<h3><?php _e( sprintf("from the %s collection", $post_type->label) ); ?></h3>
	</div>
	<?php
endif;