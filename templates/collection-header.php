<?php 
if ( $medium = get_term_by( 'slug', get_query_var('medium'), 'medium') ) :
	?>
	<div class="collection-header">
		<h3><?php _e( sprintf("<span>%s</span>", $medium->name) ); ?></h3>
	</div>
	<?php
endif;