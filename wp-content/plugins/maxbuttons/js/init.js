 
 	var maxadmin;
 	var maxcollection; 

	 	
jQuery(document).ready(function($) {	
	
	function runMaxInit()
	{
		window.maxFoundry = {};

		maxadmin = new maxAdmin(); 
	 	maxadmin.init(); 

		maxcollection = new maxCollection(); 
		maxcollection.init();  
	} 	

	runMaxInit(); 
	
}); /* END OF JQUERY */
