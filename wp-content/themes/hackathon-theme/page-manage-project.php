<?php
/*
 * Template Name: Submit Project
 */
get_header ();

$context = Timber::get_context();

/* We can either create a new post (in this case there is no information about post in either
 * get or set method), or we are editing a post (either we have an id from the GET method or an
 * id from the _POST method)
*/
$validation_result="";
// We can edit a project by adding ?postid=xx at the end of url
if ('GET' == $_SERVER ['REQUEST_METHOD'] && ! empty ( $_GET ['postid'] ) ) {
	$project_form_state = "edit_project";
	// Load the post and all attached value 
	set_timber_post_project_from_id(intval( $_GET ['postid'] ),$context);
} 

if ('POST' == $_SERVER ['REQUEST_METHOD'] && ! empty ( $_POST ['action'] ) && ($_POST ['action'] == 'submit_project'))
{
	// We have just pressed "save" so we can now edit the project
	// Or we have edited the project and pressed save
	// save all values to this post
	$post_id = update_project_values_from_post($_POST,intval($_POST ['postid']),$validation_result);
	// Then retrieve the values to display them
	set_timber_post_project_from_id($post_id, $context); 
	
}

$context['validation_result'] = $validation_result;
// To be able to display them
$context['challengestax'] =  get_terms('challenges',array('hide_empty'=>false));

$context['locationtax'] =  get_terms('locations', array('hide_empty'=>false));

if (isset ( $context ['challengetax'] )) {
	foreach ( $context ['challengetax'] as &$taxonomy ) {
		add_meta_info_to_taxonomy($taxonomy);
	}
}
if (isset ( $context ['locationtax'] )) {
	foreach ( $context ['locationtax'] as &$taxonomy ) {
		add_meta_info_to_taxonomy($taxonomy);
	}
}


Timber::render ( 'edit-project.twig', $context );

?>

<?php get_footer(); ?>
