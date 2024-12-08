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
		keepOpen           :  2,
		closeAfterSubmit   :  4,
		closeAfterSuccess  :  8,
	};

	constructor() {


		/**
		 * Fires on input.
		 */
		this.onChangeHandler = new Callback();
		this.onSaveHandler   = new Callback();
		this.onCloseHandler  = new Callback();
		this.forwardHandler  = new Callback();

		this.async = false;
		this.afterSuccess = '';
		this.element = null;
		this.autosave = false;
		this.mode = Form.modes.keepOpen;
		this.formMethod = 'GET';
		this.forwardToMethod = null;
	}

	set isLoadStatus( isLoading ) {
		if   ( isLoading )
			Workbench.getInstance().startSpinner();
		else
			Workbench.getInstance().stopSpinner();
    }

    initOnElement( element ) {
        this.element = element;

		this.formMethod      = $(this.element).attr('method').toUpperCase();
		this.afterSuccess    = $(this.element).data('afterSuccess');
		this.forwardToMethod = $(this.element).data('forwardTo');
		this.async           = $(this.element).data('async');

        // Autosave in Formularen.
        // Bei Veränderungen von Checkboxen wird das Formular sofort abgeschickt.
        if   ( $(this.element).data('autosave') ) {

        	this.autosave = true;

            $(this.element).find('input[type="checkbox"],input[type="radio"],select').change( () => {
				// Asynchronious, because all other Change-Handler should be executed before the form is submitted.
				// Otherwise the checkboxes will be submitted with an old value.
				setTimeout(() => {
					this.submit(Form.modes.keepOpen);
				},0);
            });
        }


        $(element).find('.or-act-form-cancel').click( () => {
			this.cancel();
        });
        $(element).find('.or-act-form-reset').click( () => {
			this.rollback();
        });
        $(element).find('.or-act-form-apply').click( () => {
			this.submit(Form.modes.keepOpen);
        });
        $(element).find('.or-act-form-save').click( () => {
			if   ( this.async )
				this.submit( Form.modes.closeAfterSubmit );
			else
				this.submit( Form.modes.closeAfterSuccess );
        });

		// Bei Änderungen in der View das Tab als 'dirty' markieren
		$(element).find('.or-input').change( () => {
			this.onChangeHandler.fire();
		});


		// Catches the form submit.
		// This is called by hitting the enter key.
        $(element).submit( ( event ) => {

            if   ( this.async )
				this.submit( Form.modes.closeAfterSubmit );
			else
				this.submit( Form.modes.closeAfterSuccess );

            event.preventDefault();
        });
    }

    cancel() {
        //$(this.element).html('').parent().removeClass('is-open');
		Notice.removeAllNotices();

        this.close();
    }


    rollback() {
        this.element.nodes[0].reset();
    }


	/**
	 * Forward to another action.
	 *
	 * @param action
	 * @param subaction
	 * @param id
	 * @param data
	 */
    forwardTo(action, subaction, id, data) {
		this.forwardHandler.fire( action, subaction, id, data );
	}


    async submit( mode ) {

		Notice.removeAllNotices();

		// Show progress
        let progressStatus = new Notice();
        progressStatus.setStatus('info');
        progressStatus.inProgress();
        progressStatus.msg = Workbench.language.PROGRESS;
        progressStatus.show();

        // Alle vorhandenen Error-Marker entfernen.
        // Falls wieder ein Fehler auftritt, werden diese erneut gesetzt.
		this.removeErrorMarkers();

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
            progressStatus.close();
        }
        else
        {
			if	( mode == Form.modes.closeAfterSubmit )
				this.close();
			// Async: Window is closed, but the action will be startet now.

			try {
				await this.sendFormData( formData,mode );
			}
			catch( error ) {
				// no catch logic here, error messages are already displayed.
			}
			finally {
				progressStatus.close();
			}
		}

    }


    sendFormData = async function( formData,mode ) {

		if   ( !this.async )
			this.isLoadStatus = true;

		let api = new Api();
		api.notifyBrowser = this.async;
		api.validationErrorForField = (name) => {
			$('.or-input[name='+name+']').addClass('input--error').parent().addClass('input--error').parents('.or-group').removeClass('closed').addClass('show').addClass('open');
		}


		try {
			await api.sendData( formData );

			this.onSaveHandler.fire();
			// The data was successful saved.

			if (mode == Form.modes.closeAfterSuccess) {
				this.close();
			}

			if (this.afterSuccess) {
				if (this.afterSuccess == 'reloadAll') {
					Workbench.getInstance().reloadAll();
				} else if (this.afterSuccess == 'forward') {
					// Forwarding to next subaction.
					if (this.forwardToMethod)
						this.forwardTo(formData.get('action'), this.forwardToMethod, formData.get('id'), []);
				}
			} else {
				if (this.async)
					; // do not reload
				else
					Workbench.getInstance().reloadViews();
			}
			//this.onSuccess();
			window.document.dispatchEvent( new Event("or-data-changed"));
		} finally {
			this.isLoadStatus = false;
		}
	}


	/**
	 * Closing the form.
	 */
	close = function() {
		this.onCloseHandler.fire();
	}


	removeErrorMarkers = function() {
		$(this.element).find('.or-input--error').removeClass('input--error');
	}
}

