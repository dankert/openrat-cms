
/**
 * Form.
 *
 * @constructor
 */
Openrat.Form = function() {

	const modes = {
		showBrowserNotice  : 1,
		keepOpen           : 2,
		closeAfterSubmit   : 4,
		closeAfterSuccess  : 8,
	};

    this.setLoadStatus = function( isLoading ) {
        $(this.element).closest('div.content').toggleClass('loader',isLoading);
    }

    this.initOnElement = function( element ) {
        this.element = element;

        let form = this;

        // Autosave in Formularen.
        // Bei Veränderungen von Checkboxen wird das Formular sofort abgeschickt.
        if   ( $(this.element).data('autosave') ) {

            $(this.element).find('input[type="checkbox"]').click( function() {
                form.submit(modes.keepOpen);
            });
            $(this.element).find('select').change( function() {
                form.submit(modes.keepOpen);
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
			form.submit(modes.keepOpen);
        });
        $(element).find('.or-act-form-save').click( function() {
			form.submit();
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

    this.cancel = function() {
        //$(this.element).html('').parent().removeClass('is-open');
		Openrat.Notice.removeAllNotices();

        this.close();
    }


    this.rollback = function() {
        this.element.trigger('reset');
    }

    this.close = function() {
    }

    this.forwardTo = function (action, subaction, id, data) {
    }

    this.submit = function( mode ) {

		if   ( mode === undefined )
			if   ( $(this.element).data('async') )
				mode = modes.closeAfterSubmit;
			else
				mode = modes.closeAfterSuccess;

		Openrat.Notice.removeAllNotices();

		// Show progress
        let status = new Openrat.Notice();
        status.setStatus('info');
        status.inProgress();
        status.msg = Openrat.Workbench.language.PROGRESS;
        status.show();

        // Alle vorhandenen Error-Marker entfernen.
        // Falls wieder ein Fehler auftritt, werden diese erneut gesetzt.
        $(this.element).find('.or-input--error').removeClass('input--error');

        let params = $(this.element).serializeArray();
        let data = {};
        $(params).each(function(index, obj){
            data[obj.name] = obj.value;
        });

        // If form does not contain action/id, get it from the workbench.
        if   (!data.id)
            data.id = Openrat.Workbench.state.id;
        if   (!data.action)
            data.action = Openrat.Workbench.state.action;

        let formMethod = $(this.element).attr('method').toUpperCase();

        if	( formMethod == 'GET' )
        {
            // Mehrseitiges Formular
            // Die eingegebenen Formulardaten werden zur nächsten Action geschickt.
            this.forwardTo( data.action, data.subaction,data.id,data );
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
            data.output = 'json';

            if	( mode == modes.closeAfterSubmit )
                this.close();
                // Async: Window is closed, but the action will be startet now.

            let form = this;
            console.debug( form );

            $.ajax( { 'type':'POST',url:url, data:data, success:function(responseData, textStatus, jqXHR)
                {
                    form.setLoadStatus(false);
                    status.close();

                    form.doResponse(responseData,textStatus,form.element, function() {

						// Remove dirty-flag from view
						$(form.element).closest('.or-view.or-view--is-dirty').removeClass('view--is-dirty');

						let afterSuccess = $(form.element).data('afterSuccess');
						let forwardTo    = $(form.element).data('forwardTo'   );
						let async        = $(form.element).data('async'       );

						if   ( afterSuccess == 'forward' )
							mode = modes.keepOpen;

						// The data was successful saved.
						// Now we can close the form.
						if	( mode == modes.closeAfterSuccess )
						{
							form.close();

							// clear the dirty flag.
							$(form.element).closest('div.panel').find('div.header ul.views li.action.active').removeClass('dirty');
						}

						if	( afterSuccess )
						{
							if   ( afterSuccess == 'reloadAll' )
							{
								Openrat.Workbench.reloadAll();
							}
							else if   ( afterSuccess == 'forward' )
							{
								// Forwarding to next subaction.
								if   ( forwardTo )
									form.forwardTo( data.action, forwardTo, data.id,[] );
							}
						} else {
							if   ( async )
								; // do not reload
							else
								Openrat.Workbench.reloadViews();
						}

					});
                },
                error:function(jqXHR, textStatus, errorThrown) {

					console.warn( {
						message:'could not post form',
						jqXHR:jqXHR,
						form:form,
						status: textStatus,
						error: errorThrown
					} );

					form.setLoadStatus(false);
                    status.close();

                    let msg = '';
                    try {
                        msg = jQuery.parseJSON( jqXHR.responseText ).error;
                    }
                    catch( e ) {
                        msg = jqXHR.responseText;
                    }

					let notice = new Openrat.Notice();
                    notice.setStatus('error');
                    notice.msg = msg;
                    notice.show();
				}

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
    this.doResponse = function(data,status,element, onSuccess = $.noop )
    {
        if	( status != 'success' )
        {
            console.error('Server error: ' + status);

			let notice = new Openrat.Notice();
			notice.setStatus( 'error' );
			notice.msg = Openrat.Workbench.language.ERROR;
			notice.show();

			return;
        }

        let form = this;
        // Hinweismeldungen in Statuszeile anzeigen
        $.each(data['notices'], function(idx,value) {

            // Bei asynchronen Requests wird zusätzlich eine Browser-Notice erzeugt, da der
            // Benutzer bei länger laufenden Aktionen vielleicht das Tab oder Fenster
            // gewechselt hat.
            let notifyBrowser = $(element).data('async');

            let notice = new Openrat.Notice();
            notice.setContext( value.type, value.id, value.name );
            notice.log = value.log;
            notice.setStatus( value.status );
			notice.msg = value.text;
			notice.show();

			if	( notifyBrowser )
            	notice.notifyBrowser()


            if	( value.status == 'ok' ) // Kein Fehler?
            {
                onSuccess();
                Openrat.Workbench.dataChangedHandler.fire();
            }
            else
            // Server liefert Fehler zurück.
            {
            }
        });

        // Validation error should mark the input field.
        $.each(data['errors'], function(idx,value) {
            $('.or-input[name='+value+']').addClass('input--error').parent().addClass('input--error').parents('.or-group').removeClass('closed').addClass('show').addClass('open');
        });

        // Jetzt das erhaltene Dokument auswerten.
    }




}

