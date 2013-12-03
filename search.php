<?php get_template_part('templates/page', 'header'); ?>

<?php get_search_form(); ?>

<?php do_action('before_achive'); ?>
<div class="row">
	<?php if (!have_posts()) : ?>
        <div class="alert">
            <?php _e('Sorry, no results were found.', 'roots'); ?>
        </div>
    <?php endif; ?>

    <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates/content', get_post_format()); ?>
    <?php endwhile; ?>
</div>
<?php do_action('after_achive'); ?>