<?php if (!have_posts()) : ?>
    <div class="alert">
        <?php _e('Sorry, no results were found.', 'roots'); ?>
    </div>
    <?php get_search_form(); ?>
<?php endif; ?>