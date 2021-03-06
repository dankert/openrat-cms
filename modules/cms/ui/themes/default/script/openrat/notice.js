
/**
 * Notice.
 */
Openrat.Notice = function() {

	'use strict';

	this.typ = '';
	this.id = 0;
	this.name = '';
	this.status = 'inactive';
	this.msg = '';
	this.log = '';
	this.timeout = 0;

	let element = $('<div />')
		.addClass('notice'                   )
		.addClass('notice--is-inactive'      )
		.addClass('collapsible'           )
		.addClass('collapsible--is-closed');

	this.onClick = $.Callbacks();

	const type = Object.freeze({
		warning: 0,
		validation: 1,
		info: 2,
		success: 3,
		error: 3,
		loading: 3,
		inactive: 4
	});


	this.before = function () {
	};


	// Close the notice.
	this.close = function() {
		element.fadeOut('fast', function () {
			element.remove();
		} );
	}


	this.setStatus = function( status ) {

		element.removeClass('notice--' + this.status );
		this.status = status;
		element.addClass('notice--' + this.status );
	}


	this.inProgress = function() {
		element.addClass('loader');
	}

	this.stopProgress = function() {
		element.removeClass('loader');
	}

	this.show = function() {

		console.debug('user notice: '+this.msg);
		let notice = this;
		element.removeClass('notice--is-inactive');

		element.appendTo('.or-notice-container'); // Notice anhängen.

		let toolbar = $('<div class="or-notice-toolbar"></div>');
		toolbar.appendTo(element);
		toolbar.append('<i class="or-image-icon or-image-icon--menu-close or-act-notice-close"></i>');

		element.append( $('<i />').addClass('image-icon').addClass('image-icon--node-open'  ).addClass('collapsible--on-open'  ) );
		element.append( $('<i />').addClass('image-icon').addClass('image-icon--node-closed').addClass('collapsible--on-closed') );
		element.append('<span class="or-notice-text or-collapsible-act-switch">' + htmlEntities(this.msg) + '</span>');

		if (this.name) {
			element.append( $('<div class="or-notice-name or-collapsible-value"><a class="or-act-clickable" href="' + Openrat.Navigator.createShortUrl(this.typ, this.id) + '" data-type="open" data-action="' + this.typ + '" data-id="' + this.id + '"><i class="or-notice-action-full or-image-icon or-image-icon--action-' + this.typ + '"></i><span class="">' + this.name + '</span></a></div>').orLinkify() );
		}

		if (this.log)
			element.append('<div class="or-notice-log or-collapsible-value"><pre>' + htmlEntities(this.log) + '</pre></div>');

		element.append('<div class="or-notice-date or-collapsible-value">' + new Date().toLocaleTimeString() + '</div>');


		// Fire onclick-handler
		element.find('.or-notice-text').click( function () {
			notice.onClick.fire();
		} );

		Openrat.Workbench.registerOpenClose( element );

		// Close the notice on click
		element.find('.or-act-notice-close').click(function () {
			notice.close();
		});

		// Fadeout the notice after a while.
		if   ( !this.timeout ) {
			switch( this.status ) {
				case 'ok'     : this.timeout =  3; break;
				case 'info'   : this.timeout = 30; break;
				case 'warning': this.timeout = 40; break;
				case 'error'  : this.timeout = 50; break;
				default:        this.timeout = 10; console.error('unknown notice status: '+this.status);
			}
		}

		if (this.timeout) {

			// Sets a timer to close the notice after the timeout
			let timer = setTimeout(function () {
				notice.close();
			}, this.timeout * 1000);

			// Click anywhere in the notice should clear the auto-close timer.
			// Because if the user interacts with the notice it should not magically disappear.
			element.click( function () {
				console.debug('kicked timer of notice');
				console.debug( timer );
				window.clearTimeout( timer );
			} );
		}
	}

	this.setContext = function(type,id,name) {
		this.typ  = type;
		this.id   = id;
		this.name = name;
	}


	/**
	 * Show a notice bubble in the UI.
	 * @param type
	 * @param id
	 * @param name
	 * @param status
	 * @param msg
	 * @param log
	 * @param notifyTheBrowser
	 */
	this.start = function (type, id, name, status, msg, log = null, notifyTheBrowser = false) {
		// Notice-Bar mit dieser Meldung erweitern.

		this.setContext(type,id,name);
		this.msg = msg;
		this.log = log;

		if (notifyTheBrowser)
			this.notifyBrowser(msg);  // Notify browser if wanted.

		this.setStatus(status);

	}



	/**
	 * Show a notification in the browser.
	 * Source: https://developer.mozilla.org/en-US/docs/Web/API/notification
	 * @param text text of message
	 */
	this.notifyBrowser = function()
	{
		let text = this.msg;

		// Let's check if the browser supports notifications
		if (!("Notification" in window)) {
			return;
		}

		// Let's check if the user is okay to get some notification
		else if (Notification.permission === "granted") {
			// If it's okay let's create a notification
			let notification = new Notification(text);
		}

		// Otherwise, we need to ask the user for permission
		else if (Notification.permission !== 'denied') {
			Notification.requestPermission(function (permission) {
				// If the user is okay, let's create a notification
				if (permission === "granted") {
					let notification = new Notification(text);
				}
			});
		}

		// At last, if the user already denied any notification, and you
		// want to be respectful there is no need to bother them any more.
	}



	/**
	 * Escape HTML entities.
	 *
	 * @param str
	 * @returns {string}
	 */
	let htmlEntities = function( str ) {
		return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
	}

}


Openrat.Notice.removeNoticesWithStatus = function( status) {
	$('.or-notice-container').find('.or-notice--'+status).remove();
}

Openrat.Notice.removeAllNotices = function( status) {

	$('.or-notice-container').find('.or-notice').remove();
}
