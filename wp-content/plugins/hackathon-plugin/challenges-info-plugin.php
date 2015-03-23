<?php

// Include CMB for additional metabox
require_once( 'Custom-Meta-Boxes/custom-meta-boxes.php' );

add_action ( 'init', 'register_challenge_page_type' );

function register_challenge_page_type() {
	$labels = array (
			'name' => __ ( 'Challenges Information', 'hackathon-plugin' ),
			'singular_name' => __ ( 'Challenge Information', 'hackathon-plugin' ),
			'add_new' => __ ( 'Add New Challenge Information', 'hackathon-plugin' ),
			'add_new_item' => __ ( 'Add New Challenge Information', 'hackathon-plugin' ),
			'edit_item' => __ ( 'Edit Challenge Information', 'hackathon-plugin' ),
			'new_item' => __ ( 'New Challenge Information', 'hackathon-plugin' ),
			'all_items' => __ ( 'All Challenges Information', 'hackathon-plugin' ),
			'view_item' => __ ( 'View Challenge Information', 'hackathon-plugin' ),
			'search_items' => __ ( 'Search Challenge Information', 'hackathon-plugin' ),
			'not_found' => __ ( 'No challenge information found', 'hackathon-plugin' ),
			'not_found_in_trash' => __ ( 'No challenges found in Trash', 'hackathon-plugin' ),
			'menu_name' => __ ( 'Challenge Information', 'hackathon-plugin' )
	);
	$args = array (
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'page',
			'has_archive' => true,
			'hierarchical' => true,
			'menu_position' => null,
			'supports' => array (
					'title',
					'editor',
					'thumbnail',
					'excerpt',
					'page-attributes'
			)
	);

	register_post_type ( 'challenges-info', $args );
}


add_filter( 'cmb_meta_boxes', 'cmb_challenge_metaboxes' );

function cmb_challenge_metaboxes( array $meta_boxes ) {
	$fields=array(
			array(
					'id'   => 'challenge_image_header',
					'name' => __('Background Image', 'hackathon-plugin'),
					'desc' => __('Select a background image for the challenge presentation', 'hackathon-plugin'),
					'type' => 'image',
					'required' => true,
					'size' => 'width=960&height=150&crop=1',
			),
			array(
					'id'   => 'challenge_video_url',
					'name' => __('Video URL', 'hackathon-plugin'),
					'desc' => __('Select a video presenting the challenge', 'hackathon-plugin'),
					'type' => 'text_url',
			),
				
	);
	$meta_boxes['challenge_info_metabox'] = array(
			'title' => 'Challenge Information',
			'pages' => array('challenges-info'),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields' => $fields // an array of fields - see individual field documentation.
	);

	return $meta_boxes;

}