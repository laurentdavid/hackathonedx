<?php

// Include CMB for additional metabox
require_once( 'Custom-Meta-Boxes/custom-meta-boxes.php' );

add_action ( 'init', 'register_sponsor_page_type' );

function register_sponsor_page_type() {
	$labels = array (
			'name' => __ ( 'Sponsors Information', 'hackathon-plugin' ),
			'singular_name' => __ ( 'Sponsor Information', 'hackathon-plugin' ),
			'add_new' => __ ( 'Add New Sponsor Information', 'hackathon-plugin' ),
			'add_new_item' => __ ( 'Add New Sponsor Information', 'hackathon-plugin' ),
			'edit_item' => __ ( 'Edit Sponsor Information', 'hackathon-plugin' ),
			'new_item' => __ ( 'New Sponsor Information', 'hackathon-plugin' ),
			'all_items' => __ ( 'All Sponsors Information', 'hackathon-plugin' ),
			'view_item' => __ ( 'View Sponsor Information', 'hackathon-plugin' ),
			'search_items' => __ ( 'Search Sponsor Information', 'hackathon-plugin' ),
			'not_found' => __ ( 'No sponsor information found', 'hackathon-plugin' ),
			'not_found_in_trash' => __ ( 'No sponsors found in Trash', 'hackathon-plugin' ),
			'menu_name' => __ ( 'Sponsor Information', 'hackathon-plugin' )
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
					'excerpt'
			)
	);

	register_post_type ( 'sponsors-info', $args );
}


add_filter( 'cmb_meta_boxes', 'cmb_sponsor_metaboxes' );

function cmb_sponsor_metaboxes( array $meta_boxes ) {
	$fields=array(
			array(
					'id'   => 'sponsor_image_header',
					'name' => __('Background Image', 'hackathon-plugin'),
					'desc' => __('Select a background image for the sponsor presentation', 'hackathon-plugin'),
					'type' => 'image',
					'required' => true,
					'size' => 'width=960&height=150&crop=1',
			),
			array(
					'id'   => 'sponsor_logo',
					'name' => __('Logo Image', 'hackathon-plugin'),
					'desc' => __('Select a logo for the sponsor', 'hackathon-plugin'),
					'type' => 'image',
					'required' => true,
					'size' => 'width=170&height=110&crop=1',
			),
			array(
					'id'   => 'sponsor_video_url',
					'name' => __('Video URL', 'hackathon-plugin'),
					'desc' => __('Select a video presenting the sponsor', 'hackathon-plugin'),
					'type' => 'text_url',
			),
				
	);
	$meta_boxes['sponsor_information_metabox'] = array(
			'title' => 'Sponsor Information',
			'pages' => array('sponsors-info'),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields' => $fields // an array of fields - see individual field documentation.
	);

	return $meta_boxes;

}