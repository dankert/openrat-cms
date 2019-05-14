
$(document).on('orViewLoaded',function(event, data) {
	
    // Show QR-Code
	$(event.target).find('.or-qrcode').mouseover( function() {

	    let element = this;
	    if   ( $(element).children().length > 0 )
	        return;

		let wrapper = $('<div class="or-info-popup"></div>');

        $(element).append(wrapper);

        var qrcodetext = $(element).attr('data-qrcode');

        $(wrapper).qrcode( { render : 'div',
			text   : qrcodetext,
			fill   : 'currentColor' } );


        // Title is disturbing the qr-code. Do not inherit it.
        wrapper.attr('title','');

    } );

} );