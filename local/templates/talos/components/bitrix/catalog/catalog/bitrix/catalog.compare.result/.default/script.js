function emarket_mSlider(action) {
	var _window = $('.emarket-mSlider').children(".mSlider-wrap").children(".mSlider-window");
	
	var	element_wcount = 4,
		window_width = _window.parent(".mSlider-wrap").width(),
		element_width = window_width/element_wcount,
		element_Sum = _window.find("li").size(),
		slider_ReelWidth = element_width * element_Sum;
	
	_window.width(slider_ReelWidth);
	_window.find("li").width(element_width);
	
	switch(action) {
		case 'prev':
			var prev_slide = _window.children("li.current").prev();
			if (prev_slide.length > 0) {
				_window.animate({left: "+="+element_width+"px"});
				_window.children("li").removeClass("current");
				prev_slide.addClass("current");
			}
		break;
		case 'next':			
			var next_slide = _window.children("li.current").next();
			if(next_slide.length > 0) {
			
				_window.animate({left: "-="+element_width+"px"});
				_window.children("li").removeClass("current");
				
				next_slide.addClass("current");
			}
		break;
		default: break;
	}
}

$(document).on("click", "a.mSlider-prev", function(event){
	event.preventDefault();
	emarket_mSlider('prev');
});
$(document).on("click", "a.mSlider-next", function(event){
	event.preventDefault();
	emarket_mSlider('next');
});

$(document).ready(function(){

	$(".emarket-mSlider").each(function(){
		
		var _window = $(this).children(".mSlider-wrap").children(".mSlider-window");
		
		var	element_wcount = 4,
			window_width = _window.parent(".mSlider-wrap").width(),
			element_width = window_width/element_wcount,
			element_Sum   = _window.find("li").size(),
			slider_ReelWidth = element_width * element_Sum;
			
		_window.width(slider_ReelWidth);
		_window.find("li").width(element_width);
		//del item from compare
		_window.find("li").children('.close').on('click', function(){
			compare_item_form.submit();
		});
	});
	
	$("#owl-carousel-compare").each(function(){
		
                
		var _window = $(this).children(".owl-stage-outer").children(".owl-stage");
		
		//del item from compare
		_window.find("div.item").children('.close').on('click', function(){
			compare_item_form.submit();
		});
	});
	
	$('#switch').on('change', function(){
		var u = new Url(location.href);
		console.log(u);
		//alert();
		if($(this).prop('checked'))
			 window.location = u.path+'?DIFFERENT=Y';
		else
			 window.location = u.path+'?DIFFERENT=N';

	})

	
	
	
})