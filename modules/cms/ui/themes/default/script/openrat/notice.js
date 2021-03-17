
/**
 * Notice.
 */
class Notice  {

	'use strict';

	static type = Object.freeze({
		warning: 0,
		validation: 1,
		info: 2,
		success: 3,
		error: 3,
		loading: 3,
		inactive: 4
	});

	constructor() {
		this.typ  = '';
		this.id   = 0;
		this.name = '';
		this.status = 'inactive';
		this.msg  = '';
		this.log  = '';
		this.timeout = 0;

		this.element = $('<div />')
			.addClass('notice'                   )
			.addClass('notice--is-inactive'      )
			.addClass('collapsible'           )
			.addClass('collapsible--is-closed');

		this.onClick = new Callback();

	}


	before() {
	};


	// Close the notice.
	close() {
		/* no effects in jquery slim
		this.element.fadeOut('fast', () => {
			this.element.remove();
		} );*/
		this.element.remove();
	}


	setStatus( status ) {

		this.element.removeClass('notice--' + this.status );
		this.status = status;
		this.element.addClass('notice--' + this.status );
	}


	inProgress() {
		this.element.addClass('loader');
	}

	stopProgress() {
		this.element.removeClass('loader');
	}

	show() {

		console.debug('user notice: '+this.msg);
		let notice = this;
		this.element.removeClass('notice--is-inactive');

		this.element.appendTo('.or-notice-container'); // Notice anhängen.

		let toolbar = $('<div class="or-notice-toolbar"></div>');
		toolbar.appendTo(this.element);
		toolbar.append('<i class="or-image-icon or-image-icon--menu-close or-act-notice-close"></i>');

		this.element.append( $('<i />').addClass('image-icon').addClass('image-icon--node-open'  ).addClass('collapsible--on-open'  ) );
		this.element.append( $('<i />').addClass('image-icon').addClass('image-icon--node-closed').addClass('collapsible--on-closed') );
		this.element.append('<span class="or-notice-text or-collapsible-act-switch">' + Notice.htmlEntities(this.msg) + '</span>');

		if (this.name) {
			this.element.append( $('<div class="or-notice-name or-collapsible-value"><a class="or-act-clickable" href="' + WorkbenchNavigator.createShortUrl(this.typ, this.id) + '" data-type="open" data-action="' + this.typ + '" data-id="' + this.id + '"><i class="or-notice-action-full or-image-icon or-image-icon--action-' + this.typ + '"></i><span class="">' + this.name + '</span></a></div>').orLinkify() );
		}

		if (this.log)
			this.element.append('<div class="or-notice-log or-collapsible-value"><pre>' + Notice.htmlEntities(this.log) + '</pre></div>');

		this.element.append('<div class="or-notice-date or-collapsible-value">' + new Date().toLocaleTimeString() + '</div>');


		// Fire onclick-handler
		this.element.find('.or-notice-text').click( function () {
			notice.onClick.fire();
		} );

		Workbench.registerOpenClose( this.element );

		// Close the notice on click
		this.element.find('.or-act-notice-close').click(function () {
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
			this.element.click( function () {
				console.debug('kicked timer of notice');
				console.debug( timer );
				window.clearTimeout( timer );
			} );
		}
	}

	setContext(type,id,name) {
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
	start(type, id, name, status, msg, log = null, notifyTheBrowser = false) {
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
	notifyBrowser()
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
	static htmlEntities( str ) {
		return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
	}


	static removeNoticesWithStatus( status) {
		$('.or-notice-container').find('.or-notice--'+status).remove();
	}

	static removeAllNotices( status) {

		$('.or-notice-container').find('.or-notice').remove();
	}

}
