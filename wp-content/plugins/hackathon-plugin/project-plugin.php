<?php

// Include CMB for additional metabox
require_once( 'Custom-Meta-Boxes/custom-meta-boxes.php' );


add_action ('init','register_project_post_type');
function register_project_post_type() {
	$labels = array (
			'name' => __ ( 'Projects', 'hackathon-plugin' ),
			'singular_name' => __ ( 'Project', 'hackathon-plugin' ),
			'add_new' => __ ( 'Add New', 'hackathon-plugin' ),
			'add_new_item' => __ ( 'Add New Project', 'hackathon-plugin' ),
			'edit_item' => __ ( 'Edit Project', 'hackathon-plugin' ),
			'new_item' => __ ( 'New Project', 'hackathon-plugin' ),
			'all_items' => __ ( 'All Projects', 'hackathon-plugin' ),
			'view_item' => __ ( 'View Project', 'hackathon-plugin' ),
			'search_items' => __ ( 'Search Project', 'hackathon-plugin' ),
			'not_found' => __ ( 'No project found', 'hackathon-plugin' ),
			'not_found_in_trash' => __ ( 'No projects found in Trash', 'hackathon-plugin' ),
			'menu_name' => __ ( 'Projects', 'hackathon-plugin' ) 
	);
	$args = array (
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
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
	
	register_post_type ( 'projects', $args );
}


add_filter( 'cmb_meta_boxes', 'cmb_project_metaboxes' );

function cmb_project_metaboxes( array $meta_boxes ) {
	$fields=array(
			array (
					'id'             => 'team-members',
					'name'           => 'Team members',
					'type'           => 'group',
					'repeatable'     => true,
					'repeatable_max' => 5,
					'fields' => array (
							array (
									'id' => 'team-member-name',
									'name' => 'Name',
									'type' => 'text'
							),
							array (
									'id' => 'team-member-email',
									'name' => 'Email',
									'type' => 'text'
							),
							array (
									'id' => 'team-member-role',
									'name' => 'Role',
									'type' => 'text'
							),
							array (
									'id' => 'team-member-website',
									'name' => 'Website/URL',
									'type' => 'url'
							),
					)
			)
	);
	$meta_boxes[] = array(
			'title' => 'Project Information',
			'pages' => array('projects'),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields' => $fields // an array of fields - see individual field documentation.
	);

	return $meta_boxes;

}