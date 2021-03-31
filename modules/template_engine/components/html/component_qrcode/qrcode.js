import $ from "../../../../cms/ui/themes/default/script/jquery-global.js";

export default function(element ) {

	let createQRCode = async function( value,text) {

		let Kjua = (await import("../../../../cms/ui/themes/default/script/tools/kjua.min.js")).default;

		let wrapper = $('<div class="or-info-popup or-qrcode-value"></div>');

		let element = Kjua( {
			text     : text,
			render   : 'svg',
			mode     :'label',
			label    : text,
			rounded  : 1,
			fill     : 'currentColor',
		    back     : 'black'
		} );


		// Title is disturbing the qr-code. Do not inherit it.
		wrapper.attr('title','');
		wrapper.append( element );

		if   ( text )
			wrapper.append('<small class="or-qrcode-text">' + text + '</small>');

		return wrapper;
	}


	$(element).find('.or-qrcode').click( async function() {

		let $element = $(this);

		// Create QRCode on first click.
		if   ( ! $element.children().length ) {

			let qrcodeValue = $(element).attr('data-qrcode');
			let qrcodeText  = $(element).attr('data-qrcode-text');

			if   ( $element.children().length > 0 )
				return;

			$element.append( await createQRCode(qrcodeValue,qrcodeText) );
		}

		$element.toggleClass('info--open');
    	$element.toggleClass('btn--is-active');
	});

};