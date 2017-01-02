<?php /* Template Name: Empresa Template Profile */

  get_header('pagedefault');

?>
  <link href='http://fonts.googleapis.com/css?family=Droid+Serif|Open+Sans:400,700' rel='stylesheet' type='text/css'>

  <?php 
    echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/vertical-timeline-style.css">';
    echo '<script src="'.get_template_directory_uri().'/js/vertical-timeline-modernizr.js"></script>';
    ?>
<script type="text/javascript">
  jQuery(document).ready(function () {

    jQuery('#anchor_empresa').addClass('active');
    jQuery('.expanded-view').hide();

    jQuery('.interstitial').click(function (){
      if (jQuery(this).hasClass('col-lg-6')) {
        jQuery('.interstitial').addClass('col-lg-3');
        jQuery('.interstitial').removeClass('col-lg-2');
        jQuery('.interstitial').removeClass('col-lg-6');
        jQuery('.expanded-view').hide();
        jQuery(this).children('.chopped-view').show();
      }else{
        jQuery('.expanded-view').find('.text-overlay').hide();
        jQuery('.interstitial').addClass('col-lg-2');
        jQuery('.interstitial').removeClass('col-lg-3');
        jQuery('.interstitial').removeClass('col-lg-6');
        jQuery(this).addClass('col-lg-6');
        jQuery(this).removeClass('col-lg-2');
        jQuery('.chopped-view').show();
        jQuery('.expanded-view').hide();
        jQuery(this).children('.chopped-view').hide();
        jQuery(this).children('.expanded-view').show('100',function (){
          jQuery(this).find('.text-overlay').fadeIn( "slow");
        });
      }

    });
  });

</script>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="entry-content">
    <?php $url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID ()));
        $bkg = ($url) ? 'style="background-image:url('.$url.')"' : '';
    ?>

    <div class="header-page header-empresa" <?=$bkg?>>
      <div><h1><?php echo the_title();?></h1></div>
    </div>

    <?php $post = get_post();
      echo $post->post_content;
    ?>

     </div>
      <div class="container">
        <div class="row">
        <div class="col-md-12">
            <section class="cd-horizontal-timeline">
              <div class="timeline">
                <div class="events-wrapper">
                  <div class="events">
                    <ol>
                      <?php //obtencion del history
                        query_posts(array(
                        'post_type' => 'histories',
                        'order'=>'ASC',
                        'orderby'=> 'title',
                        'posts_per_page' => -1
                        ));

                        $i=0;
                        $content='';
                        while (have_posts()) {
                          the_post();
                          $title = get_the_title();
                          $i++;
                          $clase = ($i == 1) ? 'class="selected"' : '';
                          echo '<li><a href="#0" data-date="'.$title.'" '.$clase.'>'.substr($title, -4).'</a></li>';

                          $content.= '<li '.$clase.' data-date="'.$title.'">'.get_the_content().'</li>';
                        }
                      ?>

                    </ol>

                    <span class="filling-line" aria-hidden="true"></span>
                  </div> <!-- .events -->
                </div> <!-- .events-wrapper -->

                <ul class="cd-timeline-navigation">
                  <li><a href="#0" class="prev inactive">Prev</a></li>
                  <li><a href="#0" class="next">Next</a></li>
                </ul> <!-- .cd-timeline-navigation -->
              </div> <!-- .timeline -->

              <div class="events-content">
                <ol>
                  <?=$content;?>
                </ol>
              </div> <!-- .events-content -->
            </section>

          <?php //obtencion del history
                                  query_posts(array(
                                  'post_type' => 'histories',
                                  'order'=>'ASC',
                                  'orderby'=> 'title',
                                  'posts_per_page' => -1
                                  ));

                                  $i=0;
                                  $content_2='';
                                  while (have_posts()) {
                                    the_post();
                                    $title = get_the_title();
                                    $i++;
                                    

                                    $content_2.= '    <div class="cd-timeline-vertical-block">


                <div class="cd-timeline-vertical-content">
                  <h3>'.substr($title, -4).'</h3>
                  <p>'.get_the_content().'</p>
                  
                </div> <!-- cd-timeline-content -->
              </div> <!-- cd-timeline-vertical-block -->';
                                  }
                      ?>

<section id="cd-timeline-responsive" class="cd-container">
    <?=$content_2;?>
  </section> <!-- cd-timeline -->
        </div>
        </div>
      </div>
  </article>
    <?php
      echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/timeline.js"></script>';
      echo '<script src="'.get_template_directory_uri().'/js/vertical-timeline-main.js"></script>';

      get_footer();
    ?>