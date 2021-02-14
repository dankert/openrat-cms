
// Execute after DOM ready:
$( function() {
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
        Openrat.Navigator.navigateTo(ev.state);
    };

    Openrat.Workbench.initialize();
    Openrat.Workbench.reloadAll();

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
       Openrat.Workbench.notify('', 0, '', 'info', $(this).text());
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
			dropdown    : '.or-act-search-result',
			resultEntryClass: 'or-search-result-entry',
			//openDropdown: true, // the dropdown is automatically opened by the menu.
			select      : function(obj) {
				// open the search result
				Openrat.Workbench.openNewAction( obj.name, obj.action, obj.id );
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


	Openrat.Workbench.afterNewActionHandler.add( function() {

		$('.or-sidebar').find('.or-sidebar-button').orLinkify();
	  }
	);

    Openrat.Workbench.afterNewActionHandler.add( function() {

        let url = Openrat.View.createUrl('tree','path',Openrat.Workbench.state.id, {'type':Openrat.Workbench.state.action} );

        // Die Inhalte des Zweiges laden.
        let loadPromise = $.get(url);

        loadPromise.done( function(data) {

			$('.or-breadcrumb').empty().append( data ).find('.or-act-clickable').orLinkify();

			// Open the path in the navigator tree
			$('nav .or-navtree-node').removeClass('or-navtree-node--selected');

			$('.or-breadcrumb a').each( function () {
				let action = $(this).data('action');
				let id     = $(this).data('id'    );
                let $navControl = $('nav .or-navtree-node[data-type='+action+'][data-id='+id+'].or-navtree-node--is-closed .or-navtree-node-control');
                $navControl.click();
            });

        }).fail(function ( jqXHR, textStatus, errorThrown ) {
            // Ups... aber was können wir hier schon tun, außer hässliche Meldungen anzeigen.
            console.warn( {message:'Failed to load path',url:url,error:e,status:textStatus,errorThrown } );
        }).always(function () {

        });
    } );

	Openrat.Workbench.afterNewActionHandler.fire();
});




let filterMenus = function ()
{
    let action = Openrat.Workbench.state.action;
    let id     = Openrat.Workbench.state.id;
    $('.or-workbench-title .or-dropdown-entry.or-act-clickable').addClass('dropdown-entry--active');
    $('.or-workbench-title .or-dropdown-entry.or-act-clickable.or-filtered').removeClass('dropdown-entry--active').addClass('dropdown-entry--inactive');
	// Jeder Menüeintrag bekommt die Id und Parameter.
	$('.or-workbench-title .or-dropdown-entry.or-act-clickable.or-filtered .or-link').attr('data-id'    ,id    );

	let url = Openrat.View.createUrl('profile','available',id, {'queryaction':action},true );

	// Die Inhalte des Zweiges laden.
	let promise = $.getJSON(url);

	promise.done( function (data) {

		jQuery.each(data.output.views, function(i, method) {
			$('.or-workbench-title .or-dropdown-entry.or-act-clickable.or-filtered > .or-link[data-method=\'' + method + '\']' ).parent()
				.addClass('dropdown-entry--active').removeClass('dropdown-entry--inactive');
		});
	});


}


Openrat.Workbench.afterAllViewsLoaded.add( function() {
    filterMenus();
} );






Openrat.Workbench.afterViewLoadedHandler.add( function(element) {

    // Refresh already opened popup windows.
    if   ( Openrat.Workbench.popupWindow )
        $(element).find("a[data-type='popup']").each( function() {
			Openrat.Workbench.popupWindow.location.href = $(this).attr('data-url');
        });

});


Openrat.Workbench.afterViewLoadedHandler.add( function(element) {

        $(element).find(".or-input--password").dblclick( function() {
			$(this).toggleAttr('type','text','password');
        });

        $(element).find(".or-act-make-visible").click( function() {
			$(this).toggleClass('btn--is-active' );
			$(this).parent().children('input').toggleAttr('type','text','password');
        });
});



Openrat.Workbench.afterViewLoadedHandler.add( function($element) {

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
					Openrat.Workbench.openNewAction( name,action,id );
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
Openrat.Workbench.afterViewLoadedHandler.add( function(viewEl ) {

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
	$(viewEl).find('.or-act-load-selector-tree').each( function() {
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
		let $targetElement = $(this);

		$.get(loadBranchUrl).done( function (html) {

			// Den neuen Unter-Zweig erzeugen.
			let $ul = $('<ul class="or-navtree-list" />');
			$ul.appendTo( $targetElement.empty() ).append( html );

			$ul.find('li').orTree(
				{
					'openAction' : function(name,action,id) {
						viewEl.find('.or-selector-link-value').val(id  );
						viewEl.find('.or-selector-link-name' ).val('').attr('placeholder',name);
					}
				}
			); // All subnodes are getting event listener for open/close

			// Die Navigationspunkte sind anklickbar, hier wird der Standardmechanismus benutzt.
			$ul.find('.or-act-clickable').orLinkify();

			// Open the first node.
			$ul.find('.or-navtree-node-control').first().click();
		} );

	} );


	registerDragAndDrop(viewEl);
	
	
	// Bei Änderungen in der View das Tab als 'dirty' markieren
	$(viewEl).find('.or-input').change( function() {
		$(this).closest('.or-view').addClass('view--is-dirty');
	});

	// Theme-Auswahl mit Preview
    $(viewEl).find('.or-theme-chooser').change( function() {
        Openrat.Workbench.setUserStyle( this.value );
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
        $($element).find('.or-selector .or-selector-link-name').orSearch( {
            dropdown: '.or-dropdown.or-act-selector-search-results',
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

		Openrat.Workbench.registerDraggable(viewEl);
		Openrat.Workbench.registerDroppable(viewEl);
    }

    registerDragAndDrop(viewEl);


} );

