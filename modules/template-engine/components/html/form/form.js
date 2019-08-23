//




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

			let afterSuccess = $(element).data('afterSuccess');
			if	( afterSuccess )
			{
				if   ( afterSuccess == 'reloadAll' )
				{
					Workbench.reloadAll();
				}
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

