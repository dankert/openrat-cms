
$(document).on('orViewLoaded',function(event, data) {
	
    // QR-Code anzeigen.
	$(event.target).find('[data-qrcode]').each( function() {
		
		var qrcodetext = $(this).attr('data-qrcode');
		$(this).removeAttr('data-qrcode');
		
		$(this).qrcode( { render : 'div',
			text   : qrcodetext,
			fill   : 'currentColor' } );
	} );
} );