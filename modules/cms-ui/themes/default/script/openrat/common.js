
// The crap in this file should be refactored into namespaced objects...

var OR_THEMES_EXT_DIR = 'modules/cms-ui/themes/';

// Execute after DOM ready:
$( function() {
    // JS is available.
    $('html').removeClass('nojs');

    /* Fade in all elements. */
    $('.initial-hidden').removeClass('initial-hidden');


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


        $('div.header').dblclick( function()
        {
            fullscreen( this );
        } );
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



        $('section.toggle-open-close .on-click-open-close').click(function () {
            var section = $(this).closest('section');

            // disabled sections are ignored.
            if (section.hasClass('disabled'))
                return;

            // if view is empty, lets load the content.
            var view = section.find('div.view-loader');
            if (view.children().length == 0)
                Openrat.Workbench.loadNewActionIntoElement(view);
        });

    }

    // Initial Notices
    $('.or-initial-notice').each( function() {
       Openrat.Workbench.notify('','','info',$(this).text());
       $(this).remove();
    });

    registerWorkbenchGlobalEvents();


    let closeMenu = function() {
        // Mit der Maus irgendwo hin geklickt, das Menü muss schließen.
        $('body').click( function() {
            $('.toolbar-icon.menu').parents('.or-menu').removeClass('open');
        });
    };
    closeMenu();



    Openrat.Workbench.registerAfterNewAction( function() {

        let url = './api/?action=tree&subaction=path&id=' + Openrat.Workbench.state.id + '&type=' + Openrat.Workbench.state.action + '&output=json';

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

            let $breadcrumb = $('.or-breadcrumb').empty();
            let items = [];
            $.each(output.path.concat(output.actual), function (idx, path) {
                items.push( '<li class="or-breadcrumb-item clickable" tabindex="0"><a href="'+Openrat.Navigator.createShortUrl(path.action,path.id)+'" data-type="open" data-action="'+path.action+'" data-id="'+path.id+'"><i class="image-icon image-icon--action-'+path.action+'" />'+path.name+'</a></li>');
            });
            $breadcrumb.append( items.join('<li><i class="tree-icon image-icon image-icon--node-closed"></i></li>') );
            $('.or-breadcrumb .clickable').orLinkify();

        }).fail(function (e) {
            // Ups... aber was können wir hier schon tun, außer hässliche Meldungen anzeigen.
            console.warn(e);
            console.warn('failed to load path from '+url);
        }).always(function () {

        });
    } );

});




let filterMenus = function ()
{
    let action = Openrat.Workbench.state.action;
    let id     = Openrat.Workbench.state.id;
    $('div.clickable').addClass('active');
    $('div.clickable.filtered').removeClass('active').addClass('inactive');

    $('div.clickable.filtered.on-action-'+action).addClass('active').removeClass('inactive');

    // Jeder Menüeintrag bekommt die Id und Parameter.
    $('div.clickable.filtered a').attr('data-id'    ,id    );
    /*
        $('div.clickable.filtered a').attr('data-action',action);
    */

}


$('#title.view').data('afterViewLoaded', function() {
    filterMenus();
} );

Openrat.Workbench.registerAfterNewAction( function() {
    filterMenus();
} );






Openrat.Workbench.registerAfterViewLoaded( function(element) {

    // Refresh already opened popup windows.
    if   ( typeof popupWindow != "undefined" )
        $(element).find("a[data-type='popup']").each( function() {
            popupWindow.location.href = $(this).attr('data-url');
        });

});


/**
 * Registriert alle Handler für den Inhalt einer View.
 *
 * @param viewEl DOM-Element der View
 */
Openrat.Workbench.registerAfterViewLoaded( function(viewEl ) {

    // Die Section deaktivieren, wenn die View keinen Inhalt hat.
    var section = $(viewEl).closest('section');

    //var viewHasContent = $(viewEl).children().length > 0;
	//section.toggleClass('disabled',!viewHasContent);
	section.toggleClass('is-empty',$(viewEl).is(':empty'));

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
        Openrat.Workbench.setUserStyle( this.value );
    });




    function registerMenuEvents($element )
    {
        //$e = $($element);

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

    function registerGlobalSearch($element )
    {
        $($element).find('.search input').orSearch( {
            dropdown:'#title div.search div.dropdown',
            select: function(obj) {
                openNewAction( obj.name, obj.action, obj.id );
            }
        } );

    }

    function registerSelectorSearch( $element )
    {
        $($element).find('.selector input').orSearch( {
            dropdown: '.dropdown',
            select: function(obj) {
                $($element).find('.or-selector-link-value').val(obj.id  );
                $($element).find('.or-selector-link-name' ).val(obj.name).attr('placeholder',obj.name);
            }
        } );

    }



    function registerTree(element) {

        // Klick-Funktionen zum Öffnen/Schließen des Zweiges.
        $(element).find('.or-navtree-node').orTree();

    }


    registerMenuEvents    ( viewEl );
    registerGlobalSearch  ( viewEl );
    registerSelectorSearch( viewEl );
    registerTree          ( viewEl );

    function registerDragAndDrop(viewEl)
    {

        registerDraggable(viewEl);
        registerDroppable(viewEl);
    }

    registerDragAndDrop(viewEl);


} );



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

        $('#dialog .view').fadeOut('fast').html('');
        $('#dialog').removeClass('is-open').addClass('is-closed'); // Dialog schließen

        $(document).unbind('keyup',this.escapeKeyClosingHandler); // Cleanup ESC-Key-Listener
    }

	view.start( $('div#dialog > .view') );
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
function openNewAction( name,action,id )
{
	// Im Mobilmodus soll das Menü verschwinden, wenn eine neue Action geoeffnet wird.
    $('nav').removeClass('open');

    setTitle( name ); // Title setzen.

    Openrat.Navigator.navigateToNew( {'action':action, 'id':id } );
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





function help(el,url,suffix)
{
	var action = $(el).closest('div.panel').find('li.action.active').attr('data-action');
	var method = $(el).closest('div.panel').find('li.action.active').attr('data-method');
	
	window.open(url + action + '/'+ method + suffix, 'OpenRat_Help', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');
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