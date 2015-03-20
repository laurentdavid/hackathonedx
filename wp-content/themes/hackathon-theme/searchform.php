<?php
/**
 * The template for displaying the search form.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.0.1
 */
?>

<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
	<div class="row collapse prefix-round postfix-round">
		<div class="medium-10 large-10 columns">
			<input type="text" value="" name="s" id="s" placeholder="<?php esc_attr_e('Search', 'wpforge'); ?>">
		</div>
		<div class="medium-2 large-2 columns">
			<input type="submit" id="searchsubmit" class="button postfix" value="<?php esc_attr_e('Search', 'wpforge'); ?>" >
		</div>
	</div>
</form>