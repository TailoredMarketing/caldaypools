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
class club_contact_widget extends WP_Widget {

		public function __construct() {
			parent::__construct(
				'club_contact_widget', // Base ID
				__('Club Contact Widget', 'text_domain'), // Name
				array( 'description' => __( 'Shows the club contact details', 'text_domain' ), ) // Args
			);
		}
	
		public function widget( $args, $instance ) { 
			echo $args['before_widget']; 
            if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
			}
			global $post;
			$value = get_post_meta( $post->ID, '_club_contacts', true );
			echo '<table class="table table-striped">';	
			if( isset( $value['contact_name_1'] ) && $value['contact_name_1'] != '' ) {
				echo '<tr>';
				echo '<th>'.$value['contact_name_1'].'</th>';
				echo '<td>'.( isset( $value['contact_tel_1'] ) && $value['contact_tel_1'] != '' ? $value['contact_tel_1'] : '' ).'</td>';
				echo '<td>'.( isset( $value['contact_email_1'] ) && $value['contact_email_1'] != '' ? '<a href="mailto:'.$value['contact_email_1'].'"><i class="fa fa-envelope"></i></a>' : '' ).'</td>';
				echo '</tr>';
			}
			if( isset( $value['contact_name_2'] ) && $value['contact_name_2'] != '' ) {
				echo '<tr>';
				echo '<th>'.$value['contact_name_2'].'</th>';
				echo '<td>'.( isset( $value['contact_tel_2'] ) && $value['contact_tel_2'] != '' ? $value['contact_tel_2'] : '' ).'</td>';
				echo '<td>'.( isset( $value['contact_email_2'] ) && $value['contact_email_2'] != '' ? '<a href="mailto:'.$value['contact_email_2'].'"><i class="fa fa-envelope"></i></a>' : '' ).'</td>';
				echo '</tr>';
			}
			if( isset( $value['contact_name_3'] ) && $value['contact_name_3'] != '' ) {
				echo '<tr>';
				echo '<th>'.$value['contact_name_3'].'</th>';
				echo '<td>'.( isset( $value['contact_tel_3'] ) && $value['contact_tel_3'] != '' ? $value['contact_tel_3'] : '' ).'</td>';
				echo '<td>'.( isset( $value['contact_email_3'] ) && $value['contact_email_3'] != '' ? '<a href="mailto:'.$value['contact_email_3'].'"><i class="fa fa-envelope"></i></a>' : '' ).'</td>';
				echo '</tr>';
			}
			if( isset( $value['contact_url'] ) && $value['contact_url'] != '' ) {
				echo '<tr>';
				echo '<th>Website</th>';
				echo '<td colspan="2">'.( isset( $value['contact_url'] ) && $value['contact_url'] != '' ? '<a href="'.$value['contact_url'].'" target="_blank">'.$value['contact_url'].'</a>' : '' ).'</td>';
				
				echo '</tr>';
			}
			
				echo '</table>';	
            echo $args['after_widget']; 
		}
	
		public function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => 'Contact Details' ) );
            $title = $instance['title'];
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
        <?php
		}
	
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            return $instance;
		}
	}