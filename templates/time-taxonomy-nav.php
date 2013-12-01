<div class="row taxonomy-nav nav-collapse">
	<ul class="taxonomies nav navbar-nav">
	<?php foreach ( get_terms( 'time', array( 'parent' => $term->term_id, 'hide_empty' => false ) ) as $term): ?>
		<li class="term-<?php echo $term->slug ?>"><a href="<?php echo apply_filters('taxonomy_nav_url', $url, $tax, $term); ?>"><?php echo $term->name ?></a></li>
	<?php endforeach; ?>
</div>
