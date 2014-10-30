jQuery(function ($) {
	'use strict';

	if ( !$('body').hasClass('lt-ie8') ) {
		
		// share buttons
		$('.share').coenvshare();
		
		// lightbox
		$('a').nivoLightbox();

		// lightbox captions
    	$('figure a img').each(function() {
  			var $this = $(this);
  			$this.parent().attr('title', $this.attr('alt'));
		});
		$('div.gallery img').each(function() {
  			var $this = $(this);
  			$this.parent().attr('title', $this.attr('alt'));
		});

		//$(".wp-caption-text.gallery-caption").hide();
		//$("div.gallery dl:gt(0)").hide();

    	// split galleries using parent id 
		$('div.gallery a').each(function() {
  			var $this = $(this);
  			$this.attr('data-lightbox-gallery', $this.closest('div').attr('id'));
		});

		// slick slider
		$('.homepage-features').slick({
			autoplay: false,	
			autoplaySpeed: 3000,
			dots: true,
			pauseOnDotsHover: true
		});
		
		
		var autoplay = $('.homepage-features').slickGetOption('autoplay');
		
		$('.playpause').click(function() {
            if (autoplay==null || autoplay===false) {
                $(this).html('<i class="fi-play"></i>');
				$('.homepage-features').slickPlay();
				autoplay = true;
            } else {
                $(this).html('<i class="fi-pause"></i>');
				$('.homepage-features').slickPause();
				autoplay = false;
            }
		});
		
	}

});