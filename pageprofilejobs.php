<?php /* Template Name: Profile: Jobs Template */

get_header(); 
global $page_meta;
$detect  = new Mobile_Detect;
$enable_page_title_bar     = onetone_option('enable_page_title_bar');
$page_title_bg_parallax    = esc_attr(onetone_option('page_title_bg_parallax','no'));
$page_title_bg_parallax    = $page_title_bg_parallax=="yes"?"parallax-scrolling":"";
$display_breadcrumb        = esc_attr(onetone_option('display_breadcrumb','yes'));
$breadcrumbs_on_mobile     = esc_attr(onetone_option('breadcrumbs_on_mobile_devices','yes'));
$breadcrumb_menu_prefix    = esc_attr(onetone_option('breadcrumb_menu_prefix',''));
$breadcrumb_menu_separator = esc_attr(onetone_option('breadcrumb_menu_separator','/'));

$sidebar                   = isset($page_meta['page_layout'])?$page_meta['page_layout']:'none';
$left_sidebar              = isset($page_meta['left_sidebar'])?$page_meta['left_sidebar']:'';
$right_sidebar             = isset($page_meta['right_sidebar'])?$page_meta['right_sidebar']:'';
$full_width                = isset($page_meta['full_width'])?$page_meta['full_width']:'no';
$display_breadcrumb        = isset($page_meta['display_breadcrumb'])?$page_meta['display_breadcrumb']:$display_breadcrumb;
$display_title             = isset($page_meta['display_title'])?$page_meta['display_title']:'yes';
$padding_top               = isset($page_meta['padding_top'])?$page_meta['padding_top']:'';
$padding_bottom            = isset($page_meta['padding_bottom'])?$page_meta['padding_bottom']:'';

$enable_page_title_bar     = (isset($page_meta['display_title_bar']) && $page_meta['display_title_bar']!='')?$page_meta['display_title_bar']:$enable_page_title_bar;

if( $full_width  == 'no' )
 $container = 'container';
else
 $container = 'container-fullwidth';
 
$aside          = 'no-aside';
if( $sidebar =='left' )
$aside          = 'left-aside';
if( $sidebar =='right' )
$aside          = 'right-aside';
if(  $sidebar =='both' )
$aside          = 'both-aside';

$container_css = '';
if( $padding_top )
$container_css .= 'padding-top:'.$padding_top.';';
if( $padding_bottom )
$container_css .= 'padding-bottom:'.$padding_bottom.';';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
    <?php if (  has_post_thumbnail() ): ?>
    <div class="feature-img-box">
      <div class="img-box">
        <?php the_post_thumbnail();?>
      </div>
    </div>
    <?php endif;?>

<?php if( $enable_page_title_bar == 'yes' ):?>
  
  <section class="page-title-bar title-left no-subtitle" style="">
    <div class="container">
      <div class="page-title">
        <h1 class="text-center"><?php the_title();?></h1>
      </div>
      <?php if( $display_breadcrumb == 'yes' && !$detect->isMobile() ):?>
      <?php onetone_get_breadcrumb(array("before"=>"<div class=''>".$breadcrumb_menu_prefix,"after"=>"</div>","show_browse"=>false,"separator"=>$breadcrumb_menu_separator,'container'=>'div'));?>
       <?php endif;?>
       
       <?php if( $breadcrumbs_on_mobile == 'yes' && $detect->isMobile()):?>
      <?php onetone_get_breadcrumb(array("before"=>"<div class=''>".$breadcrumb_menu_prefix,"after"=>"</div>","show_browse"=>false,"separator"=>$breadcrumb_menu_separator,'container'=>'div'));?>
       <?php endif;?>
       
      <div class="clearfix"></div>
    </div>
  </section>
 
  <?php endif;?>
  <div class="post-wrap">
    <div class="<?php echo $container;?>">
      <div class="post-inner row <?php echo $aside; ?>" style=" <?php echo $container_css;?>">
        <div class="col-main">
          <section class="post-main" role="main" id="content">
            <?php while ( have_posts() ) : the_post(); ?>
            <article class="post type-post" id="" role="article">
              <div class="entry-main">
            
                <div class="entry-content">
                  <?php the_content();?>
                  <?php
                    wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'onetone' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
                  ?>
                  
                  <section class="job-container pvm">
                  	<div class="container">
                  		<h1 class="content-title"><?php _e("[:es]Ofertas de trabajo[:en]Job offers"); ?></h1>
                  		<div class="row mbs">
	                  		<h2 class="title-tagline col-sm-6 col-xs-12"><?php _e("[:es]Éstas son nuestras vacantes actuales[:en]These are our current vacancies."); ?></h2>                 		

							<div id="location-job-filter" class="input-group pull-right">
							    <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
								<select class="form-control">
									<option value="">Filtra por localización</option>
									<option value="barcelona">Barcelona</option>
									<option value="madrid">Madrid</option>
									<option value="sevilla">Sevilla</option>
								</select>
							</div>
						</div>

                    <?php
                      function CallAPI($url) {
                          $curl = curl_init();

                          $client_id = 'ead3a0c7c59f4d1d81143fa9d2277147';
                          $client_secret = 'ZHiblujqhKzcziPMY+v2sRl6C9a7vt9mxmKFHWUVhURJHuIVaR';

                          curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                          curl_setopt($curl, CURLOPT_USERPWD, $client_id . ':' . $client_secret);
                          curl_setopt($curl, CURLOPT_URL, $url);
                          curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

                          $result = curl_exec($curl);
                          curl_close($curl);

                          return $result;
                      }
                  
                      $array = json_decode(CallAPI('https://api.infojobs.net/api/1/offer?employerId=9664852452652250253012575553'))->offers;
                      //print_r($array);
                      //print_r($array[0]);
                  
                      $urls = array();
                      for($i=0; $i<count($array); $i++){   
                          array_push($urls, 'https://api.infojobs.net/api/1/offer/' . $array[$i]->id);
                      }
                  
                      $url_count = count($urls);
                      $curl_array = array();
                      $ch = curl_multi_init();

                      foreach($urls as $count => $url) {
                          $curl_array[$count] = curl_init($url);
                          $client_id = 'ead3a0c7c59f4d1d81143fa9d2277147';
                          $client_secret = 'ZHiblujqhKzcziPMY+v2sRl6C9a7vt9mxmKFHWUVhURJHuIVaR';
                          curl_setopt($curl_array[$count], CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                          curl_setopt($curl_array[$count], CURLOPT_USERPWD, $client_id . ':' . $client_secret);
                          curl_setopt($curl_array[$count], CURLOPT_RETURNTRANSFER, 1);
                          curl_multi_add_handle($ch, $curl_array[$count]);
                      }
                  
                      do {
                        curl_multi_exec($ch, $exec);
                      } while($exec > 0);
                     

                      /* Dynamic select with job´s provinces
                      echo '<select class="country">
							<option value="">Filtra por porvincia</option>';
							foreach($urls as $count => $url) {
                          		$returned = json_decode(curl_multi_getcontent($curl_array[$count]));

								$provinceArray = array();
								$provinceValue = $returned->province->value;
								if (isset($provinceArray[$provinceValue])) {echo $provinceValue;
								} else {
								echo '<option value="'.strtolower($returned->province->value).'">'.$returned->province->value.'</option>';
								};
							}
						echo '</select>';
						*/

                      echo '<div class="offers-list grid-divider">';
                      foreach($urls as $count => $url) {
                          if( $count % 2 == 0) {
                          	$jobPos = 'item-left';
                          } else {
                          	$jobPos = 'item-right';                          	
                          }
                          $returned = json_decode(curl_multi_getcontent($curl_array[$count]));
                          echo '<a href="' . $returned->link . '" target="_blank" id="job-offer-'.$count.'" class="job-item col-sm-6 col-xs-12 ' . strtolower($returned->province->value) .' '.$jobPos.'">
                          		<div class="col-padding">
                                <div class="job-location"><i class="fa fa-map-marker"></i>' . $returned->city . ' (' . $returned->province->value . ')</div>
                                <h3>' . $returned->title  . '</h3>
                                <span class="job-extra"> Jornada ' . $returned->journey->value;

                          if ($returned->contractType->value == "(Seleccionar)") { //SI no ha sido definidio tipo en infojobs
                             echo '</span>';
                          }
                          else{
                            echo ' / Contrato ' . $returned->contractType->value . '</span>';
                          }
                          echo '<p class="job-description">' . preg_replace('/[\x00-\x08\x10\x0B\x0C\x0E-\x19\x7F]'.
                                '|[\x00-\x7F][\x80-\xBF]+'.
                                '|([\xC0\xC1]|[\xF0-\xFF])[\x80-\xBF]*'.
                                '|[\xC2-\xDF]((?![\x80-\xBF])|[\x80-\xBF]{2,})'.
                                '|[\xE0-\xEF](([\x80-\xBF](?![\x80-\xBF]))|(?![\x80-\xBF]{2})|[\x80-\xBF]{3,})/S',
                                '?', substr($returned->description, 0, 155)) . '...</p>'.
                          		'<span class="btn btn-ghost">';
                          		_e('[:es]Más información[:en]More info');
                          		echo '</span>';
                          echo '</div>';
                          echo '</a>';
                          if( ($count+1) % 2 == 0) {
                          	echo '<p class="clear"></p>';
                          }
                      }

                      echo '</div>';
                    ?>
                    </div>
                    </section>

                    <section id="job-form" class="bg-light-grey pvm brd2">
	                    <div class="container">
	                      <?php echo do_shortcode('[contact-form-7 id="203" title="Job form general"]') ?>
	                    </div>
                    </section>
                  </div>
                </div>                
              </div>
            </article>

            <div class="post-attributes">
              <!--Comments Area-->
              <div class="comments-area text-left">
                <?php
            // If comments are open or we have at least one comment, load up the comment template
            if ( comments_open()  ) :
              comments_template();
            endif;
          ?>
              </div>
              <!--Comments End-->
            </div>
            <?php endwhile; // end of the loop. ?>
          </section>
        </div>


      </div>
    </div>
  </div>
</article>

<?php get_footer(); ?>