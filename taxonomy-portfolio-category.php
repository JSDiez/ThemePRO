<?php
/**
* The sigle template file.
*
*/
get_header(); 
$related_number = absint(onetone_option('related_number','8'));
   
$left_sidebar   = onetone_option('left_sidebar_portfolio_archive');
$right_sidebar  = onetone_option('right_sidebar_portfolio_archive');
$aside          = 'no-aside';
if( $left_sidebar !='' )
$aside          = 'left-aside';
if( $right_sidebar !='' )
$aside          = 'right-aside';
if(  $left_sidebar !='' && $right_sidebar !='' )
$aside          = 'both-aside';

?>
<div id="portfolio-cat">
<section class="page-title-bar title-left no-subtitle" style="">
            <div class="container">
                <hgroup class="page-title">
                    <h1><?php single_cat_title();?></h1>
                </hgroup>
                <?php onetone_get_breadcrumb(array("before"=>"<div class=''>","after"=>"</div>","show_browse"=>false,"separator"=>'','container'=>'div'));?> 
                <div class="clearfix"></div>            
            </div>
        </section>
<div class="post-wrap">
            <div class="container">
                <div class="post-inner row <?php echo $aside; ?>">
                    <div class="col-main">
                        <section class="post-main" role="main" id="content">
                         <?php if (have_posts()) : ?>
                     <?php
							$items  = "" ;
							$i      = 1 ;
							$result = "" ;
							while ( have_posts() ) : the_post(); 
							$portfolio_image = "";
							if (has_post_thumbnail( get_the_ID()) ): 
							$thumb = get_the_post_thumbnail( get_the_ID() , "portfolio-grid-thumb" ); 
							//$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
							//$portfolio_image = $image[0];
							endif;
							
							$tags = get_the_tags(get_the_ID());
	   $tags_list = '<ul>';
	   if(is_array($tags)){
	   foreach ( $tags as $tag ) {
		  $tag_link   = get_tag_link( $tag->term_id );
		  $tags_list .= "<li><a href='{$tag_link}' title='{$tag->name}' class='{$tag->slug}'>";
		  $tags_list .= "{$tag->name}</a></li>";
	     }
	   }
	  $tags_list .= '</ul>';
	   $items  .=  '<div class="portfolio-col col-sm-4"><div class="portfolio-box text-center">';
	   $items  .=  '<a href="'.get_permalink().'">';
	   $items  .= $thumb;
	   $items  .=  '</a>'; 
					
	  $items  .=  '<div class="portfolio-box-title"><a href="'.get_permalink().'"><h3>'.get_the_title().'</h3></a>
	  									'.$tags_list.'
									</div>
								</div>
							</div>';

						if($i%3 == 0){
							$result .=  '<div class="row">'.$items.'</div>';
							$items   = "";
							}
						$i++;
					  endwhile;
					  if($items != "")
					  $result = $result.'<div class="row">'.$items.'</div>';
					  
					  echo  $result;
					  ?>

					<div class="list-pagition text-center">
						<?php onetone_native_pagenavi("echo",$wp_query);?>	
					</div>
                    <?php else:?>
                    <div style="width:100%; text-align:center; margin-bottom:30px;">
                    <?php _e("Nothing found.","onetone");?>
                    </div>
                    <?php endif; ?>
                            
                        </section>
                    </div>
                    <?php if( $left_sidebar !='' ):?>
                    <div class="col-aside-left">
                        <aside class="blog-side left text-left">
                             <?php get_sidebar('portfolioleft');?> 
                        </aside>
                    </div>
                    <?php endif; ?>
                    <?php if( $right_sidebar !='' ):?>
                    <div class="col-aside-right">
                        <?php get_sidebar('portfolioright');?>
                    </div>
                     <?php endif; ?>
                </div>
            </div>  
        </div>

</div>
<?php get_footer(); ?>