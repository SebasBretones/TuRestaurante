(function($) {
    "use strict";

	$(window).on('load', function() {
		$('.preloader').fadeOut();
		$('#preloader').delay(550).fadeOut('slow');
		$('body').delay(450).css({'overflow':'visible'});
	});


	$('#slides').superslides({
		inherit_width_from: '.cover-slides',
		inherit_height_from: '.cover-slides',
		play: 5000,
		animation: 'fade',
	});

	$( ".cover-slides ul li" ).append( "<div class='overlay-background'></div>" );

}(jQuery));
