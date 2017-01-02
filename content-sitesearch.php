<div class="entry-box-wrap" id="post-<?php the_ID(); ?>">
                                        <article class="entry-box" role="article">
                                        <?php if (  has_post_thumbnail() ): ?>
                                            <div class="feature-img-box">
                                                <div class="img-box figcaption-middle text-center from-top fade-in">
                                                    <a href="<?php the_permalink();?>">
                                                        <?php the_post_thumbnail();?>
                                                        <div class="img-overlay dark">
                                                            <div class="img-overlay-container">
                                                                <div class="img-overlay-content">
                                                                    <i class="fa fa-link"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>                                                 
                                            </div>
                                            <?php endif;?>
                                            <div class="entry-main">
                                                <div class="entry-header">
                                                    <a href="<?php the_permalink();?>"><h1 class="entry-title"><?php the_title();?></h1></a>
                                                </div>
                                                <div class="entry-summary">
                                                   <?php the_excerpt();?>
                                                </div>
                                                <div class="entry-footer">
                                                    <a href="<?php the_permalink();?>" class="entry-more pull-right"><?php _e("Read More","onetone");?> &gt;&gt;</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>