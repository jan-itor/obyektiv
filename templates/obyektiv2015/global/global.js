//GLOBAL
jQuery(document).ready(function ($) {

	//phone links attr
	$('.js-g-phone-lnk').each(function () {
		$(this).attr({
			'href': 'tel:' + $(this).text(),
			'title': 'Нажмите чтобы позвонить'
		});
	});

	//mail links attr
	$('.js-g-mail-lnk').each(function () {
		$(this).attr({
			'href': 'mailto:' + $(this).text(),
			'title': 'Нажмите чтобы написать письмо'
		});
	});

	//site links attr
	$('.js-g-site-lnk').each(function () {
		$(this).attr({
			'href': 'http://' + $(this).text(),
			'target': '_blank',
			'rel': 'nofollow',
			'title': 'Нажмите чтобы перейти по ссылке'
		});
	});

	//site social attr
	$('.js-g-social-lnk').each(function () {
		$(this).attr({
			'target': '_blank',
			'title': 'Мы в ' + $(this).attr('data-name')
		});
	});

	//site dev attr
	$('.js-g-dev-lnk').each(function () {
		$(this).attr({
			'target': '_blank',
			'title': 'Разработка и продвижение сайтов в Севастополе и Крыму - growwweb.com'
		});
	});

});