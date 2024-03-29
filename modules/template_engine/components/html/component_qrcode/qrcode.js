import $ from "../../../../cms/ui/themes/default/script/jquery-global.js";

export default function(element ) {

	let createQRCode = async function( value,text) {

		let Kjua = (await import("../../../../cms/ui/themes/default/script/tools/kjua.min.js")).default;

		let wrapper = $.create('div').addClass('info-popup').addClass('qrcode-value');

		let element = Kjua( {
			text     : value,
			render   : 'svg',
			mode     :'plain',
			label    : '',
			rounded  : 1,
			fill     : null,
		    back     : null,
		} );


		// Title is disturbing the qr-code. Do not inherit it.
		wrapper.attr('title','');

		// OQuery is not supporting appending SVGs.
		// We must append the SVG to the native HTML element.
		wrapper.get(0).appendChild( element );

		if   ( text )
			wrapper.append( $.create('small').addClass('qrcode-text').text(text) );

		return wrapper;
	}


	$(element).find('.or-qrcode').click( async function() {

		let $qrCodeElement = $(this);

		// Create QRCode on first click.
		if   ( ! $qrCodeElement.children('.or-info-popup').length ) {

			let qrcodeValue = $qrCodeElement.data('qrcode');
			let qrcodeText  = $qrCodeElement.data('qrcode-text');

			if   ( $qrCodeElement.children().length > 0 )
				return;

			$qrCodeElement.append( await createQRCode(qrcodeValue,qrcodeText) );
		}

		$qrCodeElement.toggleClass('info--open');
    	$qrCodeElement.toggleClass('btn--is-active');
	});

};