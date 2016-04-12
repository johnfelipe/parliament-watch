jQuery(document).ready(function(){

	jQuery.noConflict();


	/* TABS */
	jQuery(function($){
		
		$(".st-tabs").each(function() {
			$(this).find('li').first().addClass('active');
		});
		$(".tab-content").each(function(){
			$(this).find('div').first().addClass('active');
		});

		$('.st-tabs a').click(function (e) {
			e.preventDefault();
			$(this).tab('show');
		});

	});

	// TOGGLE
	jQuery('.st-toggle').click(function() {

		if(jQuery(this).hasClass('collapsed')){
	    	jQuery(this).find('i').attr('class', 'fa fa-minus st-size-2');
	    }else{
	    	jQuery(this).find('i').attr('class', 'fa fa-plus st-size-2');
	    }

	});


	// ACCORDION
	jQuery(function($){
		$('.ss-accordion').each(function(){

			var $accID = $(this).attr('id');
			var $elementToSearch = $(this).find('.st-toggle');

			$elementToSearch.attr("data-parent", "#"+$accID);

			$('#'+$accID+' .st-toggle').click(function(){

				$('#'+$accID+' .st-toggle').find('i').removeAttr('class');

				if ($(this).hasClass('collapsed')) {
					$(this).find('i').removeAttr('class');
					$(this).find('i').addClass('fa fa-minus st-size-2');
				}else{
					$(this).find('i').removeAttr('class');
					$(this).find('i').addClass('fa fa-plus st-size-2');
				}

				$('#'+$accID+' .st-toggle').find('i').addClass('fa fa-plus st-size-2');

			});

		});
	});

	

	// TOOLTIP
	jQuery(function($){
		$(".tooltipa").tooltip();
	});

	// POPOVER
	jQuery(function($){
		$(".popovers").popover().click(function(e) {
			e.preventDefault();
		});
	});



	// CALLOUT BTN margin top
	function calloutBtnVertCenter() {
		jQuery('.ss-callout').each(function(){
			var $colHeight = jQuery(this).find('.callout-body').height();
			var $infoHeight = jQuery(this).find('.btn-callout').height();
			
			//30px away from being centered so we can transition to center point on hover
			jQuery(this).find('.btn-callout').css('margin-top', (($colHeight / 2) - ($infoHeight / 2 )) - 0 );
		});	
	}
	
	jQuery(window).load(function(){
	 	calloutBtnVertCenter();
	});
	 
	jQuery(window).resize(function(){
		calloutBtnVertCenter();
	});


	
	// TO TOP BUTTON
	jQuery(function(){

		var offset = 220;
	    var duration = 500;
	    
	    jQuery('.to-top').click(function(event) {
	        event.preventDefault();
	        jQuery('html, body').animate({scrollTop: 0}, duration);
	        return false;
	    });

	});
	

	// PARALLAX SECTIONS
	jQuery(function($){

		var $window = $(window);
		var windowHeight = $window.height();
		
		$window.resize(function () {
			windowHeight = $window.height();
		});
		
		$.fn.ssparallax = function(xpos, speedFactor, outerHeight) {
			var $this = $(this);
			var getHeight;
			var firstTop;
			var paddingTop = 0;
			
			//get the starting position of each element to have parallax applied to it		
			$this.each(function(){
			    firstTop = (($this.offset().top) / 2) * 0.02;
			});
			
			$window.resize(function () {
				$this.each(function(){
			  	    firstTop = (($this.offset().top) / 2) * 0.02;
				});
			});
			
			$window.load(function(){
				$this.each(function(){
			  	    firstTop = (($this.offset().top) / 2) * 0.02;
				}); 
			});
		 
		
			getHeight = function(jqo) {
				return jqo.outerHeight(true);
			};
			 
				
			// setup defaults if arguments aren't specified
			if (arguments.length < 1 || xpos === null) xpos = "50%";
			if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
			if (arguments.length < 3 || outerHeight === null) outerHeight = true;
			
			// function to be called whenever the window is scrolled or resized
			function update(){
				var pos = $window.scrollTop();				
		
				$this.each(function(){
					var $element = $(this);
					var top = $element.offset().top;
					var height = getHeight($element);
					// Check if totally above or totally below viewport
					if (top + height < pos || top > pos + windowHeight) {
						return;
					}
		
					$this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px");
				});
			}		
		
			$window.bind('scroll', update).resize(update);
			update();
		};	


		// Disable parallax if touch device
		if(!navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){

			$('.full-width-section.parallax_section').each(function(){
			   var $id = $(this).attr('id');
			   $('#'+$id + ".parallax_section").ssparallax("0", 0.2);
			});
			
		}

	});

});