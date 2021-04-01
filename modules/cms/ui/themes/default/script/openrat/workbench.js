import $ from '../jquery-global.js';
import Dialog from './dialog.js';
import View from './view.js';
import Callback from './callback.js';
import WorkbenchNavigator from "./navigator.js";
import Notice from "./notice.js";


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

		$('html').removeClass('nojs');

		/* Fade in all elements. */
		$('.or--initial-hidden').removeClass('-initial-hidden');


		// Listening to the "popstate" event
		// If the user navigates back or forward, the new state is set.
		window.onpopstate = ev => {
			this.loadNewActionState(ev.state);
		};

		this.initializeState();
		this.initializeStartupNotices();
		this.initializeEvents();
		this.initializeKeystrokes();

		// Load all views
		this.reloadAll().then( () => {
				Callback.afterNewActionHandler.fire();
			}
		);


		// Initialze Ping timer.
		this.initializePingTimer();
		this.initializeDirtyWarning();

		//Workbench.registerOpenClose( $('.or-collapsible') );
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


	/**
	 * Sets a new states and loads all views.
	 *
	 * @param state
	 */
	loadNewActionState(state) {

        Workbench.state = state;

        this.reloadViews();
		this.filterMenus();

		Callback.afterNewActionHandler.fire();
	}


    /**
     *
     */
    reloadViews() {

        let promise = this.loadViews( $('.or-workbench .or-act-view-loader') );

		return promise;
    }


	/**
	 * @return a promise for all views
	 */
	reloadAll() {

		document.querySelector('body').classList.add('or-loader');

		let promise = this.loadViews( $('.or-act-view-loader,.or-act-view-static') );
        console.debug('reloading all views');

        let stylePromise    = this.loadUserStyle();
        let languagePromise = this.loadLanguage();
        let settingsPromise = this.loadUISettings();

        let all = Promise.all( [ promise,stylePromise,languagePromise,settingsPromise ] );

        all.then(
			() => document.querySelector('body').classList.remove('or-loader')
		);

        return all;
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

		let all = Promise.all( promises );

		return all;


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




	async filterMenus() {

		let action = Workbench.state.action;
		let id = Workbench.state.id;
		$('.or-workbench-title .or-dropdown-entry.or-act-clickable').addClass('dropdown-entry--active');
		$('.or-workbench-title .or-filtered').removeClass('dropdown-entry--active').addClass('dropdown-entry--inactive');
		// Jeder Menüeintrag bekommt die Id und Parameter.
		$('.or-workbench-title .or-filtered .or-link').attr('data-id', id);

		let url = View.createUrl('profile', 'available', id, {'queryaction': action}, true);

		// Die Inhalte des Zweiges laden.
		let response = await fetch(url);
		let data     = await response.json();

		for (let method of Object.values(data.output.views))
			$('.or-workbench-title .or-filtered > .or-link[data-method=\'' + method + '\']')
				.parent()
				.addClass('dropdown-entry--active')
				.removeClass('dropdown-entry--inactive');
	}




	initializeStartupNotices() {

		// Initial Notices
		$('.or-act-initial-notice').each( function() {

			let notice = new Notice();
			notice.setStatus('info');
			notice.msg = $(this).text();
			notice.show();

			//$(this).remove();
		});
	}


	initializeKeystrokes() {

		let keyPressedHandler = (event) => {

			if (event.key === 'F4') {

				let dialog = new Dialog();
				dialog.start('', '', 'prop', 0, {});
			}

			if (event.key === 'F2') {

				if ($('.or-workbench').hasClass('workbench--navigation-is-small'))
					$('.or-act-nav-wide').click();
				else
					$('.or-act-nav-small').click();
			}
		};



		document.addEventListener('keydown',keyPressedHandler);

		/*
		$('.keystroke').each( function() {
			let keystrokeElement = $(this);
			let keystroke = keystrokeElement.text();
			if (keystroke.length == 0)
				return; // No Keybinding.
			let keyaction = function() {
				keystrokeElement.click();
			};
			// Keybinding ausfuehren.
			document.addEventListener( )).bind('keydown', keystroke, keyaction );
		} );*/
	}


	/**
	 * Registriert alle Events, die in der Workbench laufen sollen.
	 */
	initializeEvents() {

		let closeMenu = function() {
			// Mit der Maus irgendwo hin geklickt, das Menü muss schließen.
			$('body').click( function() {
				//$('.toolbar-icon.or-menu-category').parents('.or-menu').removeClass('menu--is-open');
				$('.or-menu').removeClass('menu--is-open');
			});
		};
		closeMenu();



		let closeMobileNavigation = function() {
			// Mobile navigation must close on a click on the workbench
			$('.or-act-navigation-close').click( function() {
				$('.or-workbench-navigation').removeClass('workbench-navigation--is-open');
				$('.or-workbench').removeClass('workbench--navigation-is-open');
			});
		};
		closeMobileNavigation();

		let closeDesktopNavigation = function() {

			// Handler for desktop navigation
			$('.or-workbench-title .or-act-nav-small').click(function () {
				$('.or-workbench').addClass('workbench--navigation-is-small');
				$('.or-workbench-navigation').addClass('workbench-navigation--is-small');
			});
		};
		closeDesktopNavigation();


		let registerGlobalSearch = function() {
			$('.or-search-input .or-input').orSearch( {
				onSearchActive: function() {
					$('.or-search').addClass('search--is-active');
				},
				onSearchInactive: function() {
					$('.or-search').removeClass('search--is-active');
				},
				dropdown    : '.or-act-search-result',
				resultEntryClass: 'or-search-result-entry',
				//openDropdown: true, // the dropdown is automatically opened by the menu.
				select      : function(obj) {
					// open the search result
					Workbench.getInstance().openNewAction( obj.name, obj.action, obj.id );
				},
				afterSelect: function() {
					//$('.or-dropdown.or-act-selector-search-results').empty();
				}
			} );
			$('.or-search .or-act-search-delete').click( function() {
				$('.or-search .or-title-input').val('').input();
			} );
		};
		registerGlobalSearch();


		Callback.afterNewActionHandler.add( function() {

				$('.or-sidebar').find('.or-sidebar-button').orLinkify();
			}
		);

		Callback.afterNewActionHandler.add( function() {

			let url = View.createUrl('tree','path',Workbench.state.id, {'type':Workbench.state.action} );

			// Die Inhalte des Zweiges laden.
			let loadPromise = fetch( url );

			/**
			 * open a object in the navigation tree.
			 * @param action
			 * @param id
			 */
			function openNavTree(action, id) {
				let $navControl = $('.or-link[data-action="'+action+'"][data-id="'+id+'"]').closest('.or-navtree-node');
				if   ( $navControl.is( '.or-navtree-node--is-closed' ) )
					$navControl.find('.or-navtree-node-control').click();
			}

			loadPromise
				.then( response => response.text() )
				.then( data => {

					$('.or-breadcrumb').empty().html( data ).find('.or-act-clickable').orLinkify();

					// Open the path in the navigator tree
					$('.or-breadcrumb a').each( function () {
						let action = $(this).data('action');
						let id     = $(this).data('id'    );

						openNavTree( action, id );
					});

					$('.or-link--is-active').removeClass('link--is-active');

					let action = Workbench.state.action;
					let id     = Workbench.state.id;
					if  (!id) id = '0';

					// Mark the links to the actual object
					$('.or-link[data-action=\''+action+'\'][data-id=\''+id+'\']').addClass('link--is-active');
					// Open actual object
					openNavTree( action,id );

				}).catch( cause => {
				// Ups... aber was können wir hier schon tun, außer hässliche Meldungen anzeigen.
				console.warn( {
					message : 'Failed to load path',
					url     : url,
					cause   : cause } );
			}).finally(function () {

			});
		} );


		Callback.afterViewLoadedHandler.add( function(element) {
			$(element).find('.or-button').orButton();
		} );

		Callback.afterViewLoadedHandler.add( function(element) {

			// Refresh already opened popup windows.
			if   ( Workbench.popupWindow )
				$(element).find("a[data-type='popup']").each( function() {
					Workbench.popupWindow.location.href = $(this).attr('data-url');
				});

		});


		Callback.afterViewLoadedHandler.add( function(element) {

			$(element).find(".or-input--password").dblclick( function() {
				$(this).toggleAttr('type','text','password');
			});

			$(element).find(".or-act-make-visible").click( function() {
				$(this).toggleClass('btn--is-active' );
				$(this).parent().children('input').toggleAttr('type','text','password');
			});
		});



		Callback.afterViewLoadedHandler.add( function($element) {

			$element.find('.or-act-load-nav-tree').each( async function() {

				let type = $(this).data('type') || 'root';
				let loadBranchUrl = View.createUrl('tree','branch',0,{type:type});
				let $targetElement = $(this);

				let response = await fetch( loadBranchUrl );
				let html     = await response.text();

				// Den neuen Unter-Zweig erzeugen.
				let $ul = $.create('ul' ).addClass('navtree-list');
				$ul.appendTo( $targetElement.empty() ).html( html );

				$ul.find('li').orTree( {
					'openAction': function( name,action,id) {
						Workbench.getInstance().openNewAction( name,action,id );
					}

				} ); // All subnodes are getting event listener for open/close

				// Die Navigationspunkte sind anklickbar, hier wird der Standardmechanismus benutzt.
				$ul.find('.or-act-clickable').orLinkify();

				// Open the first node.
				$ul.find('.or-navtree-node-control').first().click();

			} );

		} );




		/**
		 * Registriert alle Handler für den Inhalt einer View.
		 *
		 * @param viewEl DOM-Element der View
		 */
		Callback.afterViewLoadedHandler.add( function(viewEl ) {

			// Handler for mobile navigation
			$(viewEl).find('.or-act-nav-open-close').click( function() {
				$('.or-workbench').toggleClass('workbench--navigation-is-open');
				$('.or-workbench-navigation').toggleClass('workbench-navigation--is-open');
			});

			// Handler for desktop navigation
			$(viewEl).find('.or-act-nav-small').click( function() {
				$('.or-workbench').addClass('workbench--navigation-is-small');
				$('.or-workbench-navigation').addClass('workbench-navigation--is-small');
			});
			$(viewEl).find('.or-act-nav-wide').click( function() {
				$('.or-workbench').removeClass('workbench--navigation-is-small');
				$('.or-workbench-navigation').removeClass('workbench-navigation--is-small');
			});


			// Selectors (Einzel-Ausahl für Dateien) initialisieren
			// Wurzel des Baums laden
			$(viewEl).find('.or-act-selector-tree-button').click( function() {

				let $selector = $(this).parent('.or-selector');
				let $targetElement = $selector.find('.or-act-load-selector-tree');

				if   ( $selector.hasClass('selector--is-tree-active') ) {
					$selector.removeClass('selector--is-tree-active');
					$targetElement.empty();
				}
				else {
					$selector.addClass('selector--is-tree-active');

					var selectorEl = this;
					/*
					$(this).orTree( { type:'project',selectable:$(selectorEl).attr('data-types').split(','),id:$(selectorEl).attr('data-init-folderid'),onSelect:function(name,type,id) {

						var selector = $(selectorEl).parent();

						//console.log( 'Selected: '+name+" #"+id );
						$(selector).find('input[type=text]'  ).attr( 'value',name );
						$(selector).find('input[type=hidden]').attr( 'value',id   );
					} });
					*/

					let id   = $(this).data('init-folder-id');
					let type = id?'folder':'projects';
					let loadBranchUrl = './?action=tree&subaction=branch&id='+id+'&type='+type;

					let load = fetch( loadBranchUrl );
					load
						.then( response => response.text() )
						.then( html => {

							// Den neuen Unter-Zweig erzeugen.
							let $ul = $.create('ul' ).addClass('navtree-list');
							$ul.appendTo( $targetElement ).append( html );

							$ul.find('li').orTree(
								{
									'openAction' : function(name,action,id) {
										$selector.find('.or-selector-link-value').val(id  );
										$selector.find('.or-selector-link-name' ).val('').attr('placeholder',name);

										$selector.removeClass('selector--is-tree-active');
										$targetElement.empty();
									}
								}
							); // All subnodes are getting event listener for open/close

							// Die Navigationspunkte sind anklickbar, hier wird der Standardmechanismus benutzt.
							$ul.find('.or-act-clickable').orLinkify();

							// Open the first node.
							$ul.find('.or-navtree-node-control').first().click();
						} );
				}

			} );


			registerDragAndDrop(viewEl);


			// Theme-Auswahl mit Preview
			$(viewEl).find('.or-theme-chooser').change( function() {
				Workbench.getInstance().setUserStyle( this.value );
			});




			function registerMenuEvents($element )
			{
				// Mit der Maus geklicktes Menü aktivieren.
				$($element).find('.or-menu-category').click( function(event) {
					event.stopPropagation();
					$(this).closest('.or-menu').toggleClass('menu--is-open');
				});

				// Mit der Maus überstrichenes Menü aktivieren.
				$($element).find('.or-menu-category').mouseover( function() {

					// close other menus.
					$(this).closest('.or-menu').find('.or-menu-category').removeClass('menu-category--is-open');
					// open the mouse-overed menu.
					$(this).addClass('menu-category--is-open');
				});

			}


			function registerSelectorSearch( $element )
			{
				$($element).find('.or-act-selector-search').orSearch( {
					onSearchActive: function() {
						$(this).parent('or-selector').addClass('selector-search--is-active');
					},
					onSearchInactive: function() {
						$(this).parent('or-selector').removeClass('selector-search--is-active' );
					},

					dropdown: '.or-act-selector-search-results',
					resultEntryClass: 'or-search-result-entry',

					select: function(obj) {
						$($element).find('.or-selector-link-value').val(obj.id  );
						$($element).find('.or-selector-link-name' ).val(obj.name).attr('placeholder',obj.name);
					},

					afterSelect: function() {
						$('.or-dropdown.or-act-selector-search-results').empty();
					}
				} );
			}



			function registerTree(element) {

				// Klick-Funktionen zum Öffnen/Schließen des Zweiges.
				//$(element).find('.or-navtree-node').orTree();

			}


			registerMenuEvents    ( viewEl );
			//registerGlobalSearch  ( viewEl );
			registerSelectorSearch( viewEl );
			registerTree          ( viewEl );

			function registerDragAndDrop(viewEl)
			{

				Workbench.getInstance().registerDraggable(viewEl);
				Workbench.getInstance().registerDroppable(viewEl);
			}

			registerDragAndDrop(viewEl);


		} );
	};

}

