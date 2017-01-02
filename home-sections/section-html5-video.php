<?php
$video_background_section  = onetone_option( 'video_background_section' );
 $i                   = $video_background_section-1 ;
 $section_title       = onetone_option( 'section_title_'.$i );
 $section_menu        = onetone_option( 'menu_title_'.$i );
 $parallax_scrolling  = onetone_option( 'parallax_scrolling_'.$i );
 $section_css_class   = onetone_option( 'section_css_class_'.$i );
 $section_content     = onetone_option( 'section_content_'.$i );
 $full_width          = onetone_option( 'full_width_'.$i );
 
 $section_subtitle    = onetone_option( 'section_subtitle_'.$i );
 $mp4_video_url       = onetone_option( 'mp4_video_url' );
 $ogv_video_url       = onetone_option( 'ogv_video_url' );
 $webm_video_url      = onetone_option( 'webm_video_url' );
 $poster_url          = onetone_option( 'poster_url' );
 $video_loop          = onetone_option( 'video_loop' );
 $video_volume        = onetone_option( 'video_volume' );
 $video_volume        = $video_volume == "" ? 0.8 : $video_volume ;
	
  if( !isset($section_content) || $section_content=="" ) 
  $section_content = onetone_option( 'sction_content_'.$i );
  
  $section_id      = sanitize_title( onetone_option( 'menu_slug_'.$i ,'section-'.($i+1) ) );
  if( $section_id == '' )
   $section_id = 'section-'.($i+1);
  
  $container_class = "container";
  if( $full_width == "yes" ){
  $container_class = "";
  }
 if( $parallax_scrolling == "yes" || $parallax_scrolling == "1" ){
	 $section_css_class  .= ' onetone-parallax';
  }
?>
<section id="<?php echo $section_id; ?>" class="section home-section-<?php echo $video_background_section;?> <?php echo $section_css_class;?> onetone-html5-section video-section">
 <?php get_template_part('home-sections/section',$video_background_section);?>
  <div class="clear"></div>
  <?php 
	
		 $header_cover_video_background_html5 = onetone_option( "header_cover_video_background_html5" ,1);
		 if( $video_loop == 1 ){
		    $video_loop = "true";
		  }
		else{
		    $video_loop = "false";	
			}
	
		 echo '<script type="text/javascript" src="'.get_template_directory_uri().'/plugins/jquery-ui.min.js"></script>';
		 echo '<script type="text/javascript" src="'.get_template_directory_uri().'/plugins/video.js"></script>';
		 echo '<script type="text/javascript" src="'.get_template_directory_uri().'/plugins/bigvideo.js"></script>'; 
		 
		 echo '<script type="text/javascript" > 
		    var BV;
            var BV = new jQuery.BigVideo({
				useFlashForFirefox:false,
				forceAutoplay:true,
				controls:false,
				doLoop:'.$video_loop.',
				';
				if( $header_cover_video_background_html5 == '0'){
					echo 'container:jQuery(".onetone-html5-section")';
				}
			echo '});
			BV.init();';
			
		//	echo 'if (Modernizr.touch) { BV.show("'.$poster_url.'"); } else {';
			
			echo 'BV.show(
				[
					{ type: "video/mp4",  src: "'.$mp4_video_url.'" },
					{ type: "video/webm", src: "'.$webm_video_url.'" },
					{ type: "video/ogg",  src: "'.$ogv_video_url.'" }
				],{ambient:'.$video_loop.'});
				BV.getPlayer().volume('.$video_volume.');
				BV.getPlayer().on("durationchange",function(){jQuery("#big-video-wrap").fadeIn();});';
	
		//echo '}';
		
	  echo '</script>';
	  wp_localize_script( 'onetone-default', 'onetone_video',array('header_cover_video_background_html5'=>$header_cover_video_background_html5));

	 ?>
</section>