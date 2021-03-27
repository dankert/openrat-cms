import '../jquery-global.js';
import Dialog from './dialog.js';
import View from './view.js';
import Callback from './callback.js';
import WorkbenchNavigator from "./navigator";


export default class Workbench {
    'use strict'; // Strict mode

	static state = {
		action: '',
		id: 0,
		extra: {}
	};

	static instance;

	constructor() {

		this.popupWindow = null;

		Callback.dataChangedHandler.add( () => {
			if   ( Workbench.popupWindow )
				Workbench.popupWindow.location.reload();
		} );

	}


	/**
	 *
	 * @return Workbench
	 */
	static getInstance() {

		if   ( ! Workbench.instance )
			Workbench.instance = new Workbench();

		return Workbench.instance;
	}


    /**
	 * Initializes the Workbench.
     */
	initialize() {

		// Initialze Ping timer.
		this.initializePingTimer();
		this.initializeDirtyWarning();
        this.initializeState();

		Workbench.registerOpenClose( $('.or-collapsible') );
		console.info('Application started');
    }


    initializeDirtyWarning() {

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
	 *
	 * @deprecated no dialogs are opened on load.
     */
    openModalDialog() {

        if   ( $('#dialog').data('action') ) {
        	let dialog = new Dialog();
        	dialog.start('',$('#dialog').data('action'),$('#dialog').data('action'),0,{} )
        }
    }


    /**
     * Sets the workbench state with action/id.
     *
     * Example: #/name/1 is translated to the state {action:name,id:1}
     */
    initializeState() {

        let parts = window.location.hash.split('/');
        let state = { action:'index',id:0 };

        if   ( parts.length >= 2 )
            state.action = parts[1].toLowerCase();

        if   ( parts.length >= 3 )
            // Only numbers and '_' allowed in the id.
            state.id = parts[2].replace(/[^0-9_]/gim,"");

        Workbench.state = state;

		WorkbenchNavigator.toActualHistory( state );
    }

    /**
	 *  Registriert den Ping-Timer für den Sitzungserhalt.
     */
	initializePingTimer() {

        /**
         * Ping den Server. Führt keine Aktion aus, aber sorgt dafür, dass die Sitzung erhalten bleibt.
         *
         * "Geben Sie mir ein Ping, Vasily. Und bitte nur ein einziges Ping!" (aus: Jagd auf Roter Oktober)
         */
        let ping = async () => {
        	let url = View.createUrl('profile','ping',0, {}, true);
			console.debug('ping');

			try {
				let response = await fetch( url  );

				if   ( !response.ok )
					throw "ping failed";
			} catch( cause ) {
				// oO, what has happened? There is no session with a logged in user, or the server has gone.
				console.warn( {message: 'The server ping has failed.',cause:cause });

				// Is there any user input? Ok, we should warn the user that the data could not be saved.
				if ($('.or-view--is-dirty').length > 0) {
					window.alert("The server session is lost, please save your data.");
				}
				else {
					// no input data, so lets reload all views?
					// no, maybe an anonymous user is looking around.
					//Openrat.reloadAll();
				}
			}



		}

        // Alle 5 Minuten pingen.
		let timeoutMinutes = 5;

        window.setInterval( ping, timeoutMinutes*60*1000 );
    }



    loadNewActionState(state) {

        Workbench.state = state;
        this.loadNewAction(state.action,state.id,state.data);

		Callback.afterNewActionHandler.fire();
	}


    /**
	 *
     */

    loadNewAction = function(action, id, params ) {

        this.reloadViews();
    }



    /**
     *
     */

    reloadViews() {

        // View in geschlossenen Sektionen löschen, damit diese nicht stehen bleiben.
        $('.or-workbench-section--is-closed .or-act-view-loader').empty();

        let promise = this.loadViews( $('.or-workbench .or-act-view-loader') );
		promise.then( function() {
				Callback.afterAllViewsLoaded.fire();
			}
		);

		return promise;
    }


	/**
	 * @return a promise for all views
	 */
	reloadAll() {

    	// View in geschlossenen Sektionen löschen, damit diese nicht stehen bleiben.
        let promise = this.loadViews( $('.or-act-view-loader,.or-act-view-static').empty() );
        console.debug('reloading all views');

        promise.then( () => {
				Callback.afterAllViewsLoaded.fire();
			}
		);

        let stylePromise    = this.loadUserStyle();
        let languagePromise = this.loadLanguage();
        let settingsPromise = this.loadUISettings();

        return Promise.all( [ promise,stylePromise,languagePromise,settingsPromise ] );
    }


	async loadUserStyle() {

		let url = View.createUrl('profile', 'userinfo', 0, {}, true);

		let response = await fetch(url);
		let json = await response.json();

		let style = json.output['style'];
		this.setUserStyle(style);

		let color = json.output['theme-color'];
		this.setThemeColor(color);
	}



	static settings = {};
    static language = {};

    async loadLanguage() {

		let url = View.createUrl('profile', 'language', 0, {}, true);

		let response = await fetch(url);
		let data     = await response.json();

		Workbench.language = data.output.language;
	}

	/**
	 * load UI settings from the server.
	 */
	async loadUISettings() {

		let url = View.createUrl('profile', 'uisettings', 0, {}, true);

		let response = await fetch(url);
		let data = await response.json();

		Workbench.settings = data.output.settings.settings;
	}


	/**
	 *
	 * @param $views
	 * @returns Promise for all views
	 */
	loadViews( $views )
    {
    	let wb = this;
    	let promises = [];
        $views.each(function (idx) {

            let $targetDOMElement = $(this);

            promises.push( wb.loadNewActionIntoElement( $targetDOMElement ) );
        });

        return Promise.all( promises );
    }


	/**
	 * @param $viewElement
	 * @returns {Promise}
	 */
	loadNewActionIntoElement( $viewElement )
    {
        let action;
        if   ( $viewElement.is('.or-act-view-static') )
            // Static views have always the same action.
            action = $viewElement.attr('data-action');
        else
            action = Workbench.state.action;

        let id     = Workbench.state.id;
        let params =  Workbench.state.extra;

        let method = $viewElement.data('method');

        let view = new View( action,method,id,params );
        return view.start( $viewElement );
    }




    /**
     * Sets a new theme.
     * @param styleName
     */
    setUserStyle( styleName )
    {
    	let styleUrl = View.createUrl('index','themestyle',0,{'style':styleName} );
		document.getElementById('user-style').setAttribute('href',styleUrl);
    }


    /**
     * Sets a new theme color.
     * @param color Theme-color
     */
    setThemeColor( color )
    {
		document.getElementById('theme-color').setAttribute('content',color);
    }



	static dataChangedHandler = new Callback();



	/**
	 * Sets the application title.
	 */
	static setApplicationTitle( newTitle ) {

		let title = document.querySelector('head > title');
		let defaultTitle = title.dataset.default;

		title.textContent = (newTitle ? newTitle + ' - ' : '') + defaultTitle;
	}




	/**
	 * open and close groups.
	 *
	 * @param $el
	 */
	static registerOpenClose = function( $el )
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
	openNewAction( name,action,id )
	{
		// Im Mobilmodus soll das Menü verschwinden, wenn eine neue Action geoeffnet wird.
		$('.or-workbench-navigation').removeClass('workbench-navigation--is-open');

		Workbench.setApplicationTitle( name ); // Sets the title.

		let newState = {'action':action, 'id':id };
		this.loadNewActionState( newState );

		WorkbenchNavigator.navigateToNew( newState );
	}








	registerDraggable(viewEl) {

	// Drag n Drop: Inhaltselemente (Dateien,Seiten,Ordner,Verknuepfungen) koennen auf Ordner gezogen werden.

		/*
		no jquery ui anymore.
		$(viewEl).find('.or-draggable').draggable(
			{
				helper: 'clone',
				opacity: 0.7,
				zIndex: 3,
				distance: 10,
				cursor: 'move',
				revert: 'false'
			}
		);*/

		// Enable HTML5-Drag n drop
		$(viewEl).find('.or-draggable').attr('draggable','true');

	}


	registerDroppable(viewEl) {

		$(viewEl).find('.or-droppable-selector').on('drop', (event) => {

			let data = event.dataTransfer.getData('text');
			console.debug('dropped:',dropped);
			let id   = $(data).find('.or-link').data('id');
			let name = $(data).find('.or-navtree-text').text();

			if   (!name)
				name = id;

			$(this).find('.or-selector-link-value').val( id );
			$(this).find('.or-selector-link-name' ).val( name ).attr('placeholder',name );
		});

	}


	static htmlDecode(input) {
		let doc = new DOMParser().parseFromString(input, "text/html");
		return doc.documentElement.textContent;
	}
}

