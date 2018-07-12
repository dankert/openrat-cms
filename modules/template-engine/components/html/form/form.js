//
$(document).on('orViewLoaded',function(event, data) {

	if ( $('div.panel form input[type=password]').length>0 && $('#uname').attr('value')!='' )
	{
		$('div.panel form input[name=login_name]    ').attr('value',$('#uname'    ).attr('value'));
		$('div.panel form input[name=login_password]').attr('value',$('#upassword').attr('value'));
	}


	// Autosave in Formularen. Bei Veränderungen wird das Formular sofort abgeschickt.
	$(event.target).find('form[data-autosave="true"] input[type="checkbox"]').click( function() {
		$(this).closest('form').submit();
	});

	// After click to "OK" the form is submitted.
    $(event.target).find('input.submit.ok').click( function() {
		$(this).closest('form').submit();
	});

    $(event.target).find('input.submit.cancel').click( function() {
        // TODO: cancel dialog screen (if clicked in dialog)
    });

    // Submithandler for the whole form.
    $(event.target).find('form').submit(function( event ) {
        formSubmit($(this));
        event.preventDefault();
    });

} );




function formSubmit(form)
{
	// Login-Hack
	/*
	if ( $('div.panel form input[type=password]').length>0 )
	{
		$('#uname'    ).attr('value',$('div.panel form input[name=login_name]'    ).attr('value'));
		$('#upassword').attr('value',$('div.panel form input[name=login_password]').attr('value'));
		
		$('#uname'    ).closest('form').submit();
	}
	*/
	
	if ( $('#pageelement_edit_editor').length>0 )
	{
		var instance = CKEDITOR.instances['pageelement_edit_editor'];
	    if(instance)
	    {
	        var value = instance.getData();
	        $('#pageelement_edit_editor').html( value );
	    }
	}
	

	var status = $('<div class="notice info"><div class="text loader"></div></div>');
	$('#noticebar').prepend(status); // Notice anhängen.
	$(status).show();

	// Alle vorhandenen Error-Marker entfernen.
	// Falls wieder ein Fehler auftritt, werden diese erneut gesetzt.
	$(form).find('.error').removeClass('error');

	var params = $(form).serializeArray();

	var formMethod = $(form).attr('method').toUpperCase();
	
	if	( formMethod == 'GET' )
	{
		// GET-Request
		var action  = $(form).data('action');
		var method  = $(form).data('method');
		var id      = $(form).data('id'    );

		loadView(  $(form).closest('div.content'),action,method,id,params);
	}
	else
	{
        var url    = './api/'; // Alle Parameter befinden sich im Formular

		// POST-Request
		$(form).closest('div.content').addClass('loader');
		url += '?output=json';
		params['output'] = 'json';// Irgendwie geht das nicht.
		
		if	( $(form).data('async') || $(form).data('async')=='true')
		{
			// Verarbeitung erfolgt asynchron, das heißt, dass der evtl. geöffnete Dialog
			// beendet wird.
			$('div#dialog').html('').hide();  // Dialog beenden
			
			//$('div.modaldialog').fadeOut(500); 
			//$('div#workbench').removeClass('modal'); // Modalen Dialog beenden.
			$('div#filler').fadeOut(500); // Filler beenden
		}
		
		$.ajax( { 'type':'POST',url:url, data:params, success:function(data, textStatus, jqXHR)
			{
				$(form).closest('div.content').removeClass('loader');
				$(status).remove();
				
				doResponse(data,textStatus,form);
			},
			error:function(jqXHR, textStatus, errorThrown) {
				$(form).closest('div.content').removeClass('loader');
				$(status).remove();
				
				var msg;
				try
				{
					var error = jQuery.parseJSON( jqXHR.responseText );
					msg = error.error + '/' + error.description + ': ' + error.reason;
				}
				catch( e )
				{
					msg = jqXHR.responseText;
				}
				
				notify('error',msg);
				
			}
			
		} );
		$(form).fadeIn();
	}
}





/**
 * HTTP-Antwort auf einen POST-Request auswerten.
 * 
 * @param data Formulardaten
 * @param status Status
 * @param element
 */
function doResponse(data,status,element)
{
	if	( status != 'success' )
	{
		alert('Server error: ' + status);
		return;
	}
	
	// Hinweismeldungen in Statuszeile anzeigen
	$.each(data['notices'], function(idx,value) {
		
		// Notice-Bar mit dieser Meldung erweitern.
		var notice = $('<div class="notice '+value.status+'"><div class="text">'+value.text+'</div></div>');
		notifyBrowser(value.text);
		$.each(value.log, function(name,value) {
			$(notice).append('<div class="log">'+value+'</div>');
		});
		$('#noticebar').prepend(notice); // Notice anhängen.
		
		// Per Klick wird die Notice entfernt.
		$(notice).fadeIn().click( function()
		{
			$(this).fadeOut('fast',function() { $(this).remove(); } );
		} );
		
		var timeoutSeconds;
		if	( value.status == 'ok' ) // Kein Fehler?
		{
			// Kein Fehler
			timeoutSeconds = 3;
			
			// Nur bei synchronen Prozessen soll nach Verarbeitung der Dialog
			// geschlossen werden.
			if	( $(element).data('async') != 'true' )
			{
				// Verarbeitung erfolgt asynchron, das heißt, dass der evtl. geöffnete Dialog
				// beendet wird.
				$('div#dialog').html('').hide();  // Dialog beenden
				
				//$('div.modaldialog').fadeOut(500); 
				//$('div#workbench').removeClass('modal'); // Modalen Dialog beenden.
				$('div#filler').fadeOut(500); // Filler beenden
				
				// Da gespeichert wurde, jetzt das 'dirty'-flag zurücksetzen.
				$(element).closest('div.panel').find('div.header ul.views li.action.active').removeClass('dirty');
			}
		}
		else
			// Server liefert Fehler zurück.
		{
			timeoutSeconds = 8;
		}
		
		// Und nach einem Timeout entfernt sich die Notice von alleine.
		setTimeout( function() { $(notice).fadeOut('slow').remove(); },timeoutSeconds*1000 );
	});
	
	// Felder mit Fehleingaben markieren, ggf. das übergeordnete Fieldset aktivieren.
	$.each(data['errors'], function(idx,value) {
		$('input[name='+value+']').addClass('error').parent().addClass('error').parents('fieldset').addClass('show').addClass('open');
	});
	
	// Jetzt das erhaltene Dokument auswerten.
	
	// Hinweismeldungen in Statuszeile anzeigen
	if	( ! data.control ) {
		/*
		$('div.panel div.status').html('<div />');
		$('div.panel div.status div').append( data );
		$('div.panel div.status div').delay(3000).fadeOut(2500);
		*/
		//alert( value.text );
	};
	
	
	if	( data.control.redirect )
		// Redirect
		window.location.href = data.control.redirect;
	
	if	( data.control.new_style )
		// CSS-Datei setzen
		setUserStyle( data.control.new_style );
	
	if	( data.control.refresh )
		// Views aktualisieren
		; //refreshAll();
	
	else if	( data.control.next_view )
		// Nächste View aufrufen
		//startView( $(element).closest('div.content'),data.control.next_view );
		;
		// Views gibt es so nicht mehr. Rauswerfen?

	else if ( data.errors.length==0 )
		// Aktuelle View neu laden
		$(element).closest('div.panel').find('li.action.active').orLoadView();

}

