(function($) {
    const ajax_url = _rws_object?.ajax_url;
    const nonce = _rws_object?.nonce;
    /**
     * Ajax for add flash sale event
     */
    $('.rws-ajax-create-event').on( 'click', function() {
        const thisTarget = $(this);
        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: {
                action: 'rws_add_flash_event',
                nonce,
            },
            success: function( response ) {
                const content = response?.data?.content;
                thisTarget.closest('.rws-add-sels-event-group').find('.rws-add-sels-event-inner-group').append(content);
            },
            error: function( xhr, status, error ) {
                console.log( error );
            }
        });
    } )
})(jQuery)