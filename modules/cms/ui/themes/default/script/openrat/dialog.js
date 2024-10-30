import $ from "../jquery-global.js";
import View from './view.js';
import Notice from "./notice.js";
import Workbench from "./workbench.js";
import WorkbenchNavigator from "./navigator.js";

/**
 * The encapsulated view.
 */
export default class Dialog {

	/**
	 * A dialog is a special area in the workbench for displaying and inputting data.
	 * A dialog contains a view.
	 */
	constructor( dialogElement ) {

		this.view;

		/**
		 * the DOM element which contains the dialog.
		 * @type {*|jQuery|HTMLElement}
		 */
		this.dialogElement = $(dialogElement);
		this.viewElement = this.dialogElement.find('.or-dialog-content .or-view');
	}

	/**
	 * Set Dirty-marker.
	 * @param dirty true, if unsaved changes exist
	 */
	set isDirty( dirty ) {
		if   ( dirty )
			this.viewElement.addClass('view--is-dirty');
		else
			this.viewElement.removeClass('view--is-dirty');
	}

	/**
	 * Get Dirty-marker.
	 * @return true, if unsaved changes exist
	 */
	get isDirty() {
		return this.viewElement.hasClass('view--is-dirty');
	}

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
	start( name,action,method,id,params )
	{
		// Attribute aus dem aktuellen Editor holen, falls die Daten beim Aufrufer nicht angegeben sind.
		if (!action)
			action =  Workbench.state.action;

		if  (!id)
			id =  Workbench.state.id;

		let dialog = this;

		let view = new View( action,method,id,params );

		Notice.removeAllNotices();

		this.dialogElement.find('.or-dialog-content .or-view').html(''); // Clear old content

		this.dialogElement.find('.or-dialog-content .or-act-dialog-name').html( name );
		this.show();

		view.onCloseHandler.add( function() {
			dialog.back();
		} );

		view.onChangeHandler.add( function() {
			// data has changed
			console.debug("Changes detected");
			dialog.isDirty = true;
		});

		view.onSaveHandler.add( function() {
			// data was saved
			dialog.isDirty = false;
		});

		this.view = view;

		Workbench.getInstance().startSpinner();

		let viewPromise = this.view.start( this.viewElement );

		viewPromise.then(
			() => Workbench.getInstance().stopSpinner()
		);

		return viewPromise;
	}



	show() {

		//WorkbenchNavigator.navigateToNew( {'action':Workbench.state.action+'','id':Workbench.state.id } );
		WorkbenchNavigator.navigateToNew( Workbench.state );

		this.dialogElement.removeClass('dialog--is-closed').addClass('dialog--is-open');

		if   ( this.isDirty ) {
			this.viewElement.addClass('view--is-dirty');
		}
	}

	back() {
		console.debug("Back from dialog");
		history.back();
	}

	hide() {
		this.dialogElement.removeClass('dialog--is-open').addClass('dialog--is-closed'); // Dialog schließen
	}


	/**
	 * Closing the dialog.
	 */
	close() {

		let dialog = this;

		if   ( this.isDirty ) {
			// ask the user if we should close this dialog
			//let confirmed = window.confirm( Workbench.language.UNSAVED_CHANGES_CONFIRM );

			//if   ( ! confirmed )
			//	return; // do not close the dialog

			let notice = new Notice();
			notice.msg = Workbench.language.REOPEN_CLOSED_DIALOG;
			notice.setStatus( 'warning' );
			notice.timeout = 120;
			notice.onClick( function() {
				Workbench.dialog = dialog;
				dialog.show();
				notice.close();
			});
			notice.show();
		}

		// Remove dirty-flag from view
		this.dialogElement.find('.or-dialog-content .or-view.or-view--is-dirty').removeClass('view--is-dirty');
		this.hide();
		//$(document).unbind('keyup',this.escapeKeyClosingHandler); // Cleanup ESC-Key-Listener
	}
}