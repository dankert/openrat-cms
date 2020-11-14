
Openrat.Workbench.afterViewLoadedHandler.add( function(element ) {

	
    // Show QR-Code
	$(element).find('.or-qrcode').mouseover( function() {

	    let element = this;
	    if   ( $(element).children().length > 0 )
	        return;

		let wrapper = $('<div class="or-info-popup"></div>');

        $(element).append(wrapper);

        let qrcodetext = $(element).attr('data-qrcode');

        $(wrapper).qrcode( { render : 'div',
			text   : qrcodetext,
			fill   : 'currentColor' } );

        // Title is disturbing the qr-code. Do not inherit it.
        wrapper.attr('title','');
        //wrapper.append('<small>'+qrcodetext+'</small>'); is very wide.

    } );

	$(element).find('.or-info').click( function() {
    	$(this).toggleClass('info--open');
	});

} );