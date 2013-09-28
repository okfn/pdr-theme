<div class="collections-landing-sources collections-landing">
	<?php foreach ( array('source') as $tax ): $tax = get_taxonomy($tax); ?>
	<h3><?php _e(sprintf('Browse by %s', $tax->label), 'roots'); ?></h3>
		<div class="<?php printf('%ss', $tax->name) ?>">
			<?php foreach ( get_terms( $tax->name ) as $term): ?>
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
	<?php endforeach; ?>
</div>