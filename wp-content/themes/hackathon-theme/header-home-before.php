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
if (!isset($HEADER_BACKGROUND_PATH))
{
	$HEADER_BACKGROUND_PATH=get_bloginfo('url')."/wp-content/themes/hackathon-theme/img/before-event-background-";
}
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

	
    <?php get_template_part( 'content', 'off_canvas' ); ?>

    <?php if( get_theme_mod( 'wpforge_nav_position' ) == 'top') { ?>
        <?php get_template_part( 'content', 'nav' ); ?>
    <?php } // end if ?>

    <?php if( get_theme_mod( 'wpforge_nav_position' ) == 'fixed') { ?>
        <?php get_template_part( 'content', 'nav' ); ?>
    <?php } // end if ?>

        <div class="header_before_container" data-interchange="[<?php echo $HEADER_BACKGROUND_PATH?>small.jpg,(small)],
				[<?php echo $HEADER_BACKGROUND_PATH?>medium.jpg,(medium)],
        		[<?php echo $HEADER_BACKGROUND_PATH?>large.jpg,(large)],
        		[<?php echo $HEADER_BACKGROUND_PATH?>xlarge.jpg,(xlarge)]">

        <header id="header-before" class="header_wrap row" role="banner"> 
            <div class="site-header medium-12 large-12 columns">
                <?php if ( get_header_image() ) : ?>
                <div class="header-logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" alt="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>" /></a>
                </div><!-- /.header-logo -->
                <?php endif; ?>
                <div class="header-info">                	
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <h2 class="site-description show-for-medium-up"><?php bloginfo( 'description' ); ?></h2>
                    <h2 class="hackathon-dates"><?php  echo get_theme_mod( 'event_date_text' ); ?></h2>
                    <a href="<?php get_theme_mod( 'register_link' )?>" class="button round large register-hackathon"><?php  _e( 'Register Now!','hackathon-theme' ); ?></a>                    
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