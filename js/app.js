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
		
		// get the parent of the link that was clicked
		var prop_id = $(this).parents('.epl-listing-post').prop('id');
		// remove the string "post-" to get just the ID
		prop_id = prop_id.replace('post-', '');
		
		$('.popup-opener').click();
		$('#property-popup .body').html('');
		
		// call ajax
		$.ajax({
			url: app.ajax_url,
			type: 'post',
			data: {
				'action':'property_single_popup', 
				'property_id' : prop_id
				//'printable' : 'yes'
			},
			success:function(data) {
				$('#property-popup .body').html( data );
				$('.x-flexslider').flexslider({
					controlNav: true,  
					directionNav: true,  
					prevText: '<i class="x-icon-chevron-left" data-x-icon=""></i>', 
					nextText: '<i class="x-icon-chevron-right" data-x-icon=""></i>', 
				});
			},
			error: function(errorThrown){
				
				console.log(errorThrown);
				//hide_loader();
				
			}
			
		});	  
		
	});
	
	
	
});
