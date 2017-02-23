jQuery(document).ready(function($){
	
	// get the height of the page
	var body_height = $('body').height();
	var map_height = $('#column-map').height();
	var listing_pos = $('#column-property-list').offset();
	
	console.log( map_height );
	
	
	//var new_height = body_height + 40;

	
	$('#column-map').find('.slider-map').height( map_height );
	//$('#column-property-list').height( new_height );
	
	//console.log("body: " + body_height + " map: " + map_pos.top + " listing: " + listing_pos.top );
	
	
});
