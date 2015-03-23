<?php
/*
 * Plugin Name: Hackathon Plugin 
 * Plugin URI: 
 * Description: Hackathon Project,Categories,... submission item logic 
 * Version: 1.0 
 * Author: Laurent David 
 * License: GPLv2 Text 
 * Domain: hackathon-plugin
 */
function hackathon_load_translation_files() {
	load_plugin_textdomain ( 'hackathon-plugin', false, 'hackathon-plugin/languages' );
}

// Add Challenges Info pages, location info pages and project posts
include_once ('project-plugin.php');
include_once ('challenges-info-plugin.php');
include_once ('locations-info-plugin.php');
include_once ('organisers-info-plugin.php');
include_once ('sponsors-info-plugin.php');


// add action to load my plugin files
add_action ( 'plugins_loaded', 'hackathon_load_translation_files' );

require_once("Tax-Meta-Class/Tax-meta-class/Tax-meta-class.php");

add_action ( 'init', 'register_challenges_taxonomy' );

function register_challenges_taxonomy() {
	// Subjects will be internally administered and are used as taxonomies for other entities 
	register_taxonomy ( 'challenges', array (
			'projects'
	), array (
			'label' => __ ( 'Challenges', 'hackathon-plugin' ),
			'labels' => array (
					'name' => __ ( 'Challenges', 'hackathon-plugin' ),
					'singular_name' => __ ( 'Challenge', 'hackathon-plugin' ),
					'all_items' => __ ( 'All Challenges', 'hackathon-plugin' ),
					'edit_item' => __ ( 'Edit Challenge', 'hackathon-plugin' ),
					'view_item' => __ ( 'View Challenge', 'hackathon-plugin' ),
					'update_item' => __ ( 'Update Challenge', 'hackathon-plugin' ),
					'add_new_item' => __ ( 'Add Challenge', 'hackathon-plugin' ),
					'new_item_name' => __ ( 'New Challenge', 'hackathon-plugin' ),
					'search_items' => __ ( 'Search Challenge', 'hackathon-plugin' ),
					'popular_items' => __ ( 'Most used Challenges', 'hackathon-plugin' ) 
			),
			'hierarchical' => true 
	) );
	$prefix = 'hxs_';
	$config = array(
			'id' => 'hackathon_challenges_metabox',          // meta box id, unique per meta box
			'title' => 'Challenge Additional Information',          // meta box title
			'pages' => array('challenges'),        // taxonomy name, accept categories, post_tag and custom taxonomies
			'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
			'priority' => 'high',
			'fields' => array(),            // list of meta fields (can be added by field arrays)
			'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
			'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);
	$my_meta =  new Tax_Meta_Class($config);
	$my_meta->addPosts($prefix.'challenge_info_field_id',array('args' => array('post_type' => 'challenges-info','numberposts'=>'50')),array('name'=> __('Challenge Information Page','hackedx-plugin')));
	$my_meta->Finish();
	
}

add_action ( 'init', 'register_locations_taxonomy' );

function register_locations_taxonomy() {
	// Location will be internally administered and are used as taxonomies for other entities
	register_taxonomy ( 'locations', array ('projects'), 
		array (
			'label' => __ ( 'Locations', 'hackathon-plugin' ),
			'labels' => array (
			'name' => __ ( 'Locations', 'hackathon-plugin' ),
			'singular_name' => __ ( 'Location', 'hackathon-plugin' ),
			'all_items' => __ ( 'All Locations', 'hackathon-plugin' ),
			'edit_item' => __ ( 'Edit Location', 'hackathon-plugin' ),
			'view_item' => __ ( 'View Location', 'hackathon-plugin' ),
			'update_item' => __ ( 'Update Location', 'hackathon-plugin' ),
			'add_new_item' => __ ( 'Add Location', 'hackathon-plugin' ),
			'new_item_name' => __ ( 'New Location', 'hackathon-plugin' ),
			'search_items' => __ ( 'Search for Location', 'hackathon-plugin' ),
			'popular_items' => __ ( 'Most used Locations', 'hackathon-plugin' )
			),
			'hierarchical' => true
			) );
			$prefix = 'hxl_';
			$config = array(
					'id' => 'hackathon_locations_metabox',          
					'title' => 'Locations Additional Information',  
					'pages' => array('locations'),        
					'context' => 'normal',           
					'priority' => 'high',
					'fields' => array(),            
					'local_images' => false,          
					'use_with_theme' => false          
			);
			$my_meta =  new Tax_Meta_Class($config);
			$my_meta->addPosts($prefix.'location_info_field_id',array('args' => array('post_type' => 'locations-info','numberposts'=>'50')),array('name'=> __('Location Information Page','hackedx-plugin')));
			$my_meta->Finish();

}


register_activation_hook(__FILE__, 'add_project_manager_role' );
register_deactivation_hook(__FILE__, 'remove_project_manager_role' );


add_action( 'admin_menu', 'remove_post_menu_pages' );

function remove_post_menu_pages() {
	remove_menu_page('edit-comments.php');
	remove_menu_page('edit.php');
}

?>
