<?php

 	/*	
	*	get background 
	*	---------------------------------------------------------------------
	*/
function onetone_get_background($args){
$background = "";
 if (is_array($args)) {
	if (isset($args['image']) && $args['image']!="") {
	$background .=  "background:url(".$args['image']. ")  ".$args['repeat']." ".$args['position']." ".$args['attachment'].";";
	}
	
	if(isset($args['color']) && $args['color'] !=""){
	$background .= "background-color:".$args['color'].";";
	}
	}

return $background;
}


/*	
	*	send email
	*	---------------------------------------------------------------------
	*/
function onetone_contact(){
	if(trim($_POST['Name']) === '') {
		$Error = __('Please enter your name.','onetone');
		$hasError = true;
	} else {
		$name = trim($_POST['Name']);
	}

	if(trim($_POST['Email']) === '')  {
		$Error = __('Please enter your email address.','onetone');
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['Email']))) {
		$Error = __('You entered an invalid email address.','onetone');
		$hasError = true;
	} else {
		$email = trim($_POST['Email']);
	}

	if(trim($_POST['Message']) === '') {
		$Error =  __('Please enter a message.','onetone');
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$message = stripslashes(trim($_POST['Message']));
		} else {
			$message = trim($_POST['Message']);
		}
	}

	if(!isset($hasError)) {
		
	   if (isset($_POST['sendto']) && preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim(base64_decode($_POST['sendto'])))) {
	     $emailTo = base64_decode($_POST['sendto']);
	   }
	   else{
	 	 $emailTo = get_option('admin_email');
		}
		 if($emailTo !=""){
		$subject = 'From '.$name;
		$body = "Name: $name \n\nEmail: $email \n\nMessage: $message";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		wp_mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
		}
		echo json_encode(array("msg"=>__("Your message has been successfully sent!","onetone"),"error"=>0));
		
	}
	else
	{
	echo json_encode(array("msg"=>$Error,"error"=>1));
	}
	die() ;
	}
	add_action('wp_ajax_onetone_contact', 'onetone_contact');
	add_action('wp_ajax_nopriv_onetone_contact', 'onetone_contact');
	
	
	function onetone_contact_advanced(){


    $body  = '';
	$email = '';
	
	   if (isset($_POST['sendto']) && preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim(base64_decode($_POST['sendto'])))) {
	     $emailTo = base64_decode($_POST['sendto']);
	   }
	   else{
	 	 $emailTo = get_option('admin_email');
		}
		 if($emailTo !=""){
		$subject = 'From '.get_bloginfo('name');
		
		parse_str($_POST['values'], $values);
		if( is_array($values) ){
		foreach( $values as $k => $v ){
			//$body .= str_replace('_',' ',$k).': '.$v.' <br/><br/>';
			
			$body .= str_replace('_',' ',$k).': '.utf8_encode(htmlentities($v)).' <br/><br/>';
			
			if( strpos(strtolower($k),'email') && $v != "" ){
				$email = $v;
				}
			}
		}
		
		$headers = 'From: '.get_bloginfo('name').' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email . "\r\n";	
		
		$headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
		wp_mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
		}
		echo json_encode(array("msg"=>__("Your message has been successfully sent!","onetone"),"error"=>0));
		
	die() ;
	}
	add_action('wp_ajax_onetone_contact_advanced', 'onetone_contact_advanced');
	add_action('wp_ajax_nopriv_onetone_contact_advanced', 'onetone_contact_advanced');
	
	
	
// get breadcrumbs
 function onetone_get_breadcrumb( $options = array()){
   global $post,$wp_query ;
    $postid = isset($post->ID)?$post->ID:"";
	
   $show_breadcrumb = "";
   if ( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && $wp_query->get_queried_object_id() == get_option( 'page_for_posts' ) ) { 
    $postid = $wp_query->get_queried_object_id();
   }
  
   if(isset($postid) && is_numeric($postid)){
    $show_breadcrumb = get_post_meta( $postid, '_onetone_show_breadcrumb', true );
	}
	if($show_breadcrumb == 'yes' || $show_breadcrumb==""){

               onetone_breadcrumb_trail( $options);           
	}
	   
	}
	
	
/*
*  page navigation
*
*/
function onetone_native_pagenavi($echo,$wp_query){
    if(!$wp_query){global $wp_query;}
    global $wp_rewrite;      
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
    'base' => @add_query_arg('paged','%#%'),
    'format' => '',
    'total' => $wp_query->max_num_pages,
    'current' => $current,
    'prev_text'    => '<i class="fa fa-angle-double-left"></i>',
	 'next_text'    => '<i class="fa fa-angle-double-right"></i>',
	'type'         => 'list',
    );
 
    if( $wp_rewrite->using_permalinks() )
        $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');
 
    if( !empty($wp_query->query_vars['s']) )
        $pagination['add_args'] = array('s'=>get_query_var('s'));
    if($echo == "echo"){
    echo '<div class="page_navi text-center">'.paginate_links($pagination).'</div>'; 
	}else
	{
	
	return '<div class="page_navi text-center">'.paginate_links($pagination).'</div>';
	}
}
   
    //// Custom comments list
   
   function onetone_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ;?>">
     <div id="comment-<?php comment_ID(); ?>">
     
     <div class="comment media-comment media">
                                                    <div class="media-avatar media-left">
                                                       <?php echo get_avatar($comment,'52','' ); ?>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="media-inner">
                                                            <h4 class="media-heading clearfix">
                                                                <?php echo get_comment_author_link();?> - <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ;?>">
<?php printf(__('%1$s at %2$s','onetone'), get_comment_date(), get_comment_time()) ;?></a>
                                                                <?php edit_comment_link(__('(Edit)','onetone'),'  ','') ;?>
                                                                <?php comment_reply_link(array_merge( $args, array('reply_text' => '<i class="fa fa-reply"></i> '. __('Reply','onetone'), 'depth' => $depth, 'max_depth' => $args['max_depth']))) ;?>
                                                            </h4>
                                                            
                                                            <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.','onetone') ;?></em>
         <br />
      <?php endif; ?>
                                                           <?php comment_text() ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                <div class="clear"></div>
                           </div>
<?php
        }
		

	
	
	function onetone_get_default_slider(){
	
	$sanitize_title = "home";
	$section_menu   = onetone_option( 'menu_title_0' );
	$section_slug   = onetone_option( 'menu_slug_0' );
	if( $section_menu  != "" ){
    $sanitize_title = sanitize_title($section_menu );
    if( trim($section_slug) !="" ){
	 $sanitize_title = sanitize_title($section_slug); 
	 }
 }	
	 
	$return = '<section id="'.$sanitize_title.'" class="section homepage-slider onetone-'.$sanitize_title.'"><div id="onetone-owl-slider" class="owl-carousel owl-theme">';
	 for($i=1;$i<=5;$i++){
	$active = '';
	
	 $text       = onetone_option('onetone_slide_text_'.$i);
	 $image      = onetone_option('onetone_slide_image_'.$i);
	
     if( $image != "" ){
     $return .= '<div class="item"><img src="'.$image.'" alt=""><div class="inner">'. do_shortcode($text) .'</div></div>';
	 
	 }

	}
	
		$return .= '</div></section>';

        return $return;
		
   }

   /**
 * onetone admin panel menu
 */
 
   add_action( 'optionsframework_page_title_after','onetone_options_page_title' );

function onetone_options_page_title() { ?>

		          <ul class="options-links">
                  <li><a href="<?php echo esc_url( 'http://www.mageewp.com/wordpress-themes' ); ?>" target="_blank"><?php _e( 'MageeWP Themes', 'onetone' ); ?></a></li>
                  <li><a href="<?php echo esc_url( 'http://www.mageewp.com/manuals/theme-guide-onetone.html' ); ?>" target="_blank"><?php _e( 'Manual', 'onetone' ); ?></a></li>
                  <li><a href="<?php echo esc_url( 'http://www.mageewp.com/documents/faq/' ); ?>" target="_blank"><?php _e( 'FAQ', 'onetone' ); ?></a></li>
                  <li><a href="<?php echo esc_url( 'http://www.mageewp.com/knowledges/' ); ?>" target="_blank"><?php _e( 'Knowledge', 'onetone' ); ?></a></li>
                  <li><a href="<?php echo esc_url( 'http://www.mageewp.com/forums/onetone/' ); ?>" target="_blank"><?php _e( 'Support Forums', 'onetone' ); ?></a></li>
                  </ul>
      			
<?php
}


if ( ! function_exists( '_wp_render_title_tag' ) ) {
 function onetone_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( ' Page %s ', 'onetone' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'onetone_wp_title', 10, 2 );
	}

if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function onetone_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'onetone_slug_render_title' );
}

 
 /**
 * back to top
 */
 
function onetone_back_to_top(){
	
	$back_to_top_btn = onetone_option("back_to_top_btn");
	if( $back_to_top_btn != "hide" ){
    echo '<a href="javascript:;">
        	<div id="back-to-top">
        		<span class="fa fa-arrow-up"></span>
            	<span>'.__("TOP","onetone").'</span>
        	</div>
        </a>';
	}
        }
        
  add_action( 'wp_footer', 'onetone_back_to_top' );
  


// get social icon

function onetone_get_social( $position, $class = 'top-bar-sns',$placement='top',$target='_blank'){
	global $social_icons;
   $return = '';
   $rel    = '';
   
   $social_links_nofollow  = onetone_option( 'social_links_nofollow','no' ); 
   $social_new_window = onetone_option( 'social_new_window','yes' );  
   if( $social_new_window == 'no')
   $target = '_self';
   
   if( $social_links_nofollow == 'yes' )
   $rel    = 'nofollow';
   
   if(is_array($social_icons) && !empty($social_icons)):
   $return .= '<ul class="'.esc_attr($class).'">';
   $i = 1;
   foreach($social_icons as $sns_list_item){
	 
		 $icon = onetone_option( $position.'_social_icon_'.$i,'' );  
		 $title = onetone_option( $position.'_social_title_'.$i,'' );
		 $link = onetone_option( $position.'_social_link_'.$i,'' );  
	if(  $icon !="" ){
	 $return .= '<li><a target="'.esc_attr($target).'" rel="'.$rel.'" href="'.esc_url($link).'" data-placement="'.esc_attr($placement).'" data-toggle="tooltip" title="'.esc_attr( $title).'"><i class="fa fa-'.esc_attr( $icon).'"></i></a></li>';
	} 
	$i++;
	} 
	$return .= '</ul>';
	endif;
	return $return ;
	}
	
	
 // get top bar content

 function onetone_get_topbar_content( $type =''){

	 switch( $type ){
		 case "info":
		 echo '<div class="top-bar-info">';
		 echo onetone_option('top_bar_info_content');
		 echo '</div>';
		 break;
		 case "sns":
		 $tooltip_position = onetone_option('top_social_tooltip_position','bottom'); 
		 echo onetone_get_social('header','top-bar-sns',$tooltip_position);
		 break;
		 case "menu":
		 echo '<nav class="top-bar-menu">';
		 wp_nav_menu(array('theme_location'=>'top_bar_menu','depth'=>1,'fallback_cb' =>false,'container'=>'','container_class'=>'','menu_id'=>'','menu_class'=>'','link_before' => '<span>', 'link_after' => '</span>','items_wrap'=> '<ul id="%1$s" class="%2$s">%3$s</ul>'));
		 echo '</nav>';
		 break;
		 case "none":
		
		 break;
		 }
	 }
	 
/**
 * Convert Hex Code to RGB
 * @param  string $hex Color Hex Code
 * @return array       RGB values
 */
 
function onetone_hex2rgb( $hex ) {
		if ( strpos( $hex,'rgb' ) !== FALSE ) {

			$rgb_part = strstr( $hex, '(' );
			$rgb_part = trim($rgb_part, '(' );
			$rgb_part = rtrim($rgb_part, ')' );
			$rgb_part = explode( ',', $rgb_part );

			$rgb = array($rgb_part[0], $rgb_part[1], $rgb_part[2], $rgb_part[3]);

		} elseif( $hex == 'transparent' ) {
			$rgb = array( '255', '255', '255', '0' );
		} else {

			$hex = str_replace( '#', '', $hex );

			if( strlen( $hex ) == 3 ) {
				$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
				$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
				$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
			} else {
				$r = hexdec( substr( $hex, 0, 2 ) );
				$g = hexdec( substr( $hex, 2, 2 ) );
				$b = hexdec( substr( $hex, 4, 2 ) );
			}
			$rgb = array( $r, $g, $b );
		}

		return $rgb; // returns an array with the rgb values
	}

/**
 * load less
 */
 

function onetone_enqueue_less_styles($tag, $handle) {
		global $wp_styles;
		$match_pattern = '/\.less$/U';
		if ( preg_match( $match_pattern, $wp_styles->registered[$handle]->src ) ) {
			$handle = $wp_styles->registered[$handle]->handle;
			$media = $wp_styles->registered[$handle]->args;
			$href = $wp_styles->registered[$handle]->src . '?ver=' . $wp_styles->registered[$handle]->ver;
			$rel = isset($wp_styles->registered[$handle]->extra['alt']) && $wp_styles->registered[$handle]->extra['alt'] ? 'alternate stylesheet' : 'stylesheet';
			$title = isset($wp_styles->registered[$handle]->extra['title']) ? "title='" . esc_attr( $wp_styles->registered[$handle]->extra['title'] ) . "'" : '';
	
			$tag = "<link rel='stylesheet' id='$handle' $title href='$href' type='text/less' media='$media' />\n";
		}
		return $tag;
	}
add_filter( 'style_loader_tag', 'onetone_enqueue_less_styles', 5, 2);


	 
	// get related posts
	
 function onetone_get_related_posts($post_id, $number_posts = -1,$post_type = 'post',$taxonomies='category') {
	//$query = new WP_Query();
	
	$categories = array();

	$terms = wp_get_object_terms( $post_id,  $taxonomies );
	  if ( ! empty( $terms ) ) {
		  if ( ! is_wp_error( $terms ) ) {
				  foreach( $terms as $term ) {
					  $categories[] = $term->term_id; 
				  }
		  }
	  }
   if( $post_type == 'post' )
    $args = array('category__in' => $categories);
	else
	$args = array('tax_query' => array(
        array(
            'taxonomy' => $taxonomies,
            'field'    => 'term_id',
            'terms'    => $categories,
        ),
    ),);
	
	if($number_posts == 0) {
		$query = new WP_Query();
		return $query;
	}

	$args = wp_parse_args($args, array(
		'posts_per_page' => $number_posts,
		'post__not_in' => array($post_id),
		'ignore_sticky_posts' => 0,
        'meta_key' => '_thumbnail_id',
		'post_type' =>$post_type,
		'operator'  => 'IN'
	));

	$query = new WP_Query($args);
    wp_reset_postdata(); 
  	return $query;
}



if ( ! function_exists( 'onetone_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function onetone_paging_nav($echo='echo',$wp_query='') {
    if(!$wp_query){global $wp_query;}
    global $wp_rewrite;      
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

	$pagination = array(
	'base' => @add_query_arg('paged','%#%'),
	'format'             => '?page=%#%',
	'total'              => $wp_query->max_num_pages,
	'current'            => $current,
	'show_all'           => false,
	'end_size'           => 1,
	'mid_size'           => 2,
	'prev_next'          => true,
	'prev_text'          => __(' Prev', 'onetone'),
	'next_text'          => __('Next ', 'onetone'),
	'type'               => 'list',
	'add_args'           => false,
	'add_fragment'       => '',
	'before_page_number' => '',
	'after_page_number'  => ''
);
 
    if( $wp_rewrite->using_permalinks() )
        $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');
 
    if( !empty($wp_query->query_vars['s']) )
        $pagination['add_args'] = array('s'=>get_query_var('s'));
		
	if( $wp_query->max_num_pages > 1 ){
    if($echo == "echo"){
    echo '<nav class="post-list-pagination" role="navigation">
                                    <div class="post-pagination-decoration text-center">
                                    '.paginate_links($pagination).'</div></nav>'; 
	}else
	{
	
	return '<nav class="post-list-pagination" role="navigation">
                                    <div class="post-pagination-decoration text-center">'.paginate_links($pagination).'</div></nav>';
	}
	
	}
}
endif;

/**
 * Display navigation to next/previous post when applicable.
 */
 
if ( ! function_exists( 'onetone_post_nav' ) ) :

function onetone_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
    <nav class="post-pagination" role="navigation">
                                        <ul class="clearfix">
                                        <?php
											previous_post_link( '<li class="pull-left">%link</li>', '%title' );
											next_post_link(     '<li class="pull-right">%link</li>', '%title' );
										?>
                                        </ul>
                                    </nav>  
                                    
	<!-- .navigation -->
	<?php
}
endif;

 // get post content css class
 function onetone_get_content_class( $sidebar = '' ){
	 
	 if( $sidebar == 'left' )
	 return 'left-aside';
	 if( $sidebar == 'right' )
	 return 'right-aside';
	 if( $sidebar == 'both' )
	 return 'both-aside';
	  if( $sidebar == 'none' )
	 return 'no-aside';
	 
	 return 'no-aside';
	 
	 }

// remove woocommerce page title

function onetone_woocommerce_show_page_title(){
	return false;
	}
add_filter('woocommerce_show_page_title','onetone_woocommerce_show_page_title');

// fix shortcode

 function onetone_fix_shortcodes($content){   
			$replace_tags_from_to = array (
				'<p>[' => '[', 
				']</p>' => ']', 
				']<br />' => ']',
				']<br>' => ']',
				']\r\n' => ']',
				']\n' => ']',
				']\r' => ']',
				'\r\n[' => '[',
			);

			return strtr( $content, $replace_tags_from_to );
		}

 function onetone_the_content_filter($content) {
	  $content = onetone_fix_shortcodes($content);
	  return $content;
	}
	
add_filter( 'the_content', 'onetone_the_content_filter' );


// cover excerpt length
 function onetone_get_excerpt($count,$postid){
  $permalink = get_permalink($postid);
  $excerpt = get_the_content();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt = $excerpt.'[...]';
  return $excerpt;
}

// cover content length
 function onetone_cover_content($count,$content){
  $content = substr($content, 0, $count);
  $content = substr($content, 0, strripos($content, " "));
  $content = $content.'[...]';
  return $content;
}


function onetone_tinymce_config( $init ) {


	// IFRAME
	$valid_iframe = 'iframe[id|class|title|style|align|frameborder|height|longdesc|marginheight|marginwidth|name|scrolling|src|width],span[class|id|title|style],a[href],ul[id|class|style],br,p';

	// Add to extended_valid_elements if it alreay exists
	if ( isset( $init['extended_valid_elements'] ) ) {
		$init['extended_valid_elements'] .= ',' . $valid_iframe;
	} else {
		$init['extended_valid_elements'] = $valid_iframe;
	}

// Pass $init back to WordPress
	return $init;
}
//add_filter('tiny_mce_before_init', 'onetone_tinymce_config');


// ################################## fonts family
   /**
 * Returns an array of system fonts
 */
 
function onetone_options_typography_get_os_fonts() {
    // OS Font Defaults
    $os_faces = array(
            'Arial, sans-serif' => 'Arial',
	     //   '"Avant Garde", sans-serif' => 'Avant Garde',
	        'Cambria, Georgia, serif' => 'Cambria',
			'Calibri,sans-serif' => 'Calibri' ,
	        'Copse, sans-serif' => 'Copse',
	        'Garamond, "Hoefler Text", Times New Roman, Times, serif' => 'Garamond',
	        'Georgia, serif' => 'Georgia',
	        '"Helvetica Neue", Helvetica, sans-serif' => 'Helvetica Neue',
	        'Tahoma, Geneva, sans-serif' => 'Tahoma'
	    );
	    return $os_faces;
	}
	
	
	/**
 * Returns a select list of Google fonts
 * Feel free to edit this, update the fallbacks, etc.
 */
 
function onetone_options_typography_get_google_fonts() {
    // Google Font Defaults
	
	global $google_fonts_json;
	
	$googleFontArray = array();

   $fontArray = json_decode($google_fonts_json, true);
   
   foreach($fontArray['items'] as $index => $value){
	   
   $_family = strtolower( str_replace(' ','_',$value['family']) );
   $googleFontArray[$_family]['family'] = $value['family'];
   $googleFontArray[$_family]['variants'] = $value['variants'];
   $googleFontArray[$_family]['subsets'] = $value['subsets'];
 
   $category = '';
   if( isset($value['category']) ) $category = ', '.$value['category'];
   $googleFontArray['onetone_of_family'][$value['family'].$category] = $value['family'];
   
   }
   	    return $googleFontArray;
	}
	
/*
*  get typography
*
*/

	
function onetone_options_typography_enqueue_google_font($font) {
	
	   $googleFontArray       = onetone_options_typography_get_google_fonts() ;
	   $googleFontFamilyArray = array() ;
	   foreach($googleFontArray['onetone_of_family'] as $k => $v){
		   $googleFontFamilyArray[] = $k;
		   }
	   if( in_array( $font , $googleFontFamilyArray ) ){
	    $font = explode(',', $font);
	    $font = $font[0];
		$_font_add_string = '';
		$_family = strtolower( str_replace(' ','_',$font) );
		
		if(count( $googleFontArray[$_family]['variants'] )) $_font_add_string = ":". implode(',', $googleFontArray[$_family]['variants']);
		
	    $font = str_replace(" ", "+", $font);
	    wp_enqueue_style( "onetone-typography-$_family", esc_url("//fonts.googleapis.com/css?family=$font" . $_font_add_string), false, null, 'all' );
	   }
		
}


 function onetone_get_typography( $option= array() ){


	 $return = "";
	 if( $option && is_array($option) ){
	 if($option['face']){
	 $return .= 'font-family:'.$option['face'].';' ;
	 onetone_options_typography_enqueue_google_font($option['face']);
	 }
	
	 if(isset($option['size']) && !is_array($option['size']) )
	 $return .= 'font-size:'.$option['size'].';' ;
	 if($option['style'])
	 $return .= 'font-weight:'.$option['style'].';' ;
	 if($option['color'])
	 $return .= 'color:'.$option['color'].';' ;
		 }
		 
	return $return ;
	 
	 }
	 


function onetone_of_recognized_font_styles() {
	$default = array(
	'normal' => 'normal',
	'italic' =>  'italic',
	'bold' =>  'bold',
	'bold italic' =>  'bold italic',
	'100' =>  '100',
	'200' =>  '200',
	'300' =>  '300',
	'400' =>  '400',
	'500' =>  '500',
	'600' =>  '600',
	'700' =>  '700',
	'800' =>  '800',
	'900' =>  '900'
  );
	return apply_filters( 'onetone_of_recognized_font_styles', $default );
}
add_filter( 'of_recognized_font_styles', 'onetone_of_recognized_font_styles' );
//###################################



function onetone_admin_notice(){
    if ( class_exists('Magee_Core') ) {
        echo '<div class="updated"><p>Once you got onetone theme updated from free to pro, do make sure that you got the <strong>Magee Shortcodes</strong> (the free version) deactivated in "plugin/installed plugins". Since Onetone pro was built in with <strong>Magee Shortcodes</strong> pro, no need for the free version anymore.
</p></div>';
    }
}

//add_action('admin_notices', 'onetone_admin_notice');


// footer tracking code
	
 function onetone_tracking_code(){
   $tracking_code = onetone_option('tracking_code');
   echo $tracking_code;
 } 

add_action('wp_footer', 'onetone_tracking_code'); 

 // Space before </head>
	
 function onetone_space_before_head(){
   $space_before_head = onetone_option('space_before_head');
   echo $space_before_head;
 } 

add_action('wp_head', 'onetone_space_before_head'); 


 // Space before </body>
	
 function onetone_space_before_body(){
   $space_before_body = onetone_option('space_before_body');
   echo $space_before_body;
 } 

add_action('wp_footer', 'onetone_space_before_body'); 

add_action('init', 'onetone_html_tags_code', 10);
function onetone_html_tags_code() {
  global $allowedposttags;

    $allowedposttags["javascript"] = array("src" => array(),"type" => array());
    $allowedposttags["style"] = array("type" => array());
	$allowedposttags["link"] = array("rel" => array(),"href" => array(),"id" => array(),"type" => array(),"media" => array());

}



// get summary

 function onetone_get_summary(){
	 
	 $excerpt_or_content        = onetone_option('excerpt_or_content','excerpt');
	 $excerpt_length            = onetone_option('excerpt_length','55');
	 if( $excerpt_or_content == 'full_content' ){
	 $output = get_the_content();
	 }
	 else{
	 $output = get_the_excerpt();
	 if( is_numeric($excerpt_length) && $excerpt_length !=0  )
	 $output = onetone_content_length($output, $excerpt_length );
	 }
	 return  $output;
	 }
	 
 function onetone_content_length($content, $limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return $excerpt;
    }
	
	
if ( ! function_exists( 'onetone_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function onetone_posted_on() {
	$return = '';
	$display_post_meta = onetone_option('display_post_meta','yes');
		
	if( $display_post_meta == 'yes' ){
		
	  $display_meta_author     = onetone_option('display_meta_author','yes');
	  $display_meta_date       = onetone_option('display_meta_date','yes');
	  $display_meta_categories = onetone_option('display_meta_categories','yes');
	  $display_meta_comments   = onetone_option('display_meta_comments','yes');
	  $display_meta_readmore   = onetone_option('display_meta_readmore','yes');
	  $display_meta_tags       = onetone_option('display_meta_tags','yes');
	  $date_format             = onetone_option('date_format','M d, Y');
	
		
	   $return .=  '<ul class="entry-meta">';
	  if( $display_meta_date == 'yes' )
		$return .=  '<li class="entry-date"><i class="fa fa-calendar"></i>'. get_the_date( $date_format ).'</li>';
	  if( $display_meta_author == 'yes' )
		$return .=  '<li class="entry-author"><i class="fa fa-user"></i>'.get_the_author_link().'</li>';
	  if( $display_meta_categories == 'yes' )		
		$return .=  '<li class="entry-catagory"><i class="fa fa-file-o"></i>'.get_the_category_list(', ').'</li>';
	  if( $display_meta_comments == 'yes' )	
		$return .=  '<li class="entry-comments pull-right">'.onetone_get_comments_popup_link('', __( '<i class="fa fa-comment"></i> 1 ', 'onetone'), __( '<i class="fa fa-comment"></i> % ', 'onetone'), 'read-comments', '').'</li>';
        $return .=  '</ul>';
	}

	echo $return;

}
endif;


/**
 * Modifies WordPress's built-in comments_popup_link() function to return a string instead of echo comment results
 */
function onetone_get_comments_popup_link( $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {
    global $wpcommentspopupfile, $wpcommentsjavascript;
 
    $id = get_the_ID();
 
    if ( false === $zero ) $zero = __( 'No Comments', 'onetone');
    if ( false === $one ) $one = __( '1 Comment', 'onetone');
    if ( false === $more ) $more = __( '% Comments', 'onetone');
    if ( false === $none ) $none = __( 'Comments Off', 'onetone');
 
    $number = get_comments_number( $id );
    $str = '';
 
    if ( 0 == $number && !comments_open() && !pings_open() ) {
        $str = '<span' . ((!empty($css_class)) ? ' class="' . esc_attr( $css_class ) . '"' : '') . '>' . $none . '</span>';
        return $str;
    }
 
    if ( post_password_required() ) {
     
        return '';
    }
	
 
    $str = '<a href="';
    if ( $wpcommentsjavascript ) {
        if ( empty( $wpcommentspopupfile ) )
            $home = home_url();
        else
            $home = get_option('siteurl');
        $str .= $home . '/' . $wpcommentspopupfile . '?comments_popup=' . $id;
        $str .= '" onclick="wpopen(this.href); return false"';
    } else { // if comments_popup_script() is not in the template, display simple comment link
        if ( 0 == $number )
            $str .= get_permalink() . '#respond';
        else
            $str .= get_comments_link();
        $str .= '"';
    }
 
    if ( !empty( $css_class ) ) {
        $str .= ' class="'.$css_class.'" ';
    }
    $title = the_title_attribute( array('echo' => 0 ) );
 
    $str .= apply_filters( 'comments_popup_link_attributes', '' );
 
    $str .= ' title="' . esc_attr( sprintf( __('Comment on %s', 'onetone'), $title ) ) . '">';
    $str .= onetone_get_comments_number_str( $zero, $one, $more );
    $str .= '</a>';
     
    return $str;
}

/**
 * Modifies WordPress's built-in comments_number() function to return string instead of echo
 */
function onetone_get_comments_number_str( $zero = false, $one = false, $more = false, $deprecated = '' ) {
    if ( !empty( $deprecated ) )
        _deprecated_argument( __FUNCTION__, '1.3' );
 
    $number = get_comments_number();
 
    if ( $number > 1 )
        $output = str_replace('%', number_format_i18n($number), ( false === $more ) ? __('% Comments', 'onetone') : $more);
    elseif ( $number == 0 )
        $output = ( false === $zero ) ? __('No Comments', 'onetone') : $zero;
    else // must be one
        $output = ( false === $one ) ? __('1 Comment', 'onetone') : $one;
 
    return apply_filters('comments_number', $output, $number);
}



function onetone_array_sort($array,$keys,$type='asc'){
	  if(!isset($array) || !is_array($array) || empty($array)){
	  return '';
	  }
	  if(!isset($keys) || trim($keys)==''){
	  return '';
	  }
	  if(!isset($type) || $type=='' || !in_array(strtolower($type),array('asc','desc'))){
	  return '';
	  }
	  $keysvalue=array();
	  foreach($array as $key=>$val){
	  $val[$keys] = str_replace('-','',$val[$keys]);
	  $val[$keys] = str_replace(' ','',$val[$keys]);
	  $val[$keys] = str_replace(':','',$val[$keys]);
	  $keysvalue[] =$val[$keys];
	  }
	  asort($keysvalue); 
	  reset($keysvalue); 
	  foreach($keysvalue as $key=>$vals) {
	  $keysort[] = $key;
	  }
	  $keysvalue = array();
	  $count=count($keysort);
	  if(strtolower($type) != 'asc'){
	  for($i=$count-1; $i>=0; $i--) {
	  $keysvalue[] = $array[$keysort[$i]];
	  }
	  }else{
	  for($i=0; $i<$count; $i++){
		  if(isset($array[$keysort[$i]]))
	  $keysvalue[] = $array[$keysort[$i]];
	  }
	  }
	  return $keysvalue;
}

/**
 * Change the Shop archive page title.
 * @param  string $title
 * @return string
 */
 
function onetone_custom_shop_archive_title( $title ) {
    if ( function_exists('is_shop') && function_exists('woocommerce_page_title') &&  is_shop() ) {
        return str_replace( __( 'Products', 'onetone' ), woocommerce_page_title(false), $title );
    }
    return $title;
}
add_filter( 'wp_title', 'onetone_custom_shop_archive_title' );

function onetone_is_plugin_active( $plugin ) {
    return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
}



// Onetone guide tips

/* $option_name  = optionsframework_option_name();
 $options_saved = false;
	if ( get_option($option_name) ) {
		$options_saved = true;
	}
if( (!isset($_GET['page']) || ($_GET['page'] !='onetone-options' && $_GET['page'] !='import-demos' && $_GET['page'] !='onetone' ) ) && $options_saved == false )
add_action('admin_menu', 'onetone_guide_submenu_page');

function onetone_guide_submenu_page() {
	
	// add_theme_page(__('Import Onetone Demos', 'onetone' ),__('Import Onetone Demos', 'onetone' ), 'edit_theme_options', 'import-demos', 'onetone_import_demos');
	 
	add_theme_page( __('Onetone step 2', 'onetone' ),  '<div class="onetone-step-2-text"><h2>'.__('Customize Content for Homepage', 'onetone' ).'</h2>
<p>'.__('Open this page to edit content for homepage and customize styles of the site.', 'onetone' ).'</p><div id="onetone-step-1-text" style=" display:none;"><div class="onetone-step-1"><div class="onetone-step-1-text"><h2>'.__('Customize Content for Homepage', 'onetone' ).'</h2><p>'.__('Open this page to edit content for homepage and customize styles of the site.', 'onetone' ).'</p></div></div></div></div>', 'edit_theme_options', 'themes.php?page=onetone-options', '' );
}
*/
if( isset($_GET['page']) && $_GET['page'] =='onetone-options' )
add_action('admin_footer', 'onetone_admin_footer_function');

function onetone_admin_footer_function() {
	echo '<div class="onetone-admin-footer" style="height: 60px; display:none;background: rgba(0,0,0,0.5); position:fixed;bottom:0px;padding:15px 0;z-index:99;cursor: pointer;width: 100%;"><span style=" margin-left:180px; font-size:16px;color:#fff;">'.__('To save any changes on onetone options, click on the <strong  style="color:orange;">Save All Options</strong> button on the right side.', 'onetone' ).'</span><button class="button-primary" id="onetone-save-options" style=" float:right;margin-right:50px;">'.__('Save All Options', 'onetone' ).'</button></div>
	<div class="options-saved"><i class="fa fa-check"></i>'.__('Options Updated', 'onetone' ).'</div>
	<div class="options-saving"><i class="fa fa-spinner fa-spin"></i>'.__('Options Saving', 'onetone' ).'</div>
	';
}


function onetone_tinymce_init() {
    // Hook to tinymce plugins filter
    add_filter( 'mce_external_plugins', 'onetone_tinymce_plugin' );
}
add_filter('init', 'onetone_tinymce_init');

function onetone_tinymce_plugin($init) {
    // We create a new plugin... linked to a js file.
    // Mine was created from a plugin... but you can change this to link to a file in your plugin
    $init['keyup_event'] = get_template_directory_uri() . '/js/keyup_event.js';
    return $init;
}


add_filter( 'wp_kses_allowed_html', 'onetone_allowedposttags_filter',1,1 );

function onetone_allowedposttags_filter( $allowedposttags ) {

 $allowedposttags['i'] = array ( 'class' => 1,'style' => 1);
 $allowedposttags['input']  = array ( 'class' => 1, 'id'=> 1, 'style' => 1, 'type' => 1, 'name'=>1,'value' => 1 ,'placeholder'=> 1,'size'=> 1,'tabindex'=> 1,'aria-required'=> 1);
 $allowedposttags['iframe'] = array(
					'align' => true,
					'width' => true,
					'height' => true,
					'frameborder' => true,
					'name' => true,
					'src' => true,
					'id' => true,
					'class' => true,
					'style' => true,
					'scrolling' => true,
					'marginwidth' => true,
					'marginheight' => true,
					
  );
	  return $allowedposttags;

}
