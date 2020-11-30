
Openrat.Workbench.afterViewLoadedHandler.add( function(element ) {

	let createQRCode = function( value,text) {
		let wrapper = $('<div class="or-info-popup or-qrcode-value"></div>');

		$(wrapper).qrcode( { render : 'div',
			text   : text,
			fill   : 'currentColor' } );

		// Title is disturbing the qr-code. Do not inherit it.
		wrapper.attr('title','');

		if   ( text )
			wrapper.append('<small class="or-qrcode-text">' + text + '</small>');

		return wrapper;
	}


	$(element).find('.or-qrcode').click( function() {

		let $element = $(this);

		// Create QRCode on first click.
		if   ( ! $element.children().length ) {

			let qrcodeValue = $(element).attr('data-qrcode');
			let qrcodeText  = $(element).attr('data-qrcode-text');

			if   ( $element.children().length > 0 )
				return;

			$element.append( createQRCode(qrcodeValue,qrcodeText) );
		}

		$element.toggleClass('info--open');
    	$element.toggleClass('btn--is-active');
	});

} );