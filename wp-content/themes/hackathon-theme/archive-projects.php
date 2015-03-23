<?php
/*
	List of projects
*/
get_header('home');
?>

<section class="projects-section">
<?php
	$context ['posts'] = Timber::get_posts (  );
	Timber::render ( 'projects-list.twig', $context );
?>
</section>


<?php get_footer(); ?>
