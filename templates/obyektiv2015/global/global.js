//GLOBAL
jQuery(document).ready(function ($) {

	//Выравниваем фоточки топ новостей
	$(".topNewsItemPicture img").each(function(){
		$(this).css("margin-left", "-"+($(this).width() / 2)+"px");
	});

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
			//'title': 'Разработка и продвижение сайтов в Севастополе и Крыму - growwweb.com'
		});
	});

	function userMessageError(){

		var isCtrl = false;

		$(document).keyup(function (e) {
			if(e.which == 17) isCtrl=false;
		}).keydown(function (e) {
			var erLink = window.location.href;
			var errText = window.getSelection().toString();
			if(e.which == 17) isCtrl=true;
			if(e.which == 13 && isCtrl == true) {

				$.ajax({
					type:"POST",
					url: '/ajax/erMailText.php',
					data:{'errText':errText, 'erLink':erLink},
					success: function(data){
						alert('Спасибо за проявленную внимательность, мы обязательно рассмотрим ваше замечание.');
					}
				});
			}
		});
	}

	function getFbVomments(){

		var now_permalink = window.location.href;

		jQuery.getJSON(
			'https://graph.facebook.com/v2.1/?fields=share{comment_count}&id='+now_permalink,
			function(data) {
				if (!data['share']) {
					return;
				}
				var count = data['share']['comment_count'];
				jQuery('.viewCntComments').html(function(indx, oldHtml){
					var allComments = parseInt(oldHtml) + parseInt(count);
					return allComments;
				});
				//jQuery('.viewCntComments').html(count);
			}
		);
	}


	userMessageError();
	user_prefers();
	getFbVomments();

});
function user_prefers(){
	$(document).on("click", ".simpleVoteBlock", function() {
		var dataValue = $(this).data();
		var artID = dataValue.id;
		var preferValue = dataValue.value;
		if ($(this).is(".enable")){
			$.ajax({
				type: 'post',
				url: '/ajax/user_prefers.php',
				data: {'artID': artID, 'preferValue': preferValue},
				success: function (data) {
					alert('Спасибо, мы ценим Ваше мнение');
					$('.simpleVoteBlockContainer').html(data);
				}
			});

		} else {
			alert("Вы уже голосовали");
		}
		return false;
	});
}
function onMainCommentsHide(){
	if (window.location.href == "http://obyektiv.press/") {
		console.log(window.location.href);
		$('#hypercomments_widget').remove();
	}
}

setTimeout(onMainCommentsHide, 3000);
jQuery(window).on("load", function(){

	function countReposts() {
		var countReps = 0;
		$(".ya-share2__counter_visible").each(function () {
			countReps = countReps + parseInt($(this).html());
		});

		$(".viewCntReposts").html(countReps);

		return countReps;
	}
	countReposts();
});


