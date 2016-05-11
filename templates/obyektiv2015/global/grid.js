//GRID
jQuery(document).ready(function ($) {

	//sticky-aside
	if ($(window).width() >= 1240) {
		$('.js-sticky-aside').stick_in_parent({
			offset_top: 0
		});
	};

});