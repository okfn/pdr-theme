<div class="row taxonomy-nav nav-collapse">
	<ul class="taxonomies nav navbar-nav">
	<?php foreach ($taxonomies as $tax): ?>
		<?php if ('medium' != $tax->name): ?>
			<li class="dropdown tax-<?php echo $tax->name; ?>">
				<a href="#<?php echo $tax->name; ?>" data-target="#" data-toggle="dropdown" class="dropdown-toggle"><?php echo $tax->labels->name; ?></a>
				<ul class="dropdown-menu">
					<?php foreach ( get_terms( $tax->name ) as $term ): ?>
						<li class="term-<?php echo $term->slug ?>"><a href="<?php echo add_query_arg( $tax->query_var, $term->slug ) ?>"><?php echo $term->name ?></a></li>
					<?php endforeach; ?>
				</ul>
			</li>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
