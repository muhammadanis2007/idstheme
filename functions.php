<?php 
function mytheme_enqueue_scripts() {
  // register AngularJS
  // we need to create a JavaScript variable to store our API endpoint...   
  // ... and useful information such as the theme directory and website url
  /*wp_localize_script( 'my-scripts', 'myLocalized', array( 'partials' => trailingslashit( get_template_directory_uri() ) . '/partials/' ) );*/
  wp_localize_script('localroot', 'localized',  array('partials' => get_stylesheet_directory_uri().'/partials/'));
  wp_localize_script( 'style', 'BlogInfo', array( 'url' => get_bloginfo('template_directory').'/', 'site' => get_bloginfo('wpurl')) );
 
  wp_localize_script( 'json-api', 'AppAPI', array( 'url' => get_bloginfo('wpurl').'/api/') ); // this is the API address of the JSON API plugin
 wp_deregister_script('jquery');
  wp_register_script('jquery', get_bloginfo('template_directory').'/js/jquery.min.js', array(), null, false);
  wp_register_script('jquery-migrate', get_bloginfo('template_directory').'/js/jquery-migrate-3.0.0.min.js', array(), null, false);
  wp_register_script('angular-core', get_bloginfo('template_directory').'/js/angular.min.js', array(), null, false);
  wp_register_script('angular-route', get_bloginfo('template_directory').'/js/angular-route.min.js', array(), null, false);
  wp_register_script('angular-ngSanitize', get_bloginfo('template_directory').'/js/angular-sanitize.min.js', array(), null, false);
  wp_register_script('angular-animate', get_bloginfo('template_directory').'/js/angular-animate.min.js', array(), null, false);
  wp_register_script('chieffancypants.loadingBar', get_bloginfo('template_directory').'/js/loading-bar.js', array(), null, false);
  wp_register_script('angular-app', get_bloginfo('template_directory').'/app.js', array(), null, false);
 
  // register our app.js, which has a dependency on angular-core
//  wp_register_script('angular-app', get_bloginfo('template_directory').'/app.js', array('angular-core'), null, false);
 
 
 //echo "script loaing";
  // enqueue all scripts
  
 
 // wp_enqueue_script('scripts');
  

	function footerscript()
	{
	
	 	wp_enqueue_script('angular-core');
	 	wp_enqueue_script('angular-route');
		wp_enqueue_script('angular-ngSanitize');
        wp_enqueue_script('angular-animate');
        /*wp_enqueue_script('chieffancypants.loadingBar');*/
			
         
		wp_enqueue_script('angular-app');	
		wp_enqueue_style( 'style', get_stylesheet_uri() );
		wp_enqueue_style( 'loading-bar', get_stylesheet_directory_uri() . '/loading-bar.css' );
	}
    
    
	add_action('wp_footer', 'footerscript');

}

add_action('init',"my_theme");

function my_theme(){
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');

}









function arphabet_widgets_init() {

    register_sidebar( array(
        'name' => 'Home right sidebar',
        'id' => 'home_right_1',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="rounded">',
        'after_title' => '</h2>',
    ) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );


function register_my_menus() {
  register_nav_menus(
    array(  
    	'main_menu' => __( 'Main Menu' ), 
    	'top-nav' => __( 'Top Navigation' )
    )
  );
  
 // echo get_stylesheet_directory_uri().'/partials/';
} 
add_action( 'init', 'register_my_menus' );

/*

function wpb_top_new_menu() {
  register_nav_menu('main-menu',__( 'Main Menu' ));
}
add_action( 'init', 'wpb_custom_new_menu' );

function wpb_custom_new_menu() {
  register_nav_menu('top-nav',__( 'Top Navigation' ));
}
add_action( 'init', 'wpb_top_new_menu' );*/


add_action( 'after_setup_theme', 'setup' );
function setup() {
    // ...
     
    add_theme_support( 'post-thumbnails' ); // This feature enables post-thumbnail support for a theme
    add_filter( 'image_size_names_choose', 'custom_image_sizes_choose' );
    
	add_image_size( 'header', 600, 200, true ); // header image
    add_image_size( 'gallerysize', 300, 300 ); // 400 pixel wide and 200 pixel tall, resized proportionally
    add_image_size( 'full-size', 640, 800, true ); // 400 pixel wide and 200 pixel tall, cropped
     remove_filter( 'the_content', 'wpautop' );
	remove_filter( 'the_excerpt', 'wpautop' );

    // ...
	
}


function custom_image_sizes_choose( $sizes ) {
    $custom_sizes = array(
        'featured-image' => 'Featured Image'
    );
    return array_merge( $sizes, $custom_sizes );
}



function button_shortcode($type) {
    extract(shortcode_atts(array('type' => 'type'), $type));
    
    // check what type user entered
    switch ($type) {
        case 'social-tools':
            return '<nav class="social" >
          <ul >
              <li><a href="http://twitter.com/#">Twitter <i class="fa fa-twitter"></i></a></li>
              <li>Facebook <i class="fa fa-facebook"></i></li>
              <li><a href="http://dribbble.com/#">Dribbble <i class="fa fa-dribbble"></i></a></li>
              <li><a href="http://behance.net#">Behance <i class="fa fa-behance"></i></a></li>
              
          </ul>
      </nav>';
            break;
        case 'rss':
            return '<a href="http://example.com/rss" class="btn">Subscribe to the feed!</a>';
            break;
            case 'skillbar':
            return '<progress max="100" value="80"  class="orange" >80%</progress>';
    }
}

add_shortcode('button', 'button_shortcode');




/*google map embeding Shortcode [googlemap width="600" height="300" src="http://maps.google.com/maps?q=Heraklion,+Greece&hl=en&ll=35.327451,25.140495&spn=0.233326,0.445976& sll=37.0625,-95.677068&sspn=57.161276,114.169922& oq=Heraklion&hnear=Heraklion,+Greece&t=h&z=12"]*/

function add_iframe($initArray) { 
    $initArray['extended_valid_elements'] = "iframe[id|class|title|style|align|frameborder|height|longdesc|marginheight|marginwidth|name|scrolling|src|width]"; return $initArray; } 
    // this function alters the way the WordPress editor filters your code 

add_filter('tiny_mce_before_init', 'add_iframe');



function googlemap_function($atts, $content = null) {
   extract(shortcode_atts(array(
      "width" => '640',
      "height" => '480',
      "src" => ''
   ), $atts));
   return '<iframe width="'.$width.'" height="'.$height.'" src="'.$src.'&output=embed" border="0" frameborder="0" ></iframe>';
}
add_shortcode("googlemap", "googlemap_function");


/*menu Short codes [menu name="main-menu"]*/

function menu_function($atts, $content = null) {
   extract(
      shortcode_atts(
         array( 'name' => null, ),
         $atts
      )
   );
   return wp_nav_menu(
      array(
          'menu' => $name,
          'echo' => false
          )
   );
}
add_shortcode('menu', 'menu_function');

/*Recent Posts display Shortcodes [recent-posts posts="5"]*/
function recent_posts_function($atts){
   extract(shortcode_atts(array(
      'posts' => 1,
   ), $atts));

   $return_string = '<ul>';
   query_posts(array('orderby' => 'date', 'order' => 'DESC' , 'showposts' => $posts));
   if (have_posts()) :
      while (have_posts()) : the_post();
         $return_string .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
      endwhile;
   endif;
   $return_string .= '</ul>';

   wp_reset_query();
   return $return_string;
}

/*Content or Notes shortcodes*/

function sc_note( $atts, $content = null ) {
	 if ( current_user_can( 'publish_posts' ) )
		return '<div class="note">'.$content.'</div>';
	return '';
}
add_shortcode( 'note', 'sc_note' );



/*Embed youtube videos [youtube value="http://www.youtube.com/watch?v=1aBSPn2P9bg"]*/
function youtube($atts) {
	extract(shortcode_atts(array(
		"value" => 'http://',
		"width" => '475',
		"height" => '350',
		"name"=> 'movie',
		"allowFullScreen" => 'true',
		"allowScriptAccess"=>'always',
		"controls"=> '1',
	), $atts));
	return '<object style="height: '.$height.'px; width: '.$width.'px"><param name="'.$name.'" value="'.$value.'"><param name="allowFullScreen" value="'.$allowFullScreen.'"><param name="allowScriptAccess" value="'.$allowScriptAccess.'"><embed src="'.$value.'" type="application/x-shockwave-flash" allowfullscreen="'.$allowFullScreen.'" allowScriptAccess="'.$allowScriptAccess.'" width="'.$width.'" height="'.$height.'"></object>';
}
add_shortcode("youtube", "youtube");

/*adsense shortcodes [adsense]*/

function showads() {
    return '<script type="text/javascript"><!--
    google_ad_client = "pub-3637220125174754";
    google_ad_slot = "4668915978";
    google_ad_width = 468;
    google_ad_height = 60;
    //-->
    </script>
    <script type="text/javascript"
    src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
    </script>
';
}
add_shortcode('adsense', 'showads');

/*Code display shortcode with pre tag [code]&lt;?php echo 'Hello World!'; ?>*/

function code_shortcode( $attr, $content = null ) {
        $content = clean_pre($content); // Clean pre-tags
        return '<pre"><code>' .
               str_replace('<', '<', $content) . // Escape < chars
               '</code></pre>';
}
add_shortcode('code', 'code_shortcode');

/*

function add_menu_atts( $atts, $item, $args ) {
	$atts['ng-class'] =  "{{page.slug}}";
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_atts', 10, 3 );
*/


function add_specific_menu_location_atts( $atts, $item, $args ) {
    // check if the item is in the primary menu
    if( $args->theme_location == 'Main Menu' ) {
      // add the desired attributes:
      $atts['ng-class'] = '';
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_specific_menu_location_atts', 10, 3 );



?>