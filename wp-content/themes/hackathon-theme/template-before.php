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


<section class="sponsors">
<?php
	$args = array (
		'post_type' => 'sponsors-info',
	);
	$context['posts'] = Timber::get_posts($args);
	Timber::render('sponsors-list.twig', $context);  
?>
</section>
<section class="organisers">
<?php
	$args = array (
		'post_type' => 'organisers-info',
	);
	$context['posts'] = Timber::get_posts($args);
	Timber::render('organisers-list.twig', $context);  
?>
</section>

<section class="locations">

<?php
	$args = array (
		'post_type' => 'locations-info',
	);
	$context['posts'] = Timber::get_posts($args);
	Timber::render('locations-list.twig', $context);  
?>
<div id="map"/>
<script>
// Provide your access token
L.mapbox.accessToken = 'pk.eyJ1IjoibGF1cmVudGRhdmlkIiwiYSI6IjdxY1ViZGsifQ.Lom52F2ZP27xWm9l-61Vfg';
// Create a map in the div #map
var map = L.mapbox.map('map', 'laurentdavid.lfn94m2i').setView( L.latLng(46.377, 3.032), 6 );
map.touchZoom.disable();
map.doubleClickZoom.disable();
map.scrollWheelZoom.disable();
// disable tap handler, if present.
if (map.tap) map.tap.disable();

</script>


</section>



<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
