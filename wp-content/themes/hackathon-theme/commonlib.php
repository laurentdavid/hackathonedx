<?php
// Get taxonomy and relevant posts
include_once (plugin_dir_path ( __FILE__ ) . '../../plugins/hackathon-plugin/Tax-Meta-Class/Tax-meta-class/Tax-meta-class.php');

// Get metabox and save triggers
include_once (plugin_dir_path ( __FILE__ ) . '../../plugins/hackathon-plugin/Custom-Meta-Boxes/custom-meta-boxes.php');
function add_meta_info_to_taxonomy(&$taxonomy) {
	$info_postid = get_tax_meta ( $taxonomy->term_id, "hxs_challenge_info_field_id" );
	if (! empty ( $info_postid )) {
		$taxonomy->post_info = get_post ( $info_postid );
	}
}
const MAX_TEAM_SIZE = 10;

// Override the save function in order to get it from any point
class CMB_Meta_Box_hacktheme extends CMB_Meta_Box {
	// Save data from metabox
	function save($post_id = 0) {
		
		// Verify nonce
		if (! isset ( $_POST ['wp_meta_box_nonce'] ) || ! wp_verify_nonce ( $_POST ['wp_meta_box_nonce'], 'hackathon-theme' ))
			return $post_id;
		if (isset ( $_POST [$this->_meta_box ['id']] )) { // add the condition that the hidden field with the metabox should be present
			foreach ( $this->_meta_box ['fields'] as $field ) {
				
				// Verify this meta box was shown on the page
				// if ( ! isset( $_POST['_cmb_present_' . $field['id'] ] ) )
				// continue;
				
				if (isset ( $_POST [$field ['id']] ))
					$value = ( array ) $_POST [$field ['id']];
				else
					$value = array ();
				
				$value = $this->strip_repeatable ( $value );
				
				if (! $class = _cmb_field_class_for_type ( $field ['type'] )) {
					do_action ( 'cmb_save_' . $field ['type'], $field, $value );
				}
				
				$field_obj = new $class ( $field ['id'], $field ['name'], $value, $field );
				
				$field_obj->save ( $post_id, $value );
			}
			
			// If we are not on a post, need to refresh the field objects to reflect new values, as we do not get a redirect
			if (! $post_id) {
				$this->fields = array ();
				$this->init_fields ();
			}
		}
	}
}

/**
 * Forcefully init the metabox for frontend view
 *
 * @return null
 */
function cmb_init_hacktheme() {
	if (is_admin ())
		return;
		// Load translations
	$textdomain = 'cmb';
	$locale = apply_filters ( 'plugin_locale', get_locale (), $textdomain );
	
	// By default, try to load language files from /wp-content/languages/custom-meta-boxes/
	load_textdomain ( $textdomain, WP_LANG_DIR . '/custom-meta-boxes/' . $textdomain . '-' . $locale . '.mo' );
	load_textdomain ( $textdomain, CMB_PATH . '/languages/' . $textdomain . '-' . $locale . '.mo' );
	
	$meta_boxes = apply_filters ( 'cmb_meta_boxes', array () );
	
	if (! empty ( $meta_boxes ))
		foreach ( $meta_boxes as $meta_box )
			new CMB_Meta_Box_hacktheme ( $meta_box );
}
add_action ( 'init', 'cmb_init_hacktheme', 50 );
function update_project_values_from_post($post_data, $postid = null, &$validation_result) {
	// Do the form validation
	if (empty ( $post_data ['project_name'] )) {
		$validation_result = 'Please enter a name for your project.';
	} elseif (empty ( $post_data ['project_description'] )) {
		$validation_result = 'Please enter a description of your project.';
	} elseif (! $post_data ['team_members']) {
		$validation_result = 'Please enter the name and email of at least one team member.';
	} else {
		$project_name = wp_strip_all_tags ( $post_data ['project_name'] );
		$challenge_taxid = wp_strip_all_tags ( $post_data ['project_challenge_taxid'] );
		$location_taxid = wp_strip_all_tags ( $post_data ['project_location_taxid'] );
		$project_description = wp_strip_all_tags ( $post_data ['project_description'] );
		
		// Save the new post
		if ($postid == 0) {
			$new_post = array (
					'post_title' => $project_name,
					'post_name' => sanitize_title_with_dashes ( $project_name, '', 'save' ),
					'post_content' => $project_description,
					'post_status' => 'private',
					'post_author' => get_current_user_id (),
					'post_type' => 'projects'
			);
			$postid = wp_insert_post ( $new_post, true );
		} else {
			$upd_post = array (
					'post_title' => $project_name,
					'post_name' => sanitize_title_with_dashes ( $project_name, '', 'save' ),
					'post_content' => $project_description,
					'post_type' => 'projects',
					'ID' => $postid,			
			);
			$postid = wp_update_post ( $upd_post, true );
		}
		
		// Here we are as we rely on the save callback to do the metabox fields (see commonlib.php)
		if (is_wp_error ( $postid )) {
			$contactemail = mytheme_option ( 'contact_email' );
			$validation_result = 'Uh oh, looks like something went wrong on our end. Please email your project to <a href="mailto:' . $contactemail . '">' . $contactemail . '</a> and we will enter it for you!';
		} else {
			// Add the rest of the fields
			wp_set_post_terms ( $postid, array (
					$challenge_taxid 
			), "challenges" );
			wp_set_post_terms ( $postid, array (
					$location_taxid 
			), "location" );
		}
	}
	return $postid;
}
function set_timber_post_project_from_id($postid, &$context) {
	$timberpost = new TimberPost ( $postid );
	// Get the post id and its taxonomy
	if (! is_null ( $timberpost->id )) {
		$context ['post'] = $timberpost;
		
		$select_challenge_tax_array = wp_get_post_terms ( $timberpost->id, 'challenges' );
		if (! is_null ( $select_challenge_tax_array ) && ! empty ( $select_challenge_tax_array )) {
			$context ['selected_challenge_tax'] = $select_challenge_tax_array [0]->term_id;
		}
		$select_location_tax_array = wp_get_post_terms ( $timberpost->id, 'locations' );
		if (! is_null ( $select_location_tax_array ) && ! empty ( $select_location_tax_array )) {
			$context ['selected_location_tax'] = $select_location_tax_array [0]->term_id;
		}
		// Next we need to rework on the team_members to get them from the usual array returned
		// by $timberpost (either an array of teamember that needs parsing (json) or a single
		// team_member into something like that is a simple array of team_members
		$team_array = array ();
		if (! empty ( $timberpost->team_members )) {
			// First check if we have a single team_member
			if (is_array ( $timberpost->team_members ) && array_key_exists ( "team_member_email", $timberpost->team_members )) {
				$team_array [] = array (
						"team_member_email" => $timberpost->team_members['team_member_email'],
						"team_member_role" => $timberpost->team_members['team_member_post'] 
				);
			} else {
				
				// If not
				foreach ( $timberpost->team_members as $tm ) {
					$team_array [] = unserialize ( $tm );
				}
			}
			$timberpost->team_members = $team_array;
		}
	}
}

