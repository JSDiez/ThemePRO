 //top menu
jQuery(".site-navbar,.home-navbar").click(function(){
				jQuery(".top-nav").toggle();
			});
	
  jQuery('.top-nav ul li').hover(function(){
	jQuery(this).find('ul:first').slideDown(100);
	jQuery(this).addClass("hover");
	},function(){
	jQuery(this).find('ul').css('display','none');
	jQuery(this).removeClass("hover");
	});
  jQuery('.top-nav li ul li:has(ul)').find("a:first").append(" <span class='menu_more'>»</span> ");
 
   jQuery(".top-nav > ul > li,.main-nav > li").click(function(){
	jQuery(".top-nav > ul > li,.main-nav > li").removeClass("active");
	jQuery(this).addClass("active");
    });
   
   //
     ////
  var windowWidth = jQuery(window).width(); 
  if(windowWidth > 939){
	  if(jQuery(".site-main .sidebar").height() > jQuery(".site-main .main-content").height()){
		  jQuery(".site-main .main-content").css("height",(jQuery(".site-main .sidebar").height()+140)+"px");
		  }
	}else{
		jQuery(".site-main .main-content").css("height","auto");
		}
	jQuery(window).resize(function() {
	var windowWidth = jQuery(window).width(); 
	 if(windowWidth > 939){
	  if(jQuery(".site-main .sidebar").height() > jQuery(".site-main .main-content").height()){
		  jQuery(".site-main .main-content").css("height",(jQuery(".site-main .sidebar").height()+140)+"px");
		  }
	}		else{
		jQuery(".site-main .main-content").css("height","auto");
		}	
		
		if(windowWidth > 919){
			jQuery(".top-nav").show();
		}else{
			jQuery(".top-nav").hide();
			}
		
  });

// sticky menu

(function($){
	$.fn.sticky = function( options ) {
		// adding a class to users div
		$(this).addClass('sticky-header');
		var settings = $.extend({
            'scrollSpeed '  : 500
            }, options);


   ////// get homepage sections
	var sections = [];
				jQuery(".top-nav .onetone-menuitem > a").each(function() {
				linkHref =  $(this).attr('href').split('#')[1];
				$target =  $('#' + linkHref);
 
				if($target.length) {
					topPos = $target.offset().top;
					sections[linkHref] = Math.round(topPos);
				
					
				}
			});
				
		//////////		
				
		return $('.sticky-header .home-navigation ul li.onetone-menuitem a').each( function() {
			
			if ( settings.scrollSpeed ) {

				var scrollSpeed = settings.scrollSpeed

			}
			
			
			  if( $("body.admin-bar").length){
		if( $(window).width() < 765) {
				stickyTop = 46;
				
			} else {
				stickyTop = 32;
			}
	  }
	  else{
		  stickyTop = 0;
		  }
		  $(this).css({'top':stickyTop});

			var stickyMenu = function(){

				var scrollTop = $(window).scrollTop(); 
				if (scrollTop > 111) { 
					$('.sticky-header').css({ 'position': 'fixed'}).addClass('fxd');
					} else {
						$('.sticky-header').css({ 'position': 'static' }).removeClass('fxd'); 
					}   
					
			//// set nav menu active status
			var returnValue = null;
			var windowHeight = Math.round($(window).height() * 0.3);

			for(var section in sections) {
				
				if((sections[section] - windowHeight) < scrollTop) {
					position = section;
					
				}
			}
			 
          if( typeof position !== "undefined" && position !== null ) {
			 
				jQuery(".home-navigation .onetone-menuitem ").removeClass("current");
			    jQuery(".home-navigation .onetone-menuitem ").find('a[href$="#' + position + '"]').parent().addClass("current");;
		  }

        ////
			};
			stickyMenu();
			$(window).scroll(function() {
				 stickyMenu();
			});
			  $(this).on('click', function(e){
				var selectorHeight = $('.sticky-header').height();   
				e.preventDefault();
		 		var id = $(this).attr('href');
				if(typeof $('section'+ id).offset() !== 'undefined'){
				if( $("header").css("position") === "static")
				goTo = $(id).offset().top  - 2*selectorHeight;
				else
				 goTo = $(id).offset().top - selectorHeight;
				 
				$("html, body").animate({ scrollTop: goTo }, scrollSpeed);
				}

			});	
					
		});

	}

})(jQuery);


jQuery(document).ready(function($){
								

//slider

 if(jQuery("section.homepage-slider .item").length >1 ){
 jQuery("#onetone-owl-slider").owlCarousel({
	navigation : false, // Show next and prev buttons
	slideSpeed : 300,
	items:1,
	autoplay:true,
	margin:0,
	loop:true,
	paginationSpeed : 400,
	singleItem:true,
	autoplayTimeout:parseInt(onetone_params.slideSpeed)
 
});
}
 if(jQuery("section.homepage-slider .item").length ==1 ){
	 jQuery("section.homepage-slider .owl-carousel").show();
 }


								
 $(".site-nav-toggle").click(function(){
                $(".site-nav").toggle();
            });
 // retina logo
if( window.devicePixelRatio > 1 ){
	if($('.normal_logo').length && $('.retina_logo').length){
		$('.normal_logo').hide();
		$('.retina_logo').show();
		}
	//
	$('.page-title-bar').addClass('page-title-bar-retina');
	
	}
	
//video background
								
 var myPlayer;
        $(function () {
             myPlayer = $("#onetone-youtube-video").YTPlayer();
        });
 
// BACK TO TOP 											
 $(window).scroll(function(){
		if($(window).scrollTop() > 200){
			$("#back-to-top").fadeIn(200);
		} else{
			$("#back-to-top").fadeOut(200);
		}
	});
	
  	$('#back-to-top, .back-to-top').click(function() {
		  $('html, body').animate({ scrollTop:0 }, '800');
		  return false;
	});
	
/* ------------------------------------------------------------------------ */
/* parallax background image 										  	    */
/* ------------------------------------------------------------------------ */
 $('.onetone-parallax').parallax("50%", 0.1);

// parallax scrolling
if( $('.parallax-scrolling').length ){
	$('.parallax-scrolling').parallax({speed : 0.15});
	}
	
//woocommerce
$(document).on('click','.onetone-quantity .minus',function(){
 var qtyWrap  = $(this).parent('.quantity');
 var quantity =  parseInt(qtyWrap.find('.qty').val());
 var min_num  =  parseInt(qtyWrap.find('.qty').attr('min'));
 var max_num  =  parseInt(qtyWrap.find('.qty').attr('max'));
 var step     =  parseInt(qtyWrap.find('.qty').attr('step'));
 $('input[name="update_cart"]').removeAttr("disabled");
 if( quantity > min_num){
	 quantity = quantity - step;
	 if( quantity > 0 )
	 qtyWrap.find('.qty').val(quantity);
	 }
  });
$(document).on('click','.onetone-quantity .plus',function(){
  var qtyWrap  = $(this).parent('.quantity');
  var quantity =  parseInt(qtyWrap.find('.qty').val());
  var min_num  =  parseInt(qtyWrap.find('.qty').attr('min'));
  var max_num  =  parseInt(qtyWrap.find('.qty').attr('max'));
  var step     =  parseInt(qtyWrap.find('.qty').attr('step'));
  $('input[name="update_cart"]').removeAttr("disabled");
 if( max_num ){
	 if( quantity < max_num ){
	 quantity = quantity + step;
	 qtyWrap.find('.qty').val(quantity);
	  }
	 }else{
		 quantity = quantity + step;
		qtyWrap.find('.qty').val(quantity); 
		 }
  });

$('.variations_form .single_add_to_cart_button').prepend('<i class="fa fa-shopping-cart"></i> ');
/* ------------------------------------------------------------------------ */
/*  sticky header             	  								  	    */
/* ------------------------------------------------------------------------ */
	
jQuery(window).scroll(function(){
							   
		if( jQuery("body.admin-bar").length ){
      if( jQuery(window).width() < 765 ) {
          stickyTop = 46;
        } else {
          stickyTop = 32;
        }
    }else{
		        stickyTop = 0;
		}
  
    var scrollTop = $(window).scrollTop(); 
    if (scrollTop > 200) { 
      $('.fxd-header').css({'top':stickyTop}).show();
      $('header').addClass('fixed-header');
    }else{
      $('.fxd-header').hide();
      $('header').removeClass('fixed-header');
    }
 });
 

	
	
// scheme
 if( typeof onetone_params.primary_color !== 'undefined' && onetone_params.primary_color !== '' ){
 less.modifyVars({
        '@color-main': onetone_params.primary_color
    });
   }
   
/* ------------------------------------------------------------------------ */
/*  sticky header             	  								  	    */
/* ------------------------------------------------------------------------ */
 $(document).on('click',"header .main-header .site-nav ul a[href^='#'],a.scroll,.onetone-nav a[href^='#']", function(e){
				if($("body.admin-bar").length){
				  if($(window).width() < 765) {
						  stickyTop = 46;
						  
					  } else {
						  stickyTop = 32;
					  }
				}
				else{
						  stickyTop = 0;
					}
					
						var selectorHeight = 0;
                if( $('.fxd-header').length )
			    var selectorHeight = $('.fxd-header').height();  
				
				if($(window).width() <= 919) {
					$(".site-nav").hide();
					}
								
				var scrollTop = $(window).scrollTop(); 
				e.preventDefault();
		 		var id = $(this).attr('href');
				if(typeof $(id).offset() !== 'undefined'){
				     var goTo = $(id).offset().top - 2*selectorHeight - stickyTop  + 1;
				     $("html, body").animate({ scrollTop: goTo }, 1000);
				}

			});	
$('header .fxd-header .site-nav ul').onePageNav({filter: 'a[href^="#"]',scrollThreshold:0.3});	

 /* ------------------------------------------------------------------------ */
/*  smooth scrolling  btn       	  								  	    */
/* ------------------------------------------------------------------------ */

  $("div.page a[href^='#'],div.post a[href^='#'],div.home-wrapper a[href^='#'],.banner-scroll a[href^='#']").on('click', function(e){
				var selectorHeight = $('header').height();   
				var scrollTop = $(window).scrollTop(); 
				e.preventDefault();
		 		var id = $(this).attr('href');
				if(typeof $(id).offset() !== 'undefined'){
				var goTo = $(id).offset().top - selectorHeight;
				$("html, body").animate({ scrollTop: goTo }, 1000);
				}

			});	
  
  
 //portfolio carousel
  if($("#related-portfolio").length){
 $("#related-portfolio").owlCarousel({
	navigation : false, // Show next and prev buttons
	pagination: false,
	items:4,
	slideSpeed : 300,
	paginationSpeed : 400,
	singleItem:false,
	autoPlay:parseInt(onetone_params.slideSpeed)
 
});
 }
 
 
 // portfolio filter

jQuery(function ($) {
    
    var filterList = {
    
        init: function () {
        
            // MixItUp plugin
            // http://mixitup.io
            $('.portfolio-list-filter .portfolio-list-items').mixitup({
                targetSelector: '.portfolio-box-wrap',
                filterSelector: '.filter',
                effects: ['fade'],
                easing: 'snap',
                // call the hover effect
                onMixEnd: filterList.hoverEffect()
            });                
        
        },
        
        hoverEffect: function () {             
        
        }
    };
    
    // Run the show!
    filterList.init();
	
    
});        



  $('iframe').each(function(){
							
		if( typeof $(this).attr('width') !=='undefined' && typeof $(this).attr('height') !=='undefined'){
			if( $(this).attr('width') > $(this).outerWidth() ){
			var iframe_height =  $(this).attr('height')*$(this).outerWidth()/$(this).attr('width');
			
			$(this).css({'height':iframe_height});
			
			}
			}
		
		});

   //shop carousel
  
if($(".woocommerce.single-product .thumbnails").length){
 $(".woocommerce.single-product .thumbnails").owlCarousel({
	navigation : true, // Show next and prev buttons
	pagination: false,
	items:4,
	navigationText : ['<i class="fa fa-angle-double-left"></i>', '<i class="fa fa-angle-double-right"></i>'],
	slideSpeed : 300,
	paginationSpeed : 400,
	singleItem:false
	
 
});
 }
 
 //woo

$(".product-image").each(function() {
               $(this).hover(function() {
                 if($(this).find('.product-image-back img').length){
					   $(this).find('.product-image-front').css({'opacity':'0'});
					 }
               },
           function() {
               $(this).find('.product-image-front').css({'opacity':'1'});
           });
           });

 //masonry
 // portfolio
 $('.onetone-masonry').masonry({
 // options
                itemSelector : '.portfolio-box-wrap'
            });
 // blog
 $('.blog-grid').masonry({
 // options
                itemSelector : '.entry-box-wrap'
            });

 var timeline_row_width;
 $('.magee-blog .blog-timeline-wrap .entry-box-wrap').each(function(){
	
	var wrap_width = $(this).parents('.blog-timeline-wrap').innerWidth();
	 timeline_row_width = timeline_row_width+$(this).outerWidth();
	
	if( 2*timeline_item_width >= wrap_width){
		  $(this).removeClass('timeline-left').addClass('timeline-right');
		}else{
		  $(this).removeClass('timeline-right').addClass('timeline-left');	
 }
 });
	
 
  //prettyPhoto
 
 $("a[rel^='portfolio-image']").prettyPhoto();	 
 
 // gallery lightbox
 $(".gallery .gallery-item a").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
  



/* ------------------------------------------------------------------------ */
/* parallax background image 										  	    */
/* ------------------------------------------------------------------------ */
 $('.onetone-parallax').parallax("50%", 0.1);
	 
/* ------------------------------------------------------------------------ */
/*  Section Heading Color													*/
/* ------------------------------------------------------------------------ */
	 
 $('section').each(function(){
					var headingcolor = $(this).data("headingcolor");
					if(headingcolor != ""){
						$(this).find("h1,h2,h3,h4,h5,h6").css("color",headingcolor);
						}
				});
 
  $(".section-banner").each(function(){
  var videoHeight =$(window).height();
  if( typeof onetone_params.header_cover_video_background !== 'undefined' && onetone_params.header_cover_video_background == '0'){
  var videoHeight = videoHeight-$('.sticky-header').height();
  }
  if( typeof onetone_video !== 'undefined' && typeof onetone_video.header_cover_video_background_html5 !== 'undefined' && onetone_video.header_cover_video_background_html5 == '0'){
	  
  var videoHeight = videoHeight-$('.sticky-header').height();
  $(this).find("#big-video-wrap").css({"position":"absolute"});
  
  }
  $(this).css({"min-height":videoHeight});
  $(this).find("#tubular-container,#big-video-vid").css({"height":videoHeight});
  
  });
 //
  if($(window).width() <1200){	
						  newPercentage = (($(window).width() / 1200) * 100) + "%";
						  $(".home-banner .heading-inner").css({"font-size": newPercentage});
						  }	
 $(window).on("resize", function (){
	if($(window).width() <1200){
	newPercentage = (($(window).width() / 1200) * 100) + "%";
	$(".home-banner .heading-inner").css({"font-size": newPercentage});
	}else{
	$(".home-banner .heading-inner").css({"font-size": "100%"});
	}
	
 });
 
 // section fullheight
	var win_height = $(window).height();
  
	$("section.fullheight").each(function(){
         var section_height = $(this).height();
    		if($(this).is('#home-header')) {
					var win_height = $(window).height();
  				var navBar_height = $('.top-wrap').height();
          var win_height = win_height - navBar_height;
        }
		 $(this).css({'height':section_height,'min-height':win_height});
     });
	

 });


if(jQuery().waypoint && jQuery(window).width() > 919 ) {								  
    jQuery('.onetone-animated').each(function(){
			 if(jQuery(this).data('imageanimation')==="yes"){
		         jQuery(this).find("img,i.fa").css("visibility","hidden");	
		 }
		 else{
	           jQuery(this).css("visibility","hidden");	
		 }		
		 
	 });
		
}

/* ------------------------------------------------------------------------ */
/*  home page animation													*/
/* ------------------------------------------------------------------------ */

function onetone_animation(e){
	
	e.css({'visibility':'visible'});
			e.find("img,i.fa").css({'visibility':'visible'});	

			// this code is executed for each appeared element
			var animation_type       = e.data('animationtype');
			var animation_duration   = e.data('animationduration');
	        var image_animation      = e.data('imageanimation');
			 if(image_animation === "yes"){
						 
			e.find("img,i.fa").addClass("animated "+animation_type);

			if(animation_duration) {
				e.find("img,i.fa").css('-moz-animation-duration', animation_duration+'s');
				e.find("img,i.fa").css('-webkit-animation-duration', animation_duration+'s');
				e.find("img,i.fa").css('-ms-animation-duration', animation_duration+'s');
				e.find("img,i.fa").css('-o-animation-duration', animation_duration+'s');
				e.find("img,i.fa").css('animation-duration', animation_duration+'s');
			}
			
				 
			 }else{
			e.addClass("animated "+animation_type);

			if(animation_duration) {
				e.css('-moz-animation-duration', animation_duration+'s');
				e.css('-webkit-animation-duration', animation_duration+'s');
				e.css('-ms-animation-duration', animation_duration+'s');
				e.css('-o-animation-duration', animation_duration+'s');
				e.css('animation-duration', animation_duration+'s');
			}
			 }
	
	
	}

jQuery(window).load(function ($){ 
jQuery('.onetone-animated').each(function(){
  if( jQuery(window).height() > jQuery(this).offset().top){
   onetone_animation(jQuery(this));
  }
 });
 });

 var animated = false;
 jQuery(window).scroll(function () {
if(jQuery(window).width() > 919 ){
		
if(jQuery().waypoint && animated == false ) {								  

		jQuery('.onetone-animated').waypoint(function() {onetone_animation(jQuery(this));},{ triggerOnce: true, offset: '90%' });
	}
   animated = true;
	}
 });



/*
Plugin: jQuery Parallax
Version 1.1.3
Author: Ian Lunn
Twitter: @IanLunn
Author URL: http://www.ianlunn.co.uk/
Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/

(function( $ ){
	var $window = $(window);
	var windowHeight = $window.height();

	$window.resize(function () {
		windowHeight = $window.height();
	});

	$.fn.parallax = function(xpos, speedFactor, outerHeight) {
		var $this = $(this);
		var getHeight;
		var firstTop;
		var paddingTop = 0;
		
		//get the starting position of each element to have parallax applied to it		
		$this.each(function(){
		    firstTop = $this.offset().top;
		});

		if (outerHeight) {
			getHeight = function(jqo) {
				return jqo.outerHeight(true);
			};
		} else {
			getHeight = function(jqo) {
				return jqo.height();
			};
		}
			
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
	


/*   var ua = navigator.userAgent;
	 var vi  =  jQuery("#big-video-vid_html5_api");	
	 if(vi.length){
    if (ua.indexOf("iPhone") > 0) {
        setTimeout(function(){	
            vi[0].play();
        },1000);
    }
    else if (ua.indexOf("Android") > 0) {       
        vi[0].play();
        if ( vi[0].currentTime){
            vi[0].pause();
            setTimeout(function(){
                vi[0].play();
            },1000)
        }
    }
	
	 }*/
	
})(jQuery);


