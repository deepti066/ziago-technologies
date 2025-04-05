(function ($) {
	'use strict';

    $(document).on('ready', function() {
        var file_frame;

        $('#services_video_upload_btn').on('click', function(podcast) {

            podcast.preventDefault();

            // If the media frame already exists, reopen it.
            if (file_frame) {
                file_frame.open();
                return;
            }

            // Create the media frame.
            file_frame = wp.media.frames.file_frame = wp.media({
                title: $(this).data('uploader_title'),
                button: {
                    text: $(this).data('uploader_button_text'),
                },
                multiple: false
            });
            file_frame.on('select', function() {
                var attachment = file_frame.state().get('selection').first().toJSON();
                //var all = JSON.stringify( attachment );      
                var id = attachment.id;
                var url = attachment.url;
                if(url) {
                    $('#_service_icon_id').val(id);
                    $('#service_icon_preview').attr('src', url);
                    $('#services_video_upload_btn').text('Change service icon');
                }

            });

            // Finally, open the modal
            file_frame.open();
        });
    })

})(jQuery)