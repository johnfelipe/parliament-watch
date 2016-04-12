jQuery(document).ready(function(){

	/* TESTIMONIAL */
	jQuery(function($){

		jQuery(".testimonial-wrap").each(function() {

			var id = this.id;
			$('#'+id+' > .flexslider-testimonials').flexslider({
				animation: "slide",
				animationLoop: false,
				slideshow: false,
				controlNav: true,
				useCSS: false,
				directionNav: false,
				smoothHeight: true,
				touch: true

			});			

		});

	});



	/* FLEXSLIDER - Custom Post Types Carousel */
	function supremeFlexslider() {

		jQuery(window).load(function() {

			var windowWidth = jQuery(window).width();

			jQuery(".flexslider-wrap").each(function() {

				var id = this.id;
				var flexSliderWrap = jQuery("#"+id).width();

				// tiny helper function to add breakpoints
				function getGridSize() {

					if(flexSliderWrap < 330){
						return (jQuery(window).innerWidth < 600) ? 2 : (jQuery(window).innerWidth < 900) ? 3 : 1;
					}else if(flexSliderWrap < 600){
						return (jQuery(window).innerWidth < 600) ? 2 : (jQuery(window).innerWidth < 900) ? 3 : 2;
					}else if(flexSliderWrap < 850){
						return (jQuery(window).innerWidth < 600) ? 2 : (jQuery(window).innerWidth < 900) ? 3 : 3;
					}else if(flexSliderWrap < 810){
						return (jQuery(window).innerWidth < 600) ? 2 : (jQuery(window).innerWidth < 900) ? 3 : 3;
					}else{
						return (jQuery(window).innerWidth < 600) ? 2 : (jQuery(window).innerWidth < 900) ? 3 : 4;
					};
					
				}

				jQuery('#'+id+' > .flexslider-posts').flexslider({
					animation: "slide",
					animationLoop: false,
					itemWidth: 220,
					itemMargin: 20,
					slideshow: false,
					controlNav: false,
					useCSS: false,
					touch: true,
					minItems: getGridSize(),
					maxItems: getGridSize(),
					move: 1
				});

				jQuery('.flex-direction-nav a.flex-next').html('<i class="fa fa-angle-right"></i>');
				jQuery('.flex-direction-nav a.flex-prev').html('<i class="fa fa-angle-left"></i>');

			});


			
		});

	 
	};
	supremeFlexslider();

	jQuery(function($){
		$(window).resize(supremeFlexslider);
		$(window).scroll(supremeFlexslider);
		$(window).load(supremeFlexslider);
	});

});