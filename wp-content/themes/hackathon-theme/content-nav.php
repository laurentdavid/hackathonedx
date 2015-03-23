<?php
/**
 * The template for displaying the Top-Bar menu.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.0.1
 */
$context = Timber::get_context();
$context['image_url'] = get_bloginfo('url')."/wp-content/themes/hackathon-theme/img/";


?>


<div class="nav_container">

<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'wpforge' ); ?></a>

    <?php if( get_theme_mod( 'wpforge_nav_position' ) == '') { ?>
        <div class="nav_wrap row">
                <nav class="top-bar" data-topbar data-options="mobile_show_parent_link: true">
                	<?php Timber::render('topnav_left.twig',$context)?>
                    <section class="top-bar-section">
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'container' => false,
                            'depth' => 0,
                            'items_wrap' => '<ul class="left">%3$s</ul>',
                            'fallback_cb' => 'wpforge_menu_fallback', // workaround to show a message to set up a menu
                            'walker' => new wpforge_walker( array(
                                'in_top_bar' => true,
                                'item_type' => 'li',
                                'menu_type' => 'main-menu'
                            ) ),
                        ) );
                        ?>
                    </section>
                </nav>   
        </div><!-- .row -->
    <?php } // end if ?>

    <?php if( get_theme_mod( 'wpforge_nav_position' ) == 'normal') { ?>

        <?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes') { ?>
        <div class="nav_wrap row hide-for-small-only">
        <?php } else { ?>
        <div class="nav_wrap row">
        <?php } // end if ?>
                <nav class="top-bar" data-topbar data-options="mobile_show_parent_link: true">
                    <?php Timber::render('topnav_left.twig',$context)?>
                    <section class="top-bar-section">
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'container' => false,
                            'depth' => 0,
                            'items_wrap' => '<ul class="left">%3$s</ul>',
                            'fallback_cb' => 'wpforge_menu_fallback', // workaround to show a message to set up a menu
                            'walker' => new wpforge_walker( array(
                                'in_top_bar' => true,
                                'item_type' => 'li',
                                'menu_type' => 'main-menu'
                            ) ),
                        ) );
                        ?>
                    </section>
                </nav>   
        </div><!-- .row -->

    <?php } // end if ?>

    <?php if( get_theme_mod( 'wpforge_nav_position' ) == 'top') { ?>
        
        <?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes') { ?>
        <div class="hide-for-small-only">
        <?php } else { ?>
        <div class="<?php echo get_theme_mod( 'wpforge_nav_display' ); ?>">
        <?php } // end if ?>
            <nav class="top-bar" data-topbar data-options="mobile_show_parent_link: true">
                <?php Timber::render('topnav_left.twig',$context)?>
                <section class="top-bar-section">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'depth' => 0,
                        'items_wrap' => '<ul class="right">%3$s</ul>',
                        'fallback_cb' => '', // workaround to show a message to set up a menu
                        'walker' => new wpforge_walker( array(
                            'in_top_bar' => true,
                            'item_type' => 'li',
                            'menu_type' => 'main-menu'
                        ) ),
                    ) );
                    ?>
                </section>
            </nav>
        </div>    

    <?php } // end if ?>

    <?php if( get_theme_mod( 'wpforge_nav_position' ) == 'fixed') { ?>
        
        <?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes') { ?>
        <div class="fixed hide-for-small-only">
        <?php } else { ?>
        <div class="fixed row">
        <?php } // end if ?>
            <nav class="top-bar" data-topbar data-options="mobile_show_parent_link: true">
                <?php Timber::render('topnav_left.twig',$context)?>
                <section class="top-bar-section">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'depth' => 0,
                        'items_wrap' => '<ul class="right">%3$s</ul>',
                        'fallback_cb' => '', // workaround to show a message to set up a menu
                        'walker' => new wpforge_walker( array(
                            'in_top_bar' => true,
                            'item_type' => 'li',
                            'menu_type' => 'main-menu'
                        ) ),
                    ) );
                    ?>
                </section>
            </nav>
        </div>    

    <?php } // end if ?>

    <?php if( get_theme_mod( 'wpforge_nav_position' ) == 'sticky') { ?>

        <?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes') { ?>
        <div class="nav_wrap row hide-for-small-only">
        <?php } else { ?>
        <div class="nav_wrap row">
        <?php } // end if ?>
                <div class="contain-to-grid sticky">
                    <nav class="top-bar" data-topbar data-options="mobile_show_parent_link: true">
                         <?php Timber::render('topnav_left.twig',$context)?>
                        <section class="top-bar-section">
                            <?php
                            wp_nav_menu( array(
                                'theme_location' => 'primary',
                                'container' => false,
                                'depth' => 0,
                                'items_wrap' => '<ul class="left">%3$s</ul>',
                                'fallback_cb' => '', // workaround to show a message to set up a menu
                                'walker' => new wpforge_walker( array(
                                    'in_top_bar' => true,
                                    'item_type' => 'li',
                                    'menu_type' => 'main-menu'
                                ) ),
                            ) );
                            ?>
                        </section>
                    </nav>
                </div><!-- contain-to-grid sticky -->
        </div><!-- .row -->

    <?php } // end if ?>

</div><!-- end .nav_container -->