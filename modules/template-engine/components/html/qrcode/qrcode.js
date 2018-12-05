
$(document).on('orViewLoaded',function(event, data) {
	
    // QR-Code anzeigen.
	$(event.target).find('.qrcode').click( function() {

		let wrapper = $('<div class="qrcode-wrapper"></div>');

        $('div#dialog > .view').append(wrapper);

        $('div#dialog').removeClass('is-closed').addClass('is-open');

        var qrcodetext = $(this).attr('data-qrcode');

        $(wrapper).qrcode( { render : 'div',
			text   : qrcodetext,
			fill   : 'currentColor' } );


        wrapper.attr('title',qrcodetext);
        //$(wrapper).append( $('<p>'+qrcodetext+'</p>') );
        $('div#dialog > .view').fadeIn();
    } );

} );