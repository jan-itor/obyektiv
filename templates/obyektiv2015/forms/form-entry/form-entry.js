//FORM-ENTRY
jQuery(document).ready(function ($) {

	//doctor choosing
	$('.js-form-entry_open').each(function () {
		$(this).click(function () {
			var name = $(this).attr('data-name');
			$('#js-form-entry select > option[value="' + name + '"]').attr('selected', '');
		});
	});

	//form popup init
	$('#js-form-entry').popup({
		transition: 'all 0.3s'
	});

});