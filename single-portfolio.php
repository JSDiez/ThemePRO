<?php
/**
* The sigle template file.
*
*/
get_header(); 
$related_number = absint(onetone_option('related_number','8'));
   
$left_sidebar   = onetone_option('left_sidebar_portfolio_posts');
$right_sidebar  = onetone_option('right_sidebar_portfolio_posts');
$aside          = 'no-aside';
if( $left_sidebar !='' )
$aside          = 'left-aside';
if( $right_sidebar !='' )
$aside          = 'right-aside';
if(  $left_sidebar !='' && $right_sidebar !='' )
$aside          = 'both-aside';

?>
<div id="portfolio-<?php the_ID(); ?>" <?php post_class("clear"); ?>>
<section class="page-title-bar title-left no-subtitle" style="">
            <div class="container">
                <hgroup class="page-title">
                    <h1><?php the_title();?></h1>
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
                         <?php if (have_posts()) :?>
						  <?php	
                          while ( have_posts() ) : the_post();
                          ?>
                            <article class="portfolio type-portfolio" id="">
                            
								<?php    
										  $galleryArray = get_post_gallery_ids( get_the_ID() ); 
										  
										  if( count( $galleryArray ) >0 && $galleryArray[0] != "" ):
									?>
      
                                <div class="post-slider">
                                    <!--slider-->
                                    <div id="portfolio-carousel" class="carousel slide" data-ride="carousel">
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox" style=" ">
                                        
                                           <?php
										    $i = 0 ;
											 foreach ($galleryArray as $id) { 
											 ?>
                                            <div class="item <?php echo $i==0?'active':'';?>">
                                                <img src="<?php echo wp_get_attachment_url( $id ); ?>" alt="" />
                                            </div>
                                            <?php 
											$i++;
											}
											?>
                                        </div>
                                        <!-- Controls -->
                                        <div class="multi-carousel-nav style1 nav-bg">
                                            <a class="" href="#portfolio-carousel" role="button" data-slide="prev">
                                                <span class="multi-carousel-nav-prev"></span>
                                            </a>
                                            <a class="" href="#portfolio-carousel" role="button" data-slide="next">
                                                <span class="multi-carousel-nav-next"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <!--slider end-->
                                </div>
                                <?php endif ; ?>
                                <div class="entry-main">
                                    <div class="entry-header">                                            
                                        <h1 class="entry-title"><?php the_title();?></h1>
                                    </div>
                                    <div class="entry-content">
                                        <?php the_content();?>
                                    </div>
                                    <div class="entry-footer">
  
                                        <?php

										$taxonomy = 'portfolio-tag';
										$tax_terms = wp_get_post_terms($post->ID,$taxonomy);
										
										if( $tax_terms ){?>
                                        <ul class="entry-tags no-border pull-left">
										<?php _e('Tags','onetone');?>: 
                                        <?php 
										foreach ($tax_terms as $tax_term) {
										echo '<li><a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ,'onetone'), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
										} ?>
										
										</ul>
										<?php 
										}
										?>
                                        
                                    </div>
                                </div>
                            </article>
                           <?php endwhile;?>
                            <?php endif;?>
                            <div class="post-attributes">
                                <!--Related Projects-->
                                
                          <?php 
								
								$related = onetone_get_related_posts($post->ID, $related_number,'portfolio','portfolio-category'); 
											  
									?>
			                        <?php if($related->have_posts()): 
									        $date_format = onetone_option('date_format','M d, Y');
											
									?>
            
                                    <div class="related-posts">
                                        <h3><?php _e( 'Related Project', 'onetone' );?></h3>
                                        <div id="related-portfolio" class="multi-carousel onetone-related-posts owl-carousel owl-theme">
                                        
                            <?php while($related->have_posts()): $related->the_post(); ?>
                            
							<?php if(has_post_thumbnail()): ?>
                            <?php  $full_image  = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); 
							        $thumb_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'related-post');
							?>
                                            <div class="owl-item">
											<div class="portfolio-box">
                                                                <div class="feature-img-box">
                                                                    <div class="img-box figcaption-middle text-center from-top fade-in">
                                                                        <img src="<?php echo $thumb_image[0];?>" class="feature-img"/>
                                                                        <div class="img-overlay">
                                                                            <div class="img-overlay-container">
                                                                                <div class="img-overlay-content">
                                                                                    <div class="img-overlay-icons">
                                                                                       <a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
                                                                                       <a rel="portfolio-image" href="<?php echo $full_image[0];?>"><i class="fa fa-search"></i></a>                                                                                    </div>         
                                                                                </div>
                                                                            </div>                                        
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="entry-main text-center">
                                                                    <div class="entry-header">
                                                                        <a href="<?php the_permalink(); ?>"><h1 class="entry-title"><?php the_title(); ?></h1></a>
                                                                    </div>
                                                                    <div class="entry-meta">
                                                                        <div class="entry-category">
														<?php
														$taxonomy = 'portfolio-tag';
														$tax_terms = wp_get_post_terms($post->ID,$taxonomy);
														$tags      = array();
														if( $tax_terms ){
														foreach ( $tax_terms as $tax_term ) {
														$tags[] = '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ,'onetone'), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a>';
														}
														}
														$tags = implode(', ',$tags);
														echo $tags;
														?>
																		</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                            
                                                            </div>
                                                            
                                            <?php endif; endwhile; ?>
                                        </div>
                                    </div>
                                    <?php wp_reset_postdata(); endif; ?>
                                <!--Related Posts End-->
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

                                <?php echo onetone_post_nav();?>  

                            </div>
                            
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