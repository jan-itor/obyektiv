//HEADER
jQuery(document).ready(function ($) {

	//header menu insert text to <span> tag
	function headerMenuText() {
		$('.js-header-menu-text a').each(function(){
			$(this).append('<span data-hover="' + $(this).text() + '">' + $(this).text() + '</span>');
		});
	};
	headerMenuText();

	function leftScrollLine() {
		$(".left_anchor_full").click(function () {
//Необходимо прокрутить в конец страницы
			var height = 0;
			$("body").animate({"scrollTop":height},500);
		});
	}

	leftScrollLine();

});

jQuery( window ).load(function() {

	function weatherEdit(){
		var imgContainer = $(".gsWeatherIcon");
			imgContainer.css("margin-top" , "0");
		var imgWeather = $(".gsWeatherIcon img");
			imgWeather.attr("height" , "30px");
		$(".nolink").attr("href", "#weather")
					.removeAttr("target");
		$("div.gsLinks").remove();
		$('.gsAddInfo2').remove();
	}

	weatherEdit();

});

window.onscroll = function() {
	var leftLineTop = $(".left_anchor_full");
	var scrolled = window.pageYOffset || document.documentElement.scrollTop;
	if(scrolled > 200)
	{
		leftLineTop.show();
	}else
	{
		leftLineTop.hide();
	}

}