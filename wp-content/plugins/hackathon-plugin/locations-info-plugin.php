<?php

// Include CMB for additional metabox
require_once( 'Custom-Meta-Boxes/custom-meta-boxes.php' );


add_action ('init','register_location_page_type');

function register_location_page_type() {
	$labels = array (
			'name' => __ ( 'Locations Information', 'hackathon-plugin' ),
			'singular_name' => __ ( 'Location Information', 'hackathon-plugin' ),
			'add_new' => __ ( 'Add New Location Information', 'hackathon-plugin' ),
			'add_new_item' => __ ( 'Add New Location Information', 'hackathon-plugin' ),
			'edit_item' => __ ( 'Edit Location Information', 'hackathon-plugin' ),
			'new_item' => __ ( 'New Location Information', 'hackathon-plugin' ),
			'all_items' => __ ( 'All Locations Information', 'hackathon-plugin' ),
			'view_item' => __ ( 'View Location Information', 'hackathon-plugin' ),
			'search_items' => __ ( 'Search Location Information', 'hackathon-plugin' ),
			'not_found' => __ ( 'No location information found', 'hackathon-plugin' ),
			'not_found_in_trash' => __ ( 'No locations found in Trash', 'hackathon-plugin' ),
			'menu_name' => __ ( 'Location Information', 'hackathon-plugin' )
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
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array (
					'title',
					'editor',
					'thumbnail',
					'excerpt'
			)
	);

	register_post_type ( 'locations-info', $args );
}


add_filter( 'cmb_meta_boxes', 'cmb_location_metaboxes' );

function cmb_location_metaboxes( array $meta_boxes ) {
	$fields=array(
			array(
					'id'   => 'location-image-header',
					'name' => __('Background Image', 'hackathon-plugin'),
					'desc' => __('Select a background image for the location presentation', 'hackathon-plugin'),
					'type' => 'image',
					'required' => true,
					'size' => 'width=980&height=200&crop=1',
			),
			array(
					'id'   => 'location-logo',
					'name' => __('Logo Image', 'hackathon-plugin'),
					'desc' => __('Select a logo for the host location', 'hackathon-plugin'),
					'type' => 'image',
					'required' => true,
					'size' => 'width=170&height=110&crop=1',
			),
			array(
					'id'   => 'location-video-url',
					'name' => __('Video URL', 'hackathon-plugin'),
					'desc' => __('Select a video presenting the location', 'hackathon-plugin'),
					'type' => 'text_url',
			),
				
	);
	$meta_boxes[] = array(
			'title' => 'Location Information',
			'pages' => array('locations-info'),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields' => $fields // an array of fields - see individual field documentation.
	);

	return $meta_boxes;

}