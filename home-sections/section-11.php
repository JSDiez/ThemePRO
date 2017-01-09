<?php
global $onetone_animated;
 $i                   = 10 ;
 $section_title       = onetone_option( 'section_title_'.$i );
 $section_menu        = onetone_option( 'menu_title_'.$i);
 $parallax_scrolling  = onetone_option( 'parallax_scrolling_'.$i );
 $section_css_class   = onetone_option( 'section_css_class_'.$i );
 $section_content     = onetone_option( 'section_content_'.$i );
 $full_width          = onetone_option( 'full_width_'.$i );
 
  $content_model       = onetone_option( 'section_content_model_'.$i,1);
 $section_subtitle    = onetone_option( 'section_subtitle_'.$i);
 $color               = onetone_option( 'section_color_'.$i );
	
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
        <h3 class="section-subtitle"><?php echo do_shortcode($section_subtitle);?></h3>
         <?php endif;?>
         
        
        
        <div class="<?php echo $onetone_animated;?>" data-animationduration="1.2" data-animationtype="bounceIn" data-imageanimation="no">
    <div class="magee-pricing-table row  no-margin 4_columns" id="">
    <?php 
	for($j=1;$j<=4;$j++):
	
	$featured = absint(onetone_option('section_featured_'.$i.'_'.$j));
	$icon = str_replace('fa-','',esc_attr(onetone_option('section_icon_'.$i.'_'.$j)));
	$image = esc_attr(onetone_option('section_image_'.$i.'_'.$j));
	$currency = esc_attr(onetone_option('section_currency_'.$i.'_'.$j));
	$price    = esc_attr(onetone_option('section_price_'.$i.'_'.$j));
	$unit     = esc_attr(onetone_option('section_unit_'.$i.'_'.$j));
	$title    = esc_attr(onetone_option('section_title_'.$i.'_'.$j));
	$features = onetone_option('section_features_'.$i.'_'.$j);
	$button_text = onetone_option('section_button_text_'.$i.'_'.$j);
	$button_link = onetone_option('section_button_link_'.$i.'_'.$j);
	$button_target = onetone_option('section_button_target_'.$i.'_'.$j);
	
	?>
<div class="magee-pricing-box-wrap  col-md-3 no-padding">
                                            <div class="panel panel-default text-center  magee-pricing-box <?php echo $featured=='1'?'featured':'';?>">
                                                <div class="panel-heading">
                                                    <div class="pricing-top-icon">
                                                    <?php if( $image !="" ):?>
                                                    <img src="<?php echo $image ;?>" alt=""/>
                                                    <?php else:?>
                                                        <i class="fa fa-<?php echo $icon ;?>"></i>
                                                        <?php endif;?>
                                                    </div>
                                                    <h3 class="panel-title prcing-title"><?php echo $title ;?></h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="pricing-tag">
                                                        <span class="currency"><?php echo $currency ;?></span><span class="price"><?php echo $price ;?></span><span class="unit"><?php echo $unit?'/ '.$unit:'' ;?></span>
                                                    </div>
                                                    <ul class="pricing-list">
                                                    <?php
													if( $features ){
			
														  $features = explode("\n",$features);
														  foreach( $features as $feature ){
															  if( $feature != '' ){
																	echo '<li>'.$feature.'</li>';
																  }
															  }
														  
														  }
														  ?>
                                                    </ul>
                                                </div>
                                                <div class="panel-footer">
                                                    <a href="<?php echo $button_link ;?>" target="<?php echo $button_target ;?>" class="magee-btn-normal"><i class="fa fa-shopping-cart"></i> <?php echo $button_text ;?></a>
                                                </div>
                                            </div>
                                        </div>
                           <?php endfor;?>
</div></div>
        
        
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