// counterUP
(function( $ ){
  "use strict";

  $.fn.counterUp = function( options ) {

    // Defaults
    var settings = $.extend({
        'time': 400,
        'delay': 10
    }, options);

    return this.each(function(){

        // Store the object
        var $this = $(this);
        var $settings = settings;

        var counterUpper = function() {
            var nums = [];
            var divisions = $settings.time / $settings.delay;
            var num = $this.text();
            var isComma = /[0-9]+,[0-9]+/.test(num);
            num = num.replace(/,/g, '');
            var isInt = /^[0-9]+$/.test(num);
            var isFloat = /^[0-9]+\.[0-9]+$/.test(num);
            var decimalPlaces = isFloat ? (num.split('.')[1] || []).length : 0;

            // Generate list of incremental numbers to display
            for (var i = divisions; i >= 1; i--) {

                // Preserve as int if input was int
                var newNum = parseInt(num / divisions * i);

                // Preserve float if input was float
                if (isFloat) {
                    newNum = parseFloat(num / divisions * i).toFixed(decimalPlaces);
                }

                // Preserve commas if input had commas
                if (isComma) {
                    while (/(\d+)(\d{3})/.test(newNum.toString())) {
                        newNum = newNum.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
                    }
                }

                nums.unshift(newNum);
            }

            $this.data('counterup-nums', nums);
            $this.text('0');

            // Updates the number until we're done
            var f = function() {
                $this.text($this.data('counterup-nums').shift());
                if ($this.data('counterup-nums').length) {
                    setTimeout($this.data('counterup-func'), $settings.delay);
                } else {
                    delete $this.data('counterup-nums');
                    $this.data('counterup-nums', null);
                    $this.data('counterup-func', null);
                }
            };
            $this.data('counterup-func', f);

            // Start the count up
            setTimeout($this.data('counterup-func'), $settings.delay);
        };

        // Perform counts when the element gets into view
        $this.waypoint(counterUpper, { offset: '100%', triggerOnce: true });
    });

  };

})( jQuery );

jQuery(document).ready(function($) {
								
            var s=$(".magee-feature-box.style2");
            for(i=0;i<s.length;i++) {
                var t=$(s[i]).find(".icon-box").outerWidth();
				if($(s[i]).find("img.feature-box-icon").length){
				var t=$(s[i]).find("img.feature-box-icon").outerWidth();
				}
                t+=15;
                t+="px";
                $(s[i]).css({"padding-left":t});
            }
            var s=$(".magee-feature-box.style2.reverse");
            for(i=0;i<s.length;i++) {
                var t=$(s[i]).find(".icon-box").outerWidth();
				if($(s[i]).find("img.feature-box-icon").length)
				var t=$(s[i]).find("img.feature-box-icon").outerWidth();
				
                t+=15;
                t+="px";
                $(s[i]).css({"padding-left":0,"padding-right":t});
            }
            var s=$(".magee-feature-box.style3");
            for(i=0;i<s.length;i++) {
                var t=$(s[i]).find(".icon-box").outerWidth();
				if($(s[i]).find("img.feature-box-icon").length)
				var t=$(s[i]).find("img.feature-box-icon").outerWidth();
                t+="px";
                $(s[i]).find("h3").css({"line-height":t});
            }
            var s=$(".magee-feature-box.style4");
            for(i=0;i<s.length;i++) {
                var t=$(s[i]).find(".icon-box").outerWidth();
				if($(s[i]).find("img.feature-box-icon").length)
				var t=$(s[i]).find("img.feature-box-icon").outerWidth();
                t=t/2;
                t1=-t;
                t+="px";
                t1+="px";
                $(s[i]).css({"padding-top":t,"margin-top":t});
                $(s[i]).find(".icon-box").css({"top":t1,"margin-left":t1});
				$(s[i]).find("img.feature-box-icon").css({"top":t1,"margin-left":t1});
            }
  
 //
 
  $(".wow").each(function(){
	var duration = $(this).data("animationduration");
       if( typeof duration !== "undefined"){
		   $(this).css({"-webkit-animation-duration":duration+"s","animation-duration":duration+"s"});
		   }
    });
  //
  ////flipbox
 
 $('.magee-flipbox-wrap').each(function(){
	var front_height = $(this).find('.flipbox-front').outerHeight();
	var back_height = $(this).find('.flipbox-back').outerHeight();
	var height = front_height>back_height?front_height:back_height;
	
	 	$(this).css({'height':height});	
 });										 
								 
 function DY_scroll(wraper,prev,next,img,speed,or)
 { 
  var wraper = $(wraper);
  var prev = $(prev);
  var next = $(next);
  var img = $(img).find('ul');
  var w = img.find('li').outerWidth(true);
  var s = speed;
  
  next.click(function()
       {
        img.animate({'margin-left':-w},function()
                  {
                   img.find('li').eq(0).appendTo(img);
                   img.css({'margin-left':0});
                   });
        });
 
  prev.click(function()
       {
        img.find('li:last').prependTo(img);
        img.css({'margin-left':-w});
        img.animate({'margin-left':0});
        });
 
  if (or == true)
  {
   ad = setInterval(function() { next.click();},s*1000);
   wraper.hover(function(){clearInterval(ad);},function(){ad = setInterval(function() { next.click();},s*1000);});
  }
 
 }
 
 DY_scroll('.multi-carousel','.multi-carousel-nav-prev','.multi-carousel-nav-next','.multi-carousel-inner',3,false);
            //tooltip controls 
            $('[data-toggle="tooltip"]').tooltip();	
            $('[data-toggle="popover"]').popover();
            $("[data-animation]").mouseover(function(){
                var anmiationName=$(this).attr("data-animation");
                $(this).addClass("animated").addClass(anmiationName);
            });
            $("[data-animation]").mouseout(function(){
                var anmiationName=$(this).attr("data-animation");
                $(this).removeClass("animated").removeClass(anmiationName);
            });
 
 
 
 // counter up
 
  $('.magee-counter-box .counter-num').counterUp({
            delay: 10,
            time: 1000
        });
  
  /* ------------------------------------------------------------------------ */
/*  animation													*/
/* ------------------------------------------------------------------------ */
										  
    jQuery('.magee-animated').each(function(){
			 if(jQuery(this).data('imageanimation')==="yes"){
		         jQuery(this).find("img,i.fa").css("visibility","hidden");	
		 }
		 else{
	           jQuery(this).css("visibility","hidden");	
		 }		
		 
	 });
	
	if(jQuery().waypoint) {
		jQuery('.magee-animated').waypoint(function() {
											  
			jQuery(this).css({'visibility':'visible'});
			jQuery(this).find("img,i.fa").css({'visibility':'visible'});	


			// this code is executed for each appeared element
			var animation_type       = jQuery(this).data('animationtype');
			var animation_duration   = jQuery(this).data('animationduration');
	        var image_animation      = jQuery(this).data('imageanimation');
			 if(image_animation === "yes"){
						 
			jQuery(this).find("img,i.fa").addClass("animated "+animation_type);

			if(animation_duration) {
				jQuery(this).find("img,i.fa").css('-moz-animation-duration', animation_duration+'s');
				jQuery(this).find("img,i.fa").css('-webkit-animation-duration', animation_duration+'s');
				jQuery(this).find("img,i.fa").css('-ms-animation-duration', animation_duration+'s');
				jQuery(this).find("img,i.fa").css('-o-animation-duration', animation_duration+'s');
				jQuery(this).find("img,i.fa").css('animation-duration', animation_duration+'s');
			}
			
				 
			 }else{
			jQuery(this).addClass("animated "+animation_type);

			if(animation_duration) {
				jQuery(this).css('-moz-animation-duration', animation_duration+'s');
				jQuery(this).css('-webkit-animation-duration', animation_duration+'s');
				jQuery(this).css('-ms-animation-duration', animation_duration+'s');
				jQuery(this).css('-o-animation-duration', animation_duration+'s');
				jQuery(this).css('animation-duration', animation_duration+'s');
			}
			 }

			 
		},{ triggerOnce: true, offset: '90%' });
	}
	
		$("a[rel^='prettyPhoto']").prettyPhoto(); 
  
  // contact form  
 function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
      }
	  
 jQuery("form.magee-contact-form #submit").click(function(){					
														 
	var obj = jQuery(this).parents(".magee-contact-form");
	obj.find(".contact-failed").text("");		
	var receiver  = obj.find("input#receiver").val();
	var email     = obj.find("input#email").val();
	var name      = obj.find("input#name").val();
	var subject   = obj.find("input#subject").val();
	var message   = obj.find("textarea#message").val();
	
	
	

	obj.find(".contact-failed").append("<img alt='loading' class='loading' src='"+magee_params.themeurl+"/images/AjaxLoader.gif' />");
	
	 jQuery.ajax({
				 type:"POST",
				 dataType:"json",
				 url:magee_params.ajaxurl,
				 data:"name="+name+"&email="+email+"&subject="+subject+"&receiver="+receiver+"&message="+message+"&action=magee_contact",
				 success:function(data){
					 if( data.error == 0 ){
						     obj.find(".contact-failed").addClass("notice-success");
					         obj.find(".contact-failed").html(data.msg);
							  jQuery('.loading').remove();obj[0].reset(); 
						 }else{
							 obj.find(".contact-failed").removeClass("notice-success");
							 obj.find(".contact-failed").html(data.msg);	
							 }
		          
		           return false;
				   },error:function(){
					   obj.find(".contact-failed").html("Error.");
					   obj.find('.loading').remove();
					   return false;
					   }
			 });
	
	 return false;
	});
//accordion icon controls 
  jQuery(".panel-title").each(function(){
			var open_icon =jQuery(this).find("i").attr("data-open");
			var close_icon = jQuery(this).find("i").attr("data-close");
			var now_class = jQuery(this).find("i").attr("class");
			jQuery(this).click(function(){	
			  if(jQuery(this).find("i").attr("data-open")  && jQuery(this).find("i").attr("data-close") ){							
			  if(jQuery(this).find("i").hasClass("open-magee-accordion")){ 
				  var new_class = now_class.replace('open-magee-accordion','close-magee-accordion').replace(open_icon,close_icon);
				  jQuery(this).find("i").attr("class",new_class);
				  }else{
				  var new_class = now_class.replace('close-magee-accordion','open-magee-accordion').replace(close_icon,open_icon);
				  jQuery(this).find("i").attr("class",new_class);
				  jQuery(this).parents(".panel-default").siblings().each(function(){
					  var sub_icon1 =  jQuery(this).find(".panel-title i").attr("data-open");
					  var sub_icon2 =  jQuery(this).find(".panel-title i").attr("data-close");
					  var sub_class = jQuery(this).find(".panel-title i").attr("class");
					  if( sub_icon1 && sub_icon2 && sub_class ){
					  var new_sub_class = sub_class.replace('open-magee-accordion','close-magee-accordion').replace(sub_icon1,sub_icon2);
					  jQuery(this).find(".panel-title i").attr("class",new_sub_class);															 
					  }
				  });
				  }		
			  }else{
				 jQuery(this).parents(".panel-default").siblings().each(function(){
					  var sub_icon1 =  jQuery(this).find(".panel-title i").attr("data-open");
					  var sub_icon2 =  jQuery(this).find(".panel-title i").attr("data-close");
					  var sub_class = jQuery(this).find(".panel-title i").attr("class");
					  if( sub_icon1  && sub_icon2  && sub_class ){
					  var new_sub_class = sub_class.replace('open-magee-accordion','close-magee-accordion').replace(sub_icon1,sub_icon2);
					  jQuery(this).find(".panel-title i").attr("class",new_sub_class);															 
					  }
				  });
				  }
			  });	 
  });
  
  //audio
 jQuery('.ms-audio').each(function(){
								
	jQuery(this).audioPlayer({
						classPrefix: 'audioplayer',
						strPlay: 'Play',
						strPause: 'Pause',
						strVolume: 'Volume',
						strControls : jQuery(this).data('controls'),
						strStyle : jQuery(this).data('style'),
					});							
								
								
	});
 
  //carousel 
  jQuery('.magee-carousel').each(function(){
							var carousel_owl = jQuery(this);
							var carousel_columns =  carousel_owl.data("columns");
							var carousel_itemsNum600 = (carousel_columns-2)>0?(carousel_columns-2):carousel_columns;
							var carousel_margin = carousel_columns > 1?10:0;
							 	carousel_owl.find(".owl-carousel").owlCarousel({
									loop:true,
									margin:carousel_margin,
									autoplay:(carousel_owl.data("autoplay") == 'yes'?'true':'false'),
									autoplayTimeout:carousel_owl.data("autoplaytimeout"),
									autoplayHoverPause:true,
									items:carousel_columns,
									responsiveClass:true,
									responsive:{
										0:{
											items:1,
											nav:false
										},
										600:{
											items:carousel_itemsNum600,
											nav:(carousel_owl.data("display-nav") == 'yes'?'true':'false'),
										},
										1000:{
											items:carousel_columns,
											nav:(carousel_owl.data("display-nav") == 'yes'?'true':'false'),
										}
									}
								});
								carousel_owl.find(".carousel-next").click(function(){												 
								  carousel_owl.find(".owl-carousel").trigger("next.owl.carousel");
								})
								carousel_owl.find(".carousel-prev").click(function(){
								  carousel_owl.find(".owl-carousel").trigger("prev.owl.carousel");
								});
							    carousel_owl.find(".owl-controls").addClass(carousel_owl.data("pag-style"));
  });
  
   //dailymotion
  jQuery('.magee-dailymotion').each(function(){
	dail = jQuery(this);
	if( dail.data("width") == '100%' || dail.data("width") == '' &&  dail.data("height") == '100%' || dail.data("height") == ''){
	width = dail.width();
	iframewidth = dail.find("iframe").eq(0).width();
	iframeheight = dail.find("iframe").eq(0).height();
	op = iframeheight/iframewidth;
	dail.find("iframe").eq(0).width(width-100);
	dail.find("iframe").eq(0).height(op*(width-100));		
	}
  });
  
  //document
  jQuery('.magee-document').each(function(){
    doc =  jQuery(this);
	if(doc.data("responsive") == 'yes'){
		width = doc.width();
		if(width < doc.data("width")){
		op = doc.data("height")/doc.data("width");
		doc.find("iframe").eq(0).width(width);
		doc.find("iframe").eq(0).height(op*width);
		} 			
	}
  });

  //expand
  jQuery('.magee-expand').each(function(){
	expand = jQuery(this);
	less_icon = expand.data("less-icon");
	more_icon = expand.data("more-icon");
	if(less_icon.indexOf("fa-")>=0){
	var more = '<i class="fa '+less_icon+'"></i> '+ expand.data('less-text');
	}else{
	var more = '<img src="'+less_icon+'" class="image-instead"/>'+ expand.data('less-text');
	}
	if(more_icon.indexOf("fa-")>=0){
	var less = '<i class="fa '+ more_icon +'"></i> '+ expand.data('more-text');
	}else{
	var less = '<img src="'+ more_icon +'" class="image-instead"/>'+ expand.data('more-text');
	}
	expand.find(".expand-control").toggle(
	function(){	      				  
		jQuery(this).html(more);
	},
	function(){	      				  
		jQuery(this).html(less);
	}
    );
	expand.find(".expand-control").click(function(){
	 jQuery(this).parent(".magee-expand").find(".expand-content").slideToggle(500);
	});    										 
											 
  });
  
  //heading
  jQuery(".magee-heading").each(function(){
	magee_heading = jQuery(this);	
	if(magee_heading.data("responsive") == 'yes'){
		if(jQuery(window).width() <1200){	
			newPercentage = ((jQuery(window).width() / 1200) * 100) + "%";
			jQuery(this).find(".heading-inner").css({"font-size": newPercentage});
		}	
	}
  });
  
  //image compare
  jQuery(".magee-image-compare").each(function(){
	jQuery(this).twentytwenty(
	{default_offset_pct: jQuery(this).data("pct"),
	orientation: jQuery(this).data("orientation")
	});
  });
   
  //piechart
  jQuery(".magee-chart-box").each(function(){
  piechart = jQuery(this);
							piechart.easyPieChart({
								barColor: piechart.data("barcolor"),
								trackColor: piechart.data("trackcolor"),
								scaleColor: false,
								lineWidth: 10,
								trackWidth: 10,
								size: piechart.data("size"),
								lineCap: piechart.data("linecap")
							  }); 
  
  });
  
  //vimeo
  jQuery(".vimeo-video").each(function(){
	magee_vimeo = jQuery(this);
	if( magee_vimeo.data("width") == '100%' || magee_vimeo.data("height") == '100%' && magee_vimeo.data("width") == '' || magee_vimeo.data("height") == ''){
									divwidth = magee_vimeo.width();
									width = magee_vimeo.find("iframe.magee-vimeo").width();
									height = magee_vimeo.find("iframe.magee-vimeo").height();
									op = height/width;
									magee_vimeo.find("iframe.magee-vimeo").width(divwidth-100);
									magee_vimeo.find("iframe.magee-vimeo").height(op*divwidth-100);
									}
	
  });
  
 });

jQuery(window).load(function($) {
  ////flipbox
 
 jQuery('.magee-flipbox-wrap').each(function(){
	var front_height = jQuery(this).find('.flipbox-front').outerHeight();
	var back_height = jQuery(this).find('.flipbox-back').outerHeight();
	var height = front_height>back_height?front_height:back_height;
	
	 	jQuery(this).css({'height':height});	
 });					   

 });

//heading responsive
jQuery(window).on("resize", function (){
	//heading
  jQuery(".magee-heading").each(function(){
	magee_heading = jQuery(this);	
	if(magee_heading.data("responsive") == 'yes'){
		if(jQuery(window).width() <1200){
		newPercentage = ((jQuery(window).width() / 1200) * 100) + "%";
		jQuery(this).find(".heading-inner").css({"font-size": newPercentage});
		}else{
		jQuery(this).find(".heading-inner").css({"font-size": magee_heading.data("fontsize")});
		}
		
	}	
   });  
  });						   
