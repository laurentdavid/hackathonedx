<?php
/**
 * The Header template of our theme.
 *
 * Displays all of the <head> section and everything up till <section class="container row" role="document">
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.0.1
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
<script src='https://api.tiles.mapbox.com/mapbox.js/v2.1.5/mapbox.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox.js/v2.1.5/mapbox.css' rel='stylesheet' />
</head>

<body <?php body_class(); ?>>

	<div id="social_header" class="row" >
		<div class="social_icons  large-3 columns">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Home" rel="home"><?php echo get_theme_mod( 'wpforge_nav_text' ); ?></a>
            <img src="<?php bloginfo('url'); ?>/wp-content/themes/hackathon-theme/img/facebook30.png" alt="<?php _e( 'Facebook Link','hackathon-theme' ); ?>"/>
            <img src="<?php bloginfo('url'); ?>/wp-content/themes/hackathon-theme/img/twitter30.png" alt="<?php _e( 'Facebook Link','hackathon-theme' ); ?>"/>
		</div>
		<div class="social_search_bar large-offset-6 large-3 columns">
			<?php the_widget( "WP_Widget_Search" ); ?>  
		</div>
		
	</div>
	
    <?php get_template_part( 'content', 'off_canvas' ); ?>

    <?php if( get_theme_mod( 'wpforge_nav_position' ) == 'top') { ?>
        <?php get_template_part( 'content', 'nav' ); ?>
    <?php } // end if ?>

    <?php if( get_theme_mod( 'wpforge_nav_position' ) == 'fixed') { ?>
        <?php get_template_part( 'content', 'nav' ); ?>
    <?php } // end if ?>

        <div class="header_container_small" data-interchange="[<?php bloginfo('url'); ?>/wp-content/themes/hackathon-theme/img/before-event-background-small.jpg,(small)], [<?php bloginfo('url'); ?>/wp-content/themes/hackathon-theme/img/before-event-background-medium.jpg,(medium)], [<?php bloginfo('url'); ?>/wp-content/themes/hackathon-theme/img/before-event-background-large.jpg,(large)][<?php bloginfo('url'); ?>/wp-content/themes/hackathon-theme/img/before-event-background-xlarge.jpg,(xlarge)]">

        <header id="header-small" class="header_wrap row" role="banner"> 
            <div class="site-header medium-12 large-12 columns">
                <?php if ( get_header_image() ) : ?>
                <div class="header-logo-small">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" alt="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>" /></a>
                </div><!-- /.header-logo -->
                <?php endif; ?>
                <div class="header-info-small">                	
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <h2 class="site-description show-for-medium-up"><?php bloginfo( 'description' ); ?></h2>
                    <h2 class="hackathon-dates"><?php  echo get_theme_mod( 'event_date_text' ); ?></h2>
                    <a href="#" class="button round large register-hackathon"><?php  _e( 'Register Now!','hackathon-theme' ); ?></a>                    
                </div><!-- /.header-info -->
                
             </div><!-- .site-header -->
        </header><!-- #header -->

        </div><!-- end .header_container -->

            <?php if( get_theme_mod( 'wpforge_nav_position' ) == '') { ?>
                <?php get_template_part( 'content', 'nav' ); ?>
            <?php } // end if ?>       
            
            <?php if( get_theme_mod( 'wpforge_nav_position' ) == 'normal') { ?>
                <?php get_template_part( 'content', 'nav' ); ?>
            <?php } // end if ?>

            <?php if( get_theme_mod( 'wpforge_nav_position' ) == 'sticky') { ?>
                <?php get_template_part( 'content', 'nav' ); ?>
            <?php } // end if ?>            

        <div class="content_container">
    
            <section class="content_wrap row" role="document">