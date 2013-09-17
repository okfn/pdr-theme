<div class="row home-collection <?php printf('collection-%s', get_query_var('medium')); ?>">
	<div class="main <?php echo roots_main_class(); ?>" role="main">
	    <?php 
		get_template_part( 'templates/collection', 'header' );
		get_template_part( 'index' );
		?>
	</div><!-- /.main -->
            
    <aside class="sidebar left-sidebar" role="complementary">
        <?php dynamic_sidebar(sprintf('%s-left', get_query_var('medium'))); ?>
    </aside><!-- /.left-sidebar -->

    <aside class="sidebar right-sidebar" role="complementary">
        <?php dynamic_sidebar(sprintf('%s-right', get_query_var('medium'))); ?>
    </aside><!-- /.right-sidebar -->
            
</div>
