<div class="row taxonomy-nav">
	<ul class="taxonomies">
	<?php foreach ($taxonomies as $tax): ?>
		<li><a href="<?php echo add_query_arg( 'hello', 'world'); ?>"><?php echo $tax->labels->name; ?></a></li>

	<?php endforeach; ?>
</div>
