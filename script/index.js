$(function () {
	$('.article').fontFlex(14, 18, 60);
	$('.item').fontFlex(14, 24, 60);
});
$('.owl-carousel').owlCarousel({
	nav: true,
	navText: ['<i class="icon-arrow-left2 "> </i>', '<i class="icon-arrow-right2"> </i>'],
	loop:true,
	items:1,
	margin:10
})