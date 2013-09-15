<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

  <!--[if lt IE 7]><div class="alert"><?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?></div><![endif]-->

    <?php
        do_action('get_header');
        get_template_part('templates/header');
    ?>

    <div class="wrap container" role="document">

        <?php do_action('before_content') ?>
        <div class="content row">
            <?php do_action('inside_before_content') ?>
            <div class="main <?php echo roots_main_class(); ?>" role="main">
                <?php include roots_template_path(); ?>
            </div><!-- /.main -->
            
            <?php if (roots_display_sidebar()) : ?>
                <aside class="sidebar left-sidebar" role="complementary">
                    <?php include roots_right_sidebar_path(); ?>
                </aside><!-- /.left-sidebar -->

                <aside class="sidebar right-sidebar" role="complementary">
                    <?php include roots_left_sidebar_path(); ?>
                </aside><!-- /.right-sidebar -->
            <?php endif; ?>

            <?php do_action('inside_after_content') ?>
        </div><!-- /.content -->
        <?php do_action('after_content') ?>
        
    </div><!-- /.wrap -->

    <?php get_template_part('templates/footer'); ?>


</body>
</html>
