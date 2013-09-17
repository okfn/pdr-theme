<header class="banner navbar navbar-static-top" role="banner">
    <div class="container">
        <div class="row">
            <a class="brand" href="<?php echo home_url(); ?>/">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/pdr-logo.gif" />
            </a>
            
        </div>

        <div class="row">
            <nav class="nav-main nav-collapse" role="navigation">
            <?php
                if (has_nav_menu('primary_navigation')) :
                    wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
                endif;
            ?>
            </nav>
        </div>
    </div>
</header>
