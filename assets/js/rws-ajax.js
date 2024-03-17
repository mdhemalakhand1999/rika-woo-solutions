(function($) {
    const ajax_url = _rws_object?.ajax_url;
    const nonce = _rws_object?.nonce;
    /**
     * Update option for activate features when click input
     * 
     * @since 1.0.0
     */
    $('.rws-feature-ajax-activate input').on( 'change', function() {
        const inputVal = $(this).is(":checked") ? 1 : 0;
        const inputName = $(this).attr( 'name' );
        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: {
                action: 'rws_feature_activate_option',
                nonce,
                field_value: inputVal,
                field_name: inputName
            },
            success: function( response ) {
                console.log(response);
            },
            error: function( xhr, status, error ) {
                console.log( error );
            }
        });
    } );
})(jQuery)