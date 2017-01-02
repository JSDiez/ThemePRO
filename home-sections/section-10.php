<?php
global $onetone_animated;
 $i                   = 9 ;
 $section_title       = onetone_option( 'section_title_'.$i );
 $section_menu        = onetone_option( 'menu_title_'.$i );
 $parallax_scrolling  = onetone_option( 'parallax_scrolling_'.$i );
 $section_css_class   = onetone_option( 'section_css_class_'.$i );
 $section_content     = onetone_option( 'section_content_'.$i );
 $full_width          = onetone_option( 'full_width_'.$i );
 
 $content_model       = onetone_option( 'section_content_model_'.$i,1);
 $section_subtitle    = onetone_option( 'section_subtitle_'.$i );
 $color               = onetone_option( 'section_color_'.$i );
 $columns             = absint(onetone_option('section_columns_'.$i));
 $col                 = $columns>0?12/$columns:4;
 $posts_num           = absint(onetone_option('section_posts_num_'.$i));
	
  if( !isset($section_content) || $section_content=="" ) 
  $section_content = onetone_option( 'sction_content_'.$i );
  
  $section_id      = sanitize_title( onetone_option( 'menu_slug_'.$i ,'section-'.($i+1) ) );
  if( $section_id == '' )
   $section_id = 'section-'.($i+1);
  
  $section_id  = strtolower( $section_id );
  
  $container_class = "container";
  if( $full_width == "yes" ){
  $container_class = "";
  }
  
  if( $parallax_scrolling == "yes" || $parallax_scrolling == "1" ){
	 $section_css_class  .= ' onetone-parallax';
  }
  
?>
<section id="<?php echo $section_id; ?>" class="section home-section-<?php echo ($i+1); ?> <?php echo $section_css_class;?>">
    	<div class="home-container <?php echo $container_class; ?> page_container">
		<?php
		if( $content_model == '0' ):
		?>
        <div style="color:<?php echo $color; ?>;">
         <?php if( $section_title != '' ):?>
       <?php  
		   $section_title_class = '';
		   if( $section_subtitle == '' )
		   $section_title_class = 'no-subtitle';
		?>
       <h1 class="section-title <?php echo $section_title_class; ?>"><?php echo $section_title; ?></h1>
        <?php endif;?>
        <?php if( $section_subtitle != '' ):?>
        <div class="section-subtitle"><?php echo do_shortcode($section_subtitle);?></div>
         <?php endif;?>
         
         <div class="<?php echo $onetone_animated;?>" data-animationduration="0.9" data-animationtype="fadeIn" data-imageanimation="no">
          <?php
	     echo do_shortcode('[ms_portfolio num="'.$posts_num.'" category="" layout="grid" style="1" columns="'.$columns.'" overlay_content="1" overlay_color="" overlay_opacity="0.5" orientation="top" page_nav="no" filter="yes" offset="" exclude_category="" align="left" display_title="yes" display_tags="yes" display_excerpt="yes" excerpt_length="" strip ="yes" class="" id=""]');

	  ?>      
         </div>
          </div>
            <?php
		else:
		?>
        <?php if( $section_title != '' ):?>
        <h2 class="section-title"><?php echo do_shortcode($section_title);?></h2>
        <?php endif;?>
           
            <div class="home-section-content">
            <?php 
			if(function_exists('Form_maker_fornt_end_main'))
             {
                 $section_content = Form_maker_fornt_end_main($section_content);
              }
			 echo do_shortcode($section_content);
			?>
            </div>
            <?php 
		endif;
		?>
        </div>
  <div class="clear"></div>
</section>