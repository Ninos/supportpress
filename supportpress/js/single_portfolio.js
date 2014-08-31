jQuery(function($){
	$(window).load(function() {
		$("#portfolio-slides").flexslider({
			animation: "fade",
			slideshow: true,
			slideshowSpeed: 2000,
			animationDuration: 600,
			directionNav: true,
			controlNav: true,
			slideDirection: "horizontal",
			prevText: '<i class="icon-chevron-left"></i>',
			nextText: '<i class="icon-chevron-right"></i>',
			randomize: false
		}); //end flexslider
	}); //end window load
}); // END function