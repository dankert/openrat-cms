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

		//$('.or-dialog-content .or-view').html('<div class="header"><img class="or-icon" title="" src="./themes/default/images/icon/'+method+'.png" />'+name+'</div>');
		//$('.or-dialog-content .or-view').data('id',id);
		$('.or-dialog').removeClass('dialog--is-closed').addClass('dialog--is-open');
		$('.or-dialog-content .or-act-dialog-name').html( name );

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


	/**
	 * Closing the dialog.
	 */
	this.close = function() {

		if   ( this.isDirty ) {
			// ask the user if we should close this dialog
			let exit = window.confirm( Openrat.Workbench.language.UNSAVED_CHANGES_CONFIRM );

			if   ( ! exit )
				return;
		}

		// Remove dirty-flag from view
		$('.or-dialog-content .or-view.or-view--is-dirty').removeClass('view--is-dirty');
		$('.or-dialog-content .or-view').html('');
		$('.or-dialog').removeClass('dialog--is-open').addClass('dialog--is-closed'); // Dialog schließen

		$(document).unbind('keyup',this.escapeKeyClosingHandler); // Cleanup ESC-Key-Listener
	}
}