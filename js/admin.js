jQuery(document).ready(function($){

$('.onetone_shortcodes,.onetone_shortcodes_textarea').magnificPopup({
  items: {
      src: '#onetone_shortcodes_container',
      type: 'inline'
  }
});

$(document).on('click','.onetone_shortcodes,.onetone_shortcodes_textarea',function(){
			 $("#onetone_shortcodes_container").show();																 
        });

$('.onetone_shortcodes_textarea').on("click",function(){
			var id = $(this).next().find("textarea").attr("id");
			jQuery('#onetone-shortcode-textarea').val(id);
		});																	   

$('.onetone_shortcodes_list li a.onetone_shortcode_item').on("click",function(){
													  
  var obj       = $(this);
  var shortcode = obj.data("shortcode");
  var form      = obj.parents("div#onetone_shortcodes_container form");
  
   $.ajax({
		type: "POST",
		url: onetone_params.ajaxurl,
		dataType: "html",
		data: { shortcode: shortcode, action: "onetone_shortcode_form" },
		success:function(data){
	
		   form.find(".onetone_shortcodes_list").hide();
		   form.find("#onetone-shortcodes-settings").show();
		   form.find("#onetone-shortcodes-settings .current_shortcode").text(shortcode);
		   form.find("#onetone-shortcodes-settings-inner").html(data);
		}
		});
	
});

$(".onetone-shortcodes-home").bind("click",function(){
            $("#onetone-shortcodes-settings").hide();
		    $("#onetone-shortcodes-settings-innter").html("");
		    $(".onetone_shortcodes_list").show();
		   
		});
		
// insert shortcode into editor
$(".onetone-shortcode-insert").bind("click",function(e){

    var obj       = $(this);
	var form      = obj.parents("div#onetone_shortcodes_container form");
	var shortcode = form.find("input#onetone-curr-shortcode").val();

	$.ajax({
		type: "POST",
		url: onetone_params.ajaxurl,
		dataType: "html",
		data: { shortcode: shortcode, action: "onetone_get_shortcode",attr:form.serializeArray()},
		
		success:function(data){
		
		$.magnificPopup.close();
		form.find("#onetone-shortcodes-settings").hide();
		form.find("#onetone-shortcodes-settings-innter").html("");
		form.find(".onetone_shortcodes_list").show();
        form.find(".onetone-shortcode").val(data);
		if($('#onetone-shortcode-textarea').val() !="" ){
			var textarea = $('#onetone-shortcode-textarea').val();
			if(textarea !== "undefined"){
		    var position = $("#"+textarea).getCursorPosition();
			var content = $("#"+textarea).val();
            var newContent = content.substr(0, position) + data + content.substr(position);
            $("#"+textarea).val(newContent);
			
			}
			}else{
		window.onetone_wpActiveEditor = window.wpActiveEditor;
		// Insert shortcode
		window.wp.media.editor.insert(data);
		// Restore previous editor
		window.wpActiveEditor = window.onetone_wpActiveEditor;
		}
		},
		error:function(){
			$.magnificPopup.close();
		// return false;
		}
		});
		// return false;
   });

 //preview shortcode

$(".onetone-shortcode-preview").bind("click",function(e){

    var obj       = $(this);
	var form      = obj.parents("div#onetone_shortcodes_container form");
	var shortcode = form.find("input#onetone-curr-shortcode").val();

	$.ajax({
		type: "POST",
		url: onetone_params.ajaxurl,
		dataType: "html",
		data: { shortcode: shortcode, action: "onetone_get_shortcode",attr:form.serializeArray()},
		
		success:function(data){
      
		$.ajax({type: "POST",url: onetone_params.ajaxurl,dataType: "html",data: { shortcode: data, action: "onetone_shortcode_preview"},	
		success:function(content){
			$("#onetone-shortcode-preview").html(content);
	        tb_show(shortcode + " preview","#TB_inline?width=600&amp;inlineId=onetone-shortcode-preview",null);
			}
		});
	
		},
		error:function(){
			
		// return false;
		}
		});
		// return false;
   });

/* ------------------------------------------------------------------------ */
/*  section accordion         	  								  	    */
/* ------------------------------------------------------------------------ */
								
$('.section-accordion').click(function(){
 var accordion_item = $(this).find('.heading span').attr('id');
 //$('.'+accordion_item).slideToggle();
 if( $(this).hasClass('close')){
	 $(this).removeClass('close').addClass('open');
	 $(this).find('.heading span.fa').removeClass('fa-plus').addClass('fa-minus');
	 }else{
		$(this).removeClass('open').addClass('close'); 
		$(this).find('.heading span.fa').removeClass('fa-minus').addClass('fa-plus');
		 }
	 $(this).parent('.section').find('.section_wrapper').slideToggle();   
	 })	;

// select section content model

$('.section-content-model').each(function(){
   
   var model = $(this).find('input[type="radio"]:checked').val();
   if( model == 0 ){
	   $(this).parents('.home-section').find('.content-model-0').show();
	   $(this).parents('.home-section').find('.content-model-1').hide();
   }
   else
   {
	   $(this).parents('.home-section').find('.content-model-0').hide();
       $(this).parents('.home-section').find('.content-model-1').show();
	   }
										  
 });

  $( '.section-content-model input[type="radio"]' ).change(function() {
       var model = $(this).val();
   if( model == 0 ){
	   $(this).parents('.home-section').find('.content-model-0').show();
	   $(this).parents('.home-section').find('.content-model-1').hide();
   }
   else
   {
	   $(this).parents('.home-section').find('.content-model-0').hide();
       $(this).parents('.home-section').find('.content-model-1').show();
	   }
  });
  $('.section_wrapper').each(function(){
	  $(this).children(".content-model-0:first").addClass('model-item-first');
	  $(this).children(".content-model-0:last").addClass('model-item-last');   
  });


/* ------------------------------------------------------------------------ */
/*  delete section             	  								  	    */
/* ------------------------------------------------------------------------ */
 $('#optionsframework').on('click','.delete-section',function(){
	$(this).parents('.home-section').remove();	
	var i = 0;
	 $('.home-section').each(function(){
			$(this).find("[name^='onetone']").each(function(){
				var name = $(this).attr('name');
				var id   = $(this).attr('id');
				var new_name = name.replace(/[0-9]+/, i);
				var new_id   = id.replace(/[0-9]+/, i);
				$(this).attr('name',new_name);
				$(this).attr('id',new_id);
               });
			i++;
			$('#section_num').val(i);
	   });
  });


/////
 
/*  if( $('.onetone-step-2-text').length ){
 $('#menu-appearance > a').append($('#onetone-step-1-text').html());
 $('.onetone-step-2-text').closest('li').addClass('onetone-step-2');
 }*/
  // save options
  
  $(function(){
          //Keep track of last scroll
          var lastScroll = 0;
          $(window).scroll(function(event){
              //Sets the current scroll position
              var st = $(this).scrollTop();

              //Determines up-or-down scrolling
              if (st > lastScroll){
                $(".onetone-admin-footer").css("display",'inline')
              } 
              if(st == 0){
                $(".onetone-admin-footer").css("display",'none')
              }
              //Updates scroll position
              lastScroll = st;
          });
        });
 
$(document).on('click','#onetone-save-options',function(){
         $('.options-saving').fadeIn("fast");
	$.post('options.php',$('#optionsframework form').serialize(),function(msg){
         $('.options-saving').fadeOut("fast");
		 $('.options-saved').fadeIn("fast", function() {
		   $(this).delay(2000).fadeOut("slow");
		});
	  return false;
    });													
   });



 });