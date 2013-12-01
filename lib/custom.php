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
    	add_image_size( 'pdr_large', 750, 420, true );
    	add_image_size( 'pdr_collection_large', 750, 297, true );
    }


/*  ==========================================================================
    Homepage Lists
    ========================================================================== */

	add_action('after_content', 'homepage_lists', 10);
    function homepage_lists() {
    	if ( is_front_page() ) {
	    	global $wp_query;
	    	$query_holder = $wp_query;
	    	$mediums = get_terms( 'medium' );

	    	foreach ( $mediums as $medium ) {
		    	$wp_query = new WP_Query(array(
		    		'post_type' => 'collections',
		    		'posts_per_page' => 5,
		    		'medium' => $medium->slug
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
    	global $post;
    	$length = 14 - str_word_count($post->post_title, 0);
    	if ( $length < 0 ) $length = 0;
		return $length;
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
    	$mediums = get_terms( 'medium' );

    	foreach ($mediums as $medium) {
    		register_sidebar(array(
		        'name'          => __(sprintf('%s Left Sidebar', ucfirst($medium->slug) ), 'roots'),
		        'id'            => sprintf('%s-left', $medium->slug),
		        'before_widget' => '<section class="widget %1$s %2$s"><div class="widget-inner">',
		        'after_widget'  => '</div></section>',
		        'before_title'  => '<h3>',
		        'after_title'   => '</h3>',
		    ));

		    register_sidebar(array(
		        'name'          => __(sprintf('%s Right Sidebar', ucfirst($medium->slug) ), 'roots'),
		        'id'            => sprintf('%s-right', $medium->slug),
		        'before_widget' => '<section class="widget %1$s %2$s"><div class="widget-inner">',
		        'after_widget'  => '</div></section>',
		        'before_title'  => '<h3>',
		        'after_title'   => '</h3>',
		    ));
    	}

    	register_sidebar(array(
	        'name'          => __( 'Collections Landing', 'roots'),
	        'id'            => 'collections-landing',
	        'before_widget' => '<section class="widget %1$s %2$s"><div class="widget-inner">',
	        'after_widget'  => '</div></section>',
	        'before_title'  => '<h3>',
	        'after_title'   => '</h3>',
	    ));
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
		if (!is_post_type_archive('collections'))
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
		if ( !is_post_type_archive('collections') ) {
			$taxonomies = get_object_taxonomies( get_query_var('post_type'), 'objects');
			include(locate_template('templates/taxonomy-nav.php'));
		}
	}

	function show_collection_sidebars() {
		if ( is_front_page() || !is_main_query() ) 
			return false;
		else 
			return true;
	}

	add_action('collections_archive_content', 'no_collections');
	function no_collections() {		
		if ( !is_post_type_archive('collections') ) {
        	get_template_part('templates/no', 'content');
		}
	}

	add_action('collections_archive_content', 'collections_entries');
	function collections_entries() {
		if ( !is_post_type_archive('collections') ) {
			while (have_posts()) : the_post();
	        	get_template_part('templates/content', get_post_format());
			endwhile;
		}
	}

	add_action('collections_archive_content', 'collections_landing');
	function collections_landing() {
		if ( is_post_type_archive('collections') ) {
			foreach ( array('medium', 'time') as $tax ) {
				$tax = get_taxonomy($tax);
				include(locate_template('templates/collection-landing.php'));
			} 
		}
	}

	add_action('collections_archive_content', 'collections_tag_cloud');
	function collections_tag_cloud() {
		if ( is_post_type_archive('collections') ) {
			echo '<div class="collections-landing collections-tag-cloud">';
			_e('<h3>Browse by Tag</h3>', 'roots');
			wp_tag_cloud( );
			echo '</div>';
		}
	}

	add_action('collections_archive_content', 'collections_sources');
	function collections_sources() {
		if ( is_post_type_archive('collections') ) {
			$tax = get_taxonomy('source');
			include(locate_template('templates/collection-landing.php'));
		}
	}

	add_action('before_achive', 'collections_landing_sidebar');
	function collections_landing_sidebar() {
		if ( is_post_type_archive('collections') ) {
			dynamic_sidebar('collections-landing');
		}
	}


/*  ==========================================================================
    The taxonomy nav urls
    ========================================================================== */

    add_filter('taxonomy_nav_url', 'taxonomy_nav_url', 10, 3);
    function taxonomy_nav_url($url, $tax, $term) {

    	// The "time" or "medium" tax should always persist if we're in that section, while the other options do not persist.
    	if ( $section_term = get_query_var('medium') ) {
    		$section = 'medium';
    	}
    	else if ( $section_term = get_query_var('time') ) {
    		$section = 'time';
    	}

    	if ( $term && $section ) {
    		$url = add_query_arg( array( $section => $section_term, $tax->query_var => $term->slug ), strtok( $_SERVER["REQUEST_URI"], '?' ) );
    	}
    	else {
    		$url = add_query_arg( $tax->query_var, $term->slug );
    	}

    	return $url;
    }

	