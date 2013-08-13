<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

  <!--[if lt IE 7]><div class="alert"><?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?></div><![endif]-->

    <?php
        do_action('get_header');
        get_template_part('templates/header');
    ?>

    <div class="wrap container" role="document">

        <?php for ($i = 0; $i < 3; $i++): ?>
        <div class="content row">
            <div class="main <?php echo roots_main_class(); ?>" role="main">
                <?php //include roots_template_path(); ?>

                <div class="row">

                    <div class="col-lg-12">
                        <p>Feature Image</p>
                    </div>

                    <div class="col-lg-12">
                        <p>Feature Text</p>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <p>Inside Left Column</p>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <p>Inside Right Column</p>
                    </div>

                </div>
            </div><!-- /.main -->
            
            <?php //if (roots_display_sidebar()) : ?>
                <aside class="sidebar left-sidebar col-xs-6 col-sm-6 col-lg-2 col-lg-pull-8" role="complementary">
                    <p>Left Sidebar</p>
                    <?php include roots_sidebar_path(); ?>
                </aside><!-- /.left-sidebar -->

                <aside class="sidebar right-sidebar col-xs-6 col-sm-6 col-lg-2" role="complementary">
                    <p>Right Sidebar</p>
                    <?php include roots_sidebar_path(); ?>
                </aside><!-- /.right-sidebar -->
            <?php// endif; ?>
        </div><!-- /.content -->
        <?php endfor; ?>
    </div><!-- /.wrap -->

    <?php get_template_part('templates/footer'); ?>


</body>
</html>
