<?php

// Include CMB for additional metabox
require_once( 'Custom-Meta-Boxes/custom-meta-boxes.php' );

add_action ( 'init', 'register_organiser_page_type' );

function register_organiser_page_type() {
	$labels = array (
			'name' => __ ( 'Organisers Information', 'hackathon-plugin' ),
			'singular_name' => __ ( 'Organiser Information', 'hackathon-plugin' ),
			'add_new' => __ ( 'Add New Organiser Information', 'hackathon-plugin' ),
			'add_new_item' => __ ( 'Add New Organiser Information', 'hackathon-plugin' ),
			'edit_item' => __ ( 'Edit Organiser Information', 'hackathon-plugin' ),
			'new_item' => __ ( 'New Organiser Information', 'hackathon-plugin' ),
			'all_items' => __ ( 'All Organisers Information', 'hackathon-plugin' ),
			'view_item' => __ ( 'View Organiser Information', 'hackathon-plugin' ),
			'search_items' => __ ( 'Search Organiser Information', 'hackathon-plugin' ),
			'not_found' => __ ( 'No organiser information found', 'hackathon-plugin' ),
			'not_found_in_trash' => __ ( 'No organisers found in Trash', 'hackathon-plugin' ),
			'menu_name' => __ ( 'Organiser Information', 'hackathon-plugin' )
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

	register_post_type ( 'organisers-info', $args );
}


add_filter( 'cmb_meta_boxes', 'cmb_organiser_metaboxes' );

function cmb_organiser_metaboxes( array $meta_boxes ) {
	$fields=array(
			array(
					'id'   => 'organiser_image_header',
					'name' => __('Background Image', 'hackathon-plugin'),
					'desc' => __('Select a background image for the organiser presentation', 'hackathon-plugin'),
					'type' => 'image',
					'required' => true,
					'size' => 'width=960&height=150&crop=1',
			),
			array(
					'id'   => 'organiser_logo',
					'name' => __('Logo Image', 'hackathon-plugin'),
					'desc' => __('Select a logo for the organiser', 'hackathon-plugin'),
					'type' => 'image',
					'required' => true,
					'size' => 'width=170&height=110&crop=1',
			),
			array(
					'id'   => 'organiser_video_url',
					'name' => __('Video URL', 'hackathon-plugin'),
					'desc' => __('Select a video presenting the organiser', 'hackathon-plugin'),
					'type' => 'text_url',
			),
				
	);
	// Very useful to name the metabox ref.frontend hack in the hackathon theme itself
	$meta_boxes['organiser_info_metabox'] = array(
			'title' => 'Organiser Information',
			'pages' => array('organisers-info'),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields' => $fields // an array of fields - see individual field documentation.
	);

	return $meta_boxes;

}