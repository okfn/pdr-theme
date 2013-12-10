<div class="row taxonomy-nav nav-collapse">
	<ul class="taxonomies nav navbar-nav">
	<?php foreach ( (array) $taxonomies as $tax): ?>
		<?php if ( !in_array( $tax->name, array('medium', 'post_tag', 'source', 'collections_tag') ) ): ?>
			<li class="dropdown tax-<?php echo $tax->name; ?>">
				<a href="#<?php echo $tax->name; ?>" data-target="#" data-toggle="dropdown" class="dropdown-toggle"><?php echo $tax->labels->name; ?></a>
				<ul class="dropdown-menu">
					<?php foreach ( get_terms( $tax->name ) as $term ): ?>
						<li class="term-<?php echo $term->slug ?>"><a href="<?php echo apply_filters('taxonomy_nav_url', $url, $tax, $term); ?>"><?php echo $term->name ?></a></li>
					<?php endforeach; ?>
				</ul>
			</li>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
