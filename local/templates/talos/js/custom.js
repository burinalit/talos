jQuery(document).ready(function(){
	$('.header_block.desktop .btn_search').click(function() {
		$('.top_search').addClass("active");
	});


    jQuery('.section_home_info').owlCarousel({
        loop:true,
        margin:14,
        nav:true,
		items: 3,
		dots:true,
		responsiveClass:true,
		responsive:{
			0:{
				items:1.5,
				nav:true
			},
			780:{
				items:2.5,
				nav:false
			},
			990:{
				items:3,
				nav:false
			},
			1000:{
				items:3,
				nav:true,
				loop:false
			}
		}
    });
});
jQuery(document).ready(function(){
    jQuery('.slider_struct_content').owlCarousel({
        loop:true,
        margin:14,
        nav:true,
		items: 3,
		dots:true,
		responsiveClass:true,
		responsive:{
			0:{
				items:1.5,
				nav:false
			},
			768:{
				items:2.5,
				nav:false
			},
			990:{
				items:3,
				nav:false
			},
			1000:{
				items:3,
				nav:true,
				loop:false
			}
		}
    });
});
jQuery(document).ready(function(){
    jQuery('.carusel_tenders_list').owlCarousel({
        loop:true,
        margin:14,
        nav:true,
		items: 4,
		dots:false,
		responsiveClass:true,
		responsive:{
			0:{
				items:1.5,
				nav:false
			},
			640:{
				items:2.5,
				nav:false
			},
			768:{
				items:3.5,
				nav:false
			},
			990:{
				items:4,
				nav:false
			},
			1000:{
				items:4,
				nav:false
			},
			1200:{
				items:4,
				nav:true
			}
		}
    });
});
jQuery(document).ready(function(){
    jQuery('.carusel_products_list').owlCarousel({
        loop:true,
        margin:14,
        nav:true,
		items: 3,
		dots:false,
		responsiveClass:true,
		responsive:{
			0:{
				items:1.5,
				nav:false
			},
			640:{
				items:1.5,
				nav:false
			},
			768:{
				items:2.5,
				nav:false
			},
			990:{
				items:3,
				nav:false
			},
			1000:{
				items:3,
				nav:true,
				loop:false
			}
		}
    });
	var owl4 = jQuery('.carusel_products_list');
    owl4.owlCarousel();
    jQuery('.product_item_tabs .accordion-tabs .next').click(function() {
        owl4.trigger('next.owl.carousel');
    })
    jQuery('.product_item_tabs .accordion-tabs .prev').click(function() {
        owl4.trigger('prev.owl.carousel');
    });
	
});
jQuery(document).ready(function(){
    jQuery('.carusel_dop_list').owlCarousel({
        loop:true,
        margin:14,
        nav:true,
		items: 3,
		dots:false,
		responsiveClass:true,
		responsive:{
			0:{
				items:1.5,
				nav:false
			},
			640:{
				items:1.5,
				nav:false
			},
			768:{
				items:2.5,
				nav:false
			},
			990:{
				items:3,
				nav:false
			},
			1000:{
				items:3,
				nav:true,
				loop:false
			}
		}
    });
	var owl4 = jQuery('.carusel_dop_list');
    owl4.owlCarousel();
    jQuery('.product_item_tabs .accordion-tabs .next').click(function() {
        owl4.trigger('next.owl.carousel');
    })
    jQuery('.product_item_tabs .accordion-tabs .prev').click(function() {
        owl4.trigger('prev.owl.carousel');
    });
});


var districtByIso = {
    'RU-BEL': 'COLOR1',
    'RU-BRY': 'COLOR1',
    'RU-VLA': 'COLOR1',
    'RU-VOR': 'COLOR1',
    'RU-IVA': 'COLOR1',
    'RU-KLU': 'COLOR1',
    'RU-KOS': 'COLOR1',
    'RU-KRS': 'COLOR1',
    'RU-LIP': 'COLOR1',
    'RU-MOS': 'COLOR1',
    'RU-MOW': 'COLOR1',
    'RU-ORL': 'COLOR1',
    'RU-RYA': 'COLOR1',
    'RU-SMO': 'COLOR1',
    'RU-TAM': 'COLOR1',
    'RU-TVE': 'COLOR1',
    'RU-TUL': 'COLOR1',
    'RU-YAR': 'COLOR1',
    'RU-ARK': 'COLOR2',
    'RU-VLG': 'COLOR2',
    'RU-KGD': 'COLOR2',
    'RU-KR': 'COLOR2',
    'RU-KO': 'COLOR2',
    'RU-LEN': 'COLOR2',
    'RU-MUR': 'COLOR2',
    'RU-NEN': 'COLOR2',
    'RU-NGR': 'COLOR2',
    'RU-PSK': 'COLOR2',
    'RU-SPE': 'COLOR2',
    'RU-AD': 'COLOR1',
    'RU-AST': 'COLOR1',
    'RU-VGG': 'COLOR1',
    'RU-KL': 'COLOR1',
    'RU-KDA': 'COLOR1',
    'RU-SEV': 'COLOR1',
    'RU-KRY': 'COLOR1',
    'RU-ROS': 'COLOR1',
    'RU-DA': 'COLOR1',
    'RU-IN': 'COLOR1',
    'RU-KB': 'COLOR1',
    'RU-KC': 'COLOR1',
    'RU-SE': 'COLOR1',
    'RU-STA': 'COLOR1',
    'RU-CE': 'COLOR1',
    'RU-BA': 'COLOR1',
    'RU-KIR': 'COLOR1',
    'RU-ME': 'COLOR1',
    'RU-MO': 'COLOR1',
    'RU-NIZ': 'COLOR1',
    'RU-ORE': 'COLOR1',
    'RU-PNZ': 'COLOR1',
    'RU-PER': 'COLOR1',
    'RU-SAM': 'COLOR1',
    'RU-SAR': 'COLOR1',
    'RU-TA': 'COLOR1',
    'RU-UD': 'COLOR1',
    'RU-ULY': 'COLOR1',
    'RU-CU': 'COLOR1',
    'RU-KGN': 'COLOR1',
    'RU-SVE': 'COLOR1',
    'RU-TYU': 'COLOR1',
    'RU-KHM': 'COLOR1',
    'RU-CHE': 'COLOR1',
    'RU-YAN': 'COLOR1',
    'RU-ALT': 'COLOR1',
    'RU-AL': 'COLOR1',
    'RU-BU': 'COLOR1',
    'RU-ZAB': 'COLOR1',
    'RU-IRK': 'COLOR1',
    'RU-KEM': 'COLOR1',
    'RU-KYA': 'COLOR1',
    'RU-NVS': 'COLOR1',
    'RU-OMS': 'COLOR1',
    'RU-TOM': 'COLOR1',
    'RU-TY': 'COLOR1',
    'RU-KK': 'COLOR1',
    'RU-AMU': 'COLOR1',
    'RU-YEV': 'COLOR1',
    'RU-KAM': 'COLOR1',
    'RU-MAG': 'COLOR1',
    'RU-PRI': 'COLOR1',
    'RU-SA': 'COLOR1',
    'RU-SAK': 'COLOR1',
    'RU-KHA': 'COLOR1',
    'RU-CHU': 'COLOR1'
};

$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});

$("body").on('click', '[href*="#"]', function(e){
    var fixed_offset = 0;
    $('html,body').stop().animate({ scrollTop: $(this.hash).offset().top - fixed_offset }, 1000);
    e.preventDefault();
});


$(document).ready(function () {
	$('.product-slider').slick({
		 infinite: true,
		 slidesToShow: 1,
		 slidesToScroll: 1,
		 initialSlide: 1,
		 arrows: true,
		 nextArrow: '<span class="arrow-next"></span>',
		 prevArrow: '<span class="arrow-prev"></span>',
		 asNavFor: '.product_thumb-slider'
	 });

	$('.product_thumb-slider').slick({
		 infinite: true,
		 slidesToShow: 5,
		 slidesToScroll: 1,
		 arrows: true,
		 nextArrow: '<span class="arrow-next_thumb"></span>',
		 prevArrow: '<span class="arrow-prev_thumb"></span>',
		 focusOnSelect: true,
		 asNavFor: '.product-slider',
		 responsive: [
		   {
			   breakpoint: 768,
			   settings: {
				  swipe: true
			   }
		  }
		 ]
	 });
});	

$(document).ready(function () {
	$('.product-slider_photo').slick({
		 infinite: false,
		 slidesToShow: 1,
		 slidesToScroll: 1,
		 initialSlide: 1,
		 arrows: false,
		 asNavFor: '.product_thumb-slider_photo'
	 });

	$('.product_thumb-slider_photo').slick({
		 infinite: false,
		 slidesToShow: 6,
		 slidesToScroll: 1,
		 arrows: false,
		 focusOnSelect: true,
		 asNavFor: '.product-slider_photo',
		 responsive: [
		   {
			   breakpoint: 768,
			   settings: {
				  swipe: true
			   }
		  }
		 ]
	 });
});


$(document).ready(function() { 
	var button = $('#button-up');	
	$(window).scroll (function () {
		if ($(this).scrollTop () > 300) {
		  button.fadeIn();
		} else {
		  button.fadeOut();
		}
	});	 
	button.on('click', function(){
		$('body, html').animate({
		scrollTop: 0
		}, 800);
		return false;
	});		 
});


function variChange(winWidth) {
  if (winWidth > 780) {
	$(document).ready(function(){
	  var scrolling = $("header, main");
	  $(window).scroll(function(){
		if ( $(this).scrollTop() >= 147 && scrolling.hasClass("loading") ){
		  scrolling.removeClass("loading").addClass("scrolling");
		} else if($(this).scrollTop() <= 147 && scrolling.hasClass("scrolling")) {
		  scrolling.removeClass("scrolling").addClass("loading");
		}
	  });
	});
  }
  if (winWidth < 780) {
	$(document).ready(function(){
	  var scrolling = $("header, .main");
	  $(window).scroll(function(){
		if ( $(this).scrollTop() >= 147 && scrolling.hasClass("loading") ){
		  scrolling.removeClass("loading").addClass("scrolling");
		} else if($(this).scrollTop() <= 147 && scrolling.hasClass("scrolling")) {
		  scrolling.removeClass("scrolling").addClass("loading");
		}
	  });
	});
  }
}
variChange($(window).width());

/* main menu */
var main = function() {
    $('.header__menu-btn').click(function() { 
        $('.menu_mobile').animate({
            right: '0px'
        }, 500);
    });
    $('.menu_close_btn').click(function() {
        $('.menu_mobile').animate({ 
            right: '-5000px'
        }, 500);
    });
};
$(document).ready(main);


$(document).ready(function () {
	$('.accordion-tabs').children('li').first().children('a').addClass('is-active').next().addClass('is-open').show();
	$('.accordion-tabs').on('click', 'li > a', function(event) {
		if (!$(this).hasClass('is-active')) {
			event.preventDefault();
			$('.accordion-tabs .is-open').removeClass('is-open').hide();
			$(this).next().toggleClass('is-open').toggle();
			$('.accordion-tabs').find('.is-active').removeClass('is-active');
			$(this).addClass('is-active');
		} else {
			event.preventDefault();
		}
	});
});

$(document).ready(function () {
	$('.accordion-tabs2').children('li').first().children('a').addClass('is-active').next().addClass('is-open').show();
	$('.accordion-tabs2').on('click', 'li > a', function(event) {
		if (!$(this).hasClass('is-active')) {
			event.preventDefault();
			$('.accordion-tabs2 .is-open').removeClass('is-open').hide();
			$(this).next().toggleClass('is-open').toggle();
			$('.accordion-tabs2').find('.is-active').removeClass('is-active');
			$(this).addClass('is-active');
		} else {
			event.preventDefault();
		}
	});
});

$(document).ready(function () {
    let fields = document.querySelectorAll('.field__file');
    Array.prototype.forEach.call(fields, function (input) {
      let label = input.nextElementSibling,
        labelVal = label.querySelector('.field__file-fake').innerText;
  
      input.addEventListener('change', function (e) {
        let countFiles = '';
        if (this.files && this.files.length >= 1)
          countFiles = this.files.length;
  
        if (countFiles)
          label.querySelector('.field__file-fake').innerText = 'Выбрано файлов: ' + countFiles;
        else
          label.querySelector('.field__file-fake').innerText = labelVal;
      });
    });
});