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
	// Why this?? input type=submit will submit!
	/*
    $(event.target).find('input.submit.ok').click( function() {
		$(this).closest('form').submit();
	});
	*/

    $(event.target).find('input.submit.cancel').click( function() {
        // TODO: cancel dialog screen (if clicked in dialog)
    });

    // Submithandler for the whole form.
    $(event.target).find('form').submit(function( event ) {

        //
        if   ($(this).data('target')=='view')
		{
            formSubmit($(this));
        	event.preventDefault();
        }
        // target=top will load the native way without javascript.
    });

} );




function formSubmit(form)
{
	// Show progress
	var status = $('<div class="notice info"><div class="text loader"></div></div>');
	$('#noticebar').prepend(status); // Notice anhängen.
	$(status).show();

	// Alle vorhandenen Error-Marker entfernen.
	// Falls wieder ein Fehler auftritt, werden diese erneut gesetzt.
	$(form).find('.error').removeClass('error');

	var params = $(form).serializeArray();
    var data = {};
    $(params).each(function(index, obj){
        data[obj.name] = obj.value;
    });

	var formMethod = $(form).attr('method').toUpperCase();
	
	if	( formMethod == 'GET' )
	{
		// Mehrseitiges Formular
		// Die eingegebenen Formulardaten werden zur nächsten Action geschickt.
        Workbench.loadViewIntoElement( $(form).parent('.view'),data.action, data.subaction,data.id,data );
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
			$('#dialog > .view').html('');  // Dialog beenden
			$('#dialog').removeClass('is-open').addClass('is-closed'); // Dialog schließen
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
				
				try
				{
					let error = jQuery.parseJSON( jqXHR.responseText );
                    notify('','','error',error.error,[error.description]);
				}
				catch( e )
				{
					let msg = jqXHR.responseText;
                    notify('','','error','Server Error',[msg]);
				}


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
		
		// Bei asynchronen Requests wird zusätzlich eine Browser-Notice erzeugt, da der
		// Benutzer bei länger laufenden Aktionen vielleicht das Tab oder Fenster
		// gewechselt hat.
        if   ($(element).data('async') == 'true')
			notifyBrowser(value.text);

		notify(value.type, value.name, value.status, value.text, value.log ); // Notice anhängen.
		
		if	( value.status == 'ok' ) // Kein Fehler?
		{
			// Kein Fehler
			// Nur bei synchronen Prozessen soll nach Verarbeitung der Dialog
			// geschlossen werden.
			if	( $(element).data('async') != 'true' )
			{
				// Verarbeitung erfolgt synchron, das heißt, dass jetzt der evtl. geöffnete Dialog
				// beendet wird.
				$('#dialog > .view').html('').hide();  // Dialog beenden
                $('#dialog').removeClass('is-open').addClass('is-closed'); // Dialog schließen

				// Da gespeichert wurde, jetzt das 'dirty'-flag zurücksetzen.
				$(element).closest('div.panel').find('div.header ul.views li.action.active').removeClass('dirty');
			}

            $(document).trigger('orDataChanged');
        }
		else
		// Server liefert Fehler zurück.
		{
		}
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

	/* nein, das ist Dialoglogik.
	if	( data.control.new_style )
		// CSS-Datei setzen
		setUserStyle( data.control.new_style );
	*/

/*	nein, das ist Dialoglogik.

	else if	( data.control.next_view )
		// Nächste View aufrufen
		//startView( $(element).closest('div.content'),data.control.next_view );
		;
		// Views gibt es so nicht mehr. Rauswerfen?
*/
	//if ( data.errors.length==0 )
		// Aktuelle View neu laden
	//	$(element).closest('div.panel').find('li.action.active').orLoadView();

}

