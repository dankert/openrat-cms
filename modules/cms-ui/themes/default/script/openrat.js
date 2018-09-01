
var OR_THEMES_EXT_DIR = 'modules/cms-ui/themes/';

// Execute after DOM ready:
$( function() {
    // JS is available.
    $('html').removeClass('nojs');

    /* Fade in all elements. */
    $('.initial-hidden').removeClass('initial-hidden');

    registerHeaderEvents();
    registerWorkbenchEvents();


    $('.view').each(function (index) {
        afterViewLoaded(this);
    });

    // Listening to the "popstate" event:
    window.onpopstate = function (ev) {
        Navigator.navigateTo(ev.state);
    };

    initActualHistoryState();

    Workbench.initialize();

    // Per Klick wird die Notice entfernt.
    $('#noticebar .notice').click(function () {
        $(this).fadeOut('fast', function () {
            $(this).remove();
        });
    });

    loadTree(); // Initial Loading of the navigationtree


    $(document).keyup(function (e) {
        if (e.keyCode == 27) { // ESC keycode
            $('#dialog .view').fadeOut('fast').html('');
            $('#dialog').removeClass('is-open').addClass('is-closed'); // Dialog schließen
        }
    });


    // Per Klick werden die Notices entfernt.
    $('#noticebar .notice').fadeIn().click(function () {
        $(this).fadeOut('fast', function () {
            $(this).remove();
        });
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

        filterMenus(state.action,state.id,state.data);
    }
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
		window.history.pushState(obj,obj.name,createUrl(obj.action,null,obj.id,obj.data,false) );
    }

    this.navigateToNewAction = function(action, method, id, params ) {
        var state = {action:action,method:method,id:id,data:params};
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

		Workbench.loadNewAction(state.action,state.id,state.data);
	}

    /**
	 *
     */

    this.loadNewAction = function(action, id, params ) {

    	$('#editor').attr('data-action',action);
    	$('#editor').attr('data-id'    ,id    );
    	$('#editor').attr('data-extra' ,JSON.stringify(params));

    	// View in geschlossenen Sektionen löschen, damit diese nicht stehen bleiben.
        $('#workbench section.closed .view-loader').empty();

        $('#workbench section.open .view-loader').each( function(idx) {

            var targetDOMElement = $(this);

            Workbench.loadNewActionIntoElement(targetDOMElement)
        });

        filterMenus(action, id, params);

    }


    this.loadNewActionIntoElement = function(targetDOMElement) {

        var action = $('#editor').attr('data-action');
        var id     = $('#editor').attr('data-id'    );
        var params = $('#editor').attr('data-extra' );

        var method = targetDOMElement.data('method');

        Workbench.loadViewIntoElement(targetDOMElement,action,method,id,params)
    }


    this.loadViewIntoElement = function(targetDOMElement,action,method,id,params) {

		var url = createUrl(action,method,id,params,true); // URL für das Laden erzeugen.

		targetDOMElement.empty().fadeTo(1,0.7).addClass('loader').html('').load(url,function(response, status, xhr) {
			targetDOMElement.fadeTo(350,1);

            $(targetDOMElement).removeClass("loader");

            if	( status == "error" )
			{
				// Seite nicht gefunden.
				$(targetDOMElement).html("");

				notify('error',response);
				// OK-button Ausblenden.
				//$(targetEl).closest('div.panel').find('div.bottom > div.command > input').addClass('invisible');
				// var msg = "Sorry but there was an error: ";
				//$(this).html(msg + xhr.status + " " + xhr.statusText);
				return;
			}

			afterViewLoaded( targetDOMElement );

		});

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

    // Nicht-Modale Dialoge durch Klick auf freie Fläche schließen.
    $('div#filler').click( function()
    {
        if	( $('div#dialog').hasClass('modal') )
        {

        }
        else
        {
            $('div#dialog').removeClass('is-open').addClass('is-closed');
            $('div#dialog > .view').html('');  // Dialog beenden

        }
    });

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

    var viewHasContent = $(viewEl).children().length > 0;
	section.toggleClass('disabled',!viewHasContent);

    $(viewEl).trigger('orViewLoaded');

	// Untermenüpunkte aus der View in das Fenstermenü kopieren...
	$(viewEl).closest('div.panel').find('div.header div.dropdown div.entry.perview').remove(); // Alte Einträge löschen

	$(viewEl).find('.toggle-nav-open-close').click( function() {
		$('nav').toggleClass('open');
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
	
	// Drag n Drop: Inhaltselemente (Dateien,Seiten,Ordner,Verknuepfungen) koennen auf Ordner gezogen werden.
	$('div.content li.object').draggable( {cursor:'move',revert: 'invalid' });
	$('div.content li.object > .entry[data-type=\'folder\']').droppable( {accept:'li.object',hoverClass: 'drophover',activeClass: 'dropactive',drop: function(event, ui) {
		var dropped   = ui.draggable;
        var droppedOn = $(this).parent();
        
        //alert('Moving '+$(dropped).attr('data-id')+' to folder '+$(droppedOn).attr('data-id') );
        startDialog($(this).text(),$(dropped).attr('data-type'),'copy',$(droppedOn).attr('data-id'),{'action':$(dropped).attr('data-type'),'subaction':'copy','id':$(dropped).attr('data-id'),'targetFolderId':$(droppedOn).attr('data-id')});
        /*
        if	( $(dropped).closest('div.panel').attr('id') == $(droppedOn).closest('div.panel').attr('id') )
        	$(dropped).css({top: 0,left: 0}); // Nicht auf das eigene Fenster fallen lassen.
        else
        	$(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn).click();
        	*/
    	//$(dropped).css({top: 0,left: 0}); // Nicht auf das eigene Fenster fallen lassen.
    	$(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn).click();
	} } );

	
	
	// Bei Änderungen in der View das Tab als 'dirty' markieren
	$(viewEl).find('input').change( function() {
		$(this).parent('div.view').addClass('dirty');
	});

}





function registerHeaderEvents()
{
    // Mit der Maus irgendwo hin geklickt, das Menü muss schließen.
    $('body').click( function() {
        $('.toolbar-icon.menu').parent().removeClass('open');
    });
    // Mit der Maus geklicktes Menü aktivieren.
    $('#title .toolbar-icon.menu').click( function(event) {
        event.stopPropagation();
        $(this).parent().toggleClass('open');
    });

    // Mit der Maus überstrichenes Menü aktivieren.
    $('#title .toolbar-icon.menu').mouseover( function() {
        $(this).parent().find('.toolbar-icon.menu').removeClass('open');
        $(this).addClass('open');
    });


	//   S u c h e
	$('#title div.search input').blur( function(){
		$('div.search input div.dropdown').fadeOut();
	});
	
	$('#title div.search input').orSearch( { dropdown:'#title div.search div.dropdown' } );

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


function loadTree()
{
		// Oberstes Tree-Element erzeugen
		$('#navigation').html("&nbsp;");
		
		// Wurzel des Baums laden
		//loadBranch( $('div#tree ul.tree > li'),'root',0);
		$('#navigation').orTree( { type:'root',id:0,onSelect:function(name,type,id,extraId) {
			$('nav').removeClass('open');
			openNewAction( name,type,id, extraId );
		} });
		
		// Die ersten 2 Hierarchien öffnen:
		$('#navigation > div.sheet.action-tree.method-tree > ul.tree > div.tree').delay(500).click();
		$('#navigation > div.sheet.action-tree.method-tree > ul.tree > div.tree').delay(500).click();
}



/**
 * Setzt neue View und aktualisiert alle Fenster.
 * @param element
 * @param action Action
 * @param id Id
 */
function submitUrl( element,url )
{
	postUrl( url,element );
	
	// Alle refresh-fähigen Views mit dem neuen Objekt laden.
	//refreshAllRefreshables();
}



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

    id = $('#editor').attr('data-id');

	$('div#dialog > .view').html('<div class="header"><img class="icon" title="" src="./themes/default/images/icon/'+method+'.png" />'+name+'</div>');
	$('div#dialog > .view').data('id',id);
	$('div#dialog').removeClass('is-closed').addClass('is-open');

	Workbench.loadViewIntoElement( $('div#dialog > .view'), action, method, id, params );
}


/**
 * Setzt neue modale View und aktualisiert alle Fenster.
 * @param element
 * @param action Action
 * @param id Id
 */
function modalView( element,view )
{
	var action = $(element).closest('div.panel').find('li.active').attr('data-action');
	var method = $(element).closest('div.panel').find('li.active').attr('data-method');
	var id     = $(element).closest('div.panel').find('li.active').attr('data-id'    );
	$(element).closest('div.content').modal( { "overlayClose":"true","xxxonClose":function(){alert("close)");} } );
	loadView( $(element).closest('div.content'), action, method,id );
	
	// Alle refresh-fähigen Views mit dem neuen Objekt laden.
	// refreshAllRefreshables();
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
	setTitle( name ); // Title setzen.
	
	setNewAction( action,id,extraId );
}


function filterMenus(action,id,params)
{
	$('div.clickable').addClass('active');
	$('div.clickable.filtered').removeClass('active').addClass('inactive');
	$('div.clickable.filtered.on-action-'+action).addClass('active').removeClass('inactive');

	// Jeder Menüeintrag bekommt die Id und Parameter.
    $('div.clickable.filtered a').attr('data-action',action);
    $('div.clickable.filtered a').attr('data-id'    ,id    );
    $('div.clickable.filtered a').attr('data-extra' ,JSON.stringify(params) );

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
	    var notification = new Notification(text);
	  }

	  // Otherwise, we need to ask the user for permission
	  else if (Notification.permission !== 'denied') {
	    Notification.requestPermission(function (permission) {
	      // If the user is okay, let's create a notification
	      if (permission === "granted") {
	        var notification = new Notification(text);
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

    url += '?action=' + action;

    if	(subaction != null)
    	url += '&subaction='+subaction;

	url += '&id='+id;

    if(embed)
    	url += '&embed=1';

	if	( typeof extraid === 'string')
	{
		extraid = extraid.replace(/'/g,'"'); // Replace ' with ".
		jQuery.each(jQuery.parseJSON(extraid), function(name, value) {
			if(name=='action'||name=='subaction'||name=='id')
				return;
			url = url + '&' + name + '=' + value;
		});
	}
	else if	( typeof extraid === 'object')
	{
		jQuery.each(extraid, function(name, field) {
            if(name=='action'||name=='subaction'||name=='id')
                return;
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


function notify( type,msg )
{
	// Notice-Bar mit dieser Meldung erweitern.
	var notice = $('<div class="notice '+type+'"><div class="text">'+msg+'</div></div>');
	$('#noticebar').prepend(notice); // Notice anhängen.

	// Per Klick wird die Notice entfernt.
	$(notice).fadeIn().click( function()
	{
		$(this).fadeOut('fast',function() { $(this).remove(); } );
	} );
	
}




function registerOpenClose( $el )
{
    $($el).children('.on-click-open-close').click( function() {
        $(this).closest('.toggle-open-close').toggleClass('open closed');
    });

}