"use strict"

$(document).ready(function () {
	$(".animate-box").mouseenter(function () {
		animate($(this)); 
	});

});

function animate(elem) {
	var effect = elem.data("effect"); 
	elem.addClass("animated " + effect).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
		elem.removeClass("animated " + effect);
	});

}