jQuery(function ($) {
	'use strict';

	if ( !$('body').hasClass('lt-ie8') ) {
		
		// share buttons
		$('.share').coenvshare();
		
		// lightbox
		$('a').nivoLightbox();

		// slick slider
		$('.homepage-features').slick({
			autoplay: false,
			autoplaySpeed: 3000,
			dots: true,
			pauseOnDotsHover: true
		});
	}


});