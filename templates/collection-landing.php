<div class="collections-landing <?php printf('collections-landing-%s', $tax->name) ?>">
	<div class="inner">
		<h3><?php _e(sprintf('Browse by %s', $tax->label), 'roots'); ?></h3>
		<div class="<?php printf('%ss', $tax->name) ?>">
			<?php foreach ( get_terms( $tax->name, array('parent' => 0) ) as $term): ?>
				<div class="<?php echo $tax->name ?>">
					<a href="<?php echo add_query_arg( $tax->query_var, $term->slug, get_post_type_archive_link( get_post_type() ) ) ?>">
						<?php if (function_exists('z_taxonomy_image_url')): ?>
							<img src="<?php echo z_taxonomy_image_url($term->term_id); ?>" />
						<?php endif; ?>
						<span><?php echo $term->name; ?></span>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>