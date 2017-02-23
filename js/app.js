jQuery(document).ready(function($){
	
	// get the height of the page
	var body_height = $('body').height();
	var map_height = $('#column-map').height();
	var listing_pos = $('#column-property-list').offset();
	
	$('#column-map').find('.slider-map').height( map_height );
	
	
	//-------------------------------------------------------
	
	var property_list = $('#column-property-list').find('.epl-listing-post');
	
	$('.popup-opener').magnificPopup({
		type:'inline',
		midClick: true, // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
		//closeOnContentClick: true,
		overflowY:'auto',
		fixedContentPos : false,
		fixedBgPos : true
	});
	
	
	property_list.find('a').click(function(e){
		// prevent going to the page
		e.preventDefault();
		
		var prop_url = this.href;
		
		$('.popup-opener').click();
		$('#property-popup .body').html('');
		
		// call ajax
		$.ajax({
			url: app.ajax_url,
			type: 'post',
			data: {
				'action':'property_single_popup', 
				'property_url' : prop_url
			},
			success:function(data) {
				console.log( data );
			},
			error: function(errorThrown){
				
				console.log(errorThrown);
				//hide_loader();
				
			}
			
		});	  
		
	});
	
	
	
});
