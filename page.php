<?php
/**
 * The template for displaying all single posts.
 *
 * @package onetone
 */

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
    <!-- Changed php -->
    <?php if (  has_post_thumbnail() ): ?>
    <div class="feature-img-box">
      <div class="img-box">
        <?php the_post_thumbnail();?>
      </div>
    </div>
    <?php endif;?>
    <!-- Changed php -->

<?php if( $enable_page_title_bar == 'yes' ):?>
  
  <section class="page-title-bar title-left no-subtitle" style="">
    <div class="container">
      <hgroup class="page-title">
        <h1>
          <?php the_title();?>
        </h1>
      </hgroup>
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
        <?php if(  $sidebar =='left' || $sidebar =='both' ):?>
        <div class="col-aside-left">
          <aside class="blog-side left text-left">
            <div class="widget-area">
              <?php get_sidebar('pageleft');?>
            </div>
          </aside>
        </div>
        <?php endif; ?>
        <?php if(  $sidebar =='right' || $sidebar =='both' ):?>
        <div class="col-aside-right">
          <?php get_sidebar('pageright');?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</article>
<?php get_footer(); ?>