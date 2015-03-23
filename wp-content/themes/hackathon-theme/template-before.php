<?php
/*
 Template Name: Before Event Homepage
*/
get_header('home-before');
?>

<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>

<section>
	<div class="container">
		<div class="main-content">
    <?php the_content();   ?>
    </div>

</section>

<h1 class="front-page"><?php  _e("The sponsors","hackathon-plugin"); ?></h1>
<section class="sponsors">
<?php
	foreach ( array ('platinium'=> SPONSOR_MAX_PLATINIUM,'gold' => SPONSOR_MAX_GOLD,'silver' => SPONSOR_MAX_SILVER) 
			as $sponsor_level => $sponsor_max_level ) {
			$args = array (
					'post_type' => 'sponsors-info',
					'meta_key' => 'sponsor_level_type',
					'meta_value' => $sponsor_level
			);
			$context ['posts'] = Timber::get_posts ( $args );
			$context ['sponsorship_level'] = $sponsor_level;
			$context ['sponsorship_max_level'] = $sponsor_max_level;
			if (!empty($context ['posts'])) {
				Timber::render ( 'sponsors-list.twig', $context );
			}
		}
		?>
</section>
<h1 class="front-page"><?php  _e("The organisers","hackathon-plugin"); ?></h1>
<section class="organisers">
<?php
	$args = array (
		'post_type' => 'organisers-info',
	);
	$context['posts'] = Timber::get_posts($args);
	Timber::render('organisers-list.twig', $context);  
?>
</section>

<h1 class="front-page"><?php  _e("The locations","hackathon-plugin"); ?></h1>
<section class="locations">

<?php
	$args = array (
		'post_type' => 'locations-info',
	);
	$context['posts'] = Timber::get_posts($args);
	Timber::render('locations-list.twig', $context);  
?>

</section>



<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
