<?php
/**
 * Custom functions
 */



/*  ==========================================================================
    Post Classes
    ========================================================================== */

	add_filter('post_class', 'pdr_list_item_number_post_class');
	function pdr_list_item_number_post_class($classes) {
		global $post, $wp_query;
		$key = get_article_list_item_number($post, $wp_query->posts);
		if ( isset( $key ) ) 
			$classes[] = 'list-item-'.$key;
		return $classes;
	}

	add_filter('post_class', 'pdr_list_item_feature_post_class');
	function pdr_list_item_feature_post_class($classes) {
		if ( is_feature_item() )
			$classes[] = 'feature-list-item';
		else 
			$classes[] = 'regular-list-item';
		return $classes;
	}

	add_filter('post_class', 'pdr_media_post_class');
	function pdr_media_post_class($classes) {
		$classes[] = 'media';
		return $classes;
	}

/*  ==========================================================================
    Post List Functions
    ========================================================================== */

	function get_article_list_item_number($post, $posts) {
		return array_search($post, $posts);
	}

	function is_feature_item() {
		global $post, $wp_query;
		$key = get_article_list_item_number($post, $wp_query->posts);
		$in_a_set = 5;
		
		if ( !show_collection_sidebars() && ( ( ( $key >= $in_a_set ) && ( $key % 5 ) === 0 ) || $key == 0 ) )
			return true;
		else return false;
	}


/*  ==========================================================================
    Image sizes
    ========================================================================== */

    add_action('init', 'pdr_image_sizes');
    function pdr_image_sizes() {
    	add_image_size( 'pdr_main', 540, 280, true );
    	add_image_size( 'pdr_large', 750, 389, true );
    }


/*  ==========================================================================
    Homepage Lists
    ========================================================================== */

	add_action('after_content', 'homepage_lists', 10);
    function homepage_lists() {
    	if ( is_front_page() ) {
	    	global $wp_query, $collections;
	    	$query_holder = $wp_query;

	    	foreach ( $collections as $post_type ) {
		    	$wp_query = new WP_Query(array(
		    		'post_type' => $post_type,
		    		'posts_per_page' => 5
				));
				get_template_part( 'templates/homepage', 'collection' );
			}

			$wp_query = $query_holder;
			wp_reset_postdata();
		}
    }

    function feature_excerpt_length() {
    	return 45;
    }
    function standard_exerpt_length( $length ) {
		return 15;
	}

	add_filter( 'excerpt_length', 'standard_exerpt_length', 999 );
    add_action('before_post', 'set_feature_excerpt_length');
    function set_feature_excerpt_length() {
    	if ( is_feature_item() )
	    	add_filter( 'excerpt_length', 'feature_excerpt_length', 999 );
    }
    add_action('after_post', 'unset_feature_excerpt_length');
    function unset_feature_excerpt_length() {
    	remove_filter( 'excerpt_length', 'feature_excerpt_length', 999 );
    }

    // Collections Sidebars
    add_action('init', 'collections_sidebars_init');
    function collections_sidebars_init() {
    	global $collections;

    	foreach ($collections as $collection) {
    		register_sidebar(array(
		        'name'          => __(sprintf('%s Left Sidebar', ucfirst($collection) ), 'roots'),
		        'id'            => sprintf('%s-left', $collection),
		        'before_widget' => '<section class="widget %1$s %2$s"><div class="widget-inner">',
		        'after_widget'  => '</div></section>',
		        'before_title'  => '<h3>',
		        'after_title'   => '</h3>',
		    ));

		    register_sidebar(array(
		        'name'          => __(sprintf('%s Right Sidebar', ucfirst($collection) ), 'roots'),
		        'id'            => sprintf('%s-right', $collection),
		        'before_widget' => '<section class="widget %1$s %2$s"><div class="widget-inner">',
		        'after_widget'  => '</div></section>',
		        'before_title'  => '<h3>',
		        'after_title'   => '</h3>',
		    ));
    	}
	}


	// Change output of WP-PageNavi to work with Bootstrap pagination styles
	// http://calebserna.com/bootstrap-wordpress-pagination-wp-pagenavi/
	add_filter( 'wp_pagenavi', 'bootstrap_pagination', 10, 2 );
	function bootstrap_pagination($html) {
		$out = '';
		$out = str_replace("<div","",$html);
		$out = str_replace("class='wp-pagenavi'>","",$out);
		$out = str_replace("<a","<li><a",$out);
		$out = str_replace("</a>","</a></li>",$out);
		$out = str_replace("<span","<li><span",$out);  
		$out = str_replace("</span>","</span></li>",$out);
		$out = str_replace("</div>","",$out);
		return '<ul class="pagination">'.$out.'</ul>';
	}

	add_action('after_achive', 'show_pagination');
	function show_pagination() {
		get_template_part('templates/pagination');
	}


	add_action( 'pre_get_posts', 'archive_posts_per_page', 1 );
	function archive_posts_per_page( $query ) {
	    if ( is_admin() || ! $query->is_main_query() )
	        return;

	    if ( is_archive( ) ) {
	        $query->set( 'posts_per_page', 8 );
	        return;
	    }
	}


	add_action('before_achive', 'taxonomy_nav');
	function taxonomy_nav() {
		$taxonomies = get_object_taxonomies( get_query_var('post_type'), 'objects');
		include(locate_template('templates/taxonomy-nav.php'));
	}

	function show_collection_sidebars() {
		if ( is_front_page() || !is_main_query() ) 
			return false;
		else 
			return true;
	}