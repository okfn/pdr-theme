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
		
		if ( ( ( $key >= $in_a_set ) && ( $key % 5 ) === 0 ) || $key == 0 ) 
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

	add_action('homepage_lists', 'homepage_lists', 10);
    function homepage_lists() {
    	global $wp_query;
    	$query_holder = $wp_query;

    	foreach ( array('post', 'image', 'text') as $post_type ) {
	    	$wp_query = new WP_Query(array(
	    		'post_type' => $post_type,
	    		'posts_per_page' => 5
			));
			get_template_part( 'templates/collection', 'header' );
			get_template_part( 'index' );
		}

		$wp_query = $query_holder;
		wp_reset_postdata();
    }

    function feature_excerpt_length() {
    	return 45;
    }
    function standard_exerpt_length( $length ) {
		return 20;
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