<?php get_template_part('templates/page', 'header'); ?>
<?php do_action('before_achive'); ?>
<div class="row">
    <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates/content', get_post_format()); ?>
    <?php endwhile; ?>
</div>
<?php do_action('after_achive'); ?>