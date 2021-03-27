import '../jquery-global.js';
import Workbench from "./workbench.js";
import Notice from "./notice.js";
import Callback from "./callback.js";

/**
 * Form.
 *
 * @constructor
 */
export default class Form {

	static modes = {
		showBrowserNotice  : 1,
		keepOpen           : 2,
		closeAfterSubmit   : 4,
		closeAfterSuccess  : 8,
	};

	constructor() {


		/**
		 * Fires on input.
		 */
		this.onChangeHandler = new Callback();
		this.onSaveHandler   = new Callback();
		this.onCloseHandler  = new Callback();
	}

	setLoadStatus( isLoading ) {
        $(this.element).closest('div.content').toggleClass('loader',isLoading);
    }

    initOnElement( element ) {
        this.element = element;

        let form = this;

        // Autosave in Formularen.
        // Bei Veränderungen von Checkboxen wird das Formular sofort abgeschickt.
        if   ( $(this.element).data('autosave') ) {

            $(this.element).find('input[type="checkbox"]').click( function() {
                form.submit(Form.modes.keepOpen);
            });
            $(this.element).find('select').change( function() {
                form.submit(Form.modes.keepOpen);
            });
        }

        // After click to "OK" the form is submitted.
        // Why this?? input type=submit will submit!
        /*
        $(event.target).find('input.submit.ok').click( function() {
            $(this).closest('form').submit();
        });
        */

        $(element).find('.or-act-form-cancel').click( function() {
            form.cancel();

        });
        $(element).find('.or-act-form-reset').click( function() {
            form.rollback();

        });
        $(element).find('.or-act-form-apply').click( function() {
			form.submit(Form.modes.keepOpen);
        });
        $(element).find('.or-act-form-save').click( function() {
			form.submit();
        });

		// Bei Änderungen in der View das Tab als 'dirty' markieren
		$(element).find('.or-input').change( function() {
			form.onChangeHandler.fire();
		});


		// Submithandler for the whole form.
        $(element).submit( function( event ) {

            //
            if   ($(this).data('target')=='view')
            {
                form.submit();
                event.preventDefault();
            }
            // target=top will load the native way without javascript.
        });
    }

    cancel() {
        //$(this.element).html('').parent().removeClass('is-open');
		Notice.removeAllNotices();

        this.onCloseHandler.fire();
    }


    rollback() {
        this.element.trigger('reset');
    }

    forwardTo(action, subaction, id, data) {
    }

    submit( mode ) {

		if   ( mode === undefined )
			if   ( $(this.element).data('async') )
				mode = Form.modes.closeAfterSubmit;
			else
				mode = Form.modes.closeAfterSuccess;

		Notice.removeAllNotices();

		// Show progress
        let status = new Notice();
        status.setStatus('info');
        status.inProgress();
        status.msg = Workbench.language.PROGRESS;
        status.show();

        // Alle vorhandenen Error-Marker entfernen.
        // Falls wieder ein Fehler auftritt, werden diese erneut gesetzt.
        $(this.element).find('.or-input--error').removeClass('input--error');

        let formData = new FormData( $(this.element).get(0) );

        // If form does not contain action/id, get it from the workbench.
        if   (!formData.has('id') )
            formData.append('id',Workbench.state.id);
        if   (!formData.has('action') )
            formData.append('action',Workbench.state.action);

        let formMethod = $(this.element).attr('method').toUpperCase();

        if	( formMethod == 'GET' )
        {
            // Mehrseitiges Formular
            // Die eingegebenen Formulardaten werden zur nächsten Action geschickt.
            this.forwardTo( formData.get('action'), formData.get('subaction'),formData.get('id,'),formData );
            $(status).remove();
        }
        else
        {
            let url    = './api/'; // Alle Parameter befinden sich im Formular

            // POST-Request
            this.setLoadStatus(true);
            //url += '?output=json';
            url += '';
            //params['output'] = 'json';// Irgendwie geht das nicht.
			formData.append('output','json');

            if	( mode == Form.modes.closeAfterSubmit )
                this.onCloseHandler.fire();
                // Async: Window is closed, but the action will be startet now.

            let form = this;
            console.debug( form );

            let load = fetch( url, { 'method':'POST', body:formData } );

            load.then( response => {
            	if   ( ! response.ok )
            		throw "Failed to post";

            	return response.json();
			}).then( data => {
				form.setLoadStatus(false);
				status.close();

				form.doResponse(data, "", form.element, () => {

					form.onSaveHandler.fire();

					let afterSuccess = $(form.element).data('afterSuccess');
					let forwardTo = $(form.element).data('forwardTo');
					let async = $(form.element).data('async');

					if (afterSuccess == 'forward')
						mode = Form.modes.keepOpen;

					// The data was successful saved.
					// Now we can close the form.
					if (mode == Form.modes.closeAfterSuccess) {
						form.onCloseHandler.fire();

						// clear the dirty flag.
						$(form.element).closest('div.panel').find('div.header ul.views li.action.active').removeClass('dirty');
					}

					if (afterSuccess) {
						if (afterSuccess == 'reloadAll') {
							Workbench.getInstance().reloadAll();
						} else if (afterSuccess == 'forward') {
							// Forwarding to next subaction.
							if (forwardTo)
								form.forwardTo(formData.get('action'), forwardTo, formData.get('id'), []);
						}
					} else {
						if (async)
							; // do not reload
						else
							Workbench.getInstance().reloadViews();
					}

				})
			} ).catch( cause => {

				console.warn( {
					message:'could not post form',
					cause: cause,
					form:form,
				} );

				form.setLoadStatus(false);
				status.close();

				let msg = '';
				try {
					msg = JSON.parse( cause ).message;
				}
				catch( e ) {
					msg = cause;
				}

				let notice = new Notice();
				notice.setStatus('error');
				notice.msg = msg;
				notice.log = cause; //JSON.stringify( $.parseJSON(jqXHR.responseText),null,2);
				notice.show();
            } );

            $(form.element).fadeIn();
        }

    }



    /**
     * HTTP-Antwort auf einen POST-Request auswerten.
     *
     * @param data Formulardaten
     * @param status Status
     * @param element
     */
    doResponse = function(data,status,element, onSuccess = $.noop )
    {
        let form = this;
        // Hinweismeldungen in Statuszeile anzeigen
        for( let value of data['notices'] ) {

            // Bei asynchronen Requests wird zusätzlich eine Browser-Notice erzeugt, da der
            // Benutzer bei länger laufenden Aktionen vielleicht das Tab oder Fenster
            // gewechselt hat.
            let notifyBrowser = $(element).data('async');

            let notice = new Notice();
            notice.setContext( value.type, value.id, value.name );
            notice.log = value.log;
            notice.setStatus( value.status );
			notice.msg = value.text;
			notice.show();

			if	( notifyBrowser )
            	notice.notifyBrowser()
        };

		if	( data.success ) { // Kein Fehler?
			onSuccess();
			Callback.dataChangedHandler.fire();
		}
		else
			; // Server liefert Fehler zurück.

		// Validation error should mark the input field.
        for( name of data['errors'] )
            $('.or-input[name='+name+']').addClass('input--error').parent().addClass('input--error').parents('.or-group').removeClass('closed').addClass('show').addClass('open');

        // Jetzt das erhaltene Dokument auswerten.
    }
}

