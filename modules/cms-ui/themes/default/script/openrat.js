
var OR_THEMES_EXT_DIR = 'modules/cms-ui/themes/';

// Execute after DOM ready:
$( function() {
    // JS is available.
    $('html').removeClass('nojs');

    /* Fade in all elements. */
    $('.initial-hidden').removeClass('initial-hidden');

    registerWorkbenchEvents();


    // Listening to the "popstate" event:
    window.onpopstate = function (ev) {
        Navigator.navigateTo(ev.state);
    };

    initActualHistoryState();

    Workbench.initialize();
    Workbench.reloadAll();

    registerNavigation();

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



    // Per Klick wird die Notice entfernt.
    $('#noticebar .notice .image-icon--menu-close').click(function () {
        $(this).closest('.notice').fadeOut('fast', function () {
            $(this).remove();
        });
    });
    // Die Notices verschwinden automatisch.
    $('#noticebar .notice').each(function () {
    	let noticeToClose = this;
		setTimeout( function() {
			$(noticeToClose).fadeOut('slow', function() { $(this).remove(); } );
		},30/*seconds*/ *1000 );

    });


    registerOpenClose($('section.toggle-open-close'));

    $('section.toggle-open-close .on-click-open-close').click(function () {
        var section = $(this).closest('section');

        // disabled sections are ignored.
        if (section.hasClass('disabled'))
            return;

        // if view is empty, lets load the content.
        var view = section.find('div.view-loader');
        if (view.children().length == 0)
            Workbench.loadNewActionIntoElement(view);
    });
});


function initActualHistoryState() {
	var state = {};
	state.name   = window.document.title;

	var params = new URLSearchParams( window.location.search );

    if (params.has('action')){

        state.action = params.get('action');
        state.id     = params.get('id'    );
        state.name   = window.document.title;

        state.data   = {};

        //Iterate the search parameters.

        var params = Array.from( params.entries() );
		for( var entry in params ) {
            state.data[params[entry][0]] = params[entry][1];
        };

        Navigator.toActualHistory( state );

    }
}


function registerNavigation() {
    $(document).on('orNewAction',function(event, data) {

        let url = './api/?action=tree&subaction=path&id=' + Workbench.state.id + '&type=' + Workbench.state.action + '&output=json';

        // Die Inhalte des Zweiges laden.
        $.getJSON(url, function (json) {

            $('nav .or-navtree-node').removeClass('or-navtree-node--selected');

            let output = json['output'];
            $.each(output.path, function (idx, path) {

                $nav = $('nav .or-navtree-node[data-type='+path.type+'][data-id='+path.id+'].or-navtree-node--is-closed .or-navtree-node-control');
                $nav.click();
            });
            if   ( output.actual )
                $('nav .or-navtree-node[data-type='+output.actual.type+'][data-id='+output.actual.id+']').addClass('or-navtree-node--selected');

        }).fail(function (e) {
            // Ups... aber was können wir hier schon tun, außer hässliche Meldungen anzeigen.
            console.warn(e);
            console.warn('failed to load path from '+url);
        }).always(function () {

        });
    });
}


/**
 * Navigation.
 */
var Navigator = new function () {
	'use strict';

	/**
	 * Navigiert zu einer Action, aber ohne ein neues History-Element einzufügen.
	 */
	this.navigateTo = function(state) {
		Workbench.loadNewActionState(state);
	}


    /**
	 *
     * Navigiert zu einer neue Action und fügt einen neuen History-Eintrag hinzu.
     */
	this.navigateToNew = function(obj) {

		Workbench.loadNewActionState(obj);
		window.history.pushState(obj,obj.name,'./#/'+obj.action+(obj.id?'/'+obj.id:'') );
    }

    this.navigateToNewAction = function(action, method, id, params ) {
        var state = {action:action,method:method,id:id.replace(/[^0-9_]/gim,""),data:params};
        this.navigateToNew(state);
	}

    /**
	 * Setzt den State für den aktuellen History-Eintrag.
     * @param obj
     */
    this.toActualHistory = function(obj) {
        window.history.replaceState(obj,obj.name,createUrl(obj.action,null,obj.id,obj.data,false) );
    }
}


var Workbench = new function()
{
    'use strict'; // Strict mode


    /**
	 * Initializes the Workbench.
     */
	this.initialize = function() {

		// Initialze Ping timer.
		this.initializePingTimer();
        this.initializeState();
        this.initializeMenues();
        this.openModalDialog();
    }


    /**
     * Starts a dialog, if necessary.
     */
    this.openModalDialog = function () {

        if   ( $('#dialog').data('action') ) {
            startDialog('',$('#dialog').data('action'),$('#dialog').data('action'),0,{})
        }
    }


    this.initializeMenues = function () {

        filterMenus();
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

        Workbench.state = state;

        // TODO: Remove this sometimes.... only state.
        $('#editor').attr('data-action',state.action);
        $('#editor').attr('data-id'    ,state.id    );
        $('#editor').attr('data-extra' ,'{}'  );

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
        var ping = function()
        {
            $.ajax( createUrl('title','ping',0) );
            //window.console && console.log("session-ping");
        }

        // Alle 5 Minuten pingen.
		var timeoutMinutes = 5;

        window.setInterval( ping, timeoutMinutes*60*1000 );
    }



    this.loadNewActionState = function(state) {

	    Workbench.state = state;
		Workbench.loadNewAction(state.action,state.id,state.data);


        filterMenus();

        $(document).trigger('orNewAction');
	}

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

        Workbench.loadViews( $('#workbench section.open .view-loader') );
    }


    this.reloadAll = function() {

    	// View in geschlossenen Sektionen löschen, damit diese nicht stehen bleiben.
        $('#workbench .view').empty();

        Workbench.loadViews( $('#workbench .view') );
    }



    this.loadViews = function( $views )
    {

        $views.each(function (idx) {

            let $targetDOMElement = $(this);

            Workbench.loadNewActionIntoElement( $targetDOMElement )
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

        let view = new View( action,method,id,params );
        view.start( $viewElement );
    }


}




/**
 * Registriert alle Events, die in der Workbench laufen sollen.
 */
function registerWorkbenchEvents()
{
	// Modalen Dialog erzeugen.

	/*
	if	( $('#workbench div.panel.modal').length > 0 )
	{
		$('#workbench div.panel.modal').parent().addClass('modal');
		$('div#filler').fadeTo(500,0.5);
		$('#workbench').addClass('modal');
	}
	*/
	
	
	$('div.header').dblclick( function()
	{
		fullscreen( this );
	} );
}


/**
 * Laden einer View.
 *
 * @param contentEl
 * @param action
 * @param method
 * @param id
 * @param params
 */
function loadView(contentEl,action,method,id,params  )
{
	Navigator.navigateToNewAction( action,method,id,params );
}



/**
 * Registriert alle Handler für den Inhalt einer View.
 *
 * @param viewEl DOM-Element der View
 */
function afterViewLoaded(viewEl )
{

	// Die Section deaktivieren, wenn die View keinen Inhalt hat.
    var section = $(viewEl).closest('section');

    //var viewHasContent = $(viewEl).children().length > 0;
	//section.toggleClass('disabled',!viewHasContent);
	section.toggleClass('is-empty',$(viewEl).is(':empty'));

    $(viewEl).trigger('orViewLoaded');

	// Untermenüpunkte aus der View in das Fenstermenü kopieren...
	$(viewEl).closest('div.panel').find('div.header div.dropdown div.entry.perview').remove(); // Alte Einträge löschen

	$(viewEl).find('.toggle-nav-open-close').click( function() {
		$('nav').toggleClass('open');
	});

	$(viewEl).find('.toggle-nav-small').click( function() {
		$('nav').toggleClass('small');
	});

	$(viewEl).find('div.headermenu > a').each( function(idx,el)
	{
		// Jeden Untermenüpunkt zum Fenstermenü hinzufügen.
		
		// Nein, Untermenüs erscheinen jetzt in der View selbst.
		// $(el).wrap('<div class="entry clickable modal perview" />').parent().appendTo( $(viewEl).closest('div.panel').find('div.header div.dropdown').first() );
	} );
	
	$(viewEl).find('div.header > a.back').each( function(idx,el)
	{
		// Zurück-Knopf zum Fenstermenü hinzufügen.
		$(el).removeClass('button').wrap('<div class="entry perview" />').parent().appendTo( $(viewEl).closest('div.panel').find('div.header div.dropdown').first() );
	} );
	//$(viewEl).find('div.header').html('<!-- moved to window-menu -->');
	
//	$(viewEl).find('input,select,textarea').focus( function() {
//		$(this).closest('div.panel').find('div.command').css('visibility','visible').fadeIn('slow');
//	});


	// Selectors (Einzel-Ausahl für Dateien) initialisieren
	// Wurzel des Baums laden
	$(viewEl).find('div.selector.tree').each( function() {
		var selectorEl = this;
		$(this).orTree( { type:'project',selectable:$(selectorEl).attr('data-types').split(','),id:$(selectorEl).attr('data-init-folderid'),onSelect:function(name,type,id) {
		
			var selector = $(selectorEl).parent();
			
			//console.log( 'Selected: '+name+" #"+id );
			$(selector).find('input[type=text]'  ).attr( 'value',name );
			$(selector).find('input[type=hidden]').attr( 'value',id   );
		} });
	} );
	

	registerDragAndDrop(viewEl);
	
	
	// Bei Änderungen in der View das Tab als 'dirty' markieren
	$(viewEl).find('input').change( function() {
		$(this).parent('div.view').addClass('dirty');
	});

	// Theme-Auswahl mit Preview
    $(viewEl).find('.or-theme-chooser').change( function() {
        setUserStyle( this.value );
    });

}



function registerDragAndDrop(viewEl)
{

    registerDraggable(viewEl);
    registerDroppable(viewEl);
}




function registerDraggable(viewEl) {

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

function registerTreeBranchEvents(viewEl)
{
    registerDraggable(viewEl);
}


function registerDroppable(viewEl) {

    /*
    $(viewEl).find('div.header > a.back').each( function(idx,el) {
        $('div.content li.object > .entry[data-type=\'folder\']').droppable({
            accept: 'li.object', hoverClass: 'drophover', activeClass: 'dropactive', drop: function (event, ui) {
                let dropped = ui.draggable;
                let droppedOn = $(this).parent();

                //alert('Moving '+$(dropped).attr('data-id')+' to folder '+$(droppedOn).attr('data-id') );
                startDialog($(this).text(), $(dropped).attr('data-type'), 'copy', $(droppedOn).attr('data-id'), {
                    'action': $(dropped).attr('data-type'),
                    'subaction': 'copy',
                    'id': $(dropped).attr('data-id'),
                    'targetFolderId': $(droppedOn).attr('data-id')
                });
                //$(dropped).css({top: 0,left: 0}); // Nicht auf das eigene Fenster fallen lassen.
                $(dropped).detach().css({top: 0, left: 0}).appendTo(droppedOn).click();
            }
        });
    }
*/

    $(viewEl).find('.or-droppable').droppable({
        accept: '.or-draggable',
        hoverClass: 'or-droppable--hover',
        activeClass: 'or-droppable--active',

        drop: function (event, ui) {

            let dropped = ui.draggable;

            $(this).find('.or-selector-link-value').val( dropped.data('id') );
            $(this).find('.or-selector-link-name' ).val( dropped.data('id') );
            // Id übertragen
            //$(this).value(dropped.data('id'));
        }
    });
}



function registerMenuEvents($element )
{
    //$e = $($element);

    // Mit der Maus irgendwo hin geklickt, das Menü muss schließen.
    $('body').click( function() {
        $('.toolbar-icon.menu').parents('.or-menu').removeClass('open');
    });
    // Mit der Maus geklicktes Menü aktivieren.
    $($element).find('.toolbar-icon.menu').click( function(event) {
        event.stopPropagation();
        $(this).parents('.or-menu').toggleClass('open');
    });

    // Mit der Maus überstrichenes Menü aktivieren.
    $($element).find('.toolbar-icon.menu').mouseover( function() {

        // close other menus.
        $(this).parents('.or-menu').find('.toolbar-icon.menu').removeClass('open');
        // open the mouse-overed menu.
        $(this).addClass('open');
    });

}

function registerSearch($element )
{
    //$e = $($element);
	$($element).find('.search input').orSearch( { dropdown:'#title div.search div.dropdown' } );

}



function registerTree(element) {

    // Klick-Funktionen zum Öffnen/Schließen des Zweiges.
    $(element).find('.or-navtree-node').orTree();

}



/**
 * Schaltet die Vollbildfunktion an oder aus.
 * 
 * @param element Das Element, auf dem die Vollbildfunktion ausgeführt wurde
 */
function fullscreen( element ) {
	$(element).closest('div.panel').fadeOut('fast', function()
	{
		$(this).toggleClass('fullscreen').fadeIn('fast');
	} );
}




/**
 * Setzt neue View und aktualisiert alle Fenster.
 * @param element
 * @param action Action
 * @param id Id
 * @deprecated
 */

function submitUrl( element,url )
{
	postUrl( url,element );
	
	// Alle refresh-fähigen Views mit dem neuen Objekt laden.
	//refreshAllRefreshables();
}


/**
 * @deprecated

 * @param url
 * @param element
 */
function postUrl(url,element)
{
	url += '&output=json';
	$.ajax( { 'type':'POST',url:url, data:{}, success:function(data, textStatus, jqXHR)
		{
			$('div.panel div.status div.loader').html('&nbsp;');
			doResponse(data,textStatus,element);
		} } );

}


/**
 * Form.
 *
 * @constructor
 */
function Form() {

    this.setLoadStatus = function( isLoading ) {
        $(this.element).closest('div.content').toggleClass('loader',isLoading);
    }

    this.initOnElement = function( element ) {
        this.element = element;

        let form = this;

        // Autosave in Formularen.
        // Bei Veränderungen von Checkboxen wird das Formular sofort abgeschickt.
        $(element).find('form[data-autosave="true"] input[type="checkbox"]').click( function() {
            form.submit();
        });

        // After click to "OK" the form is submitted.
        // Why this?? input type=submit will submit!
        /*
        $(event.target).find('input.submit.ok').click( function() {
            $(this).closest('form').submit();
        });
        */

        $(element).find('.or-form-btn--cancel').click( function() {
            form.cancel();

        });
        $(element).find('.or-form-btn--reset').click( function() {
            form.rollback();

        });

        // Submithandler for the whole form.
        $(element).submit( function( event ) {

            //
            if   ($(this).data('target')=='view')
            {
                form.submit();
                event.preventDefault();
            }
            // target=top will load the native way without javascript.
        });
    }

    this.cancel = function() {
        //$(this.element).html('').parent().removeClass('is-open');
        this.close();
    }


    this.rollback = function() {
        this.element.trigger('reset');
    }

    this.close = function() {

    }

    this.submit = function() {


        // Show progress
        let status = $('<div class="notice info"><div class="text loader"></div></div>');
        $('#noticebar').prepend(status); // Notice anhängen.
        $(status).show();

        // Alle vorhandenen Error-Marker entfernen.
        // Falls wieder ein Fehler auftritt, werden diese erneut gesetzt.
        $(this.element).find('.error').removeClass('error');

        var params = $(this.element).serializeArray();
        var data = {};
        $(params).each(function(index, obj){
            data[obj.name] = obj.value;
        });

        // If form does not contain action/id, get it from the workbench.
        if   (!data.id)
            data.id = Workbench.state.id;
        if   (!data.action)
            data.action = Workbench.state.action;

        let formMethod = $(this.element).attr('method').toUpperCase();

        if	( formMethod == 'GET' )
        {
            // Mehrseitiges Formular
            // Die eingegebenen Formulardaten werden zur nächsten Action geschickt.
            //Workbench.loadViewIntoElement( $(form).parent('.view'),data.action, data.subaction,data.id,data );
            this.forwardTo( data.action, data.subaction,data.id,data );
        }
        else
        {
            let url    = './api/'; // Alle Parameter befinden sich im Formular

            // POST-Request
            this.setLoadStatus(true);
            //url += '?output=json';
            url += '';
            //params['output'] = 'json';// Irgendwie geht das nicht.
            data.output = 'json';

            if	( $(this.element).data('async') || $(this.element).data('async')=='true')
            {
                // Verarbeitung erfolgt asynchron, das heißt, dass der evtl. geöffnete Dialog
                // beendet wird.
                this.close();
                // Async: Window is closed, but the action will be startet now.
            }

            let form = this;
            $.ajax( { 'type':'POST',url:url, data:data, success:function(data, textStatus, jqXHR)
                {
                    form.setLoadStatus(false);
                    $(status).remove();

                    doResponse(data,textStatus,form.element);
                },
                error:function(jqXHR, textStatus, errorThrown) {
                    form.setLoadStatus(false);
                    $(status).remove();

                    try
                    {
                        let error = jQuery.parseJSON( jqXHR.responseText );
                        notify('','','error',error.error,[error.description]);
                    }
                    catch( e )
                    {
                        let msg = jqXHR.responseText;
                        notify('','','error','Server Error',[msg]);
                    }


                }

            } );
            $(form.element).fadeIn();
        }

    }
}



/**
 * View.
 * Eine View ist ein HTML-Fragment, in das eine Action geladen wird.
 * Das Erzeugen der View, das Laden vom Server sowie das Schließen sind hier gekapselt.
 *
 * @param action
 * @param method
 * @param id
 * @param params
 * @constructor
 */
function View( action,method,id,params ) {

    this.action = action;
    this.method = method;
    this.id = id;
    this.params = params;

    this.before = function() {};

    this.start = function( element ) {
        this.before();
        this.element = element;
        this.loadView();
    }

    this.afterLoad = function() {

    }

    this.close = function() {
    }


    function registerViewEvents(element) {

        registerMenuEvents( element );
        registerSearch    ( element );
        registerTree      ( element );
        afterViewLoaded   ( element );

    }


    this.loadView = function() {

        let url = createUrl( this.action,this.method,this.id,this.params,true); // URL für das Laden erzeugen.
        let element = this.element;
        let view = this;

        $(this.element).empty().fadeTo(1,0.7).addClass('loader').html('').load(url,function(response, status, xhr) {

            $(element).fadeTo(350,1);

            $(element).removeClass("loader");

            $(element).find('form').each( function() {
                let form = new Form();
                form.close = function() {
                    view.close();
                }
                form.initOnElement(this);

            });
            if	( status == "error" )
            {
                // Seite nicht gefunden.
                $(element).html("");

                notify('','','error','Server Error',['Server Error while requesting url '+url, response]);
                return;
            }

            registerViewEvents( element );

        });

    }

}


/**
 * Setzt neuen modalen Dialog und aktualisiert alle Fenster.
 * @param name
 * @param action Action
 * @param method
 * @param id Id
 * @param params
 */
function startDialog( name,action,method,id,params )
{
	// Attribute aus dem aktuellen Editor holen, falls die Daten beim Aufrufer nicht angegeben sind.
	if (!action)
		action = $('#editor').attr('data-action');

    if  (!id)
        id = $('#editor').attr('data-id');

	let view = new View( action,method,id,params );

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

        $('#dialog .view').fadeOut('fast').html('');
        $('#dialog').removeClass('is-open').addClass('is-closed'); // Dialog schließen

        $(document).unbind('keyup',this.escapeKeyClosingHandler); // Cleanup ESC-Key-Listener
    }

	view.start( $('div#dialog > .view') );
}


/**
 * Starts a non-modal editing dialog.
 * @param name
 * @param action
 * @param method
 * @param id
 * @param params
 */
function startEdit( name,action,method,id,params )
{
	// Attribute aus dem aktuellen Editor holen, falls die Daten beim Aufrufer nicht angegeben sind.
	if (!action)
		action = Workbench.state.action;

	if  (!id)
        id = Workbench.state.id;

    let view = new View( action,method,id,params );

    view.before = function() {

        let view = this;

        $edit = $('#edit');
        $edit.addClass('is-open');

        $('#editor').addClass('is-closed');

        // Dialog durch Klick auf freie Fläche schließen.
        $('#edit .filler').click( function()
        {
            view.close();
        });

    };

    view.close = function() {
        $edit.removeClass('is-open');
        $('#editor').removeClass('is-closed');
    }

	view.start( $('#edit > .view') );
}


/**
 * Setzt einen Fenster-Titel für die ganze Anwendung. 
 */
function setTitle( title )
{
	if	( title )
		$('head > title').text( title + ' - ' + $('head > title').data('default') );
	else
		$('head > title').text( $('head > title').data('default') );
}

/**
 * Setzt neue Action und aktualisiert alle Fenster.
 * 
 * @param action Action
 * @param id Id
 */
function openNewAction( name,action,id,extraId )
{
	// Im Mobilmodus soll das Menü verschwinden, wenn eine neue Action geoeffnet wird.
    $('nav').removeClass('open');

    setTitle( name ); // Title setzen.
	
	setNewAction( action,id,extraId );
}


function filterMenus()
{
    let action = Workbench.state.action;
    let id     = Workbench.state.id;
    $('div.clickable').addClass('active');
    $('div.clickable.filtered').removeClass('active').addClass('inactive');

	$('div.clickable.filtered.on-action-'+action).addClass('active').removeClass('inactive');

    // Jeder Menüeintrag bekommt die Id und Parameter.
    $('div.clickable.filtered a').attr('data-id'    ,id    );
    /*
        $('div.clickable.filtered a').attr('data-action',action);
    */

}



/**
 * Setzt neue Action und aktualisiert alle Fenster.
 * 
 * @param action Action
 * @param id Id
 */
function setNewAction( action,id,extraId )
{
	Navigator.navigateToNewAction(action,'edit',id,extraId);
	// Alle refresh-fähigen Views mit dem neuen Objekt laden.
	//refreshAllRefreshables();
}


/**
 * Setzt neue Id und aktualisiert alle Fenster.
 * @param id Id
 */
function setNewId( id ) {
}





/**
 * Notification im Browser anzeigen.
 * Quelle: https://developer.mozilla.org/en-US/docs/Web/API/notification
 * @param text Text der Nachricht.
 */
function notifyBrowser(text)
{
	  // Let's check if the browser supports notifications
	  if (!("Notification" in window)) {
		return;
	    //alert("This browser does not support desktop notification");
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
 * Setzt einen neuen Theme.
 * @param styleName
 * @returns
 */
function setUserStyle( styleName )
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




//Quelle:
//http://aktuell.de.selfhtml.org/tippstricks/javascript/bbcode/
function insert(tagName, aTag, eTag)
{
var input = document.forms[0].elements[tagName];
input.focus();
/* IE */
if(typeof document.selection != 'undefined') {
 /* Einfuegen des Formatierungscodes */
// alert('IE');
 var range = document.selection.createRange();
 var insText = range.text;
 range.text = aTag + insText + eTag;
 /* Anpassen der Cursorposition */
 range = document.selection.createRange();
 if (insText.length == 0) {
   range.move('character', -eTag.length);
 } else {
   range.moveStart('character', aTag.length + insText.length + eTag.length);      
 }
 range.select();
}
/* Gecko */
else if(typeof input.selectionStart != 'undefined')
{
// alert('Gecko');
 /* Einfuegen des Formatierungscodes */
 var start = input.selectionStart;
 var end = input.selectionEnd;
 var insText = input.value.substring(start, end);
 input.value = input.value.substr(0, start) + aTag + insText + eTag + input.value.substr(end);
 /* Anpassen der Cursorposition */
 var pos;
 if (insText.length == 0) {
   pos = start + aTag.length;
 } else {
   pos = start + aTag.length + insText.length + eTag.length;
 }
 input.selectionStart = pos;
 input.selectionEnd = pos;
}
/* uebrige Browser */
else
{
 /* Abfrage der Einfuegeposition */
 
 /*
 var pos;
 var re = new RegExp('^[0-9]{0,3}$');
 while(!re.test(pos)) {
   pos = prompt("Position (0.." + input.value.length + "):", "0");
 }
 if(pos > input.value.length) {
   pos = input.value.length;
 }
	*/
 pos = input.value.length;
 
 /* Einfuegen des Formatierungscodes */
 var insText = prompt("Text");
 input.value = input.value.substr(0, pos) + aTag + insText + eTag + input.value.substr(pos);
}
}




/**
 * Erzeugt eine URL, um die gewünschte Action vom Server zu laden.
 * 
 * @param action
 * @param subaction
 * @param id
 * @param extraid
 * @returns URL
 */
function createUrl(action,subaction,id,extraid,embed)
{
	var url = './';

	url += '?';

    if(action)
    	url += '&action='+action;
    if(subaction)
    	url += '&subaction='+subaction;
    if(id)
    	url += '&id='+id;

	if	( typeof extraid === 'string')
	{
		extraid = extraid.replace(/'/g,'"'); // Replace ' with ".
		var extraObject = jQuery.parseJSON(extraid);
		jQuery.each(extraObject, function(name, value) {
			url = url + '&' + name + '=' + value;
		});
	}
	else if	( typeof extraid === 'object')
	{
		jQuery.each(extraid, function(name, field) {
			url = url + '&' + name + '=' + field;
		});
	}
	else
	{
	}
	return url;
}


/**
 * Setzt Breite/Höhe für einen Container in der Workbench.
 * 
 * Sind weitere Container enthalten, werden diese rekursiv angepasst.
 * 
 * @param container
 */
function resizeWorkbenchContainer( container )
{
}



/**
 * Fenstergröße wurde verändert, nun die Größe der DIVs neu berechnen.
 */
function resizeWorkbench()
{
}


/**
 * Größe der TABs pro Frame neu berechnen.
 */
function resizeTabs( panel ) 
{
}


function help(el,url,suffix)
{
	var action = $(el).closest('div.panel').find('li.action.active').attr('data-action');
	var method = $(el).closest('div.panel').find('li.action.active').attr('data-method');
	
	window.open(url + action + '/'+ method + suffix, 'OpenRat_Help', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');
}


/**
 * Show a notice bubble in the UI.
 * @param type
 * @param name
 * @param status
 * @param msg
 * @param log
 */
function notify( type,name,status,msg,log=[] )
{
	// Notice-Bar mit dieser Meldung erweitern.

	let notice = $('<div class="notice '+status+'"></div>');

	let toolbar = $('<div class="or-notice-toolbar"></div>');
	if   ( log.length )
        $(toolbar).append('<i class="or-action-full image-icon image-icon--menu-fullscreen"></i>');
	$(toolbar).append('<i class="or-action-close image-icon image-icon--menu-close"></i>');
	$(notice).append(toolbar);

	id = 0; // TODO
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


function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function registerOpenClose( $el )
{
    $($el).children('.on-click-open-close').click( function() {
        $(this).closest('.toggle-open-close').toggleClass('open closed');
    });

}