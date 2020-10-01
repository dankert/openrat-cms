

Openrat.Workbench = new function()
{
    'use strict'; // Strict mode


    this.state = {};

    this.popupWindow = null;

    /**
	 * Initializes the Workbench.
     */
	this.initialize = function() {

		// Initialze Ping timer.
		this.initializePingTimer();
		this.initializeDirtyWarning();
        this.initializeState();
        this.openModalDialog();
    }


    this.initializeDirtyWarning = function () {

		// If the application should be closed, inform the user about unsaved changes.
		window.addEventListener('beforeunload', function (e) {

			// Are there views in the dirty state?
			if   ( $('.view.dirty').length > 0 ) {

				e.preventDefault(); // Cancel the event

				// This text is replaced by modern browsers with a common message.
				return 'Unsaved content will be lost.';
			}
			else {
				// Let the browser quitting the page.
				// Do NOT logout here, because there could be other windows/tabs with the same session.
				return undefined; // nothing to do.
			}
		});
	}

    /**
     * Starts a dialog, if necessary.
     */
    this.openModalDialog = function () {

        if   ( $('#dialog').data('action') ) {
            this.startDialog('',$('#dialog').data('action'),$('#dialog').data('action'),0,{})
        }
    }


    /**
     * Sets the workbench state with action/id.
     *
     * Example: #/name/1 is translated to the state {action:name,id:1}
     */
    this.initializeState = function () {

        let parts = window.location.hash.split('/');
        let state = { action:'index',id:0 };

        if   ( parts.length >= 2 )
            state.action = parts[1].toLowerCase();

        if   ( parts.length >= 3 )
            // Only numbers and '_' allowed in the id.
            state.id = parts[2].replace(/[^0-9_]/gim,"");

        Openrat.Workbench.state = state;

        // TODO: Remove this sometimes.... only state.
        $('#editor').attr('data-action',state.action);
        $('#editor').attr('data-id'    ,state.id    );
        $('#editor').attr('data-extra' ,'{}'  );

        Openrat.Navigator.toActualHistory( state );

    }

    /**
	 *  Registriert den Ping-Timer für den Sitzungserhalt.
     */
	this.initializePingTimer = function() {

        /**
         * Ping den Server. Führt keine Aktion aus, aber sorgt dafür, dass die Sitzung erhalten bleibt.
         *
         * "Geben Sie mir ein Ping, Vasily. Und bitte nur ein einziges Ping!" (aus: Jagd auf Roter Oktober)
         */
        let ping = function()
        {
            let pingPromise = $.getJSON( Openrat.View.createUrl('profile','ping',0, {}, true) );

            pingPromise.fail( function() {
				// oO, what has happened? There is no session with a logged in user, or the server has gone.
				console.warn('The server ping has failed.');

				// Is there any user input? Ok, we should warn the user that the data could not be saved.
				if ($('.view.dirty').length > 0) {
					window.alert("The server session is lost, please save your data.");
				}
				else {
					// no input data, so lets reload all views?
					// no, maybe an anonymous user is looking around.
					//Openrat.reloadAll();
				}
			} );
        }

        // Alle 5 Minuten pingen.
		let timeoutMinutes = 5;

        window.setInterval( ping, timeoutMinutes*60*1000 );
    }



    this.loadNewActionState = function(state) {

        Openrat.Workbench.state = state;
        Openrat.Workbench.loadNewAction(state.action,state.id,state.data);

        this.afterNewActionHandler.fire();
	}


    this.afterNewActionHandler = $.Callbacks();


    /**
	 *
     */

    this.loadNewAction = function(action, id, params ) {

    	$('#editor').attr('data-action',action);
    	$('#editor').attr('data-id'    ,id    );
    	$('#editor').attr('data-extra' ,JSON.stringify(params));

        this.reloadViews();
    }



    /**
     *
     */

    this.reloadViews = function() {

        // View in geschlossenen Sektionen löschen, damit diese nicht stehen bleiben.
        $('#workbench section.closed .view-loader').empty();

        Openrat.Workbench.loadViews( $('#workbench section.open .view-loader') );
    }


    this.reloadAll = function() {

    	// View in geschlossenen Sektionen löschen, damit diese nicht stehen bleiben.
        Openrat.Workbench.loadViews( $('.view-loader,.view-static').empty() );

        this.loadUserStyle();
        this.loadLanguage();
        this.loadUISettings();
        this.loadNavigationTree();
    }


    this.loadUserStyle = function() {

        let url = Openrat.View.createUrl('profile','userinfo',0, {},true );

        // Die Inhalte des Zweiges laden.
        $.getJSON(url, function (response) {

            let style = response.output['style'];
            Openrat.Workbench.setUserStyle(style);

            let color = response.output['theme-color'];
            Openrat.Workbench.setThemeColor(color);
        });
    }

    this.loadNavigationTree = function() {
		let loadBranchUrl = './?action=tree&subaction=branch&id=0&type=root';

		$.get(loadBranchUrl).done( function (html) {

			// Den neuen Unter-Zweig erzeugen.
			let $ul = $('<ul class="or-navtree-list" />');
			$ul.appendTo( $('.or-navtree').empty() ).append( html );

			$ul.find('li').orTree(); // All subnodes are getting event listener for open/close

			// Die Navigationspunkte sind anklickbar, hier wird der Standardmechanismus benutzt.
			$ul.find('.clickable').orLinkify();

			// Open the first node.
			$ul.find('.or-navtree-node-control').first().click();
		} );
	};


	this.settings = {};
    this.language = {};

    this.loadLanguage = function() {

        let url = Openrat.View.createUrl('profile','language',0, {},true );

        // Die Inhalte des Zweiges laden.
        $.getJSON(url, function (response) {

            Openrat.Workbench.language = response.output.language;
        });
    }

    this.loadUISettings = function() {

        let url = Openrat.View.createUrl('profile','uisettings',0, {},true );

        // Die Inhalte des Zweiges laden.
        $.getJSON(url, function (response) {

            Openrat.Workbench.settings = response.output.settings.settings;
        });
    }



    this.loadViews = function( $views )
    {

        $views.each(function (idx) {

            let $targetDOMElement = $(this);

            Openrat.Workbench.loadNewActionIntoElement( $targetDOMElement )
        });
    }



    this.loadNewActionIntoElement = function( $viewElement )
    {
        let action;
        if   ( $viewElement.is('.view-static') )
            // Static views have always the same action.
            action = $viewElement.attr('data-action');
        else
            action = $('#editor').attr('data-action');

        let id     = $('#editor').attr('data-id'    );
        let params = $('#editor').attr('data-extra' );

        let method = $viewElement.data('method');

        let view = new Openrat.View( action,method,id,params );
        view.start( $viewElement );
    }




    /**
     * Sets a new theme.
     * @param styleName
     */
    this.setUserStyle = function( styleName )
    {
        var html = $('html');
        var classList = html.attr('class').split(/\s+/);
        $.each(classList, function(index, item) {
            if (item.startsWith('theme-')) {
                html.removeClass(item);
            }
        });
        html.addClass( 'theme-' + styleName.toLowerCase() );
    }


    /**
     * Sets a new theme color.
     * @param color Theme-color
     */
    this.setThemeColor = function( color )
    {
        $('#theme-color').attr('content',color);
    }




    /**
     * Show a notification in the browser.
     * Source: https://developer.mozilla.org/en-US/docs/Web/API/notification
     * @param text text of message
     */
    let notifyBrowser = function(text)
    {
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
     * Show a notice bubble in the UI.
     * @param type
     * @param name
     * @param status
     * @param msg
     * @param log
     */
    this.notify = function( type,name,status,msg,log=[],notifyTheBrowser=false )
    {
        // Notice-Bar mit dieser Meldung erweitern.

        if   ( notifyTheBrowser )
            notifyBrowser( msg );  // Notify browser if wanted.

        let notice = $('<div class="notice '+status+'"></div>');

        let toolbar = $('<div class="or-notice-toolbar"></div>');
        if   ( log.length )
            $(toolbar).append('<i class="or-action-full image-icon image-icon--menu-fullscreen"></i>');
        $(toolbar).append('<i class="or-action-close image-icon image-icon--menu-close"></i>');
        $(notice).append(toolbar);

        let id = 0; // TODO id of objects to click on
        if	(name)
            $(notice).append('<div class="name clickable"><a href="" data-type="open" data-action="'+type+'" data-id="'+id+'"><i class="or-action-full image-icon image-icon--action-'+type+'"></i> '+name+'</a></div>');

        $(notice).append( '<div class="text">'+htmlEntities(msg)+'</div>');

        if (log.length) {

            let logLi = log.reduce((result, item) => {
                result += '<li><pre>'+htmlEntities(item)+'</pre></li>';
                return result;
            }, '');
            $(notice).append('<div class="log"><ul>'+logLi+'</ul></div>');
        }

        $('#noticebar').prepend(notice); // Notice anhängen.
        $(notice).orLinkify(); // Enable links


        // Toogle Fullscreen for notice
        $(notice).find('.or-action-full').click( function() {
            $(notice).toggleClass('full');
        });

        // Close the notice on click
        $(notice).find('.or-action-close').click( function() {
            $(notice).fadeOut('fast',function() { $(notice).remove(); } );
        });

        // Fadeout the notice after a while.
        let timeout = 1;
        if ( status == 'ok'     ) timeout = 20;
        if ( status == 'info'   ) timeout = 60;
        if ( status == 'warning') timeout = 120;
        if ( status == 'error'  ) timeout = 120;

        if (timeout > 0)
            setTimeout( function() {
                $(notice).fadeOut('slow', function() { $(this).remove(); } );
            },timeout*1000 );
    }



	this.dataChangedHandler = $.Callbacks();

	this.dataChangedHandler.add( function() {
		if   ( Openrat.Workbench.popupWindow )
			Openrat.Workbench.popupWindow.location.reload();
	} );

    this.afterViewLoadedHandler = $.Callbacks();

    let afterViewFunctions = [];

    this.registerAfterViewLoaded = function( f ) {
        afterViewFunctions.push( f );
    }

    this.afterViewLoaded = function( element ) {

        afterViewFunctions.forEach( function( f ) {
           f(element);
        });
    }


	/**
	 * Sets the application title.
	 */
	this.setApplicationTitle = function( title ) {

		if (title)
			$('head > title').text( title + ' - ' + $('head > title').data('default') );
		else
			$('head > title').text( $('head > title').data('default') );
	}


	/**
	 * Escape HTML entities.
	 *
	 * @param str
	 * @returns {string}
	 */
	var htmlEntities = function( str ) {
		return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
	}


	/**
	 * open and close groups.
	 *
	 * @param $el
	 */
	this.registerOpenClose = function( $el )
	{
		$($el).children('.on-click-open-close').click( function() {
			$(this).closest('.toggle-open-close').toggleClass('open closed');
		});
	}



	/**
	 * Setzt neue Action und aktualisiert alle Fenster.
	 *
	 * @param action Action
	 * @param id Id
	 */
	this.openNewAction = function( name,action,id )
	{
		// Im Mobilmodus soll das Menü verschwinden, wenn eine neue Action geoeffnet wird.
		$('nav').removeClass('open');

		Openrat.Workbench.setApplicationTitle( name ); // Sets the title.

		Openrat.Navigator.navigateToNew( {'action':action, 'id':id } );
	}



	/**
	 * Creating a new modal dialog.
	 *
	 * @param name
	 * @param action Action
	 * @param method
	 * @param id Id
	 * @param params
	 */
	this.startDialog = function( name,action,method,id,params )
	{
		// Attribute aus dem aktuellen Editor holen, falls die Daten beim Aufrufer nicht angegeben sind.
		if (!action)
			action = $('#editor').attr('data-action');

		if  (!id)
			id = $('#editor').attr('data-id');

		let view = new Openrat.View( action,method,id,params );

		view.before = function() {
			$('#dialog > .view').html('<div class="header"><img class="icon" title="" src="./themes/default/images/icon/'+method+'.png" />'+name+'</div>');
			$('#dialog > .view').data('id',id);
			$('#dialog').removeClass('is-closed').addClass('is-open');

			let view = this;

			this.escapeKeyClosingHandler = function (e) {
				if (e.keyCode == 27) { // ESC keycode
					view.close();

					$(document).off('keyup'); // de-register.
				}
			};

			$(document).keyup(this.escapeKeyClosingHandler);

			// Nicht-Modale Dialoge durch Klick auf freie Fläche schließen.
			$('#dialog .filler').click( function()
			{
				view.close();
			});

		}

		view.close = function() {

			// Strong modal dialogs are unable to close.
			// Really?
			if	( $('div#dialog').hasClass('modal') )
				return;

			$('#dialog .view').removeClass('dirty');
			$('#dialog .view').html('');
			$('#dialog').removeClass('is-open').addClass('is-closed'); // Dialog schließen

			$(document).unbind('keyup',this.escapeKeyClosingHandler); // Cleanup ESC-Key-Listener
		}

		view.start( $('div#dialog > .view') );
	}




	this.registerDraggable = function(viewEl) {

// Drag n Drop: Inhaltselemente (Dateien,Seiten,Ordner,Verknuepfungen) koennen auf Ordner gezogen werden.

		$(viewEl).find('.or-draggable').draggable(
			{
				helper: 'clone',
				opacity: 0.7,
				zIndex: 2,
				distance: 10,
				cursor: 'move',
				revert: 'false'
			}
		);

	}


	this.registerDroppable = function(viewEl) {


		$(viewEl).find('.or-droppable').droppable({
			accept: '.or-draggable',
			hoverClass: 'or-droppable--hover',
			activeClass: 'or-droppable--active',

			drop: function (event, ui) {

				let dropped = ui.draggable;

				let id   = dropped.data('id'  );
				let name = dropped.data('name');
				if   (!name)
					name = id;

				$(this).find('.or-selector-link-value').val( id );
				$(this).find('.or-selector-link-name' ).val( name ).attr('placeholder',name );
			}
		});
	}

}

