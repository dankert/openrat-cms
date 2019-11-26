
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

        $(element).find('.or-form-btn--cancel').click( function() {
            form.cancel();

        });
        $(element).find('.or-form-btn--reset').click( function() {
            form.rollback();

        });
        $(element).find('.or-form-btn--apply').click( function() {
			form.submit(modes.keepOpen);
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
        this.close();
    }


    this.rollback = function() {
        this.element.trigger('reset');
    }

    this.close = function() {

    }

    this.forwardTo = function (action, subaction, id, data) {

        let view = new Openrat.View( action, subaction, id, data );
        view.start( $(this.element).closest('.view') );
    }

    this.submit = function( mode ) {

    	if   ( mode === undefined )
			if   ( $(this.element).data('async') )
				mode = modes.closeAfterSubmit;
			else
				mode = modes.closeAfterSuccess;


		// Show progress
        let status = $('<div class="notice info"><div class="text loader"></div></div>');
        $('#noticebar').prepend(status); // Notice anhängen.
        $(status).show();

        // Alle vorhandenen Error-Marker entfernen.
        // Falls wieder ein Fehler auftritt, werden diese erneut gesetzt.
        $(this.element).find('.error').removeClass('error');

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
            $.ajax( { 'type':'POST',url:url, data:data, success:function(data, textStatus, jqXHR)
                {
                    form.setLoadStatus(false);
                    $(status).remove();

                    form.doResponse(data,textStatus,form.element, function() {

						// The data was successful saved.
						// Now we can close the form.
						if	( mode == modes.closeAfterSuccess )
						{
							form.close();

							// clear the dirty flag.
							$(form.element).closest('div.panel').find('div.header ul.views li.action.active').removeClass('dirty');
						}

						let afterSuccess = $(form.element).data('afterSuccess');
						let async        = $(form.element).data('async'       );
						if	( afterSuccess )
						{
							if   ( afterSuccess == 'reloadAll' )
							{
								Openrat.Workbench.reloadAll();
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
                    form.setLoadStatus(false);
                    $(status).remove();

                    try
                    {
                        let error = jQuery.parseJSON( jqXHR.responseText );
                        Openrat.Workbench.notify('','','error',error.error,[error.description]);
                    }
                    catch( e )
                    {
                        let msg = jqXHR.responseText;
                        Openrat.Workbench.notify('','','error','Server Error',[msg]);
                    }


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
            alert('Server error: ' + status);
            return;
        }

        let form = this;
        // Hinweismeldungen in Statuszeile anzeigen
        $.each(data['notices'], function(idx,value) {

            // Bei asynchronen Requests wird zusätzlich eine Browser-Notice erzeugt, da der
            // Benutzer bei länger laufenden Aktionen vielleicht das Tab oder Fenster
            // gewechselt hat.
            let notifyBrowser = $(element).data('async');

            Openrat.Workbench.notify(value.type, value.name, value.status, value.text, value.log, notifyBrowser ); // Notice anhängen.

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

        // Felder mit Fehleingaben markieren, ggf. das übergeordnete Fieldset aktivieren.
        $.each(data['errors'], function(idx,value) {
            $('input[name='+value+']').addClass('error').parent().addClass('error').parents('fieldset').addClass('show').addClass('open');
        });

        // Jetzt das erhaltene Dokument auswerten.


        if	( data.control.redirect )
        // Redirect
            window.location.href = data.control.redirect;
    }




}

