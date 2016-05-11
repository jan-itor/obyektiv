jQuery(document).ready(function ($) {
	var r = navigator.userAgent,
		e = /chrome/i,
		a = /firefox/i,
		s = /opera/i,
		o = /trident/i;
	$("html").addClass(-1 != r.search(e) ? " fix-webkit" : -1 != r.search(a) ? " fix-gecko" : -1 != r.search(s) ? "fix-presto" : -1 != r.search(o) ? " fix-trident" : "")
});