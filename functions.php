<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {
	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
	wp_enqueue_style( 'header-css', get_stylesheet_directory_uri() . '/styles/header.css' );
	wp_enqueue_style( 'breakpoint-styles-css', get_stylesheet_directory_uri() . '/styles/breakpoint-styles.css' );
    wp_enqueue_style( 'footer-css', get_stylesheet_directory_uri() . '/styles/footer.css' );
    wp_enqueue_style( 'menu-css', get_stylesheet_directory_uri() . '/styles/menu.css' );
    wp_enqueue_style( 'front-page-css', get_stylesheet_directory_uri() . '/styles/front-page.css' );
}
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

//** *Enable upload for webp image files.*/
function webp_upload_mimes($existing_mimes) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');

//** * Enable preview / thumbnail for webp image files.*/
function webp_is_displayable($result, $path) {
    if ($result === false) {
        $displayable_image_types = array( IMAGETYPE_WEBP );
        $info = @getimagesize( $path );

        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }

    return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);

//Creating a custom post type for home page testimonials
function create_testimonials() {
    $labels = array(
		'name'               => _x( 'Testimonials', 'post type general name' ),
		'singular_name'      => _x( 'Testimonial', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'review' ),
		'add_new_item'       => __( 'Add New Testimonial' ),
		'edit_item'          => __( 'Edit Testimonial' ),
		'new_item'           => __( 'New Testimonial' ),
		'all_items'          => __( 'All Testimonials' ),
		'view_item'          => __( 'View Testimonials' ),
		'search_items'       => __( 'Search Testimonials' ),
		'not_found'          => __( 'No testimonials found' ),
		'not_found_in_trash' => __( 'No testimonials found in the Trash' ), 
		'parent_item_colon'  => '’',
		'menu_name'          => 'Testimonials'
	  );
	  $args = array(
		'labels'        => $labels,
		'description'   => 'Holds testimonials for Quality Roofing in 2019',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon'     => 'dashicons-awards',
		'supports'      => array( 'title' ),
		'has_archive'   => true,
	  );
	  register_post_type( 'testimonial', $args ); 
}
// Hooking up our function to theme setup
add_action( 'init', 'create_testimonials' );

// Code to render/save Author post metabox
function add_author_metabox(){
    add_meta_box(
        "author_meta_box",
        "Author",
        "show_custom_metabox_author",
        "testimonial"
    );
}
add_action("add_meta_boxes", "add_author_metabox");

function show_custom_metabox_author(){
	global $post;
    $value = get_post_meta($post->ID, "author_meta_box_nonce", true);

    echo '<input type="text" name="author_meta_box_nonce" value="'. $value .'">';
 }

 function on_save_post_author($post_id){
    $meta_value = isset($_POST["author_meta_box_nonce"]) ?  $_POST["author_meta_box_nonce"]  : false;

    update_post_meta($post_id,"author_meta_box_nonce", $meta_value);
 }
 add_action("save_post", "on_save_post_author");
//Auther End

// Code to render/save Content post metabox
function add_content_metabox(){
    add_meta_box(
        "content_meta_box",
        "Content",
        "show_custom_metabox_content",
        "testimonial"
    );
}
add_action("add_meta_boxes", "add_content_metabox");

function show_custom_metabox_content(){
	global $post;
    $value = get_post_meta($post->ID, "content_meta_box_nonce", true);
	?> 
		<textarea name="content_meta_box_nonce" id="content_meta_box_nonce" rows="5" cols="30" style="width:500px;"><?php echo $value; ?></textarea>
	<?php
 }

 function on_save_post_content($post_id){
    $meta_value = isset($_POST["content_meta_box_nonce"]) ?  $_POST["content_meta_box_nonce"]  : false;

    update_post_meta($post_id,"content_meta_box_nonce", $meta_value);

 }
 add_action("save_post", "on_save_post_content");
//Content End

// Code to render/save Rating post metabox -- if needed
 function add_rating_metabox(){
    add_meta_box(
        "rating_meta_box",
        "Rating",
        "show_custom_metabox_rating",
        "testimonial"
    );
}
add_action("add_meta_boxes", "add_rating_metabox");

function show_custom_metabox_rating(){
	global $post;
    $value = get_post_meta($post->ID, "rating_meta_box_nonce", true);

    echo '<input type="text" name="rating_meta_box_nonce" value="'. $value .'">';
 }

 function on_save_post_rating($post_id){
    $meta_value = isset($_POST["rating_meta_box_nonce"]) ?  $_POST["rating_meta_box_nonce"]  : false;

    update_post_meta($post_id,"rating_meta_box_nonce", $meta_value);
 }
 add_action("save_post", "on_save_post_rating");
//Rating End

// Using Astras' astra_head_bottom hook to load Swiper and Bootstrap stylesheets into head.
// For more info of Astra Hooks see: https://wpastra.com/docs/using-hooks/
add_action( 'astra_head_bottom', 'load_css' );
function load_css() { ?>
      <link rel="stylesheet" id="bootstrap-css" href="/wp-content/astra-child/lib/bootstrap/css/bootstrap.min.css" type="text/css" media="all">
      <link rel="stylesheet" id="swiper-css" href="/wp-content/astra-child/lib/swiper/css/swiper.min.css" type="text/css" media="all">
<?php }

// Using Astras' astra_footer_after hook to load (w/ defer) our custom script, Swiper, and Bootstrap into footer template.
// For more info of Astra Hooks see: https://wpastra.com/docs/using-hooks/
add_action( 'astra_footer_after', 'load_js' );
function load_js() { ?>
      <script type="text/javascript" src="/wp-content/astra-child/lib/swiper/js/swiper.min.js" id="swiper-js" defer></script>
      <script type="text/javascript" src="/wp-content/astra-child/lib/bootstrap/js/bootstrap.min.js" id="bootstrap-js" defer></script>
      <script type="text/javascript" src="/wp-content/themes/astra-child/custom.js" defer></script>
<?php }

//Defining default excerpt length for posts
function my_excerpt_length($length){
	return 15;
}
add_filter('excerpt_length', 'my_excerpt_length');