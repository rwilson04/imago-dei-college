(function($)
 {
 	var methods = {
		initIndexIndex : function()
		{
			$('.contact').click(function() {
				$('html, body').animate({
					scrollTop: $(document).height()
				}, 1500);
				return false;
			});

			$('.about').click(function() {
				$('html, body').animate({
					scrollTop: '960px'
				}, 1500);
				return false;
			});

			$('.mentoring').click(function() {
				$('html, body').animate({
					scrollTop: '1260px'
				}, 1500);
				return false;
			});

			$('.friday-night').click(function() {
				$('html, body').animate({
					scrollTop: '1560px'
				}, 1500);
				return false;
			});


			$('.top').click(function() {
				$('html, body').animate({
					scrollTop: '0px'
				}, 1500);
				return false;
			});
		},
		initMentorsApplication : function()
		{
			//alert("apply");
		}
	}
	$.fn.idc = function(method)
	{
		if ( methods[method] )
		{    
			return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			return false;
		}   
	}
 })(jQuery);
