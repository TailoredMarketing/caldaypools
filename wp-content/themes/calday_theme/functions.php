<?php
require_once('inc/wp_bootstrap_navwalker.php');
require_once('inc/widgets.php');
require_once('inc/template_functions.php');
class tailored_theme_class {
    
	public $option_name = 'tailored_theme';
	
    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) ); 
        add_action( 'init', array( $this, 'register_image_sizes' ) );
        add_action( 'init', array( $this, 'register_sidebars' ) );
		add_action( 'init', array( $this, 'register_shortcodes' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) ); 
        add_action( 'init', array( $this, 'register_menus' ) );
		add_action( 'add_meta_boxes', array( $this, 'clubs_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_club_contacts_meta' ), 10, 3 ) ;
		add_action( 'admin_menu', array($this, 'admin_menu') );
		add_action('pre_get_posts', array( $this, 'sort_archive_loop' ) );
		
		add_action( 'admin_post_tailored_theme_options_save', array($this, 'tailored_theme_options_save') );
		
		if ( ! isset( $content_width ) ) $content_width = 1170;
        add_action( 'widgets_init', array( $this, 'register_widgets' ) );
        add_theme_support( 'post-thumbnails' );
		
		$this->option = get_option($this->option_name);
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
    
	public function admin_enqueue_scripts(){
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'admin-js', get_stylesheet_directory_uri() . '/js/admin.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_style( 'admin-css', get_stylesheet_directory_uri() . '/css/admin.css' );
		wp_enqueue_style('thickbox');
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
	public function get_option()
    {
        return $this->option;
    }
	public function admin_menu() {
		add_object_page('Theme Options', 'Theme Options', 'manage_options', 'theme-options', array($this, 'theme_options'), $this->admin_icon);	
		add_submenu_page('theme-options', 'Theme Options', 'Homepage', 'manage_options', 'theme-options', array($this, 'theme_options'));
		add_submenu_page('theme-options', 'Theme Options', 'Contact Details', 'manage_options', 'theme-options/tab1', array($this, 'theme_options'));
		add_submenu_page('theme-options', 'Theme Options', 'Analytics', 'manage_options', 'theme-options/tab2', array($this, 'theme_options'));
		add_submenu_page('theme-options', 'Theme Options', 'Advanced', 'manage_options', 'theme-options/tab3', array($this, 'theme_options'));
	}
	
	public function theme_options() { 
		$option = $this->get_option();
		$tab = explode( '/', urldecode( $_REQUEST['page'] ) );
		$tab = $tab[1];
		$tab = str_replace( 'tab', '', $tab );
		wp_enqueue_media();
	?>
    	<div class="wrap">
            <h2>Settings</h2>

            <h2 class="nav-tab-wrapper">
                <a class="nav-tab <?php echo(!isset($tab) || $tab == 0 ? 'nav-tab-active' : ''); ?>"
                   href="<?php echo admin_url('admin.php?page=theme-options'); ?>">Homepage</a>
                <a class="nav-tab <?php echo(isset($tab) && $tab == 1 ? 'nav-tab-active' : ''); ?>"
                   href="<?php echo admin_url('admin.php?page=theme-options/tab1'); ?>">Contact Details</a>
                <a class="nav-tab <?php echo(isset($tab) && $tab == 2 ? 'nav-tab-active' : ''); ?>"
                   href="<?php echo admin_url('admin.php?page=theme-options/tab2'); ?>">Analytics</a>
                <a class="nav-tab <?php echo(isset($tab) && $tab == 3 ? 'nav-tab-active' : ''); ?>"
                   href="<?php echo admin_url('admin.php?page=theme-options/tab3'); ?>">Advanced</a>
            </h2>
            <form method="POST" action="<?php echo admin_url('admin-post.php'); ?>">
            <?php if ( !isset( $tab ) || $tab == 0 ) { ?>
            	<h3>Homepage Options</h3>
            	<table class="form-table">
                    <tr>
                        <th>Intro Text</th>
                        <td>
                            <?php wp_editor((isset($option['theme_options']['homepage']['intro']) ? $option['theme_options']['homepage']['intro'] : ''), 'home_intro', array('textarea_name' => $this->option_name . '[theme_options][homepage][intro]', 'textarea_rows' => 5, 'media_buttons' => false)); ?>
                        </td>
                    </tr>
                    <tr>
                    	<th>Sales Boxes</th>
                        <td>
                        	<table width="100%">
                            	<tr>
                                	<td width="5%">
                                    	<strong>Image</strong>
                                    </td>
                                    <td width="25%">
                                    	<div id="box1_preview" class="preview_box">
                                        	<?php
											
												if( isset( $option['theme_options']['homepage']['boxes']['box1']['image'] ) && $option['theme_options']['homepage']['boxes']['box1']['image'] != '' ) {
													$image 		= wp_get_attachment_image_src( $option['theme_options']['homepage']['boxes']['box1']['image'], 'full' );
													$preview 	= $image[0];
													$imgsrc 	= $option['theme_options']['homepage']['boxes']['box1']['image'];
												} else {
													$preview = 'https://placehold.it/500x250/ffffff/cccccc/?txtsize=33&text=no+image+uploaded';
													$imgsrc = '';
												}
											?>
                                        	<img src="<?php echo $preview; ?>" style="width: 100%; height: auto;">
                                        </div>
                                        <input type="hidden" name="<?php echo $this->option_name . '[theme_options][homepage][boxes][box1][image]'; ?>" value="<?php echo $imgsrc; ?>" id="box1_image">
                                        <?php 
											if( $imgsrc == '' ) { $buttext = 'Upload'; } else { $buttext = 'Change'; }
											submit_button( $buttext, 'secondary upload_media_box', 'upload-box1', false, array( 'rel' => 'box1' ) ); 
										?>
                                    </td>
                                    <td width="25%">
                                    	<div id="box2_preview" class="preview_box">
                                        	<?php
												if( isset( $option['theme_options']['homepage']['boxes']['box2']['image'] ) && $option['theme_options']['homepage']['boxes']['box2']['image'] != '' ) {
													$image 		= wp_get_attachment_image_src( $option['theme_options']['homepage']['boxes']['box2']['image'], 'full' );
													$preview 	= $image[0];
													$imgsrc 	= $option['theme_options']['homepage']['boxes']['box2']['image'];
												} else {
													$preview = 'https://placehold.it/500x250/ffffff/cccccc/?txtsize=33&text=no+image+uploaded';
													$imgsrc = '';
												}
											?>
                                        	<img src="<?php echo $preview; ?>" style="width: 100%; height: auto;">
                                        </div>
                                        <input type="hidden" name="<?php echo $this->option_name . '[theme_options][homepage][boxes][box2][image]'; ?>" value="<?php echo $imgsrc; ?>" id="box2_image">
                                        <?php 
											if( $imgsrc == '' ) { $buttext = 'Upload'; } else { $buttext = 'Change'; }
											submit_button( $buttext, 'secondary upload_media_box', 'upload-box2', false, array( 'rel' => 'box2' ) ); 
											
										?>
                                    </td>
                                    <td width="25%">
                                    	<div id="box3_preview" class="preview_box">
                                        	<?php
												if( isset( $option['theme_options']['homepage']['boxes']['box3']['image'] ) && $option['theme_options']['homepage']['boxes']['box3']['image'] != '' ) {
													$image = 	wp_get_attachment_image_src( $option['theme_options']['homepage']['boxes']['box3']['image'], 'full' );
													$preview 	= $image[0];
													$imgsrc 	= $option['theme_options']['homepage']['boxes']['box3']['image'];
												} else {
													$preview = 'https://placehold.it/500x250/ffffff/cccccc/?txtsize=33&text=no+image+uploaded';
													$imgsrc = '';
												}
											?>
                                        	<img src="<?php echo $preview; ?>" style="width: 100%; height: auto;">
                                        </div>
                                        <input type="hidden" name="<?php echo $this->option_name . '[theme_options][homepage][boxes][box3][image]'; ?>" value="<?php echo $imgsrc; ?>" id="box3_image">
                                        <?php 
											if( $imgsrc == '' ) { $buttext = 'Upload'; } else { $buttext = 'Change'; }
											submit_button( $buttext, 'secondary upload_media_box', 'upload-box3', false, array( 'rel' => 'box3' ) ); 
											
										?>
                                    </td>
                                </tr>
                                <tr>
                                	<td>
                                    	<strong>Header</strong>
                                    </td>
                                	<td>
                                    	<input type="text" class="large-text" name="<?php echo $this->option_name . '[theme_options][homepage][boxes][box1][header]'; ?>" value="<?php echo (isset($option['theme_options']['homepage']['boxes']['box1']['header']) ? $option['theme_options']['homepage']['boxes']['box1']['header'] : ''); ?>">
                                    </td>
                                    <td>
                                    	<input type="text" class="large-text" name="<?php echo $this->option_name . '[theme_options][homepage][boxes][box2][header]'; ?>"  value="<?php echo (isset($option['theme_options']['homepage']['boxes']['box2']['header']) ? $option['theme_options']['homepage']['boxes']['box2']['header'] : ''); ?>">
                                    </td>
                                    <td>
                                    	<input type="text" class="large-text" name="<?php echo $this->option_name . '[theme_options][homepage][boxes][box3][header]'; ?>"  value="<?php echo (isset($option['theme_options']['homepage']['boxes']['box3']['header']) ? $option['theme_options']['homepage']['boxes']['box3']['header'] : ''); ?>">
                                    </td>
                                </tr>
                                <tr>
                                	<td>
                                    	<strong>Text</strong>
                                    </td>
                                	<td>
                                    	<textarea width="100%" class="large-text" name="<?php echo $this->option_name . '[theme_options][homepage][boxes][box1][text]'; ?>" rows="5"><?php echo (isset($option['theme_options']['homepage']['boxes']['box1']['text']) ? $option['theme_options']['homepage']['boxes']['box1']['text'] : ''); ?></textarea>
                                    </td>
                                    <td>
                                    	<textarea width="100%" class="large-text" name="<?php echo $this->option_name . '[theme_options][homepage][boxes][box2][text]'; ?>" rows="5"><?php echo (isset($option['theme_options']['homepage']['boxes']['box2']['text']) ? $option['theme_options']['homepage']['boxes']['box2']['text'] : ''); ?></textarea>
                                    </td>
                                    <td>
                                    	<textarea width="100%" class="large-text" name="<?php echo $this->option_name . '[theme_options][homepage][boxes][box3][text]'; ?>" rows="5"><?php echo (isset($option['theme_options']['homepage']['boxes']['box3']['text']) ? $option['theme_options']['homepage']['boxes']['box3']['text'] : ''); ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                	<td>
                                    	<strong>Link</strong>
                                    </td>
                                	<td>
                                    	<input type="text" class="large-text" name="<?php echo $this->option_name . '[theme_options][homepage][boxes][box1][link]'; ?>" value="<?php echo (isset($option['theme_options']['homepage']['boxes']['box1']['link']) ? $option['theme_options']['homepage']['boxes']['box1']['link'] : ''); ?>">
                                    </td>
                                    <td>
                                    	<input type="text" class="large-text" name="<?php echo $this->option_name . '[theme_options][homepage][boxes][box2][link]'; ?>"  value="<?php echo (isset($option['theme_options']['homepage']['boxes']['box2']['link']) ? $option['theme_options']['homepage']['boxes']['box2']['link'] : ''); ?>">
                                    </td>
                                    <td>
                                    	<input type="text" class="large-text" name="<?php echo $this->option_name . '[theme_options][homepage][boxes][box3][link]'; ?>"  value="<?php echo (isset($option['theme_options']['homepage']['boxes']['box3']['link']) ? $option['theme_options']['homepage']['boxes']['box3']['link'] : ''); ?>">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            <?php } elseif( isset( $tab ) && $tab == 1 ) { ?>
            	<h3>Contact Details</h3>
            	<table class="form-table">
                    <tr>
                        <th>Street Address</th>
                        <td>
                        	<input class="regular-text" type="text" name="<?php echo $this->option_name . '[theme_options][address][street]'; ?>" value="<?php echo (isset($option['theme_options']['address']['street']) ? $option['theme_options']['address']['street'] : ''); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>Address 2</th>
                        <td>
                        	<input class="regular-text" type="text" name="<?php echo $this->option_name . '[theme_options][address][address_2]'; ?>" value="<?php echo (isset($option['theme_options']['address']['address_2']) ? $option['theme_options']['address']['address_2'] : ''); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>Town</th>
                        <td>
                        	<input class="regular-text" type="text" name="<?php echo $this->option_name . '[theme_options][address][town]'; ?>" value="<?php echo (isset($option['theme_options']['address']['town']) ? $option['theme_options']['address']['town'] : ''); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>County</th>
                        <td>
                        	<input class="regular-text" type="text" name="<?php echo $this->option_name . '[theme_options][address][county]'; ?>" value="<?php echo (isset($option['theme_options']['address']['county']) ? $option['theme_options']['address']['county'] : ''); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>Postcode</th>
                        <td>
                        	<input class="regular-text" type="text" name="<?php echo $this->option_name . '[theme_options][address][postcode]'; ?>" value="<?php echo (isset($option['theme_options']['address']['postcode']) ? $option['theme_options']['address']['postcode'] : ''); ?>">
                        </td>
                    </tr>
                    <tr><td colspan="2"><hr></td></tr>
                    <tr>
                        <th>Phone Number</th>
                        <td>
                        	<input class="regular-text" type="text" name="<?php echo $this->option_name . '[theme_options][address][phone]'; ?>" value="<?php echo (isset($option['theme_options']['address']['phone']) ? $option['theme_options']['address']['phone'] : ''); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>Email Address</th>
                        <td>
                        	<input class="regular-text" type="text" name="<?php echo $this->option_name . '[theme_options][address][email]'; ?>" value="<?php echo (isset($option['theme_options']['address']['email']) ? $option['theme_options']['address']['email'] : ''); ?>">
                        </td>
                    </tr>
                    <tr><td colspan="2"><hr></td></tr>
                    <tr>
                        <th>Facebook</th>
                        <td>
                        	<input class="regular-text" type="text" name="<?php echo $this->option_name . '[theme_options][address][facebook]'; ?>" value="<?php echo (isset($option['theme_options']['address']['facebook']) ? $option['theme_options']['address']['facebook'] : ''); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>Twitter</th>
                        <td>
                        	<input class="regular-text" type="text" name="<?php echo $this->option_name . '[theme_options][address][twitter]'; ?>" value="<?php echo (isset($option['theme_options']['address']['twitter']) ? $option['theme_options']['address']['twitter'] : ''); ?>">
                        </td>
                    </tr>
                </table>            
            <?php } elseif( isset( $tab ) && $tab == 2 ) { ?>
            	<h3>Contact Details</h3>
            	<table class="form-table">
                    <tr>
                        <th>Tracking Code</th>
                        <td>
                        	<textarea width="60%" class="large-text code" name="<?php echo $this->option_name . '[theme_options][analytics][code]'; ?>" rows="10"><?php echo (isset($option['theme_options']['analytics']['code']) ? $option['theme_options']['analytics']['code'] : ''); ?></textarea>
                        </td>
                    </tr>
                </table>
            <?php } elseif( isset( $tab ) && $tab == 3 ) { ?>
            	<h3>Advanced</h3>
            	<table class="form-table">
                    <tr>
                        <th>Custom &lt;head&gt; code</th>
                        <td>
                        	<textarea width="60%" class="large-text code" name="<?php echo $this->option_name . '[theme_options][advanced][head]'; ?>" rows="10"><?php echo (isset($option['theme_options']['advanced']['head']) ? $option['theme_options']['advanced']['head'] : ''); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>Custom CSS</th>
                        <td>
                        	<textarea width="60%" class="large-text code" name="<?php echo $this->option_name . '[theme_options][advanced][css]'; ?>" rows="10"><?php echo (isset($option['theme_options']['advanced']['css']) ? $option['theme_options']['advanced']['css'] : ''); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>Custom JS</th>
                        <td>
                        	<textarea width="60%" class="large-text code" name="<?php echo $this->option_name . '[theme_options][advanced][js]'; ?>" rows="10"><?php echo (isset($option['theme_options']['advanced']['js']) ? $option['theme_options']['advanced']['js'] : ''); ?></textarea>
                        </td>
                    </tr>
                </table>
            <?php } ?>
            	<input type="hidden" value="tailored_theme_options_save" name="action"/>
                <?php wp_nonce_field('tailored_theme_options_save', $this->option_name . '_nonce', TRUE); ?>
                <?php submit_button( 'Update Settings', 'primary', 'save_settings', false ); ?>
            </form>
        </div>
    <?php } 
	
	public function tailored_theme_options_save() {
		if (!wp_verify_nonce($_POST[$this->option_name . '_nonce'], 'tailored_theme_options_save'))
            die('Invalid nonce.' . var_export($_POST, true));
        
		
		if (isset ($_POST[$this->option_name])) {
			$array = $this->get_option();
            foreach ($_POST[$this->option_name] AS $key => $value) {
				foreach ( $value AS $k => $v) { 
                	$array[$key][$k] = $v;
				}
            }
			update_option($this->option_name, $array);
            
        } 
        if (!isset ($_POST['_wp_http_referer']))
            die('Missing target.');

        $url = urldecode($_POST['_wp_http_referer']);

        wp_safe_redirect($url);
        exit;
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
		register_sidebar( array(
			'name' => __( 'Clubs Sidebar', 'seowned' ),
			'id' => 'clubs_sidebar',
			'before_widget' => '<div class="sidebox">',
			'after_widget' => "</div>",
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
	}
    
    public function register_widgets (){
		register_widget( 'social_widget' );
		register_widget( 'club_contact_widget' );
	}
	
	public function register_post_types() {
		$labels = array(
			'name'               => _x( 'Clubs', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Club', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Clubs', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Clubs', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New Club', 'book', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Clubs', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Club', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Club', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Club', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Clubs', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Clubs', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Clubs:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No clubs found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No clubs found in Trash.', 'your-plugin-textdomain' )
		);
	
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'clubs', 'with_front' => false ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'exclude_from_search'=> true,
			'menu_position'      => 21,
			'menu_icon'			 => 'dashicons-universal-access',
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
		);
		
		$labels2 = array(
			'name'               => _x( 'Lessons', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Lesson', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Lessons', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Lessons', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New Lesson', 'book', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Lesson', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Lesson', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Lesson', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Lesson', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Lessons', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Lessons', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Lessons:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No lesson found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No lesson found in Trash.', 'your-plugin-textdomain' )
		);
	
		$args2 = array(
			'labels'             => $labels2,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'lessons', 'with_front' => false ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'exclude_from_search'=> true,
			'menu_position'      => 22,
			'menu_icon'			 => 'dashicons-megaphone',
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
		);
	
		register_post_type( 'clubs', $args );
		register_post_type( 'lessons', $args2 );
	}
	
	function register_taxonomies() {
		
	}
	
	function clubs_meta_box() {
		add_meta_box(
			'club_contacts_meta',
			__( 'Club Contacts', 'myplugin_textdomain' ),
			array( $this, 'club_contacts_meta_callback' ),
			'clubs'
		);
		
		add_meta_box(
			'club_contacts_meta',
			__( 'Lesson Contacts', 'myplugin_textdomain' ),
			array( $this, 'club_contacts_meta_callback' ),
			'lessons'
		);
	}
	
	function club_contacts_meta_callback( $post ) {
	
		// Add a nonce field so we can check for it later.
		wp_nonce_field( 'club_contacts_meta_data', 'club_contacts_meta_nonce' );
	
		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */
		$value = get_post_meta( $post->ID, '_club_contacts', true );
		echo '<table id="club_contact_table">';
		?>
			<tbody>
            	<tr>
                    <th>Contact 1</th>
                    <td><input type="text" name="contact_name_1" placeholder="Contact Name" value="<?php echo ( isset( $value['contact_name_1'] ) ? $value['contact_name_1'] : '' );?>"></td>
                    <td><input type="text" name="contact_tel_1" placeholder="Contact Telephone" value="<?php echo ( isset( $value['contact_tel_1'] ) ? $value['contact_tel_1'] : '' );?>"></td>
                    <td><input type="email" name="contact_email_1" placeholder="Contact Email" value="<?php echo ( isset( $value['contact_email_1'] ) ? $value['contact_email_1'] : '' );?>"></td>
                </tr>
                <tr>
                	<th>Contact 2</th>
                    <td><input type="text" name="contact_name_2" placeholder="Contact Name" value="<?php echo ( isset( $value['contact_name_2'] ) ? $value['contact_name_2'] : '' );?>"></td>
                    <td><input type="text" name="contact_tel_2" placeholder="Contact Telephone" value="<?php echo ( isset( $value['contact_tel_2'] ) ? $value['contact_tel_2'] : '' );?>"></td>
                    <td><input type="email" name="contact_email_2" placeholder="Contact Email" value="<?php echo ( isset( $value['contact_email_2'] ) ? $value['contact_email_2'] : '' );?>"></td>
                </tr>
                <tr>
                	<th>Contact 3</th>
                    <td><input type="text" name="contact_name_3" placeholder="Contact Name" value="<?php echo ( isset( $value['contact_name_3'] ) ? $value['contact_name_3'] : '' );?>"></td>
                    <td><input type="text" name="contact_tel_3" placeholder="Contact Telephone" value="<?php echo ( isset( $value['contact_tel_3'] ) ? $value['contact_tel_3'] : '' );?>"></td>
                    <td><input type="email" name="contact_email_3" placeholder="Contact Email" value="<?php echo ( isset( $value['contact_email_3'] ) ? $value['contact_email_3'] : '' );?>"></td>
                </tr>
                <tr>
                	<th>Website</th>
                    <td><input type="url" name="contact_url" placeholder="Website Address" value="<?php echo ( isset( $value['contact_url'] ) ? $value['contact_url'] : '' );?>"></td>
                </tr>
            </tbody>
		<?php
		echo '</table>';
	}
	
	public function save_club_contacts_meta( $post_id ) {
	
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['club_contacts_meta_nonce'] ) )
			return $post_id;

		$nonce = $_POST['club_contacts_meta_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'club_contacts_meta_data' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
                //     so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		// Check the user's permissions.
		if ( 'clubs' == $_POST['post_type'] || 'lessons' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		/* OK, its safe for us to save the data now. */

		// Sanitize the user input.
		$mydata = array(
			'contact_name_1' => ( isset( $_POST['contact_name_1'] ) ? $_POST['contact_name_1'] : '' ),
			'contact_tel_1' => ( isset( $_POST['contact_tel_1'] ) ? $_POST['contact_tel_1'] : '' ),
			'contact_email_1' => ( isset( $_POST['contact_email_1'] ) ? $_POST['contact_email_1'] : '' ),
			'contact_name_2' => ( isset( $_POST['contact_name_2'] ) ? $_POST['contact_name_2'] : '' ),
			'contact_tel_2' => ( isset( $_POST['contact_tel_2'] ) ? $_POST['contact_tel_2'] : '' ),
			'contact_email_2' => ( isset( $_POST['contact_email_2'] ) ? $_POST['contact_email_2'] : '' ),
			'contact_name_3' => ( isset( $_POST['contact_name_3'] ) ? $_POST['contact_name_3'] : '' ),
			'contact_tel_3' => ( isset( $_POST['contact_tel_3'] ) ? $_POST['contact_tel_3'] : '' ),
			'contact_email_3' => ( isset( $_POST['contact_email_3'] ) ? $_POST['contact_email_3'] : '' ),
			'contact_url'	=> ( isset( $_POST['contact_url'] ) ? $_POST['contact_url'] : '' ),
		);
				
		// Update the meta field.
		update_post_meta( $post_id, '_club_contacts', $mydata );
	}
	function sort_archive_loop($query) {
		if ( is_post_type_archive('lessons') || is_post_type_archive('clubs') ) {
			$query->set('order', 'ASC');
			$query->set('orderby', 'menu_order');
		}
	}
}
$tailored_theme = new tailored_theme_class();