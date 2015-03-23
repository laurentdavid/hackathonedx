<?php
/*
	Single project
*/
get_header('home');
?>

<section class="projects-section">
<?php
	$context ['post'] = Timber::get_post (  );
	// To be able to display them
	
//	$challenge_list =  get_terms('challenges',array('hide_empty'=>false));
	
//	$location_list =  get_terms('locations', array('hide_empty'=>false));

	
	// Process team member so to get their details
	$terms = $context ['post']->terms;
	
	foreach ($terms as &$term) {
		add_meta_info_to_taxonomy($term);
	}
	$context['enhanced_teammembers'] = array();
	foreach ($context['post']->team_members as $tm ) {
		$team_member= unserialize($tm);
		$tm_out = new stdClass();
		if (!empty($team_member['team_member_email'])) {
			$tm_out->role= $team_member['team_member_role'];
			$tm_out->email= $team_member['team_member_email'];
			$tm_out->avatar = get_avatar($tm_out->emaill);
			$tm_user = get_user_by( 'email', $team_member['team_member_email'] );
			if ($tm_user) {
				$tm_out->link = bp_core_get_userlink_by_username($tm_user["data"]->user_login);
				$tm_out->nice_name = $tm_user["data"]->user_nicename;
			}
			$context['enhanced_teammembers'][]=$tm_out;
		}
		
	}
	
	
	Timber::render ( 'single-project.twig', $context );
?>
</section>


<?php get_footer(); ?>