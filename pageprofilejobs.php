<?php /* Template Name: Jobs Template Profile */
  get_header('pagedefault');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="entry-content">
    <?php $url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID ()));
        $bkg = ($url) ? 'style="background-image:url('.$url.')"' : '';
    ?>
    <div class="header-page" <?=$bkg?>>
      <div><h1><?php echo the_title();?></h1></div>
    </div>

    <?php $post = get_post();
          echo $post->post_content;
    ?>


    <div class="post-wrap">
      <div class="container job-container">
        <div class="post-inner row no-aside">
          <div class="col-main">
            <section class="post-main" role="main" id="content">

                <div class="post type-post row" id="">
                  <div class="entry-main">
                    <h3>Estas son nuestras vacantes actuales</h3>
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
                       
                        echo '<div class="table-responsive"><table class="table table-striped borderless" style="border: none"><tbody style="border: none">';
                        foreach($urls as $count => $url) {
                            $returned = json_decode(curl_multi_getcontent($curl_array[$count]));
                            echo '<tr><td><p class="text-center">
                                      <img class="marginless" src="http://52.27.163.227/wordpress/wp-content/uploads/2016/09/briefcase-1.png" alt="1" width="43"></p>
                                  </td>
                                  <td>
                                  <p class="text-center"><a href="' . $returned->link . '" target="_blank">' . $returned->title  . '</a></p></td>
                                  <td><p class="text-center">' . $returned->city . ' (' . $returned->province->value . ')</p></td>
                                  <td><p class="text-center"> Jornada ' . $returned->journey->value . '</p></td>';

                            if ($returned->contractType->value == "(Seleccionar)") { //SI no ha sido definidio tipo en infojobs
                               echo '<td></td>';
                            }
                            else{
                              echo '<td><p class="text-center"> Contrato ' . $returned->contractType->value . '</p></td>';
                            }
                            echo ' <td><p class="text-center">' . preg_replace('/[\x00-\x08\x10\x0B\x0C\x0E-\x19\x7F]'.
 																	'|[\x00-\x7F][\x80-\xBF]+'.
                                   '|([\xC0\xC1]|[\xF0-\xFF])[\x80-\xBF]*'.
                                   '|[\xC2-\xDF]((?![\x80-\xBF])|[\x80-\xBF]{2,})'.
                                   '|[\xE0-\xEF](([\x80-\xBF](?![\x80-\xBF]))|(?![\x80-\xBF]{2})|[\x80-\xBF]{3,})/S',
                                   '?', substr($returned->description, 0, 155)) . '... <a href="' . $returned->link . '" target="_blank" class"inline">[LEER MAS]</a></p></td></tr>';
                        }

                        echo '</tbody></table></div>';
                      ?>
                  </div>
                </div>
            </section>
          </div>
        </div>
      </div>
    </div>

    </div>
  </article>

<?php

echo do_shortcode('[contact-form-7 id="203" title="Job form general" html_class="bgcolorf4"]');

get_footer(); ?>

