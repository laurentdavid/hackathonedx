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
	$wp_customize->get_setting( 'wpforge_nav_position' )->default = 'top';
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
	$wp_customize->add_setting( 'twitter_link' , array('default'     => 'https://twitter.com/universite_num',
			'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'facebook_link' , array('default'     => 'https://fr-fr.facebook.com/france.universite.numerique',
			'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'register_link' , array('default'     => '/register',
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
	/* Facebook and twitter */
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter_link', array(
			'label'        => __( 'URL to twitter account', 'hackathon-theme' ),
			'section'    => 'hackathon_section_specifics',
			'settings'   => 'twitter_link',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook_link', array(
			'label'        => __( 'URL to facbook account', 'hackathon-theme' ),
			'section'    => 'hackathon_section_specifics',
			'settings'   => 'facebook_link',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'register_link', array(
			'label'        => __( 'Relative link for the register page', 'hackathon-theme' ),
			'section'    => 'hackathon_section_specifics',
			'settings'   => 'register_link',
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

function logged_in_logged_out( $args = '' ) {
	if( is_user_logged_in() ) {
		$args['menu'] = 'logged-in';
	} else {
		$args['menu'] = 'logged-out';
	}
	return $args;
}
add_filter( 'wp_nav_menu_args', 'logged_in_logged_out' );

// Login screen styles

function hackathon_login_stylesheet() {
	wp_enqueue_style( 'custom-login', get_template_directory_uri() . '../hackathon-theme/style-login.css' );
	wp_enqueue_script( 'custom-login', get_template_directory_uri() . '../hackathon-theme/style-login.js' );
}
add_action( 'login_enqueue_scripts', 'hackathon_login_stylesheet' );
