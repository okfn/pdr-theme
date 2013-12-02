<?php if ( $content = apply_filters('the_content', term_description( get_queried_object()->term_id, get_queried_object()->taxonomy ) ) ): ?>
<div class="row">
	<div class="tax-description">
		<?php  echo $content; ?>
	</div>
</div>
<?php endif; ?>