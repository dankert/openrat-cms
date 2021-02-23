

Openrat.Workbench = new function()
{
    'use strict'; // Strict mode


    this.state = {
    	action: '',
    	id: 0,
		extra: {}
	};

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

		Openrat.Workbench.registerOpenClose( $('.or-collapsible') );
		console.info('Application started');
    }


    this.initializeDirtyWarning = function () {

		// If the application should be closed, inform the user about unsaved changes.
		window.addEventListener('beforeunload', function (e) {

			// Are there views in the dirty state?
			if   ( $('.or-view--is-dirty').length > 0 ) {

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
        	let dialog = new Openrat.Dialog();
        	dialog.start('',$('#dialog').data('action'),$('#dialog').data('action'),0,{} )
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
            console.debug('ping');

            pingPromise.fail( function( jqXHR, textStatus, errorThrown ) {
				// oO, what has happened? There is no session with a logged in user, or the server has gone.
				console.warn( {message: 'The server ping has failed.',jqXHR:jqXHR,status:textStatus,error:errorThrown });

				// Is there any user input? Ok, we should warn the user that the data could not be saved.
				if ($('.or-view--is-dirty').length > 0) {
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
    this.afterAllViewsLoaded   = $.Callbacks();


    /**
	 *
     */

    this.loadNewAction = function(action, id, params ) {

        this.reloadViews();
    }



    /**
     *
     */

    this.reloadViews = function() {

        // View in geschlossenen Sektionen löschen, damit diese nicht stehen bleiben.
        $('.or-workbench-section--is-closed .or-act-view-loader').empty();

        let promise = Openrat.Workbench.loadViews( $('.or-workbench .or-act-view-loader') );
		promise.done( function() {
				Openrat.Workbench.afterAllViewsLoaded.fire();
			}
		);

		return promise;
    }


    this.reloadAll = function() {

    	// View in geschlossenen Sektionen löschen, damit diese nicht stehen bleiben.
        let promise = Openrat.Workbench.loadViews( $('.or-act-view-loader,.or-act-view-static').empty() );
        console.debug('reloading all views');

        promise.done( function() {
				Openrat.Workbench.afterAllViewsLoaded.fire();
			}
		);

        this.loadUserStyle();
        this.loadLanguage();
        this.loadUISettings();

        return promise;
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


	/**
	 *
	 * @param $views
	 * @returns Promise for all views
	 */
	this.loadViews = function( $views )
    {
    	let promises = [];
        $views.each(function (idx) {

            let $targetDOMElement = $(this);

            promises.push( Openrat.Workbench.loadNewActionIntoElement( $targetDOMElement ) );
        });

        return $.when.apply( $, promises );
    }


	/**
	 * @param $viewElement
	 * @returns {Promise}
	 */
	this.loadNewActionIntoElement = function( $viewElement )
    {
        let action;
        if   ( $viewElement.is('.or-act-view-static') )
            // Static views have always the same action.
            action = $viewElement.attr('data-action');
        else
            action = Openrat.Workbench.state.action;

        let id     = Openrat.Workbench.state.id;
        let params =  Openrat.Workbench.state.extra;

        let method = $viewElement.data('method');

        let view = new Openrat.View( action,method,id,params );
        return view.start( $viewElement );
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
            if (item.startsWith('or-theme-')) {
                html.removeClass(item.substring(3));
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



	this.dataChangedHandler = $.Callbacks();

	this.dataChangedHandler.add( function() {
		if   ( Openrat.Workbench.popupWindow )
			Openrat.Workbench.popupWindow.location.reload();
	} );

    this.afterViewLoadedHandler = $.Callbacks();



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
	 * open and close groups.
	 *
	 * @param $el
	 */
	this.registerOpenClose = function( $el )
	{
		$($el).children('.or-collapsible-act-switch').click( function() {
			$(this).closest('.or-collapsible').toggleClass('collapsible--is-open').toggleClass('collapsible--is-closed');
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
		$('.or-workbench-navigation').removeClass('workbench-navigation--is-open');

		Openrat.Workbench.setApplicationTitle( name ); // Sets the title.

		Openrat.Navigator.navigateToNew( {'action':action, 'id':id } );
	}








	this.registerDraggable = function(viewEl) {

// Drag n Drop: Inhaltselemente (Dateien,Seiten,Ordner,Verknuepfungen) koennen auf Ordner gezogen werden.

		$(viewEl).find('.or-draggable').draggable(
			{
				helper: 'clone',
				opacity: 0.7,
				zIndex: 3,
				distance: 10,
				cursor: 'move',
				revert: 'false'
			}
		);

	}


	this.registerDroppable = function(viewEl) {


		$(viewEl).find('.or-droppable-selector').droppable({
			accept: '.or-draggable',
			hoverClass: 'droppable--hover',
			activeClass: 'droppable--active',

			drop: function (event, ui) {

				let dropped = ui.draggable;
				console.info('dropped:');
				console.info(dropped);
				let id   = $(dropped).find('.or-link').data('id');
				let name = $(dropped).find('.or-navtree-text').text();

				if   (!name)
					name = id;

				$(this).find('.or-selector-link-value').val( id );
				$(this).find('.or-selector-link-name' ).val( name ).attr('placeholder',name );
			}
		});

/*
		$(viewEl).find('.or-droppable-navigation').droppable({
			accept: '.or-draggable',
			hoverClass: 'droppable--hover',
			activeClass: 'droppable--active',

			drop: function (event, ui) {

				let dropped = ui.draggable;

				let id   = dropped.data('id'  );
				let name = dropped.data('name');
				if   (!name)
					name = id;

				alert('dropped');
			}
		});
*/
	}

}

