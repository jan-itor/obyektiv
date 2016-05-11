/* ДЛЯ ВСПЛЫВАЮЩЕЙ ФОРМЫ В ШАПКЕ */

(function($){
$('#ordersite').click(function(e) {
  e.preventDefault();
  $('#orderform').addClass('active');
  });     
})(jQuery);

(function($){
$('.close').click(function(e) {
  e.preventDefault();
  $('#orderform').removeClass('active');
  });     
})(jQuery);

