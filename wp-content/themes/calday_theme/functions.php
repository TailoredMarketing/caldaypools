<?php
require_once('inc/wp_bootstrap_navwalker.php');
require_once('inc/widgets.php');
require_once('inc/template_functions.php');
class tailored_theme_class {
    
    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'init', array( $this, 'register_image_sizes' ) );
        add_action( 'init', array( $this, 'register_sidebars' ) );
		add_action( 'init', array( $this, 'register_shortcodes' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) ); 
        add_action( 'init', array( $this, 'register_menus' ) );
		add_action( 'add_meta_boxes', array( $this, 'only_home_settings' ) ); 		
		if ( ! isset( $content_width ) ) $content_width = 1070;
        add_action( 'widgets_init', array( $this, 'register_widgets' ) );
		add_filter( 'pre_get_posts', array( $this, 'be_archive_query' ) );

		
		add_action( 'add_meta_boxes_packages', array( $this, 'packages_meta_box') );
		add_action( 'save_post', array( $this, 'save_packages' ) );
		add_action( 'save_post', array( $this, 'save_homepage' ) );
        add_theme_support( 'post-thumbnails' );
    }
	function be_archive_query( $query ) {
		if( $query->is_main_query() && $query->is_post_type_archive('galleries') ) {
			$query->set( 'posts_per_page', 4 );
		}
	}
    public function enqueue_scripts(){
		
		wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', '1.0');
		wp_enqueue_style( 'bootstrap_theme', get_stylesheet_directory_uri() . '/css/bootstrap-theme.min.css', '1.0');
		wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', '1.0');
		wp_enqueue_style( 'theme-style', get_stylesheet_uri(), array( 'bootstrap', 'bootstrap_theme', 'fontawesome' ) );
		
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array( 'jquery'), '1.0', true );
		wp_enqueue_script( 'matchHeight-js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array( 'jquery', 'bootstrap-js' ), '1.0', true );
		wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/js/frontend.js', array( 'jquery', 'bootstrap-js' ), '1.0', true );
		
	}
    
    public function register_image_sizes() {
        add_image_size( 'home-blog', 600, 350, true ); 
        add_image_size( 'custom-medium', 451, 347, true ); 
        add_image_size( 'custom-small', 65, 65, true ); 
        add_image_size( 'blog-home', 300, 200, true ); 
		add_image_size( 'blog-home-lg', 455, 228, true ); 
    }
    
	public function register_shortcodes() {

	}
	
    public function register_menus() {
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'sosen' ),
        ) );
		
		register_nav_menus( array(
            'foot1' => __( 'Footer', 'sosen' ),
        ) );
		
    }
    
    public function register_sidebars() {
		register_sidebar( array(
			'name' => __( 'Main Sidebar', 'seowned' ),
			'id' => 'main_sidebar',
			'before_widget' => '<div class="panel panel-default">',
			'after_widget' => "</div></div>",
			'before_title' => '<div class="panel-heading"><h3 class="panel-title">',
			'after_title' => '</h3></div><div class="panel-body">',
		) );
		
		register_sidebar( array(
			'name' => __( 'Contact Sidebar', 'seowned' ),
			'id' => 'contact_sidebar',
			'before_widget' => '<div class="panel panel-default"><div class="panel-body">',
			'after_widget' => "</div></div>",
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		) );
		
		register_sidebar( array(
			'name' => __( 'About Sidebar', 'seowned' ),
			'id' => 'about_sidebar',
			'before_widget' => '<div class="panel panel-default"><div class="panel-body">',
			'after_widget' => "</div></div>",
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		) );
        
	}
    
    public function register_widgets (){
		register_widget( 'social_widget' );
		register_widget( 'contact_widget' );
	}
	
	public function register_post_types() {
		$gallerylabels = array(
			'name'               => _x( 'Galleries', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Gallery', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Galleries', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Galleries', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New', 'book', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Gallery', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Gallery', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Gallery', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Gallery', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Gallaries', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Galleries', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Galleries:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No Galleries found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No Galleries found in Trash.', 'your-plugin-textdomain' )
		);
	
		$galleryargs = array(
			'labels'             => $gallerylabels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'galleries', 'with_front' => false ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'exclude_from_search'=> false,
			'menu_icon'			 => 'dashicons-format-gallery',
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies'		 => array ( 'slider-cat' )
		);
		
		$packagelabels = array(
			'name'               => _x( 'Packages', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Package', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Packages', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Packages', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New', 'book', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Package', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Package', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Package', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Package', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Packages', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Packages', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Packages:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No packages found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No packages found in Trash.', 'your-plugin-textdomain' )
		);
	
		$packageargs = array(
			'labels'             => $packagelabels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'packages', 'with_front' => false ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'exclude_from_search'=> false,
			'menu_icon'			 => 'dashicons-cart',
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies'		 => array ( 'slider-cat' )
		);
		
		$faqlabels = array(
			'name'               => _x( 'FAQs', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'FAQ', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'FAQs', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'FAQs', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New FAQ', 'book', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New FAQ', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New FAQ', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit FAQ', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View FAQ', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All FAQs', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search FAQs', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent FAQs:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No FAQs found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No FAQs found in Trash.', 'your-plugin-textdomain' )
		);
	
		$faqargs = array(
			'labels'             => $faqlabels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => false,
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'exclude_from_search'=> false,
			'menu_icon'			 => 'dashicons-lightbulb',
			'supports'           => array( 'title', 'editor' ),
			'taxonomies'		 => array ( 'slider-cat' )
		);
		
		$testlabels = array(
			'name'               => _x( 'Testimonials', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Testimonial', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Testimonials', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Testimonials', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New', 'book', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Testimonial', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Testimonial', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Testimonial', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Testimonial', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Testimonials', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Testimonials', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Testimonials:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No testimonials found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No testimonials found in Trash.', 'your-plugin-textdomain' )
		);
	
		$testargs = array(
			'labels'             => $testlabels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'exclude_from_search'=> false,
			'menu_icon'			 => 'dashicons-megaphone',
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies'		 => array ( 'slider-cat' )
		);
		
		$homeslidelabels = array(
			'name'               => _x( 'Landing Page Slider', 'post type general name', 'your-plugin-textdomain' ),
		);
	
		$homeslideargs = array(
			'labels'             => $homeslidelabels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => false,
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'exclude_from_search'=> false,
			'menu_icon'			 => 'dashicons-slides',
			'supports'           => array( 'title', 'thumbnail' ),
			'taxonomies'		 => array ( 'slider-cat' )
		);
	
		register_post_type( 'galleries', $galleryargs );
		register_post_type( 'packages', $packageargs );
		register_post_type( 'faqs', $faqargs );
		register_post_type( 'testimonials', $testargs );
		register_post_type( 'home-slide', $homeslideargs );
	}
	
	function register_taxonomies() {
		
		$slidercatlabels = array(
			'name'              => _x( 'Section', 'taxonomy general name' ),
			'singular_name'     => _x( 'Section', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Sections' ),
			'all_items'         => __( 'All Sections' ),
			'parent_item'       => __( 'Parent Section' ),
			'parent_item_colon' => __( 'Parent Section:' ),
			'edit_item'         => __( 'Edit Section' ),
			'update_item'       => __( 'Update Section' ),
			'add_new_item'      => __( 'Add New Section' ),
			'new_item_name'     => __( 'New Section Name' ),
			'menu_name'         => __( 'Section' ),
		);
	
		$args = array(
			'hierarchical'      => true,
			'labels'            => $slidercatlabels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => false,
			'rewrite'           => false,
		);	
		
		register_taxonomy( 'slider-cat', array( 'home-slide', 'page', 'packages', 'faqs', 'testimonials', 'galleries' ), $args );
		
	}
	
	function only_home_settings() {
	   global $post;
	   $frontpage_id = get_option('page_on_front');
	   if($post->ID == $frontpage_id):
		  add_meta_box('home-text', 'Homepage bottom text', array( $this, 'only_home_form' ), 'page', 'advanced', 'core');
	   endif;
	}
	
	public function only_home_form() {
		global $post;
		$content = get_post_meta( $post->ID, 'home_bottom_text', true );
		$settings = array( 'media_buttons' => false );
		wp_editor( $content, 'home_bottom_text', $settings );	
	}
	
	public function save_homepage( $post_id ) {
		$content = $_POST['home_bottom_text'];
		update_post_meta( $post_id, 'home_bottom_text', $content );
	}
	
	public function packages_meta_box() {
        add_meta_box( 'package_details', 'Package Details', array( $this, 'packages_meta_content' ), 'packages', 'side' , 'core' ); 
    }
	
	public function packages_meta_content( $post ) {
        $meta = get_post_meta($post->ID); ?>
		<table class="form-table">
        	<tr>
            	<th>Price</th>
                <td><input name="package_price" type="number" value="<?php echo ( isset( $meta['package_price'] ) ? $meta['package_price'][0] : '' ); ?>"><p class="description">Please do not include the &pound; symbol</p></td>
            </tr>
            <tr>
            	<th>PayPal Link</th>
                <td><input name="package_paypal" type="url" value="<?php echo ( isset( $meta['package_paypal'] ) ? $meta['package_paypal'][0] : '' ); ?>"></td>
            </tr>
        </table>
    <?php  
		wp_nonce_field( 'packages_save_box', 'packages_save_box_nonce' );  
	}
	
	public function save_packages( $post_id ) {
		if ( ! isset( $_POST['packages_save_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['packages_save_box_nonce'];

		if ( ! wp_verify_nonce( $nonce, 'packages_save_box' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		if ( 'page' == $_POST['post_type'] ) {
			
			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {
			
			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		$price = sanitize_text_field( $_POST['package_price'] );
		$link = sanitize_text_field( $_POST['package_paypal'] );

		// Update the meta field.
		update_post_meta( $post_id, 'package_price', $price );
		update_post_meta( $post_id, 'package_paypal', $link );
	}
	
}
$tailored_theme = new tailored_theme_class();
add_filter( 'template_include', 'var_template_include', 1000 );
function var_template_include( $t ){
    $GLOBALS['current_theme_template'] = basename($t);
    return $t;
}

function get_current_template( $echo = false ) {
    if( !isset( $GLOBALS['current_theme_template'] ) )
        return false;
    if( $echo )
        echo $GLOBALS['current_theme_template'];
    else
        return $GLOBALS['current_theme_template'];
}