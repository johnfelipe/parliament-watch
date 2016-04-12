
jQuery.noConflict();


jQuery('#ts-all').addClass('ts-current-li');
jQuery("#ts-filter-nav > li").click(function(){
    ts_show(this.id);
}).children().click(function(e) {
  return false;
});

jQuery("#ts-filter-nav > li > ul > li").click(function(){
    ts_show(this.id);
});

//In case you want all entries to hide when the page loads
//jQuery('.tshowcase-filter-active').hide();	
	


//FILTER CODE
function ts_show(category) {	 

	//console.log(category);
	
	if (category == "ts-all") {
        jQuery('#ts-filter-nav > li').removeClass('ts-current-li');
        jQuery('#ts-all').addClass('ts-current-li');
        jQuery('.tshowcase-filter-active').show('slow');
		}
	
	else {
		jQuery('#ts-filter-nav > li').removeClass('ts-current-li');
   		jQuery('#' + category).addClass('ts-current-li');  
		jQuery('.' + category).show('slow');
		jQuery('.tshowcase-filter-active:not(.'+ category+')').hide('slow');
	}
	
}


jQuery(document).ajaxSuccess(function() {
  
	jQuery('#ts-all').addClass('ts-current-li');
	jQuery("#ts-filter-nav > li").click(function(){
	    ts_show(this.id);
	}).children().click(function(e) {
	  return false;
	});

	jQuery("#ts-filter-nav > li > ul > li").click(function(){
	    ts_show(this.id);
	});
});