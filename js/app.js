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
	
	// post listing
	var property_list = $('#column-property-list').find('.epl-listing-post');
	
	property_list.find('a').click(function(e){
		// prevent going to the page
		e.preventDefault();
		
		alert(this.href);
	});
	
	$('.overlay-featured-marker').bind('click', function(ev){
		alert('test');
		// prevent going to the page
		ev.preventDefault();
	});
	
	
	
});
