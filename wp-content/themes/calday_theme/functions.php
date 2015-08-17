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
		if ( ! isset( $content_width ) ) $content_width = 1170;
        add_action( 'widgets_init', array( $this, 'register_widgets' ) );

        add_theme_support( 'post-thumbnails' );
    }
	
    public function enqueue_scripts(){
		
		wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css', '3.3.5');
		wp_enqueue_style( 'bootstrap_theme', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css', '3.3.5');
		wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', '4.3.0');
		wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Scada:400,700|Open+Sans:400,300,400italic,600,700', '4.3.0');
		wp_enqueue_style( 'stylesheet', get_stylesheet_directory_uri() . '/css/style.css', array( 'bootstrap', 'bootstrap_theme', 'fontawesome', 'google-fonts' ), '1.0.0' );
		
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', array( 'jquery'), '1.0', true );
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
			'before_widget' => '<div class="sidebox">',
			'after_widget' => "</div>",
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
		
	}
    
    public function register_widgets (){
		register_widget( 'social_widget' );
		register_widget( 'contact_widget' );
	}
	
	public function register_post_types() {
		
	}
	
	function register_taxonomies() {
		
	}
	
}
$tailored_theme = new tailored_theme_class();