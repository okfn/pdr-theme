<?php
/*  ==========================================================================
    Custom Post Types
    ========================================================================== */

    // $collections = array('image', 'text', 'film', 'audio');

    add_action('init', 'init_pdr_collections');
	function init_pdr_collections() {

		$labels = array(
			'name' => 'Collections',
			'singular_name' => 'Collection',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New Collection',
			'edit_item' => 'Edit Collection',
			'new_item' => 'New Collection',
			'all_items' => 'All Collections',
			'view_item' => 'View Collection',
			'search_items' => 'Search Collections',
			'not_found' =>  'No collections found',
			'not_found_in_trash' => 'No collections found in trash', 
			'parent_item_colon' => '',
			'menu_name' => 'Collections'
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' => array( 'slug' => 'collections' ),
			'capability_type' => 'post',
			'has_archive' => true, 
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		); 
		register_post_type( 'collections', $args );
	}

	$collections = array('image', 'text', 'film', 'audio');

    // add_action('init', 'init_pdr_cpt');
	// function init_pdr_cpt() {
	// 	global $collections;
		
	// 	foreach ( $collections as $collection ) {

	// 		$labels = array(
	// 			'name' => sprintf( '%ss', ucfirst($collection) ),
	// 			'singular_name' => sprintf( '%s', ucfirst($collection) ),
	// 			'add_new' => 'Add New',
	// 			'add_new_item' => sprintf( 'Add New %s', ucfirst($collection) ),
	// 			'edit_item' => sprintf( 'Edit %s', ucfirst($collection) ),
	// 			'new_item' => sprintf( 'New %s', ucfirst($collection) ),
	// 			'all_items' => sprintf( 'All %ss', ucfirst($collection) ),
	// 			'view_item' => sprintf( 'View %s', ucfirst($collection) ),
	// 			'search_items' => sprintf( 'Search %ss', ucfirst($collection) ),
	// 			'not_found' =>  sprintf( 'No %ss found', $collection ),
	// 			'not_found_in_trash' => sprintf( 'No %ss found in trash', $collection ), 
	// 			'parent_item_colon' => '',
	// 			'menu_name' => sprintf( '%ss', ucfirst($collection) )
	// 		);
	// 		$args = array(
	// 			'labels' => $labels,
	// 			'public' => true,
	// 			'publicly_queryable' => true,
	// 			'show_ui' => true, 
	// 			'show_in_menu' => true, 
	// 			'query_var' => true,
	// 			'rewrite' => array( 'slug' => $collection ),
	// 			'capability_type' => 'post',
	// 			'has_archive' => true, 
	// 			'hierarchical' => false,
	// 			'menu_position' => null,
	// 			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	// 		); 
	// 		register_post_type( $collection, $args );

	// 	}
	// }


/*  ==========================================================================
    Custom Taxonomies
    ========================================================================== */

    add_action('init', 'init_pdr_taxonomies');

    function init_pdr_taxonomies() {
    	// global $collections;

    	$global_options = array(
			'hierarchical'          => true,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
		);

		// Time (Centuries)
		$labels = array(
			'name'                       => _x( 'Medium', 'taxonomy general name' ),
			'singular_name'              => _x( 'Medium', 'taxonomy singular name' ),
			'search_items'               => __( 'Search Mediums' ),
			'popular_items'              => __( 'Popular Mediums' ),
			'all_items'                  => __( 'All Mediums' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Medium' ),
			'update_item'                => __( 'Update Medium' ),
			'add_new_item'               => __( 'Add New Medium' ),
			'new_item_name'              => __( 'New Medium Name' ),
			'separate_items_with_commas' => __( 'Separate mediums with commas' ),
			'add_or_remove_items'        => __( 'Add or remove mediums' ),
			'choose_from_most_used'      => __( 'Choose from the most used mediums' ),
			'not_found'                  => __( 'No mediums found.' ),
			'menu_name'                  => __( 'Medium' ),
		);
		$args = array_merge($global_options, array(
			'labels'                => $labels,
			'rewrite'               => array( 'slug' => 'medium' ),
		) );
		register_taxonomy( 'medium', array('collections'), $args );

    	// Time (Centuries)
		$labels = array(
			'name'                       => _x( 'Time', 'taxonomy general name' ),
			'singular_name'              => _x( 'Time', 'taxonomy singular name' ),
			'search_items'               => __( 'Search Time' ),
			'popular_items'              => __( 'Popular Time' ),
			'all_items'                  => __( 'All Time' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Time' ),
			'update_item'                => __( 'Update Time' ),
			'add_new_item'               => __( 'Add New Time' ),
			'new_item_name'              => __( 'New Time Name' ),
			'separate_items_with_commas' => __( 'Separate time with commas' ),
			'add_or_remove_items'        => __( 'Add or remove time' ),
			'choose_from_most_used'      => __( 'Choose from the most used time' ),
			'not_found'                  => __( 'No time found.' ),
			'menu_name'                  => __( 'Time' ),
		);
		$args = array_merge($global_options, array(
			'labels'                => $labels,
			'rewrite'               => array( 'slug' => 'time' ),
		) );
		register_taxonomy( 'time', array('collections'), $args );

		// Styles
		$labels = array(
			'name'                       => _x( 'Style', 'taxonomy general name' ),
			'singular_name'              => _x( 'Style', 'taxonomy singular name' ),
			'search_items'               => __( 'Search Styles' ),
			'popular_items'              => __( 'Popular Styles' ),
			'all_items'                  => __( 'All Styles' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Style' ),
			'update_item'                => __( 'Update Style' ),
			'add_new_item'               => __( 'Add New Style' ),
			'new_item_name'              => __( 'New Style Name' ),
			'separate_items_with_commas' => __( 'Separate styles with commas' ),
			'add_or_remove_items'        => __( 'Add or remove styles' ),
			'choose_from_most_used'      => __( 'Choose from the most used styles' ),
			'not_found'                  => __( 'No styles found.' ),
			'menu_name'                  => __( 'Style' ),
		);
		$args = array_merge($global_options, array(
			'labels'                => $labels,
			'rewrite'               => array( 'slug' => 'style' ),
		) );
		register_taxonomy( 'style', array('collections'), $args );


		// Genres
		$labels = array(
			'name'                       => _x( 'Genre', 'taxonomy general name' ),
			'singular_name'              => _x( 'Genre', 'taxonomy singular name' ),
			'search_items'               => __( 'Search Genres' ),
			'popular_items'              => __( 'Popular Genres' ),
			'all_items'                  => __( 'All Genres' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Genre' ),
			'update_item'                => __( 'Update Genre' ),
			'add_new_item'               => __( 'Add New Genre' ),
			'new_item_name'              => __( 'New Genre Name' ),
			'separate_items_with_commas' => __( 'Separate genres with commas' ),
			'add_or_remove_items'        => __( 'Add or remove genres' ),
			'choose_from_most_used'      => __( 'Choose from the most used genres' ),
			'not_found'                  => __( 'No genres found.' ),
			'menu_name'                  => __( 'Genre' ),
		);
		$args = array_merge($global_options, array(
			'labels'                => $labels,
			'rewrite'               => array( 'slug' => 'genre' ),
		) );
		register_taxonomy( 'genre', array('collections'), $args );


		// Content
		$labels = array(
			'name'                       => _x( 'Content', 'taxonomy general name' ),
			'singular_name'              => _x( 'Content', 'taxonomy singular name' ),
			'search_items'               => __( 'Search Content' ),
			'popular_items'              => __( 'Popular Content' ),
			'all_items'                  => __( 'All Content' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Content' ),
			'update_item'                => __( 'Update Content' ),
			'add_new_item'               => __( 'Add New Content' ),
			'new_item_name'              => __( 'New Content Name' ),
			'separate_items_with_commas' => __( 'Separate content with commas' ),
			'add_or_remove_items'        => __( 'Add or remove content' ),
			'choose_from_most_used'      => __( 'Choose from the most used content' ),
			'not_found'                  => __( 'No content found.' ),
			'menu_name'                  => __( 'Content' ),
		);
		$args = array_merge($global_options, array(
			'labels'                => $labels,
			'rewrite'               => array( 'slug' => 'content' ),
		) );
		register_taxonomy( 'content', array('collections'), $args );

		// Types
		$labels = array(
			'name'                       => _x( 'Type', 'taxonomy general name' ),
			'singular_name'              => _x( 'Type', 'taxonomy singular name' ),
			'search_items'               => __( 'Search Types' ),
			'popular_items'              => __( 'Popular Types' ),
			'all_items'                  => __( 'All Types' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Type' ),
			'update_item'                => __( 'Update Type' ),
			'add_new_item'               => __( 'Add New Type' ),
			'new_item_name'              => __( 'New Type Name' ),
			'separate_items_with_commas' => __( 'Separate types with commas' ),
			'add_or_remove_items'        => __( 'Add or remove types' ),
			'choose_from_most_used'      => __( 'Choose from the most used types' ),
			'not_found'                  => __( 'No types found.' ),
			'menu_name'                  => __( 'Type' ),
		);
		$args = array_merge($global_options, array(
			'labels'                => $labels,
			'rewrite'               => array( 'slug' => 'type' ),
		) );
		register_taxonomy( 'type', array('collections'), $args );

		// Sources
		$labels = array(
			'name'                       => _x( 'Source', 'taxonomy general name' ),
			'singular_name'              => _x( 'Source', 'taxonomy singular name' ),
			'search_items'               => __( 'Search Sources' ),
			'popular_items'              => __( 'Popular Sources' ),
			'all_items'                  => __( 'All Sources' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Source' ),
			'update_item'                => __( 'Update Source' ),
			'add_new_item'               => __( 'Add New Source' ),
			'new_item_name'              => __( 'New Source Name' ),
			'separate_items_with_commas' => __( 'Separate sources with commas' ),
			'add_or_remove_items'        => __( 'Add or remove sources' ),
			'choose_from_most_used'      => __( 'Choose from the most used sources' ),
			'not_found'                  => __( 'No sources found.' ),
			'menu_name'                  => __( 'Sources' ),
		);
		$args = array_merge($global_options, array(
			'labels'                => $labels,
			'rewrite'               => array( 'slug' => 'source' ),
		) );
		register_taxonomy( 'source', array('collections'), $args );


		// Collections Tags
		$labels = array(
			'name'                       => _x( 'Collections Tags', 'taxonomy general name' ),
			'singular_name'              => _x( 'Collection Tag', 'taxonomy singular name' ),
			'search_items'               => __( 'Search Tags' ),
			'popular_items'              => __( 'Popular Tags' ),
			'all_items'                  => __( 'All Tags' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Tag' ),
			'update_item'                => __( 'Update Tag' ),
			'add_new_item'               => __( 'Add New Tag' ),
			'new_item_name'              => __( 'New Tag Name' ),
			'separate_items_with_commas' => __( 'Separate tags with commas' ),
			'add_or_remove_items'        => __( 'Add or remove tags' ),
			'choose_from_most_used'      => __( 'Choose from the most used tags' ),
			'not_found'                  => __( 'No tags found.' ),
			'menu_name'                  => __( 'Collections Tags' ),
		);
		$args = array_merge($global_options, array(
			'labels'                => $labels,
			'rewrite'               => array( 'slug' => 'collections_tag' ),
			'hierarchical'			=> false
		) );
		// register_taxonomy( 'collections_tag', array('collections', 'post'), $args );


		// Collections Categories
		$labels = array(
			'name'                       => _x( 'Collections Categories', 'taxonomy general name' ),
			'singular_name'              => _x( 'Collections Category', 'taxonomy singular name' ),
			'search_items'               => __( 'Search Categories' ),
			'popular_items'              => __( 'Popular Categories' ),
			'all_items'                  => __( 'All Categories' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Category' ),
			'update_item'                => __( 'Update Category' ),
			'add_new_item'               => __( 'Add New Category' ),
			'new_item_name'              => __( 'New Category Name' ),
			'separate_items_with_commas' => __( 'Separate categories with commas' ),
			'add_or_remove_items'        => __( 'Add or remove categories' ),
			'choose_from_most_used'      => __( 'Choose from the most used categories' ),
			'not_found'                  => __( 'No categories found.' ),
			'menu_name'                  => __( 'Collections Categories' ),
		);
		$args = array_merge($global_options, array(
			'labels'                => $labels,
			'rewrite'               => array( 'slug' => 'collections_categories' ),
		) );
		register_taxonomy( 'collections_categories', array('collections'), $args );


		// Rights Labelling
		$labels = array(
			'name'                       => _x( 'Rights', 'taxonomy general name' ),
			'singular_name'              => _x( 'Rights Label', 'taxonomy singular name' ),
			'search_items'               => __( 'Search Labels' ),
			'popular_items'              => __( 'Popular Labels' ),
			'all_items'                  => __( 'All Labels' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Label' ),
			'update_item'                => __( 'Update Label' ),
			'add_new_item'               => __( 'Add New Label' ),
			'new_item_name'              => __( 'New Label Name' ),
			'separate_items_with_commas' => __( 'Separate labels with commas' ),
			'add_or_remove_items'        => __( 'Add or remove labels' ),
			'choose_from_most_used'      => __( 'Choose from the most used labels' ),
			'not_found'                  => __( 'No labels found.' ),
			'menu_name'                  => __( 'Rights' ),
		);
		$args = array_merge($global_options, array(
			'labels'                => $labels,
			'rewrite'               => array( 'slug' => 'rights_label' ),
		) );
		register_taxonomy( 'rights_label', array('collections'), $args );


    }


	add_action('init', 'tags_for_collections');
    function tags_for_collections() {
    	register_taxonomy_for_object_type( 'post_tag', 'collections' );
    }

    add_filter('term_link', 'collections_tags_link', 100, 3);
    function collections_tags_link($termlink, $term, $taxonomy) {
    	global $post;
    	if ( ( is_post_type_archive('collections') || ( get_post_type($post) == 'collections' ) )
    		&& ( 'post_tag' == $taxonomy ) 
    		) {
    		$termlink = add_query_arg( 'tag', $term->slug, get_post_type_archive_link( 'collections' ) );
    	}    	
    	return $termlink;
    }