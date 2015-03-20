<?php
/**
 * Hackathon functions and definitions.
 *
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Hackathon
 * @since WP-Forge 5.5.0.1
 */

// Priority => very low in order for parent theme to initialise settings
add_action( 'customize_register', 'hackathon_customize_register',100 );

function hackathon_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'wpforge_nav_position' )->default = 'fixed';
	$wp_customize->get_setting( 'wpforge_nav_text' )->default = __('edX Hackathon','hackathon-theme');
	$wp_customize->add_section( 'hackathon_section_specifics' , array(
			'title'      => __( 'Hackathon Theme Specifics', 'hackathon-theme' ),
			'priority'   => 100,
	) );
	$wp_customize->add_setting( 'event_date_text' , array('default'     => 'Les 29 et 30 mai 2015',
			'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'contact_mail' , array('default'     => '',
			'transport'   => 'refresh',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'event_date_text', array(
			'label'        => __( 'Dates for the event (textual form)', 'hackathon-theme' ),
			'section'    => 'hackathon_section_specifics',
			'settings'   => 'event_date_text',
	) ) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contact_mail', array(
			'label'        => __( 'Contact email for site', 'hackathon-theme' ),
			'section'    => 'hackathon_section_specifics',
			'settings'   => 'contact_mail',
	) ) );
}

add_action('wp_enqueue_scripts', 'child_add_scripts' );
function child_add_scripts() {
	wp_register_script(
		'submit-project',
		'/wp-content/themes/hackathon-theme/js/submit-project.js',
		array('jquery'), 
		'1.201',
	    true
	);

	wp_enqueue_script( 'submit-project' );
}


add_filter( 'show_admin_bar' , 'hide_admin_bar');

function hide_admin_bar() {
	if (! current_user_can ( edit_posts )) {
		return false;
	} else {
		
		return true;
	}
}

include 'commonlib.php';