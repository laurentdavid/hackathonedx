var showTeamMember = function (teamMember) {
  teamMember
    .find('.required').attr('required', 'required').end()
    .slideDown();
  teamMember.find('input').removeAttr('disabled').end();
  
}
var hideTeamMember = function (teamMember) {
  teamMember
    .find('.required').removeAttr('required').end()
    .find('input').val('').end()
    .slideUp();
  teamMember.find('input').attr('disabled','disabled').end();
}

var initProjectSubmitForm = function () {
  jQuery('#add-team-member').click(function (e) {
    e.preventDefault();
    var $invisibleRows = jQuery('.team-member-form-row:hidden');
    if ($invisibleRows.length == 1) {
      jQuery(this).hide();
    }
    showTeamMember($invisibleRows.eq(0));
    jQuery('#no-team-members').slideUp();
  });
  jQuery('.team-member-form-row .close').click(function (e) {
    e.preventDefault();
    if (jQuery('.team-member-form-row:visible').length <= 1) {
      jQuery('#no-team-members').slideDown();
    }
    hideTeamMember(jQuery(this).parents('.team-member-form-row'));

    jQuery('#add-team-member').show();
  });
  //jQuery('#submit_project').validate();
};

jQuery(document).ready(function($) {
	initProjectSubmitForm();
});
