jQuery(document).ready(function($){

   var flexible_upload;
   var flexible_selector;

   function flexible_add_file(event, selector) {

      var upload = $(".uploaded-file"), frame;
      var $el = $(this);
      flexible_selector = selector;

      event.preventDefault();

      // If the media frame already exists, reopen it.
      if ( flexible_upload ) {
         flexible_upload.open();
      } else {
         // Create the media frame.
         flexible_upload = wp.media.frames.flexible_upload =  wp.media({
            // Set the title of the modal.
            title: $el.data('choose'),

            // Customize the submit button.
            button: {
               // Set the text of the button.
               text: $el.data('update'),
               // Tell the button not to close the modal, since we're
               // going to refresh the page when the image is selected.
               close: false
            }
         });

         // When an image is selected, run a callback.
         flexible_upload.on( 'select', function() {
            // Grab the selected attachment.
            var attachment = flexible_upload.state().get('selection').first();
            flexible_upload.close();
            flexible_selector.find('.upload').val(attachment.attributes.url);
            if ( attachment.attributes.type == 'image' ) {
               flexible_selector.find('.screenshot').empty().hide().append('<img src="' + attachment.attributes.url + '" style="width:100%;"><a class="remove-image">Remove</a>').slideDown('fast');
            }
            flexible_selector.find('.upload-button').unbind().addClass('remove-file').removeClass('upload-button').val(optionsframework_l10n.remove);
            flexible_selector.find('.of-background-properties').slideDown();
            flexible_selector.find('.remove-image, .remove-file').on('click', function() {
               flexible_remove_file( $(this).parents('.section') );
            });
         });

      }

      // Finally, open the modal.
      flexible_upload.open();
   }

   function flexible_remove_file(selector) {
      selector.find('.remove-image').hide();
      selector.find('.upload').val('');
      selector.find('.of-background-properties').hide();
      selector.find('.screenshot').slideUp();
      selector.find('.remove-file').unbind().addClass('upload-button').removeClass('remove-file').val(flexible_l10n.upload);
      // We don't display the upload button if .upload-notice is present
      // This means the user doesn't have the WordPress 3.5 Media Library Support
      if ( $('.section-upload .upload-notice').length > 0 ) {
         $('.upload-button').remove();
      }
      selector.find('.upload-button').on('click', function(event) {
         flexible_add_file(event, $(this).parents('.sub-option'));
      });
   }

   $('body').on('click', '.remove-image, .remove-file', function() {
      flexible_remove_file( $(this).parents('.sub-option') );
    });

    $('body').on('click', '.upload-button', function( event ) {
      flexible_add_file(event, $(this).parents('.sub-option'));
    });

});