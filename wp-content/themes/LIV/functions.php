<?php

if ( ! function_exists( 'mvn_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mvn_setup() {
	
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	if ( ! isset( $content_width ) ) {
		$content_width = 1200; /* pixels */
	}
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'mvn' ),
		'mobile' => esc_html__( 'Mobile Menu', 'mvn' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );
	add_theme_support( 'post-formats', array(
		'image', 'video', 'audio', 'quote', 'gallery',
	) );
	
	
	/**
	 * Widget.
	 */
	
	/**
	 * Custom template tags for this theme.
	 */
	require get_template_directory() . '/inc/template-tags.php';
	
	function mvn_render_script_ajax_block($args, $mvn_blog, $ajax_key) {
		
		ob_start();
		?>
			<script type="text/javascript">
				function mvn_blocks() {this.atts = '';this.url = '';}
				var mvn_<?php echo esc_html($ajax_key) ?> = new mvn_blocks();
				mvn_<?php echo esc_html($ajax_key) ?>.query = '<?php echo str_replace( '\'', '\\\'', json_encode($args ) ); ?>';
				mvn_<?php echo esc_html($ajax_key) ?>.atts = '<?php echo str_replace( '\'', '\\\'', json_encode($mvn_blog) ); ?>'; 
				mvn_<?php echo esc_html($ajax_key) ?>.url = '<?php echo esc_html(admin_url( "admin-ajax.php" )); ?>'; 
			</script>
		<?php
		echo ob_get_clean();
		
	}
	
	function mvn_init() {
		
	}
	add_action('init','mvn_init', 6);
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	
	if ( function_exists( 'add_image_size' ) ) { 
		
		
		add_image_size( 'mvn_200x200', '200', '200', true );
		add_image_size( 'mvn_1150x500', '1150', '500', true );
		add_image_size( 'mvn_272x200', '272', '200', true );
		add_image_size( 'mvn_484x460', '484', '460', true );
		add_image_size( 'mvn_732x250', '732', '250', true );
	}

	/**
	 * Enqueue Google Fonts
	 */
	
	
	/**
	 * Enqueue theme scripts and styles.
	 */
	function mvn_enqueue() {
		
		/* Enqueue styles */
		wp_enqueue_style( 'mvn-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700|Roboto:300,400,500,700,900', false ); 
		wp_enqueue_style( 'mvn-awesome', get_template_directory_uri() . '/assets/fonts/font-awesome/font-awesome.css' );
		wp_enqueue_style( 'mvn-swiper', get_template_directory_uri() . '/assets/css/swiper.min.css' );
		wp_enqueue_style('mvn-aos', '//cdnjs.cloudflare.com/ajax/libs/aos/2.3.0/aos.css');
		wp_enqueue_style('mvn-slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
		wp_enqueue_style( 'mvn-style', get_template_directory_uri() . '/assets/css/style.css' );
		wp_enqueue_style( 'mvn-stylesheet', get_stylesheet_uri() );

		/* Enqueue scripts */
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'mvn-swiper', get_template_directory_uri() . '/assets/js/swiper.min.js', 'jquery', '', true );
		wp_enqueue_script( 'mvn-aos', '//cdnjs.cloudflare.com/ajax/libs/aos/2.3.0/aos.js', array('jquery'), false, false );
		wp_enqueue_script( 'mvn-slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), false, false );
		wp_enqueue_script( 'mvn-main', get_template_directory_uri() . '/assets/js/common.js', 'jquery', '', true );
		wp_enqueue_script('google-recaptcha', 'https://www.google.com/recaptcha/api.js');
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );

		}
	}
	add_action( 'wp_enqueue_scripts', 'mvn_enqueue' );
	
	/**
	 * Initialize themes
	 */
	function mvn_setup_init() {

		/* Functions */
		$functions = glob( get_template_directory() . "/inc/*" );
		foreach($functions as $dir){
			$basename = basename($dir);
			if( strrpos( $basename,'.php' ) && file_exists( get_template_directory() . "/inc/$basename") ) {
				include_once( get_template_directory() . "/inc/$basename" );
			}
		}

	}
	add_action('init','mvn_setup_init',1);
	
	function mvn_get_attachment_image_src( $attributes_id, $size ){
		$attributes = wp_get_attachment_image_src( $attributes_id, $size );
		return $attributes[0];
	}
	
}

endif; // mvn_setup
add_action( 'after_setup_theme', 'mvn_setup' );


/* Archive Title */
function mvn_get_the_archive_title($before="",$after="") {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_year() ) {
		$title = get_the_date( 'Y');
	} elseif ( is_month() ) {
		$title = get_the_date( 'F Y');
	} elseif ( is_day() ) {
		$title = get_the_date( 'F j, Y');
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = 'Asides';
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = 'Galleries';
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = 'Images';
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = 'Videos';
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = 'Quotes';
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = 'Links';
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = 'Statuses';
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = 'Audio';
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = 'Chats';
		}
	} elseif ( is_post_type_archive() ) {
		$title =  post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = $tax->labels->singular_name. ': '. single_term_title( '', false );
	} else {
		$title = mvn_get_translate('Archives','translation_archives');
	}
	/**
	 * Filter the archive title.
	 *
	 * @since 4.1.0
	 *
	 * @param string $title Archive title to be displayed.
	 */
	return apply_filters( 'get_the_archive_title', $before.$title.$after );
}

function remove_jquery_migrate( $scripts ) {
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];
		if ( $script->deps ) {
			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
		}
	}
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );
function setpostview($postID)
{
    $count_key ='post_views_count';
    $count = get_post_meta($postID, $count_key,true);
    if($count=='')
    {
        $count = 1;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key,'1');
    }
    Else
    {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
function getpostviews($postID)
{
    $count_key ='post_views_count';
    $count = get_post_meta($postID, $count_key,true);
    if($count=='')
    {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key,'1');
        return"0 View";
    }
    return $count.' Views';
}
function weather_widget () {
	$results = true;
	$api_key = "22b1d05362bdc144ae5b9d952f1035e0";
	$open_weather_api = 'http://api.openweathermap.org/data/2.5/group?id=1581130,1583992,1566083&units=metric&appid='.$api_key;

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $open_weather_api);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_VERBOSE, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$response = curl_exec($ch);
	if (curl_errno($ch)) {
		$results = false;    		
	} else {
	    $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	    if ($resultStatus != 200) {
	    	$results = false;
	    }
	}
	
	curl_close($ch);
	$results  = json_decode($response);
	return $results;
}
function currency_widget() {
	$results = true;
	$api_key = "6391ee7ca39e98ac133aa9c469ed9669";
	$currency_layer_api = 'http://apilayer.net/api/live?access_key='.$api_key.'&source=USD&currencies=VND,KRW&format=1';

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $currency_layer_api);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_VERBOSE, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$response = curl_exec($ch);
	if (curl_errno($ch)) {
		$results = false;    		
	} else {
	    $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	    if ($resultStatus != 200) {
	    	$results = false;
	    }
	}
	curl_close($ch);
	$results  = json_decode($response);
	return $results;
}

if( function_exists('acf_add_options_page') ) {
	$parent = acf_add_options_page( array(
		'page_title' => 'LIV General',
		'menu_title' => 'LIV General',
		'icon_url' => 'dashicons-image-filter',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'LIV',
		'menu_title' 	=> 'LIV',
		'parent_slug' 	=> $parent['menu_slug'],
	));
}
function get_reviews($post_id = null) {
  $comments_args = array(
    'post_id' => $post_id,
    'status' => 'approve',
    'type'  => 'comment'
  );
  return get_comments($comments_args);
}
function custom_comment($comment, $agrs, $depth){
	$GLOBALS['comment'] = $comment;
	include ( get_template_directory() . "/template/template-comment.php" );

}
function add_google_recaptcha($submit_field) {
    $submit_field['submit_field'] = '<div class="g-recaptcha" data-sitekey="6LeMwJYUAAAAAJ3cUISBORqTfMdl5fF4WIw_hYyH"></div><br>' . $submit_field['submit_field'];
    return $submit_field;
}
if (!is_user_logged_in()) {
    add_filter('comment_form_defaults','add_google_recaptcha');
}
 
/**
 * Google recaptcha check, validate and catch the spammer
 */
function is_valid_captcha($captcha) {
	$captcha_postdata = http_build_query(array(
        'secret' => '6LeMwJYUAAAAAGKhBFxhGN3HZ51QF8Rl7Pi56G7e',
        'response' => $captcha,
        'remoteip' => $_SERVER['REMOTE_ADDR']));
	$captcha_opts = array('http' => array(
          'method'  => 'POST',
          'header'  => 'Content-type: application/x-www-form-urlencoded',
          'content' => $captcha_postdata));
	$captcha_context  = stream_context_create($captcha_opts);
	$captcha_response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify" , false , $captcha_context), true);
	if ($captcha_response['success'])
	    return true;
	else
	    return false;
}
 
function verify_google_recaptcha() {
	$recaptcha = $_POST['g-recaptcha-response'];
	if (empty($recaptcha))
	    wp_die( __("<b>ERROR:</b> please select <b>I'm not a robot!</b><p><a href='javascript:history.back()'>« Back</a></p>"));
	else if (!is_valid_captcha($recaptcha))
	    wp_die( __("<b>Go away SPAMMER!</b>"));
	}
	if (!is_user_logged_in()) {
	    add_action('pre_comment_on_post', 'verify_google_recaptcha');
}
function ilc_mce_buttons($buttons){
  array_push($buttons,
     "anchor",
     "hr",
     "sub",
     "sup",
     "fontselect",
     "fontsizeselect",
     "styleselect",
     "cleanup"
);
  return $buttons;
}
add_filter("mce_buttons", "ilc_mce_buttons");
function get_average_vote ( $post_id, $post_type ){
	$comment_args = array(
		'status' => 'approve',
		'type'  => 'comment',
		'post_type' => $post_type,
		'post_id' => $post_id,
	);
	$comments = get_comments($comment_args);
	$average_vote = 1;
	if($comments){
		$comment_point = array();
		foreach($comments as $comment) {
			$rating = get_comment_meta( $comment->comment_ID, 'restaurant_rating', true );
			if($rating != ''){
				$comment_point[] = $rating;
			}
		}
		if($comment_point != null){
			$average_vote = array_sum($comment_point)/count($comment_point);
		}
	}
	return $average_vote;
}
