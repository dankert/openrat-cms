import $         from  '../jquery-global.js';
import Workbench from "./workbench.js";
import Notice    from "./notice.js";
import Callback  from "./callback.js";
import Api       from "./api.js";

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

		this.async = false;
		this.afterSuccess = '';
		this.element = null;
		this.autosave = false;
		this.mode = Form.modes.keepOpen;
		this.formMethod = 'GET';
		this.forwardToMethod = null;
	}

	setLoadStatus( isLoading ) {
        $(this.element).closest('div.content').toggleClass('loader',isLoading);
    }

    initOnElement( element ) {
        this.element = element;

		this.formMethod    = $(this.element).attr('method').toUpperCase();
		this.afterSuccess  = $(this.element).data('afterSuccess');
		this.forwardToMethod = $(this.element).data('forwardTo');
		this.async         = $(this.element).data('async');

		let form = this;

        // Autosave in Formularen.
        // Bei Veränderungen von Checkboxen wird das Formular sofort abgeschickt.
        if   ( $(this.element).data('autosave') ) {

        	this.autosave = true;

            $(this.element).find('input[type="checkbox"]').click( function() {
                form.submit(Form.modes.keepOpen);
            });
            $(this.element).find('select').change( function() {
                form.submit(Form.modes.keepOpen);
            });
        }


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
			if   ( this.async )
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


        if	( this.formMethod == 'GET' )
        {
            // Mehrseitiges Formular
            // Die eingegebenen Formulardaten werden zur nächsten Action geschickt.
            this.forwardTo( formData.get('action'), formData.get('subaction'),formData.get('id,'),formData );
            $(status).remove();
        }
        else
        {
			if	( mode == Form.modes.closeAfterSubmit )
				this.onCloseHandler.fire();
			// Async: Window is closed, but the action will be startet now.

			formData.append('output','json');
        	this.sendFormData( formData );
			status.close();
		}

    }


    sendFormData = function( formData ) {

		this.setLoadStatus(true);

		let form = this;

		let api = new Api();
		api.notifyBrowser = form.async;
		api.validationErrorForField = (name) => {
			$('.or-input[name='+name+']').addClass('input--error').parent().addClass('input--error').parents('.or-group').removeClass('closed').addClass('show').addClass('open');
		}

		let result = api.sendData( formData );
		let mode = 0;

		result.then(
			() => {
				form.onSaveHandler.fire();
				if (this.afterSuccess == 'forward')
					mode = Form.modes.keepOpen;

				// The data was successful saved.
				// Now we can close the form.
				if (mode == Form.modes.closeAfterSuccess) {
					form.onCloseHandler.fire();

					// clear the dirty flag.
					$(form.element).closest('div.panel').find('div.header ul.views li.action.active').removeClass('dirty');
				}

				if (form.afterSuccess) {
					if (form.afterSuccess == 'reloadAll') {
						Workbench.getInstance().reloadAll();
					} else if (form.afterSuccess == 'forward') {
						// Forwarding to next subaction.
						if (form.forwardToMethod)
							form.forwardTo(formData.get('action'), form.forwardToMethod, formData.get('id'), []);
					}
				} else {
					if (async)
						; // do not reload
					else
						Workbench.getInstance().reloadViews();
				}
				//form.onSuccess();
				Callback.dataChangedHandler.fire();
			}
		).catch( (reason) => {

		}).finally( () => {
			form.setLoadStatus(false);
		})

	}
}

