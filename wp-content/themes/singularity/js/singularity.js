/**
 * File singularity.js
 * Navigation, scrolling, footer
 */
( function($) {
	
	$(document).ready(function() {
		// Add class to page as it exits
		var ignore_onbeforeunload = false;
	    $('a[href^=mailto]').on('click',function(){
	        ignore_onbeforeunload = true;
	    });
		$(window).bind('beforeunload', function(){
			if( ! ignore_onbeforeunload ) {
				$('body').addClass('page-is-loading');
				$('body').removeClass('page-has-loaded');
			}
		});
		// Remove page loading class once page loads
		$(window).load(quitAnimation());
		// Remove page loading class if page has been longer than 5 seconds loading
		$(window).ready(function(){
			setTimeout(quitAnimation, 5000);
		});
		function quitAnimation(){
			// Don't leave the animation on screen too long
			$('body').removeClass('page-is-loading');
			$('body').addClass('page-has-loaded');
		};
		
		// Mobile menu
		$('.menu-toggle').on('click tap',function(){
			$('body').toggleClass('menu-toggled');
		});
		
		// Scrolling
		var headerHeight, windowWidth, windowHeight, bodyHeight, footerHeight, imageOpacity, imageHeight, contentPadding;
		
		headerHeight = $('.site-header').innerHeight();
		// Set the image height as percentage of window height
		windowHeight = $(window).height();
		// Need to add extra padding to top of #content
		if($('body').hasClass('thumbnail-height-third')){
			imageHeight = windowHeight/3;
			contentPadding = parseInt(imageHeight)-90;
		} else if($('body').hasClass('thumbnail-height-half')){
			imageHeight = windowHeight/2;
			contentPadding = parseInt(imageHeight)-90;
		} else if($('body').hasClass('thumbnail-height-full')){
			imageHeight = windowHeight;
			contentPadding = parseInt(windowHeight-parseInt(headerHeight)+32);
		}
		$('.pinned-thumbnail .featured-image-wrapper').css('height',imageHeight);
		$('.single.pinned-thumbnail .site-content').css('padding-top',contentPadding);
		$('.page.pinned-thumbnail .site-content').css('padding-top',contentPadding);
		
		// Set filler element to header height
		$('.site-header-filler').css('height',headerHeight);
		$(window).scroll(function(){
			// Adds class to body on scroll, if fixed header is enabled
			var scroll = $(window).scrollTop();
			if( $('body').hasClass('fixed-header')){
				if ( scroll < 1 ) {
					$('body').removeClass('singularity-is-scrolling');
					$('body').addClass('singularity-not-scrolling');
				} else {
					$('body').addClass('singularity-is-scrolling');
					$('body').removeClass('singularity-not-scrolling');
				}
			}
			
			// Checking width < 768px
			windowWidth = $(window).width();
			if( windowWidth<600 ) {
			//	$('.site-header').css('top',scroll+'px');
			} else {
			//	$('.site-header').css('top','0');
			}
			// Fade out featured image
			if( $('body').hasClass('thumbnail-height-third') ) {
				imageOpacity = 1 - (scroll/250);
				$('.featured-image-wrapper').css('opacity',imageOpacity);
			}
			// If footer reveal is enabled
			if( $('body').hasClass('footer-reveal') ) {
				footerHeight = $('.site-footer').height();
				$('.site-content').css('margin-bottom',footerHeight+'px');
			}
		});
		
		// Mobile menu height
		bodyHeight = $('body').height();
		$('.mobile-menu-wrapper').css('height',bodyHeight+'px');
	});
	
} )(jQuery);
