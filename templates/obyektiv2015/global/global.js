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

	function userMessageError(){
		var isCtrl = false;
		$(document).keyup(function (e) {
			if(e.which == 17) isCtrl=false;
		}).keydown(function (e) {
			if(e.which == 17) isCtrl=true;
			if(e.which == 13 && isCtrl == true) {
				var erLink = window.location.href;
				var errText = window.getSelection().toString();
				$.ajax({
					type:'post',
					url: '/ajax/erMailText.php',
					data:{'errText':errText, 'erLink':erLink},
					success: function(data){
						alert('Спасибо, мы учтём Ваше замечание');
						console.log(data);
					}
				});
			}
				return false;
		});
	}

	function user_prefers(){

		$('.simpleVoteBlock').click(function() {
			if ($(this).hasClass("enable")){
				var dataValue = $(this).data();
				var artID = dataValue.id;
				var preferValue = dataValue.value;
			console.log(preferValue);
			$.ajax({
				type: 'post',
				url: '/ajax/user_prefers.php',
				data: {'artID': artID, 'preferValue': preferValue},
				success: function (data) {
					alert('Спасибо, мы ценим Ваше мнение');
					$('.simpleVoteBlock').html(data);
				}
			});
			return false;
			}
		});
	}

	/*function onMainPollHide(iframe,content,div) {
		alert("da");
		//if (window.location.href == "http://obyektiv.press/") {
		var iFrame = $(iframe).text();
		console.log(iFrame);
		var iFrameClear = iFrame.remove(content);
		$(div).html(iFrameClear);
		//}
	};*/

	//onMainPollHide('.pollRU','.poll-links','.vidgetPoll');
	userMessageError();
	user_prefers();

});

function onMainCommentsHide(){
	if (window.location.href == "http://obyektiv.press/") {
		console.log(window.location.href);
		$('#hypercomments_widget').remove();
	}
}

setTimeout(onMainCommentsHide, 3000);
//setTimeout(onMainPollHide('iframe','.poll-links','.vidgetPoll'), 5000);