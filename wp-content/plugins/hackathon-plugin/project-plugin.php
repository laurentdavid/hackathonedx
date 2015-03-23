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
			'capability_type' => array('project','projects'),
			'has_archive' => true,
			'rewrite' => array('slug' => 'projects'),
			'hierarchical' => false,
			'menu_position' => null,
			'map_meta_cap' => true,
			'supports' => array (
					'title',
					'editor',
					'thumbnail',
					'excerpt',
					'author',
			) 
	);
	register_post_type ( 'projects', $args );
	
}


add_filter( 'cmb_meta_boxes', 'cmb_project_metaboxes' );

function cmb_project_metaboxes( array $meta_boxes ) {
	$fields=array(
			array (
					'id'             => 'team_members',
					'name'           => 'Team members',
					'type'           => 'group',
					'repeatable'     => true,
					'fields' => array (
							array (
									'id' => 'team_member_email',
									'name' => 'Email',
									'type' => 'text'
							),
							array (
									'id' => 'team_member_role',
									'name' => 'Role',
									'type' => 'text'
							),								
					)
			),
			array (
					'id' => 'link_demo',
					'name' => __('Demo Link'),
					'type' => 'text_url'
			),
			array (
					'id' => 'link_repo',
					'name' => __('Repository Link'),
					'type' => 'text_url'
			),
			array (
					'id' => 'link_video',
					'name' => __('Video Link'),
					'type' => 'text_url'
			),
	);
	// Challenges and location are taxonomies so we leave them out
	$meta_boxes['project_metabox'] = array(
			'title' => 'Project Information',
			'id' => 'project_metabox',
			'pages' => array('projects'),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields' => $fields // an array of fields - see individual field documentation.
	);

	return $meta_boxes;

}
function add_project_manager_role() {
	// Add a new role to manage projects posts
	$role = add_role ( 'project_manager', 'Project Manager', array (
			'read' => true,
			'edit_posts' => false,
			'edit_others_posts' => false,
			'delete_posts' => false,
			'publish_posts' => false,
			'upload_files' => true,
			'moderate_comment' => false 
	) );
	if ($role != null) {
		// Add the roles you'd like to administer the custom post types
		$roles = array (
				'project_manager',
				'administrator',
				'author',
				'editor'
		);
		
		// Loop through each role and assign capabilities
		foreach ( $roles as $the_role ) {
			
			$role = get_role ( $the_role );
			
			if ($the_role == 'project_manager') {
				$role->add_cap ( 'read' );
				$role->add_cap ( 'upload_files' );
			}
			$role->add_cap ( 'edit_project' );
			$role->add_cap ( 'edit_projects' );
			$role->add_cap ( 'delete_project' );
			if (in_array($the_role, array ('administrator','author','editor'))) {
				$role->add_cap ( 'read_projects' );
				$role->add_cap ( 'delete_projects' );
				$role->add_cap ( 'edit_others_projects' );
				$role->add_cap ( 'edit_others_project' );
				$role->add_cap ( 'publish_projects' );
				$role->add_cap ( 'edit_published_projects' );
				$role->add_cap ( 'delete_published_projects' );
				$role->add_cap ( 'edit_private_projects' );
				$role->add_cap ( 'delete_private_projects' );
			}
		}
	}
}

function remove_project_manager_role() {
	// Add the roles you'd like to administer the custom post types
	$roles = array (
			'project_manager', 
			'administrator',
			'author',
			'editor'
	);
	
	// Loop through each role and assign capabilities
	foreach ( $roles as $the_role ) {
		
		$role = get_role ( $the_role );
		
		if (in_array($the_role, array ('administrator','author','editor')) ) {			
			$role->remove_cap ( 'read_projects' );
			$role->remove_cap ( 'delete_projects' );
			$role->remove_cap ( 'edit_others_projects' );
			$role->remove_cap ( 'edit_others_project' );
			$role->remove_cap ( 'publish_projects' );
			$role->remove_cap ( 'edit_published_projects' );
			$role->remove_cap ( 'delete_published_projects' );
			$role->remove_cap ( 'edit_private_projects' );
			$role->remove_cap ( 'delete_private_projects' );
				
				
		}
	}
	// Remove role to manage projects posts
	remove_role ( 'project_manager' );
}


