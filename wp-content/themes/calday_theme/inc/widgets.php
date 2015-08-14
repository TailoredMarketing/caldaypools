<?php
class social_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'social_widget', // Base ID
			__('Social Icons', 'text_domain'), // Name
			array( 'description' => __( 'Shows the social icons', 'text_domain' ), ) // Args
		);
	}
	
	public function widget( $args, $instance ) { ?>
		<?php echo $args['before_widget']; ?>
		<p class="text-center social-icons">
			<a href="http://twitter.com/LisaGillPhoto"><i class="fa fa-twitter fa-2x"></i></a> 
			<a href="http://www.facebook.com/LisaGillPhotographyStudio"><i class="fa fa-facebook fa-2x"></i></a> 
			<a href="https://pinterest.com/lisagillphoto/"><i class="fa fa-pinterest fa-2x"></i></a>
		</p>            
		<?php echo $args['after_widget']; ?>
	<?php
	}
	
	public function form( $instance ) {
	?>
		<p>There are no options for this widget.</p>
	<?php
	}
	
	public function update( $new_instance, $old_instance ) {
		
	}
}
class contact_widget extends WP_Widget {

		public function __construct() {
			parent::__construct(
				'contact_widget', // Base ID
				__('Contact Widget', 'text_domain'), // Name
				array( 'description' => __( 'Shows the contact details', 'text_domain' ), ) // Args
			);
		}
	
		public function widget( $args, $instance ) { ?>
			<?php echo $args['before_widget']; ?>
            <p class="text-center">For more information, please<br>
                do email or give me a call:</p>
                <p class="text-center"><strong><?php echo $instance['phone']; ?></strong></p>
                <hr>
                <p class="text-center">I am also on Facebook, Twitter<br>
                and more recently Linked In.</p>
            <?php echo $args['after_widget']; ?>
        <?php
		}
	
		public function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'phone' => '(01494) 680811' ) );
            $phone = $instance['phone'];
?>
            <p><label for="<?php echo $this->get_field_id('phone'); ?>">Phone Number: <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($phone); ?>" /></label></p>
        <?php
		}
	
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
            $instance['phone'] = $new_instance['phone'];
            return $instance;
		}
	}