jQuery(document).ready(function() {
	var clicked, imgurl, inputclass, imageclass, file_frame, attachment;
	jQuery('.upload_media_box').click(function(e) {
		clicked = jQuery(this);
		inputclass = clicked.attr('rel');
		e.preventDefault();
		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
		  file_frame.open();
		  return;
		}
	
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		  title: jQuery( this ).data( 'uploader_title' ),
		  button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		  },
		  multiple: false  // Set to true to allow multiple files to be selected
		});
	
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
		  // We set multiple to false so only get one image from the uploader
		  attachment = file_frame.state().get('selection').first().toJSON();
	
		  jQuery('#'+inputclass+'_preview img').attr( 'src', attachment.url );
		  jQuery('#'+inputclass+'_image').val( attachment.id );
		});
	
		// Finally, open the modal
		file_frame.open();
	});
	
	window.send_to_editor = function(html) {
		console.log( jQuery('img',html) );
		imgurl = jQuery('img',html).attr('src');
		jQuery('#'+inputclass+'_image').val(imgurl);
		jQuery('#'+inputclass+'_preview img').attr('src', imgurl);
		tb_remove();
	}
});