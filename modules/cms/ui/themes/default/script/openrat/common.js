
// Execute after DOM ready:
document.addEventListener("DOMContentLoaded", event => {
    // JS is available.
    $('html').removeClass('nojs');

    /* Fade in all elements. */
    $('.or--initial-hidden').removeClass('-initial-hidden');


    /**
     * Registriert alle Events, die in der Workbench laufen sollen.
     */
    function registerWorkbenchEvents()
    {

    }


    registerWorkbenchEvents();


    // Listening to the "popstate" event:
    window.onpopstate = function (ev) {
        Openrat.navigator.navigateTo(ev.state);
    };

    Openrat.workbench.initialize();
    Openrat.workbench.reloadAll();

    let registerWorkbenchGlobalEvents = function() {

        // Binding aller Sondertasten.
        $('.keystroke').each( function() {
            let keystrokeElement = $(this);
            let keystroke = keystrokeElement.text();
            if (keystroke.length == 0)
                return; // No Keybinding.
            let keyaction = function() {
                keystrokeElement.click();
            };
            // Keybinding ausfuehren.
            $(document).bind('keydown', keystroke, keyaction );
        } );

    }

    // Initial Notices
    $('.or-act-initial-notice').each( function() {

       let notice = new Notice();
       notice.setStatus('info');
       notice.msg = $(this).text();
       notice.show();

       $(this).remove();
    });

    registerWorkbenchGlobalEvents();


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
				Workbench.openNewAction( obj.name, obj.action, obj.id );
			},
			afterSelect: function() {
				//$('.or-dropdown.or-act-selector-search-results').empty();
			}
		} );
		$('.or-search .or-act-search-delete').click( function() {
			$('.or-search .or-title-input').val('').change();
		} );
	};
	registerGlobalSearch();


	Workbench.afterNewActionHandler.add( function() {

		$('.or-sidebar').find('.or-sidebar-button').orLinkify();
	  }
	);

    Workbench.afterNewActionHandler.add( function() {

        let url = View.createUrl('tree','path',Workbench.state.id, {'type':Workbench.state.action} );

        // Die Inhalte des Zweiges laden.
        let loadPromise = $.get(url);

		/**
		 * open a object in the navigation tree.
		 * @param action
		 * @param id
		 */
		function openNavTree(action, id) {
			let $navControl = $('.or-link[data-action='+action+'][data-id='+id+']').closest('.or-navtree-node');
			if   ( $navControl.is( '.or-navtree-node--is-closed' ) )
				$navControl.find('.or-navtree-node-control').click();
		}

		loadPromise.done( function(data) {

			$('.or-breadcrumb').empty().append( data ).find('.or-act-clickable').orLinkify();

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

		}).fail(function ( jqXHR, textStatus, errorThrown ) {
            // Ups... aber was können wir hier schon tun, außer hässliche Meldungen anzeigen.
            console.warn( {
				message:'Failed to load path',
				url    :url,
				jqXHR  :jqXHR,
				status :textStatus,
				error  :errorThrown } );
        }).always(function () {

        });
    } );

	Workbench.afterNewActionHandler.fire();
});




let filterMenus = function ()
{
    let action = Workbench.state.action;
    let id     = Workbench.state.id;
    $('.or-workbench-title .or-dropdown-entry.or-act-clickable').addClass('dropdown-entry--active');
    $('.or-workbench-title .or-filtered').removeClass('dropdown-entry--active').addClass('dropdown-entry--inactive');
	// Jeder Menüeintrag bekommt die Id und Parameter.
	$('.or-workbench-title .or-filtered .or-link').attr('data-id'    ,id    );

	let url = View.createUrl('profile','available',id, {'queryaction':action},true );

	// Die Inhalte des Zweiges laden.
	let promise = $.getJSON(url);

	promise.done( function (data) {

		jQuery.each(data.output.views, function(i, method) {
			$('.or-workbench-title .or-filtered > .or-link[data-method=\'' + method + '\']' ).parent()
				.addClass('dropdown-entry--active').removeClass('dropdown-entry--inactive');
		});
	});


}


Workbench.afterAllViewsLoaded.add( function() {
    filterMenus();
} );

Workbench.afterAllViewsLoaded.add( function() {
	$('body').removeClass('loader');
} );




Workbench.afterViewLoadedHandler.add( function(element) {
	$(element).find('.or-button').orButton();
} );

Workbench.afterViewLoadedHandler.add( function(element) {

    // Refresh already opened popup windows.
    if   ( Workbench.popupWindow )
        $(element).find("a[data-type='popup']").each( function() {
			Workbench.popupWindow.location.href = $(this).attr('data-url');
        });

});


Workbench.afterViewLoadedHandler.add( function(element) {

        $(element).find(".or-input--password").dblclick( function() {
			$(this).toggleAttr('type','text','password');
        });

        $(element).find(".or-act-make-visible").click( function() {
			$(this).toggleClass('btn--is-active' );
			$(this).parent().children('input').toggleAttr('type','text','password');
        });
});



Workbench.afterViewLoadedHandler.add( function($element) {

	$element.find('.or-act-load-nav-tree').each( function() {

		let type = $(this).data('type') || 'root';
		let loadBranchUrl = './?action=tree&subaction=branch&id=0&type='+type;
		let $targetElement = $(this);

		$.get(loadBranchUrl).done( function (html) {

			// Den neuen Unter-Zweig erzeugen.
			let $ul = $('<ul class="or-navtree-list" />');
			$ul.appendTo( $targetElement.empty() ).append( html );

			$ul.find('li').orTree( {
				'openAction': function( name,action,id) {
					Openrat.workbench.openNewAction( name,action,id );
				}

			} ); // All subnodes are getting event listener for open/close

			// Die Navigationspunkte sind anklickbar, hier wird der Standardmechanismus benutzt.
			$ul.find('.or-act-clickable').orLinkify();

			// Open the first node.
			$ul.find('.or-navtree-node-control').first().click();
		} );

	} );

} );




/**
 * Registriert alle Handler für den Inhalt einer View.
 *
 * @param viewEl DOM-Element der View
 */
Workbench.afterViewLoadedHandler.add( function(viewEl ) {

    // Die Section deaktivieren, wenn die View keinen Inhalt hat.
    var section = $(viewEl).closest('section');

    //var viewHasContent = $(viewEl).children().length > 0;
	//section.toggleClass('disabled',!viewHasContent);
	section.toggleClass('is-empty',$(viewEl).is(':empty'));
	if   ( ! $(viewEl).is(':empty') )
		section.slideDown('fast');
	else
		section.slideUp('fast');

	// Untermenüpunkte aus der View in das Fenstermenü kopieren...
	//$(viewEl).closest('div.panel').find('div.header div.dropdown div.entry.perview').remove(); // Alte Einträge löschen

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

			$.get(loadBranchUrl).done( function (html) {

				// Den neuen Unter-Zweig erzeugen.
				let $ul = $('<ul class="or-navtree-list" />');
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
		Openrat.workbench.setUserStyle( this.value );
    });




    function registerMenuEvents($element )
    {
        // Mit der Maus geklicktes Menü aktivieren.
        $($element).find('.or-menu-category').click( function(event) {
            event.stopPropagation();
            $(this).parents('.or-menu').toggleClass('menu--is-open');
        });

        // Mit der Maus überstrichenes Menü aktivieren.
        $($element).find('.or-menu-category').mouseover( function() {

            // close other menus.
            $(this).parents('.or-menu').find('.or-menu-category').removeClass('menu-category--is-open');
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

		Openrat.workbench.registerDraggable(viewEl);
		Openrat.workbench.registerDroppable(viewEl);
    }

    registerDragAndDrop(viewEl);


} );

