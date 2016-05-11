jQuery(document).ready(function ($) {

	//theme of the day
	$('#k2ModuleBox100 .js-category-title-color').text('Тема дня');

	//category-title-color
	$('.js-category-title-color').each(function () {
		if ($(this).text() == 'Аналитика') {
			$(this).css({
				backgroundColor: '#3f6b33'
			})
		} else if ($(this).text() == 'Блогосфера') {
			$(this).css({
				backgroundColor: '#5f554e'
			})
		} else if ($(this).text() == 'Расследование') {
			$(this).css({
				backgroundColor: '#6558a0'
			})
		} else if ($(this).text() == 'Лицом к лицу') {
			$(this).css({
				backgroundColor: '#e3151d'
			})
		} else if ($(this).text() == 'Ваше право') {
			$(this).css({
				backgroundColor: '#e3151d'
			})
		} else if ($(this).text() == 'Духовность') {
			$(this).css({
				backgroundColor: '#009fe0'
			})
		} else if ($(this).text() == 'История') {
			$(this).css({
				backgroundColor: '#e3151d'
			})
		} else if ($(this).text() == 'Свой дом') {
			$(this).css({
				backgroundColor: '#f1c40f'
			})
		} else if ($(this).text() == 'Видео') {
			$(this).css({
				backgroundColor: '#bd6b0c'
			})
		} else if ($(this).text() == 'Новости') {
			$(this).css({
				backgroundColor: '#9b59b6'
			})
		}
	});

	//title-text-cut
	$('.js-title-text-cut').each(function () {
		var textCut = $(this).html().slice(0, 165) + " ...";
		if ($(this).html().length >= 170) {
			$(this).html(textCut);
		};
	});

	//news feed height fix
	if (location.pathname.length != 1) {
		$('#k2ModuleBox99').css({
			height: 'auto'
		});
	};

	//remove popups on images
	$('.typography .modal img').unwrap();

});