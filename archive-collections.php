<?php get_template_part('templates/page', 'header'); global $wp_query; fb($wp_query); ?>
<?php do_action('before_achive'); ?>
<div class="row">
	<?php do_action('collections_archive_content'); ?>
</div>
<?php do_action('after_achive'); ?>