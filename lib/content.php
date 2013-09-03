<?php
/*  ==========================================================================
    Custom Post Types
    ========================================================================== */

    $collections = array('image', 'text', 'film', 'audio');

    add_action('init', 'init_pdr_cpt');
	function init_pdr_cpt() {
		global $collections;
		
		foreach ( $collections as $collection ) {

			$labels = array(
				'name' => sprintf( '%ss', ucfirst($collection) ),
				'singular_name' => sprintf( '%s', ucfirst($collection) ),
				'add_new' => 'Add New',
				'add_new_item' => sprintf( 'Add New %s', ucfirst($collection) ),
				'edit_item' => sprintf( 'Edit %s', ucfirst($collection) ),
				'new_item' => sprintf( 'New %s', ucfirst($collection) ),
				'all_items' => sprintf( 'All %ss', ucfirst($collection) ),
				'view_item' => sprintf( 'View %s', ucfirst($collection) ),
				'search_items' => sprintf( 'Search %ss', ucfirst($collection) ),
				'not_found' =>  sprintf( 'No %ss found', $collection ),
				'not_found_in_trash' => sprintf( 'No %ss found in trash', $collection ), 
				'parent_item_colon' => '',
				'menu_name' => sprintf( '%ss', ucfirst($collection) )
			);
			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true, 
				'show_in_menu' => true, 
				'query_var' => true,
				'rewrite' => array( 'slug' => $collection ),
				'capability_type' => 'post',
				'has_archive' => true, 
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
			); 
			register_post_type( $collection, $args );

		}
	}


/*  ==========================================================================
    Custom Taxonomies
    ========================================================================== */

    add_action('init', 'init_pdr_taxonomies');

    function init_pdr_taxonomies() {
    	global $collections;

    	$global_options = array(
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
		);

    	// Time (Centuries)
		$labels = array(
			'name'                       => _x( 'Time (Centuries)', 'taxonomy general name' ),
			'singular_name'              => _x( 'Century', 'taxonomy singular name' ),
			'search_items'               => __( 'Search Centuries' ),
			'popular_items'              => __( 'Popular Centuries' ),
			'all_items'                  => __( 'All Centuries' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Century' ),
			'update_item'                => __( 'Update Century' ),
			'add_new_item'               => __( 'Add New Century' ),
			'new_item_name'              => __( 'New Century Name' ),
			'separate_items_with_commas' => __( 'Separate centuries with commas' ),
			'add_or_remove_items'        => __( 'Add or remove centuries' ),
			'choose_from_most_used'      => __( 'Choose from the most used centuries' ),
			'not_found'                  => __( 'No centuries found.' ),
			'menu_name'                  => __( 'Time (Centuries)' ),
		);
		$args = array_merge($global_options, array(
			'labels'                => $labels,
			'rewrite'               => array( 'slug' => 'time_century' ),
		) );
		register_taxonomy( 'time_century', array('image', 'text'), $args );

		// Time (Decades)
		$labels = array(
			'name'                       => _x( 'Time (Decades)', 'taxonomy general name' ),
			'singular_name'              => _x( 'Decade', 'taxonomy singular name' ),
			'search_items'               => __( 'Search Decades' ),
			'popular_items'              => __( 'Popular Decades' ),
			'all_items'                  => __( 'All Decades' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Decade' ),
			'update_item'                => __( 'Update Decade' ),
			'add_new_item'               => __( 'Add New Decade' ),
			'new_item_name'              => __( 'New Decade Name' ),
			'separate_items_with_commas' => __( 'Separate decade with commas' ),
			'add_or_remove_items'        => __( 'Add or remove decade' ),
			'choose_from_most_used'      => __( 'Choose from the most used decades' ),
			'not_found'                  => __( 'No decades found.' ),
			'menu_name'                  => __( 'Time (Decades)' ),
		);
		$args = array_merge($global_options, array(
			'labels'                => $labels,
			'rewrite'               => array( 'slug' => 'time_decade' ),
		) );
		register_taxonomy( 'time_decade', array('film', 'audio'), $args );


		// Styles
		$labels = array(
			'name'                       => _x( 'Styles', 'taxonomy general name' ),
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
			'menu_name'                  => __( 'Styles' ),
		);
		$args = array_merge($global_options, array(
			'labels'                => $labels,
			'rewrite'               => array( 'slug' => 'style' ),
		) );
		register_taxonomy( 'style', array('image'), $args );


		// Genres
		$labels = array(
			'name'                       => _x( 'Genres', 'taxonomy general name' ),
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
			'menu_name'                  => __( 'Genres' ),
		);
		$args = array_merge($global_options, array(
			'labels'                => $labels,
			'rewrite'               => array( 'slug' => 'genre' ),
		) );
		register_taxonomy( 'genre', array('audio', 'text', 'film'), $args );


		// Rights Labelling
		$labels = array(
			'name'                       => _x( 'Rights Labelling', 'taxonomy general name' ),
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
			'menu_name'                  => __( 'Rights Labelling' ),
		);
		$args = array_merge($global_options, array(
			'labels'                => $labels,
			'rewrite'               => array( 'slug' => 'rights_label' ),
		) );
		register_taxonomy( 'rights_label', array($collections), $args );


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
		register_taxonomy( 'content', array('image'), $args );

		// Types
		$labels = array(
			'name'                       => _x( 'Types', 'taxonomy general name' ),
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
			'menu_name'                  => __( 'Types' ),
		);
		$args = array_merge($global_options, array(
			'labels'                => $labels,
			'rewrite'               => array( 'slug' => 'type' ),
		) );
		register_taxonomy( 'type', array('film'), $args );


    }