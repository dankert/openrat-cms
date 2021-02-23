/**
 * A dialog is a special area in the workbench for displaying and inputting data.
 * A dialog contains a view.
 */

Openrat.Dialog = function() {

	/**
	 * The encapsulated view.
	 */
	this.view;

	/**
	 * Dirty-marker (if unsaved changes exist).
	 *
	 * @type {boolean}
	 */
	this.isDirty = false;

	/**
	 * the DOM element which contains the dialog.
	 * @type {*|jQuery|HTMLElement}
	 */
	this.element = $('.or-dialog-content .or-view');

	/**
	 * Creating a new dialog.
	 *
	 * @param name
	 * @param action Action
	 * @param method
	 * @param id Id
	 * @param params
	 *
	 * @return Promise of underlying view
	 */
	this.start = function( name,action,method,id,params )
	{
		// Attribute aus dem aktuellen Editor holen, falls die Daten beim Aufrufer nicht angegeben sind.
		if (!action)
			action =  Openrat.Workbench.state.action;

		if  (!id)
			id =  Openrat.Workbench.state.id;

		let dialog = this;

		let view = new Openrat.View( action,method,id,params );

		Openrat.Notice.removeAllNotices();

		$('.or-dialog-content .or-view').html(''); // Clear old content

		$('.or-dialog-content .or-act-dialog-name').html( name );
		this.show();

		view.onCloseHandler.add( function() {
			dialog.close();
		} );

		view.onChangeHandler.add( function() {
			// data has changed
			console.debug("Changes detected");
			dialog.isDirty = true;
			// Remove dirty-flag from view
			dialog.element.addClass('view--is-dirty');
		});

		view.onSaveHandler.add( function() {
			// data was saved
			dialog.isDirty = false;
			// Remove dirty-flag from view
			dialog.element.removeClass('view--is-dirty');
		});

		this.view = view;

		return this.view.start( this.element );
	}



	this.show = function() {

		$('.or-dialog').removeClass('dialog--is-closed').addClass('dialog--is-open');

		if   ( this.isDirty ) {
			this.element.addClass('view--is-dirty');
		}

		let dialog = this;

		this.escapeKeyClosingHandler = function (e) {
			if (e.keyCode == 27) { // ESC keycode
				dialog.close();

				$(document).off('keyup'); // de-register.
			}
		};

		$(document).keyup(this.escapeKeyClosingHandler);

		// close dialog on click onto the blurred area.
		$('.or-dialog-filler,.or-act-dialog-close').off('click').click( function(e)
		{
			e.preventDefault();
			dialog.close();
		});
	}


	this.hide = function() {
		$('.or-dialog').removeClass('dialog--is-open').addClass('dialog--is-closed'); // Dialog schließen
	}


	/**
	 * Closing the dialog.
	 */
	this.close = function() {

		let dialog = this;

		if   ( this.isDirty ) {
			// ask the user if we should close this dialog
			let exit = window.confirm( Openrat.Workbench.language.UNSAVED_CHANGES_CONFIRM );

			if   ( ! exit )
				return; // do not close the dialog

			let notice = new Openrat.Notice();
			notice.msg = Openrat.Workbench.language.REOPEN_CLOSED_DIALOG;
			notice.setStatus( 'warning' );
			notice.timeout = 120;
			notice.onClick.add( function() {
				dialog.show();
				notice.close();
			});
			notice.show();
		}

		// Remove dirty-flag from view
		$('.or-dialog-content .or-view.or-view--is-dirty').removeClass('view--is-dirty');
		this.hide();
		$(document).unbind('keyup',this.escapeKeyClosingHandler); // Cleanup ESC-Key-Listener
	}
}