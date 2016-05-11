//INTERNAL-SUBHEADER
jQuery(document).ready(function ($) {
	
	//category image
	$('.js-internal-subheader').each(function(){
		if($(this).text() == 'Новости') {
			$(this).css({
				backgroundImage: 'url(/templates/obyektiv2015/blocks/internal-subheader/nov.jpg)'
			});
		} else if($(this).text() == 'Аналитика') {
			$(this).css({
				backgroundImage: 'url(/templates/obyektiv2015/blocks/internal-subheader/ana.jpg)'
			});
		} else if($(this).text() == 'Блогосфера') {
			$(this).css({
				backgroundImage: 'url(/templates/obyektiv2015/blocks/internal-subheader/blo.jpg)'
			});
		} else if($(this).text() == 'Расследование') {
			$(this).css({
				backgroundImage: 'url(/templates/obyektiv2015/blocks/internal-subheader/ras.jpg)'
			});
		} else if($(this).text() == 'Лицом к лицу') {
			$(this).css({
				backgroundImage: 'url(/templates/obyektiv2015/blocks/internal-subheader/lic.jpg)'
			});
		} else if($(this).text() == 'Ваше право') {
			$(this).css({
				backgroundImage: 'url(/templates/obyektiv2015/blocks/internal-subheader/vas.jpg)'
			});
		} else if($(this).text() == 'Духовность') {
			$(this).css({
				backgroundImage: 'url(/templates/obyektiv2015/blocks/internal-subheader/duh.jpg)'
			});
		} else if($(this).text() == 'История') {
			$(this).css({
				backgroundImage: 'url(/templates/obyektiv2015/blocks/internal-subheader/ist.jpg)'
			});
		} else if($(this).text() == 'Свой дом') {
			$(this).css({
				backgroundImage: 'url(/templates/obyektiv2015/blocks/internal-subheader/svo.jpg)'
			});
		} else if($(this).text() == 'Видео') {
			$(this).css({
				backgroundImage: 'url(/templates/obyektiv2015/blocks/internal-subheader/vid.jpg)'
			});
		} else if($(this).text() == 'Форма обратной связи') {
			$(this).css({
				backgroundImage: 'url(/templates/obyektiv2015/blocks/internal-subheader/kon.jpg)'
			});
		};
	});

});