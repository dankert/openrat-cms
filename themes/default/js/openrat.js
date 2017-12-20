
$('html').removeClass('nojs');
 
// Default-Subaction
var DEFAULT_CONTENT_ACTION = 'edit';


$(document).ready(function()
{

	refreshAll();
	
	// Alle 5 Minuten pingen.
	window.setInterval( "ping()", 300000 );
});


 
/**
 * Ping den Server. Führt keine Aktion aus, aber sorgt dafür, dass die Sitzung erhalten bleibt.
 * 
 * "Geben Sie mir ein Ping, Vasily. Und bitte nur ein einziges Ping!" (aus: Jagd auf Roter Oktober)
 */
function ping()
{
	$.ajax( createUrl('title','ping',0) );
	//window.console && console.log("session-ping");
}



function refreshAll()
{
	//$('ul#history').sortable();
	
	refreshTitleBar();
	refreshWorkbench();
	
	// Workbench-Events registrieren
	
	// Nicht-Modale Dialoge durch Klick auf freie Fläche schließen.
	$('div#filler').click( function()
	{
		if	( $('div#dialog').hasClass('modal') )
		{
			
		}
		else
		{
			$('div#dialog').html('').hide();  // Dialog beenden
			
			//$('div.modaldialog').fadeOut(500); 
			//$('div#workbench').removeClass('modal'); // Modalen Dialog beenden.
			$('div#filler').fadeOut(500); // Filler beenden

		}
	});
	

}


function refreshAllRefreshables()
{
	// Default-Inhalte der einzelnen Views laden.
	$('div#workbench div.panel > div.header > ul.views > li.active').each( function() {
		if	( $(this).hasClass('static') )
			return;
		
		var method  = $(this).attr('data-method');
		var action  = $(this).attr('data-action');
		var id      = $(this).attr('data-id');
		var extraid = $(this).attr('data-extra');
		
		loadView( $(this).closest('div.panel').find('div.content'),action,method,id);
	});
	
}



function refreshActualView( element )
{
	// Default-Inhalte der einzelnen Views laden.
	$(element).closest('div.panel').find('li.active').each( function() {
		var method = $(this).attr('data-method');
		var action = $(this).attr('data-action');
		var id     = $(this).attr('data-id');
		
		loadView( $(this).closest('div.panel').find('div.content'),action,method,id);
	});

}



/**
 * Lade die Workbench neu.
 */
function refreshWorkbench()
{
	// Workbench laden
	$('ul#history').empty();
	$('div#workbench').empty().fadeOut('fast').load(createUrl('workbench','show',0),null,function() {

		
		// View-Größe initial berechnen.
		resizeWorkbench();
		
		// Modale Dialoge beenden
		$('div.modaldialog').fadeOut(500);
		$('div#workbench').removeClass('modal');
		$('div#filler').fadeOut(500);

		// Default-Inhalte der einzelnen Views laden.
		$(this).fadeIn(750).find('li.active').each( function() {
			var method = $(this).attr('data-method');
			var action = $(this).attr('data-action');
			
			if	( action )
				loadView( $(this).closest('div.panel').find('div.content'),action,method,0);
		});

		// OnClick-Handler zum Scrollen der Tabs
		$('div.backward_link').click( function() {
			var $views = $(this).closest('div.header').find('ul.views');
			//$views.scrollTo( -50 );
			var $prev = $views.find('li.action.active').prev();
			$views.scrollTo( $prev,500,{"axis":"x"} );
			$prev.click();
		}
		);
		$('div.forward_link').click( function() {
			var $views = $(this).closest('div.header').find('ul.views');
			var $next  = $views.find('li.action.active').next();
			$views.scrollTo( $next,500,{"axis":"x"} );
			$next.click();
		}
		);
		


		registerWorkbenchEvents();
	});
	//alert('go');
	
	
	loadTree(); // ??
	
	// Modale Dialoge
	//$('form.login, form.profile').dialog( { modal:true, resizable:false, width:760, height:600, draggable: false } );
	
	
	$(window).resize( function() {
		resizeWorkbench();
	} );
}



/**
 * Registriert alle Events, die in der Workbench laufen sollen.
 */
function registerWorkbenchEvents()
{
	// Drag and Drop für Views
	$('ul.views > li.action').draggable(
	{
		cursor: 'move',
		revert: 'invalid'
	} );
	
	// Ziehen von Views in andere View-Leisten.
	// Die View wird dabei einfach kopiert. Container mit leeren View-Leisten werden gelöscht.
	$('ul.views').droppable(
		{
			accept     : 'li.action',
			hoverClass : 'drophover',
			activeClass: 'dropactive',
			drop: function(event, ui) // View fällt auf eine andere, existierende View-Liste
			{
				var dropped     = ui.draggable;
				var droppedOn   = $(this);
				var oldViewList = dropped.parent();
				
				if	( $(dropped).closest('div.panel').attr('id') == $(droppedOn).closest('div.panel').attr('id') )
					$(dropped).css({top: 0,left: 0}); // Nicht auf das eigene Fenster fallen lassen.
				else
					$(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn).click();
				
				// Falls die View-Liste, von der die View weggezogen wurde, jetzt leer ist:
				if	( oldViewList.find('li').size() == 0 )
				{
					var oldContainer = oldViewList.closest('div.container');
					oldViewList.closest('div.panel').remove(); // Die Bar, in der die leere Viewliste ist, entfernen.
					
					if	( oldContainer.hasClass('autosize') )
						oldContainer.children('div.panel').addClass('autosize').removeClass('resizable');
					else
						oldContainer.children('div.panel').addClass('resizable').removeClass('autosize');

					oldContainer.replaceWith( oldContainer.children('div.panel') ); // die andere Bar nehmen und den übergeordneten Container ersetzen.
					resizeWorkbench();
				}
			}
		}
	);

	// Ziehen von Views in anderen Inhalt-Bereichen
	// Dabei wird der Ziel-Bereich durch einen neuen View-Container ersetzt.
	$('div.content').droppable(
		{
			accept     : 'li.action',
			hoverClass : 'drophover',
			activeClass: 'dropactive',
			drop       : function(event, ui)
			{
				var dropped     = ui.draggable;
				var droppedOn   = $(this);
				var oldViewList = dropped.parent();
				
				var offsetDropped = dropped.offset();
				var offsetContent = droppedOn.offset();

				// Abstände im Zielelement zu dem Rändern bestimmen.
				var paddingLeft   = offsetDropped.left-offsetContent.left;
				var paddingRight  = offsetContent.left+droppedOn.width()-offsetDropped.left;
				var paddingTop    = offsetDropped.top-offsetContent.top;
				var paddingBottom = offsetContent.top+droppedOn.height()-offsetDropped.top;
				//alert( ' L:' + paddingLeft + ' R:'  + paddingRight + ' T:'+ paddingTop + ' B:' + paddingBottom );
				
				var newContainer = $('<div class="container"><div class="first" /><div class="divider" /><div class="second"></div>');
				
				if	( paddingLeft < Math.min(paddingRight,Math.min(paddingTop,paddingBottom)) )
				{
					// Linker Rand ist der nächste.
					newContainer.addClass('axle-x');
					newContainer.children('div.divider' ).addClass('to-right');
					newContainer.children('div.first' ).removeClass('first').addClass('resizable');
					newContainer.children('div.second').removeClass('first').addClass('autosize' );
				}
				else if	( paddingRight < Math.min(paddingTop,paddingBottom) )
				{
					// Rechter Rand ist der nächste.
					newContainer.addClass('axle-x');
					newContainer.children('div.divider' ).addClass('to-left');
					newContainer.children('div.first' ).removeClass('first').addClass('autosize');
					newContainer.children('div.second').removeClass('first').addClass('resizable' );
				}
				else if	( paddingTop < paddingBottom )
				{
					// Oberer Rand ist der nächste.
					newContainer.addClass('axle-y');
					newContainer.children('div.divider' ).addClass('to-bottom');
					newContainer.children('div.first' ).removeClass('first').addClass('resizable');
					newContainer.children('div.second').removeClass('first').addClass('autosize' );
				}
				else
				{
					// Unterer Rand ist der nächste.
					newContainer.addClass('axle-y');
					newContainer.children('div.divider' ).addClass('to-top');
					newContainer.children('div.first' ).removeClass('first').addClass('autosize');
					newContainer.children('div.second').removeClass('first').addClass('resizable' );
				}

				newContainer.children('div.resizable' ).addClass('bar').data('size-factor',0.4);
				
				// Die komplette Bar der Quelle kopieren.
				$(dropped).closest('div.panel').clone().addClass('resizable').removeClass('autosize').replaceAll( newContainer.children('div.resizable') );
				newContainer.find('ul.views > li').remove(); // Alle View entfernen
				$(dropped).detach().css({top: 0,left: 0}).appendTo( newContainer.find('ul.views') ).click(); // View kopieren

				// Neuen Container in den DOM einfügen.
				var oldContainer = $(droppedOn).closest('div.panel').replaceWith( newContainer );
				newContainer.children('div.autosize').replaceWith( oldContainer ); 
				
				if	( oldContainer.hasClass('autosize' )) { newContainer.addClass('autosize' ).removeClass('resizable'); }
				if	( oldContainer.hasClass('resizable')) { newContainer.addClass('resizable').removeClass('autosize' ); }
				oldContainer.addClass('autosize' ).removeClass('resizable');
			
				// Falls die View-Liste, von der die View weggezogen wurde, jetzt leer ist:
				if	( oldViewList.find('li').length == 0 )
				{
					var oldContainer = oldViewList.closest('div.container');
					oldViewList.closest('div.panel').remove(); // Die Bar, in der die leere Viewliste ist, entfernen.
					
					if	( oldContainer.hasClass('autosize') )
						oldContainer.children('div.panel').addClass('autosize').removeClass('resizable');
					else
						oldContainer.children('div.panel').addClass('resizable').removeClass('autosize');

					oldContainer.replaceWith( oldContainer.children('div.panel') ); // die andere Bar nehmen und den übergeordneten Container ersetzen.
					resizeWorkbench();
				}
				
				resizeWorkbench();
				registerWorkbenchEvents();
			}
		} );

	// geht nicht zusammen mit draggable...
	//$('ul.views').sortable();

	// Modalen Dialog erzeugen.
	if	( $('div#workbench div.panel.modal').length > 0 )
	{
		$('div#workbench div.panel.modal').parent().addClass('modal');
		$('div#filler').fadeTo(500,0.5);
		$('div#workbench').addClass('modal');
	}
	
	
	// Größe der einzelnen Bereiche verändern
	$('div.container.axle-x > div.divider').draggable(
			
			{
				stop: function( event, ui ) {
					var xoffset = ui.position.left;
					var lr = $(this).hasClass('to-right')?1:-1;
						
					$(this).parent().children('div.resizable').each( function()
						{
							var factor = ((lr*xoffset)+$(this).width()) / ($(this).parent().width());
							factor = Math.min(0.5,Math.max(0.1,factor)); // Erlaubter Bereich
							
							$(this).data('size-factor',factor);
						}
					);
					resizeWorkbenchContainer( $(this).parent() );
				},
				axis: "x",
				revert: true,
				revertDuration: 0
			}
		);
	$('div.container.axle-y > div.divider').draggable(
			
			{
				stop: function( event, ui ) {
					var yoffset = ui.position.top;
					var lr = $(this).hasClass('to-bottom')?1:-1;
					
					$(this).parent().children('div.resizable').each( function()
						{
							var factor = ((lr*yoffset)+$(this).height()) / ($(this).parent().height());
							factor = Math.min(0.5,Math.max(0.1,factor)); // Erlaubter Bereich
							
							$(this).data('size-factor',factor);
						}
					);
					resizeWorkbenchContainer( $(this).parent() );
				},
				axis: "y",
				revert: true,
				revertDuration: 0
			}
		);

	// OnClick-Handler für Klick auf einen Tab-Reiter.
	$('ul.views > li.action').click( function() {
		$(this).orLoadView();
	});
	
	$('div.header').dblclick( function()
			{
				fullscreen( this );
			} );
}



/**
 * Laedt den Header neu.
 */
function refreshTitleBar()
{
	$('div#header').load( createUrl('title','show',0 ),function() {
		$(this).fadeIn('slow');
		$('div.clickable.filtered').addClass('inactive');

		registerHeaderEvents();
	});
	
	
	// Modale Dialoge
	//$('form.login, form.profile').dialog( { modal:true, resizable:false, width:760, height:600, draggable: false } );
}



function loadViewByName(viewName, url )
{
	alert('loadViewByName');
	
	loadView( $('div#'+viewName),url );
}


/**
 * Laden einer View.
 * 
 * @param jo
 * @param url URL, von der der Inhalt geladen wird.
 */
function loadView(contentEl,action,method,id,params  )
{
	// Schauen, ob der Inhalt schon geladen ist...
	var targetEl = $(contentEl).children('div.sheet.action-'+action+'.method-'+method+'.id-'+id);
	
	if	( targetEl.length == 0 )
	{
		// Noch nicht vorhanden, neues Element erstellen.
		$(contentEl).children('div.sheet').hide();
		targetEl = $('<div class="sheet action-'+action+' method-'+method+' id-'+id + '" />' );
		$(contentEl).append(targetEl);
	}
	else
	{
		if	( targetEl.is(':visible') )
		{
			return;
		}
		else
		{
			$(contentEl).children('div.sheet').hide();
			targetEl.show();
			return;
		}
	}
			
	var url = createUrl(action,method,id,params); // URL für das Laden erzeugen.
	
	$(targetEl).empty().fadeTo(1,0.7).addClass('loader').html('').load(url,function(response, status, xhr) {
			$(targetEl).fadeTo(350,1);
			
			if	( status == "error" )
			{
				// Seite nicht gefunden.
				$(targetEl).html("");
				$(targetEl).removeClass("loader");
				
				notify('error',response);
				// OK-button Ausblenden.
				//$(targetEl).closest('div.panel').find('div.bottom > div.command > input').addClass('invisible');
				// var msg = "Sorry but there was an error: ";
				//$(this).html(msg + xhr.status + " " + xhr.statusText);
				return;
			}

			$(targetEl).removeClass("loader");
			registerViewEvents( targetEl );
		});
}



/**
 * Registriert alle Handler für den Inhalt einer View.
 *
 * @param viewEl DOM-Element der View
 */
function registerViewEvents( viewEl )
{
	$(viewEl).trigger('orViewLoaded');

	
	// Eingabefeld-Hints aktivieren...
	$(viewEl).find('input[data-hint]').orHint();
	
	// Untermenüpunkte aus der View in das Fenstermenü kopieren...
	$(viewEl).closest('div.panel').find('div.header div.dropdown div.entry.perview').remove(); // Alte Einträge löschen
	
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
	$('div.content li.object > div.entry[data-type=\'folder\']').droppable( {accept:'li.object',hoverClass: 'drophover',activeClass: 'dropactive',drop: function(event, ui) {
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
		$(this).closest('div.panel').find('ul.views li.action.active').addClass('dirty');
	});
	

	
	



}





function registerHeaderEvents()
{
	$('div#header').trigger('orHeaderLoaded');
	

	//   S u c h e
	$('div.search input').blur( function(){
		$('div.search input div.dropdown').fadeOut();
	});
	
	// Hints...
	$('div.search input').orHint();

	
	$('div.search input').orSearch( { dropdown:'div.search div.dropdown' } );

	/*
	 * 
	// V e r l a u f
	$('div#header div.history').hover( function(){
		$('div#header div.history div.dropdown').html('');
		$.ajax( { 'type':'GET', url:'./dispatcher.php?action=title&subaction=history', data:null, success:function(data, textStatus, jqXHR)
			{
				for( id in data.history )
				{
					var result = data.history[id];
					
					// Suchergebnis-Zeile in das Ergebnis schreiben.
					$('div#header div.history div.dropdown').append('<div title="'+result.desc+'" onclick="loadViewByName(\'content\',\''+result.url+'\');"><img src="'+OR_THEMES_EXT_DIR+'default/images/icon_'+result.type+'.png" />'+result.name+'</div>');
				}
			} } );
		$('div#header div.history div.dropdown').fadeIn();
	});
	 */

	
	/*
	$base = defined('OR_BASE_URL')?slashify(OR_BASE_URL).'editor/editor/':'./editor/editor/';
	$editor->basePath = $base;
	$editor->config['skin' ] = 'v2';
	$editor->config['language' ] = config('language','language_code');
	$editor->config['toolbar' ] = 'Openrat';
	$editor->config['toolbar_Openrat' ] =  array( 
array('Save','Preview','-','Templates'),
array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'),
array('Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
array('Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'),
'/',
array('Bold','Italic','Underline','Strike','-','Subscript','Superscript'),
array('NumberedList','BulletedList','-','Outdent','Indent','Blockquote'),
array('JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
array('Link','Unlink','Anchor'),
array('Image','Flash','Table','HorizontalRule','SpecialChar','PageBreak'),
'/',
array('Styles','Format','Font','FontSize'),
array('TextColor','BGColor'),
array('Source','-', 'ShowBlocks','Maximize') );
	
	$editor->config['filebrowserUploadUrl' ] = str_replace('&amp;','&',Html::url('filebrowser','directupload','-',array(REQ_PARAM_TOKEN=>token(),'name'=>'upload')));
	$editor->config['filebrowserBrowseUrl' ] = str_replace('&amp;','&',Html::url('filebrowser','browse','-'));
	*/
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
	// Nur, wenn ein Baum auch angezeigt werden soll.
	if	( $('div#panel-tree li.action').data('action')=='tree' )
	{
		// Oberstes Tree-Element erzeugen
		$('div#panel-tree div.content > div.sheet.action-tree.method-tree').html("&nbsp;");
		
		// Wurzel des Baums laden
		//loadBranch( $('div#tree ul.tree > li'),'root',0);
		$('div#panel-tree div.content > div.sheet.action-tree.method-tree').orTree( { type:'root',id:0,onSelect:function(name,type,id) {
			openNewAction( name,type,id, '' );
		} });
		
		// Die ersten 2 Hierarchien öffnen:
		$('div#panel-tree div.content > div.sheet.action-tree.method-tree > ul.tree > div.tree').delay(500).click();
		$('div#panel-tree div.content > div.sheet.action-tree.method-tree > ul.tree > div.tree').delay(500).click();
	}
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
	refreshAllRefreshables();
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
 * Setzt neue View und aktualisiert alle Fenster.
 * @param element
 * @param action Action
 * @param id Id
 */
function startView( element,method )
{
	var action = $('#panel-content').find('li.active').data('action');
	var id     = $('#panel-content').find('li.active').data('id'    );
	
	loadView( $(element).closest('div.panel').find('div.content'), action,method,id );
	
	// Alle refresh-fähigen Views mit dem neuen Objekt laden.
	// refreshAllRefreshables();
}


/**
 * Setzt neuen modalen Dialog und aktualisiert alle Fenster.
 * @param element
 * @param action Action
 * @param id Id
 */
function startDialog( name,action,method,id,params )
{
	if ( action== null || action.length ==0 )
		action = $('#panel-content').find('li.active').data('action');
	if	(id==null  || id.length ==0)
		id     = $('#panel-content').find('li.active').data('id'    );
//	if	(params==null)
//		params = {};
	
	$('div#filler').fadeTo(500,0.5);
	$('div#dialog').html('<div class="header"><ul class="views"><li class="action active"><img class="icon" title="" src="./themes/default/images/icon/'+method+'.png" /><div class="tabname" style="width:100px;">'+name+'</div></li></ul></div><div class="content" />');
	$('div#dialog').data('id',id);
	$('div#dialog').show();

	//alert("neuer Dialog2: "+name+" action: "+action+" method: "+method+ " id:"+id + " params:"+params);

	loadView( $('div#dialog div.content'), action,method,id,params );
	
	//$('div#workbench div.panel.modal').parent().addClass('modal');
	//$('div#workbench').addClass('modal');

	// Alle refresh-fähigen Views mit dem neuen Objekt laden.
	// refreshAllRefreshables();
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
	
	// Andere Tabs auf inaktiv setzen
	$('ul#history li.active').removeClass('active');
	
	// Tab schon vorhanden?
	if	( $('ul#history li.'+action+'.id'+id).length > 0 )
	{
		// Ja, Tab schon vorhanden
		// Gewünschtes Tab aktiv setzen
		$('ul#history li.'+action+'.id'+id).addClass('active');
	}
	else
	{
		// Tab noch nicht vorhanden, also jetzt hier ergänzen.
		$('ul#history').append('<li class="action active '+action+' id'+id+'"><img src="'+OR_THEMES_EXT_DIR+'default/images/icon_'+action+'.png" title="" />'+name+'</li>');
		$('ul#history li.active').click( function()
			{
				// Action-Tab wurde angeklickt
				$('ul#history li.active').removeClass('active'); // Andere Tabs auf inaktiv setzen
				$(this).addClass('active'); // Angeklicktes Tab auf aktiv setzen
			
				setNewAction(action,id,extraId);
			} );
	}

	// Andere Tabs auf inaktiv setzen
	$('div#panel-content > div.header > ul.views li.active').removeClass('active');
	
	// Tab schon vorhanden?
	if	( $('div#panel-content > div.header > ul.views > li.'+action+'.id'+id).length > 0 )
	{
		// Ja, Tab schon vorhanden
		// Gewünschtes Tab aktiv setzen
		$('div#panel-content > div.header > ul.views > li.'+action+'.id'+id).addClass('active');
	}
	else
	{	
		// Neuen Tab in Hauptfenster anlegen
		$('div#panel-content > div.header > ul.views > li.active').removeClass('active');
		
		// Wenn max. Anzahl überschritten, dann den ersten entfernen.
		var maxTabs = 7;
		if	( $('div#panel-content > div.header > ul.views > li.action').length >= maxTabs )
			$('div#panel-content > div.header > ul.views > li.action').first().remove();
				
		$('div#panel-content > div.header > ul.views').append('<li class="action active '+action+' id'+id+'" title="'+name+'" data-action="'+action+'"  data-id="'+id+'" data-method="'+DEFAULT_CONTENT_ACTION+'"><img class="icon" src="'+OR_THEMES_EXT_DIR+'default/images/icon_'+action+'.png" title="" /><div class="tabname">'+name+'</div><img class="close icon" src="'+OR_THEMES_EXT_DIR+'default/images/icon/close.gif" title="" /></li>');
		resizeTabs( $('div#contentbar'),true);
		$('div#panel-content > div.header > ul.views').scrollLeft(9999);
		
		// Klick auf den "Schließen"-Knopf
		$('div#panel-content > div.header > ul.views img.close').click( function()
				{
					setTitle( '' ); // Title entfernen.

					// Zuerst die dazugehörigen, geladenen Inhalte von Views löschen, um kein
					// Memory-Leak zu erzeugen ;)
					var action = $(this).closest('li.action').data('action');
					var id     = $(this).closest('li.action').data('id'    );
					$('div#workbench div.content > div.sheet.action-'+action+'.id-'+id).remove();
					
					// Schließen
					// Wenn aktiver Tab, dann den Inhalt loeschen
					if	( $(this).closest('li.action').hasClass('active') )
					{
						//$(this).closest('div.panel').find('div.content').html(''); // Inhalt entfernen
						$('div#workbench div.refreshable div.content').html('');
						
						var views = $(this).closest('ul.views');
						
						// Und jetzt den Tab entfernen
						$(this).parent().remove(); // Tab entfernen
						
						// Letzten Tab aktivieren (sofern vorhanden)
						$(views).find('li.action').last().click();
					}
					else
					{
						// Inaktive Tabs nur löschen.
						$(this).parent().remove(); // Tab entfernen
					}
					
					resizeTabs( $('div#panel-content'),true);
				} );
		
		// Klick auf den Reiter
		$('div#panel-content > div.header > ul.views > li.active').click( function()
			{
				// Action-Tab wurde angeklickt
				$('div#panel-content > div.header > ul.views li.active').removeClass('active'); // Andere Tabs auf inaktiv setzen
				$(this).addClass('active'); // Angeklicktes Tab auf aktiv setzen

				setTitle( $(this).children('div.tabname').text() );

				// Zum angeklickten Tab scrollen
				//$('div#content > div.panel > div.menu > div.views > ul.views').scrollTo(this);
			
				setNewAction(action,id,extraId);
			} );

		// Nach dem Hinzufügen eines neue Tabs die Größe aller Tabs in diesem Panel anpassen.
		resizeTabs( $('div#panel-content ') );

		/*
		 * Eventhandler hängt schon auf div.menu
		$('div#content > div.panel > div.menu > div.views > ul.views li.active').dblclick( function()
				{
					fullscreen( this );
				} );
				*/

	}
	
	// Zum angeklickten Tab scrollen
	
	//$('div#content > div.panel > div.menu > div.views > ul.views').scrollTo(this);
	setNewAction( action,id,extraId );
	
	
}


function filterMenus(action)
{
	$('div.clickable.filtered').addClass('inactive');
	$('div.clickable.filtered.on-action-'+action).removeClass('inactive');
}



/**
 * Setzt neue Action und aktualisiert alle Fenster.
 * 
 * @param action Action
 * @param id Id
 */
function setNewAction( action,id,extraId )
{
	filterMenus(action);
	$('div#workbench ul.views > li.action.dependent').attr('data-action',action).attr('data-id',id).attr('data-extra',JSON.stringify(extraId));
	
	// Alle refresh-fähigen Views mit dem neuen Objekt laden.
	refreshAllRefreshables();
}


/**
 * Setzt neue Id und aktualisiert alle Fenster.
 * @param id Id
 */
function setNewId( id )
{
	$('div#workbench div.refreshable').attr('data-id',id);
	// Alle refresh-fähigen Views mit dem neuen Objekt laden.
	refreshAllRefreshables();
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



function loadSubaction( el, actionName, subactionName,id )
{
	alert('nobody should call loadSubaction()');
	//   E d i t o r
	var editorConfig = {
			skin : 'v2',
			baseHref: OR_THEMES_EXT_DIR+'../editor/editor/',
			customConfig : 'config-openrat.js',
			filebrowserUploadUrl:'./dispatcher.php?action=filebrowser&subaction=directupload&name=upload',
			filebrowserBrowseUrl:'./dispatcher.php?action=filebrowser&subaction=browse'
	};
	
	var main = $(el).parent().parent().parent('div.panel').children('div.content').first();
	$(main).load(createUrl(actionName,subactionName,id)+' div.content',null, function() {
			var o=CKEDITOR.instances[ $('textarea.editor').attr('name') ];
			if (o) o.destroy();
			
			//alert("o ist "+o);
			//$('textarea.editor').ckeditor( function() { /*alert("editor ready");*/ /* callback code */ }, editorConfig );
			CKEDITOR.replace('text',{
		        customConfig : 'config-openrat.js'
		    });
		});

	$(el).parent().parent().find('.active').removeClass('active');
	$(el).parent().addClass('active');

	
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
function createUrl(action,subaction,id,extraid) 
{
	var url = './dispatcher.php';
	if	( typeof extraid === 'string')
	{
		url += '?action='+action+'&subaction='+subaction+'&id='+id;
		jQuery.each(jQuery.parseJSON(extraid), function(name, value) {
			url = url + '&' + name + '=' + value;
		});
	}
	else if	( typeof extraid === 'object')
	{
		url += '?0=0';
		jQuery.each(extraid, function(name, field) {
			url = url + '&' + field.name + '=' + field.value;
		});
	}
	else
	{
		url += '?action='+action+'&subaction='+subaction+'&id='+id;
	}
	console.log("URL="+url);
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

	var availableWidth  = container.width();
	var availableHeight = container.height();
	var factor = container.children('div.resizable').data('size-factor');
	
	if	( !factor)
		factor = 0.3;
	
	var horizontal = container.hasClass('axle-x');
	
	if	( horizontal )
	{
		// Container ist horizontal geteilt.
		var size = Math.floor(availableWidth * factor);
		container.find('div.panel.resizable').css('width',''+size                   +'px');
		container.find('div.panel.resizable > div.content').css('height',''+(availableHeight-26)+'px');
		container.find('div.panel.autosize ').css('width',''+(availableWidth-size-9)+'px');
		container.find('div.panel.autosize  > div.content').css('height',''+(availableHeight-26)+'px');

		container.children('div.resizable').css('width',''+size                   +'px');
		container.children('div.resizable').css('height',''+availableHeight+'px');
		container.children('div.autosize').css('width',''+(availableWidth-size-9)+'px');
		container.children('div.autosize').css('height',''+availableHeight+'px');

		container.children('div.divider').css('height',''+availableHeight+'px');
	}
	else
	{
		// Container ist vertikal geteilt.
		var size = Math.floor(availableHeight * factor);
		container.find('div.panel.resizable ').css('width',''+availableWidth +'px');
		container.find('div.panel.resizable > div.content').css('height',''+(size-26)+'px');
		container.find('div.panel.autosize  ').css('width',''+availableWidth  +'px');
		container.find('div.panel.autosize  > div.content').css('height',''+(availableHeight-size-26)+'px');
		
		container.children('div.resizable').css('width',''+availableWidth +'px');
		container.children('div.resizable').css('height',''+size+'px');
		container.children('div.autosize').css('width',''+availableWidth+'px');
		container.children('div.autosize').css('height',''+(availableHeight-size-5)+'px');

		container.children('div.divider').css('width',''+availableWidth+'px');
	}

	container.children('div.panel').each( function()
	{
		resizeTabs( $(this) );
	}
	);
	
	$(container).children('div.container').each( function() {
		resizeWorkbenchContainer($(this));
	});

}



/**
 * Fenstergröße wurde verändert, nun die Größe der DIVs neu berechnen.
 */
function resizeWorkbench()
{
	// Größe des Anzeige-Bereiches im Browser ermitteln.
	var viewportWidth  = $(window).width();
	var viewportHeight = $(window).height();
	
	var titleHeight = 40;
	
	var container = $('div#workbench > div.container');
	
	// Verfügbare Breite der Workbench ist Fensterbreite - Innenabstand der Workbench (2*3px)
	container.css('width' ,''+(viewportWidth-6)+'px');
	
	// Verfügbare Höhe   der Workbench ist Fensterhöhe - Höhe der Titelleiste - Innenabstand der Workbench (2*3px)
	container.css('height',''+(viewportHeight-titleHeight-6)+'px');
	
	resizeWorkbenchContainer( container );
}


/**
 * Größe der TABs pro Frame neu berechnen.
 */
function resizeTabs( panel ) 
{
	// Anzahl Tabs pro Panel
	var tabCount = $(panel).find('div.header li.action').length;
	
	// Von der Panel-Breite werden 18px für das Fenstermenü substrahiert.
	// Von der Breite pro Tab werden 39px für das Icon substrahiert.
	var tabWidth = Math.floor((($(panel).width()-18)/tabCount)-39);
	if	( $(panel).is('#panel-content') )
		tabWidth -= 24; // Im Content-Bereich gibt es noch den Schließen-Knopf.
	
	// Validierung: Mindest- und Maximalbreite
	tabWidth = Math.min(90,Math.max(5,tabWidth)); 
	$(panel).find('li.action div.tabname').width(tabWidth);
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
	notifyBrowser(msg);
	
	// Per Klick wird die Notice entfernt.
	$(notice).fadeIn().click( function()
	{
		$(this).fadeOut('fast',function() { $(this).remove(); } );
	} );
	
}