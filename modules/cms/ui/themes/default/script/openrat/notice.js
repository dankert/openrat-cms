
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

	let element = $('<div class="or-notice or-notice--is-inactive"></div>');


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

		element.appendTo('.or-notices'); // Notice anhängen.

		let toolbar = $('<div class="or-notice-toolbar"></div>');
		toolbar.appendTo(element);
		toolbar.append('<i class="or-image-icon or-image-icon--menu-close or-act-notice-close"></i>');

		if (this.log)
			toolbar.append('<i class="or-act-notice-full or-image-icon or-image-icon--menu-fullscreen"></i>');

		if (this.name)
			element.append('<div class="or-notice-name"><a class="or-act-clickable" href="' + Openrat.Navigator.createShortUrl(this.typ, this.id) + '" data-type="open" data-action="' + this.typ + '" data-id="' + this.id + '"><i class="or-notice-action-full or-image-icon or-image-icon--action-' + this.typ + '"></i> ' + this.name + '</a></div>');

		element.append('<div class="or-notice-text">' + htmlEntities(this.msg) + '</div>');

		if (this.log)
			element.append('<div class="or-notice-log"><pre>' + htmlEntities(this.log) + '</pre></div>');

		element.orLinkify(); // Enable links


		// Toogle Fullscreen for notice
		element.find('.or-act-notice-full').click(function () {
			element.toggleClass('notice--is-full');
		});

		// Close the notice on click
		element.find('.or-act-notice-close').click(function () {
			notice.close();
		});

		// Fadeout the notice after a while.
		let timeout = 1;
		if (this.status == 'ok') timeout = 3;
		if (this.status == 'info') timeout = 30;
		if (this.status == 'warning') timeout = 40;
		if (this.status == 'error') timeout = 50;

		if (timeout > 0)
			setTimeout(function () {
				element.fadeOut('slow', function () {
					element.remove();
				});
			}, timeout * 1000);
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
	$('.or-notices').find('.or-notice--'+status).remove();
}

Openrat.Notice.removeAllNotices = function( status) {

	$('.or-notices').find('.or-notice').remove();
}
