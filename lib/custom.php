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
    	add_image_size( 'pdr_large', 540, 362, true );
    	add_image_size( 'pdr_home_article', 540, 302, true );
    	add_image_size( 'pdr_collection_large', 540, 214, true );
    }


/*  ==========================================================================
    Template Override
    ========================================================================== */
    add_filter('template_include', 'pdr_index_template', 100);
	function pdr_index_template($template) {
		if ( is_front_page() ) // Use the index on our front page
			return Roots_Wrapping::wrap(locate_template('index.php'));
		elseif ( is_home() ) // Use the archive page for our blog page
			return Roots_Wrapping::wrap(locate_template('archive.php'));
		else
			return $template;
	}


/*  ==========================================================================
    Homepage Lists
    ========================================================================== */
	add_action('inside_before_content', 'homepage_articles', 10);
	function homepage_articles() {
		if ( is_front_page() ) {
			global $wp_query, $query_holder;
	    	$query_holder = $wp_query;

	    	$wp_query = new WP_Query(array(
	    		'post_type' => 'post',
	    		'posts_per_page' => 5,
			));
		}
	}

	add_action('inside_after_content', 'homepage_articles_end', 10);
	function homepage_articles_end() {
		if ( is_front_page() ) {
			global $wp_query, $query_holder;
	    	$wp_query = $query_holder;
	    	wp_reset_query();
	    }
	}

	add_action('wp', 'init_homepage_lists');
	function init_homepage_lists() {
		if ( is_front_page() ) {
			add_action('after_content', 'homepage_lists', 10);
		}
	}

    function homepage_lists() {
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
		wp_reset_query();
	}

 //    function feature_excerpt_length() {
 //    	return 45;
 //    }
 //    function standard_exerpt_length( $length ) {
 //    	global $post;
 //    	$length = 14 - str_word_count($post->post_title, 0);
 //    	if ( $length < 0 ) $length = 0;
	// 	return $length;
	// }

	// add_filter( 'excerpt_length', 'standard_exerpt_length', 999 );
 //    add_action('before_post', 'set_feature_excerpt_length');
 //    function set_feature_excerpt_length() {
 //    	if ( is_feature_item() )
	//     	add_filter( 'excerpt_length', 'feature_excerpt_length', 999 );
 //    }
 //    add_action('after_post', 'unset_feature_excerpt_length');
 //    function unset_feature_excerpt_length() {
 //    	remove_filter( 'excerpt_length', 'feature_excerpt_length', 999 );
 //    }

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
		if (!check_collection_landing() or !is_post_type_archive('collections'))
			get_template_part('templates/pagination');
	}


	add_action( 'pre_get_posts', 'archive_posts_per_page', 1 );
	function archive_posts_per_page( $query ) {
	    if ( is_admin() || ! $query->is_main_query() )
	        return;

	    // if ( is_archive() || is_search() || is_home() ) {
	    //     $query->set( 'posts_per_page', 8 );
	    //     return;
	    // }
	}


	add_action('before_achive', 'collections_taxonomy_nav', 11);
	function collections_taxonomy_nav() {
		if ( !check_collection_landing() ) {
			if ( get_query_var('medium') ) {
				$taxonomies = get_object_taxonomies( get_query_var('post_type'), 'objects');
				include(locate_template('templates/medium-taxonomy-nav.php'));
			}
			else if ( $time = get_query_var('time') ) {
				$tax = get_taxonomy( 'time' );
				$term = get_term_by( 'slug', $time, 'time');

				include(locate_template('templates/time-taxonomy-nav.php'));
			}
		}
	}

	add_action('before_achive', 'articles_taxonomy_nav', 11);
	function articles_taxonomy_nav() {
		if ( !is_post_type_archive('post')
			&& 'post' == get_post_type()
			) {
				$tax = get_taxonomy( 'category' );
				$term = get_term_by( 'slug', $time, 'category');

				include(locate_template('templates/taxonomy-nav.php'));
		}
	}

	function show_collection_sidebars() {
		if ( is_front_page() || !is_main_query() || is_singular('post') || is_page_template('page-sidebars.php') )
			return false;
		else
			return true;
	}

	add_action('collections_archive_content', 'no_collections');
	function no_collections() {
		if ( !check_collection_landing('collections') ) {
        	get_template_part('templates/no', 'content');
		}
	}

	add_action('collections_archive_content', 'collections_entries');
	function collections_entries() {
		if ( ! check_collection_landing() ) {
			while (have_posts()) : the_post();
	        	get_template_part('templates/content', get_post_format());
			endwhile;
		}
	}

	add_action('collections_archive_content', 'collections_landing');
	function collections_landing() {
		if ( check_collection_landing() ) {
			foreach ( array('medium', 'time') as $tax ) {
				$tax = get_taxonomy($tax);
				include(locate_template('templates/collection-landing.php'));
			}
		}
	}

	add_action('collections_archive_content', 'collections_tag_cloud');
	function collections_tag_cloud() {
		if ( check_collection_landing() )
			include(locate_template('templates/tag-cloud.php'));
	}

	add_action('after_achive', 'tag_landing_tag_cloud');
	function tag_landing_tag_cloud() {
		if ( is_tag() )
			include(locate_template('templates/tag-cloud.php'));
	}

	add_action('after_single_content', 'collections_single_tags');
	function collections_single_tags() {
		if ( 'collections' == get_post_type() ) {
			echo '<div class="collection-tags">';
			the_tags();
			echo '</div>';
		}
	}

	add_action('pre_get_posts', 'tags_post_types');
	function tags_post_types($query) {
		if ( !is_admin() && $query->is_main_query() ) {
			if ( is_tag() && ( $query->query['post_type'] != 'collections' ) ) {
				$query->set('post_type', array('post', 'collections' ) );
			}
		}
	}




	add_action('collections_archive_content', 'collections_sources');
	function collections_sources() {
		if ( check_collection_landing() ) {
			$tax = get_taxonomy('source');
			include(locate_template('templates/collection-landing.php'));
		}
	}

	add_action('before_achive', 'collections_landing_sidebar');
	function collections_landing_sidebar() {
		if ( check_collection_landing() ) {
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

    	if ($section ) {
    		$url = add_query_arg( array( $section => $section_term, $tax->query_var => $term->slug ), get_post_type_archive_link( 'collections' ) );
    	}
    	// else if ( !$term && $section ) {

    	// }
    	else {
    		$url = add_query_arg( array($tax->query_var => $term->slug), get_permalink( get_option('page_for_posts' ) ) );
    	}

    	return $url;
    }


/*  ==========================================================================
    PDR Thumbnail size
    ========================================================================== */

    add_filter('pdr_thumbnail_size', 'pdr_theme_thumbnail_size');
    function pdr_theme_thumbnail_size($size) {
    	// fb(is_home(), 'is_home');
    	if ( is_feature_item() && !is_singular('post') ) {
    		$size = 'pdr_home_article';
    	}
    	else if ( is_home_page() ) {
    		$size = 'thumbnail';
    	}
    	else if ( is_grid() || is_singular('post') ) {
    		$size = 'pdr_large';
    	}
    	else  {
    		$size = 'thumbnail';
    	}

    	return $size;
    }

/*  ==========================================================================
    The excerpt
    ========================================================================== */

    add_action('pdr_excerpt', 'content_summary_excerpt');
    function content_summary_excerpt() {
        global $post;

        $limit = true;

        if ( ( is_feature_item() || is_singular('post') ) ) {
        	$length = 50;
        	$limit = $post->post_excerpt ? false : true;
        }
        elseif ( is_home_page() ) {
        	$length = 12;
        }
        elseif ( is_grid() ) {
        	$length = 25;
        }
        else {
        	$length = 12;
        }

        if ( $limit ) {
        	$excerpt = $post->post_excerpt ?
	        	AdvancedExcerpt::text_add_more( AdvancedExcerpt::text_excerpt( $post->post_excerpt, $length, true, false, false), '', '&hellip;'.__('Continued', 'roots') ) :
	        	the_advanced_excerpt( array( 'use_words' => true, 'allowed_tags' => array(), 'length' => $length, 'read_more' => '&hellip;'.__('Continued', 'roots'), 'add_link' => true, 'ellipsis' => '' ), true )
        	;
        }
        else {
        	$excerpt = $post->post_excerpt ?
	        	AdvancedExcerpt::text_add_more( $post->post_excerpt, '', '&hellip;'.__('Continued', 'roots') ) :
	        	the_advanced_excerpt( array( 'allowed_tags' => array(), 'length' => $length, 'read_more' => '&hellip;'.__('Continued', 'roots'), 'add_link' => true, 'ellipsis' => '' ), true )
        	;
        }

        echo $excerpt;
    }


/*  ==========================================================================
    Taxonomy description
    ========================================================================== */

    add_action('before_achive', 'taxonomy_description');
    function taxonomy_description() {
    	get_template_part('templates/taxonomy', 'description');
    }

    function is_grid() {
    	return ( is_archive() || is_search() || is_home() );
    }

    function is_home_page() {
    	return ( $_SERVER['REQUEST_URI'] === '/' );
    }

/*  ==========================================================================
    Grid body class
    ========================================================================== */

	add_filter('body_class', 'grid_body_class');
	function grid_body_class( $classes ) {
		if ( is_grid() )
			$classes[] = 'grid';

		return $classes;
	}

/*  ==========================================================================
    Add related content after collections single
    ========================================================================== */

	add_action('after_single_content', 'related_content_grid');
	function related_content_grid() {
		global $post, $wp_query;

		if ( 'collections' !== $post->post_type )
			return;

		$post_terms = wp_get_post_terms( $post->ID, get_taxonomies() );
		$post_medium = wp_get_post_terms( $post->ID, 'medium' );
		$post_categories = wp_get_post_terms( $post->ID, 'collections_categories' );
    	$query_holder = $wp_query;

    	$args = array(
    		'post_type' => $post->post_type,
    		'posts_per_page' => 12,
    		'post__not_in' => array($post->ID)
		);

		if ( $post_medium ) {
			switch ($post_medium[0]->slug) {
				case 'image':
					$related_tax = "content";
					break;
				case 'audio':
					$related_tax = "genre";
					break;
				case 'film':
					$related_tax = "genre";
					break;
				case 'book':
					$related_tax = "genre";
					break;
			}
		}
		else if ( has_term( 'animated-gifs', 'collections_categories', $post ) || has_term( 'curators-choice', 'collections_categories', $post ) ) {
			$related_tax = "collections_categories";
		}


		if ( is_array($post_terms) ) {
			$args['tax_query']['relation'] = 'OR';
			foreach ( $post_terms as $term ) {
				if ( $related_tax == $term->taxonomy ) {
					$args['tax_query'][] = array(
						'taxonomy' => $term->taxonomy,
						'field' => 'slug',
						'terms' => $term->slug
					);
				}
			}
		}
    	$wp_query = new WP_Query($args);

    	if ( have_posts() ) {
			echo '<div class="related-content">';
			echo __('<h3 class="entry-title">Related Content</h3>', 'roots' );
			get_template_part('archive');
			echo '</div>';
		}

    	$wp_query = $query_holder;
		wp_reset_query();
	}

/*  ==========================================================================
    Setup the containers for the Border Frame widget style
    ========================================================================== */

	add_action('widget_css_classes_add_classes', 'setup_widget_bf_containers', 10, 5);
	function setup_widget_bf_containers($params, $widget_id, $widget_number, $widget_opt, $widget_obj) {
		add_filter('dynamic_sidebar_params', 'widget_bf_containers');
	}

	function widget_bf_containers($params) {

		if ( strpos( $params[0]['before_widget'], 'frame' ) ) {

			$params[0]['before_widget'] = str_replace(
				'<div class="widget-inner">',
				'<div class="bf1"><div class="bf2"><div class="bf3"><div class="bf4"><div class="bf5"><div class="bf6"><div class="bf7"><div class="bf8"><div class="widget-inner">',
				$params[0]['before_widget']
			);

			$params[0]['after_widget'] = str_replace(
				'</section>',
				'</div></div></div></div></div></div></div></div></section>',
				$params[0]['after_widget']
			);
		}

		return $params;
	}

/*  ==========================================================================
    Tag cloud shortcode
    ========================================================================== */

	add_shortcode('tag_cloud', 'tag_cloud_shortcode');
	function tag_cloud_shortcode( $atts ) {
		return wp_tag_cloud(array('echo' => false, 'number' => 250));
	}


/*  ==========================================================================
    The featured articles shown in the sidebars on single article pages
    ========================================================================== */
	add_action('after_sidebar_left', 'featured_articles_sidebar');
	add_action('after_sidebar_right', 'featured_articles_sidebar');
	function featured_articles_sidebar($id) {

		if ( is_singular('post') ) {
			global $post;
			$post_holder = $post;
			$side = strpos(current_filter(), 'right') ? true : false;

			foreach ( get_posts( array( 'category_name' => 'featured-articles', 'posts_per_page' => -1, 'post__not_in' => array($post_holder->ID) ) ) as $k => $post ) {
				if ( $side == ($k & 1) ) {
					setup_postdata( $post );
					get_template_part( 'templates/content');
				}
			}
			$post = $post_holder;
			setup_postdata( $post );
		}
	}


/*  ==========================================================================
    Limit title lengths on homepage
    ========================================================================== */

    add_action('wp', 'setup_homepage_title_length');
    function setup_homepage_title_length() {
    	if ( is_front_page() )
    		add_filter('the_title', 'homepage_title_length');
    }

    function homepage_title_length($title) {
    	if ( !is_feature_item() ) {
    		if ( strlen($title) > 50 )
	    		$title = AdvancedExcerpt::text_add_more( AdvancedExcerpt::text_excerpt( html_entity_decode($title, ENT_QUOTES, "UTF-8"), 50, false, false, false), '&hellip;', false );
		}
    	return $title;
    }


/*  ==========================================================================
    An intro section on the collections and articles landing page
    ========================================================================== */

    add_action('before_achive', 'collections_landing_intro');
    function collections_landing_intro() {
    	if ( check_collection_landing() && is_post_type_archive('collections')) {
    		$page = get_page_by_title('collections');
    		echo apply_filters('the_content', $page->post_content);
    	}
    }

    add_action('before_achive', 'articles_landing_intro');
    function articles_landing_intro() {
    	if ( is_home() ) {
    		$page = get_post(get_option('page_for_posts' ));
    		// $page = get_page_by_title('articles');
    		echo apply_filters('the_content', $page->post_content);
    	}
    }

/*  ==========================================================================
    Hide the admin bar
    ========================================================================== */

    if ( ! current_user_can( 'manage_options' ) ) {
		show_admin_bar( false );
		add_filter('show_admin_bar', '__return_false');
	}


/*  ==========================================================================
    Supress the cgview shortcode
    ========================================================================== */
	add_shortcode('cgview', '__return_false');


/*  ==========================================================================
    Browse by tag page
    ========================================================================== */

	add_filter('browse_by_tag_link', 'browse_by_tag_link');
	function browse_by_tag_link($link) {
		$page = get_page_by_title('Browse by Tag');
		return get_permalink($page->ID);
	}

/*  ==========================================================================
    Check if it's a collection landing page or not
    ========================================================================== */

  function check_collection_landing() {
    $keys = array('medium', 'time', 'tag', 'source');
    foreach ($keys as $key) {
      if ('' != get_query_var( $key ) ) {
        return False;
      }
    }
    return True;
}

