
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
	$('div#workbench div.bar ul.views li.active').each( function() {
		if	( $(this).hasClass('static') )
			return;
		
		var method  = $(this).attr('data-method');
		var action  = $(this).attr('data-action');
		var id      = $(this).attr('data-id');
		var extraid = $(this).attr('data-extra');
		
		loadView( $(this).closest('div.frame').find('div.content'),action,method,id);
	});
	
}



function refreshActualView( element )
{
	// Default-Inhalte der einzelnen Views laden.
	$(element).closest('div.frame').find('li.active').each( function() {
		var method = $(this).attr('data-method');
		var action = $(this).attr('data-action');
		var id     = $(this).attr('data-id');
		
		loadView( $(this).closest('div.frame').find('div.content'),action,method,id);
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
			
			loadView( $(this).closest('div.frame').find('div.content'),action,method,0);
		});

		// OnClick-Handler zum Scrollen der Tabs
		$('div.backward_link').click( function() {
			var $views = $(this).closest('div.views').find('ul.views');
			//$views.scrollTo( -50 );
			var $prev = $views.find('li.action.active').prev();
			$views.scrollTo( $prev,500,{"axis":"x"} );
			$prev.click();
		}
		);
		$('div.forward_link').click( function() {
			var $views = $(this).closest('div.views').find('ul.views');
			var $next  = $views.find('li.action.active').next();
			$views.scrollTo( $next,500,{"axis":"x"} );
			$next.click();
		}
		);
		
		// OnClick-Handler für Klick auf einen Tab-Reiter.
		$('ul.views > li.action').click( function() {
			$(this).orLoadView();
		});
		
		$('div.menu').dblclick( function()
				{
					fullscreen( this );
				} );
		
		// Drag n Drop für Views
		$('ul.views > li.action').draggable( {cursor:'move',revert: 'invalid' });
		$('ul.views').droppable( {accept:'li.action',hoverClass: 'drophover',activeClass: 'dropactive',drop: function(event, ui) {
			var dropped   = ui.draggable;
            var droppedOn = $(this);
            if	( $(dropped).closest('div.frame').attr('id') == $(droppedOn).closest('div.frame').attr('id') )
            	$(dropped).css({top: 0,left: 0}); // Nicht auf das eigene Fenster fallen lassen.
            else
            	$(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn).click();
		} } );

		// geht nicht zusammen mit draggable...
		//$('ul.views').sortable();

		// Modalen Dialog erzeugen.
		if	( $('div#workbench div.frame.modal').size() > 0 )
		{
			$('div#workbench div.frame.modal').parent().addClass('modal');
			$('div#filler').fadeTo(500,0.5);
			$('div#workbench').addClass('modal');
		}
		
		
		// Divider
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
 * Laedt den Header neu.
 */
function refreshTitleBar()
{
	$('div#title').load( createUrl('title','show',0 ),function() {
		$(this).fadeIn('slow');
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
function loadView(contentEl,action,method,id  )
{
	// Schauen, ob der Inhalt schon geladen ist...
	var targetEl = $(contentEl).children('div.sheet.action-'+action+'.method-'+method+'.id'+id);
	
	if	( targetEl.size() == 0 )
	{
		// Noch nicht vorhanden, neues Element erstellen.
		$(contentEl).children('div.sheet').hide();
		targetEl = $('<div class="sheet action-'+action+' method-'+method+' id'+id + '" />' );
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
			
	var url = createUrl(action,method,id,0); // URL für das Laden erzeugen.
	
	$(targetEl).empty().fadeTo(1,0.7).addClass('loader').html('').load(url,function(response, status, xhr) {
			$(targetEl).fadeTo(350,1);
			
			if	( status == "error" )
			{
				// Seite nicht gefunden.
				$(this).html("");
				$(this).removeClass("loader");
				// OK-button Ausblenden.
				$(targetEl).closest('div.frame').find('div.bottom > div.command > input').addClass('invisible');
				// var msg = "Sorry but there was an error: ";
				//$(this).html(msg + xhr.status + " " + xhr.statusText);
				return;
			}

			$(this).removeClass("loader");
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
	
	var $formVorhanden = $(viewEl).find('form').size() > 0;
	var $formInput     = $(viewEl).closest('div.frame').find('div.bottom > div.command > input');
	if	( $formVorhanden )
		$formInput.removeClass('invisible');
	else
		$formInput.addClass('invisible');

	if ( $('div.window form input[type=password]').length>0 && $('#uname').attr('value')!='' )
	{
		$('div.window form input[name=login_name]    ').attr('value',$('#uname'    ).attr('value'));
		$('div.window form input[name=login_password]').attr('value',$('#upassword').attr('value'));
	}
	
	// Fokus nicht setzen, da mehrere Views sich sonst um den Fokus streiten.
	//$(viewEl).find('input.focus').focus();
	
	// Sortieren von Tabellen
	$(viewEl).find('table.sortable > tbody').sortable({
		   update: function(event, ui)
		   {
			   $(ui).addClass('loader');
				var order = [];
				$(ui.item).closest('table.sortable').find('tbody > tr.data').each( function() {
					var objectid = $(this).data('id');
					order.push( objectid );
				});
				var url    = './dispatcher.php';
				var params = {};
				params.action    = 'folder';
				params.subaction = 'order';
				params.token     = $('#id_token').attr('value');
				params.order     = order.join(',');
				params.id        = $(viewEl).closest('div.frame').data('id');
				params.output    = 'json';
				
				$.ajax( { 'type':'POST',url:url, data:params, success:function(data, textStatus, jqXHR)
					{
					   $(ui).removeClass('loader');
						doResponse(data,textStatus,ui);
					},
					error:function(jqXHR, textStatus, errorThrown) {
						alert( errorThrown );
					}
					
				} );
		   }
	});
	
	if	( $(viewEl).find('textarea#pageelement_edit_editor').size() > 0 )
	{
		var instance = CKEDITOR.instances['pageelement_edit_editor'];
	    if(instance)
	    {
	        CKEDITOR.remove(instance);
	    }
	    CKEDITOR.replace( 'pageelement_edit_editor',{customConfig:'config-openrat.js'} );
	}
	
	// Wiki-Editor
	var markitupSettings = {	markupSet:  [ 	
	                        	     		{name:'Bold', key:'B', openWith:'*', closeWith:'*' },
	                        	    		{name:'Italic', key:'I', openWith:'_', closeWith:'_'  },
	                        	    		{name:'Stroke through', key:'S', openWith:'--', closeWith:'--' },
	                        	    		{separator:'-----------------' },
	                        	    		{name:'Bulleted List', openWith:'*', closeWith:'', multiline:true, openBlockWith:'\n', closeBlockWith:'\n'},
	                        	    		{name:'Numeric List', openWith:'#', closeWith:'', multiline:true, openBlockWith:'\n', closeBlockWith:'\n'},
	                        	    		{separator:'---------------' },
	                        	    		{name:'Picture', key:'P', replaceWith:'{[![Source:!:http://]!]" alt="[![Alternative text]!]" }' },
	                        	    		{name:'Link', key:'L', openWith:'""->"[![Link:!:http://]!]"', closeWith:'"', placeHolder:'Your text to link...' },
	                        	    		{separator:'---------------' },
	                        	    		{name:'Clean', className:'clean', replaceWith:function(markitup) { return markitup.selection.replace(/<(.*?)>/g, "") } },		
	                        	    		{name:'Preview', className:'preview',  call:'preview'}
	                        	    	]};
	$(viewEl).find('.wikieditor').markItUp(markitupSettings);
	
	// HTML-Editor
	var wymSettings = {lang: 'de',basePath: OR_THEMES_EXT_DIR+'../editor/wymeditor/wymeditor/',
			  toolsItems: [
			               {'name': 'Bold', 'title': 'Strong', 'css': 'wym_tools_strong'}, 
			               {'name': 'Italic', 'title': 'Emphasis', 'css': 'wym_tools_emphasis'},
			               {'name': 'Superscript', 'title': 'Superscript', 'css': 'wym_tools_superscript'},
			               {'name': 'Subscript', 'title': 'Subscript', 'css': 'wym_tools_subscript'},
			               {'name': 'InsertOrderedList', 'title': 'Ordered_List', 'css': 'wym_tools_ordered_list'},
			               {'name': 'InsertUnorderedList', 'title': 'Unordered_List', 'css': 'wym_tools_unordered_list'},
			               {'name': 'Indent', 'title': 'Indent', 'css': 'wym_tools_indent'},
			               {'name': 'Outdent', 'title': 'Outdent', 'css': 'wym_tools_outdent'},
			               {'name': 'Undo', 'title': 'Undo', 'css': 'wym_tools_undo'},
			               {'name': 'Redo', 'title': 'Redo', 'css': 'wym_tools_redo'},
			               {'name': 'CreateLink', 'title': 'Link', 'css': 'wym_tools_link'},
			               {'name': 'Unlink', 'title': 'Unlink', 'css': 'wym_tools_unlink'},
			               {'name': 'InsertImage', 'title': 'Image', 'css': 'wym_tools_image'},
			               {'name': 'InsertTable', 'title': 'Table', 'css': 'wym_tools_table'},
			               {'name': 'Paste', 'title': 'Paste_From_Word', 'css': 'wym_tools_paste'},
			               {'name': 'ToggleHtml', 'title': 'HTML', 'css': 'wym_tools_html'},
			               {'name': 'Preview', 'title': 'Preview', 'css': 'wym_tools_preview'}
			             ]
			          };
	//$(viewEl).find('.htmleditor').wymeditor(wymSettings);
	//resizeWorkbench();
	
	// Eingabefeld-Hints aktivieren...
	$(viewEl).find('input[data-hint]').orHint();
	
	// Untermenüpunkte aus der View in das Fenstermenü kopieren...
	$(viewEl).closest('div.frame').find('div.menu div.dropdown div.entry.perview').remove(); // Alte Einträge löschen
	
	$(viewEl).find('div.headermenu > a').each( function(idx,el)
	{
		// Jeden Untermenüpunkt zum Fenstermenü hinzufügen.
		$(el).wrap('<div class="entry clickable modal perview" />').parent().appendTo( $(viewEl).closest('div.frame').find('div.menu div.dropdown').first() );
	} );
	
	$(viewEl).find('div.header > a.back').each( function(idx,el)
	{
		// Zurück-Knopf zum Fenstermenü hinzufügen.
		$(el).removeClass('button').wrap('<div class="entry perview" />').parent().appendTo( $(viewEl).closest('div.frame').find('div.menu div.dropdown').first() );
	} );
	$(viewEl).find('div.header').html('<!-- moved to window-menu -->');
	
	$(viewEl).find('input,select,textarea').focus( function() {
		$(this).closest('div.frame').find('div.command').css('visibility','visible').fadeIn('slow');
	});

	$(viewEl).find('fieldset.open > legend').click( function() {
		$(this).parent().find('div').first().toggleClass('invisible');
	});

	// Links aktivieren...
	$(viewEl).closest('div.frame').find('.clickable').orLinkify();

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
	
	// Drag n Drop für Inhaltselemente (Dateien,Seiten,Ordner,Verknuepfungen)
	$('div.content li.object').draggable( {cursor:'move',revert: 'invalid' });
	$('div.content li.object > div.entry[data-type=\'folder\']').droppable( {accept:'li.object',hoverClass: 'drophover',activeClass: 'dropactive',drop: function(event, ui) {
		var dropped   = ui.draggable;
        var droppedOn = $(this).parent();
        
        //alert('Moving '+$(dropped).attr('data-id')+' to folder '+$(droppedOn).attr('data-id') );
        /*
        if	( $(dropped).closest('div.frame').attr('id') == $(droppedOn).closest('div.frame').attr('id') )
        	$(dropped).css({top: 0,left: 0}); // Nicht auf das eigene Fenster fallen lassen.
        else
        	$(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn).click();
        	*/
    	//$(dropped).css({top: 0,left: 0}); // Nicht auf das eigene Fenster fallen lassen.
    	$(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn).click();
	} } );

	// Alle Checkboxen setzen oder nicht setzen.
	$(viewEl).find('tr.headline > td > input.checkbox').click( function() {
		$(this).closest('table').find('tr.data > td > input.checkbox').attr('checked',Boolean( $(this).attr('checked') ) );
	});
	
	$(viewEl).find('textarea').orAutoheight();

}



function registerHeaderEvents()
{
	// Links aktivieren...
	$('div#title').find('.clickable').orLinkify();
	
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
	$(element).closest('div.window').fadeOut('fast', function()
	{
		$(this).toggleClass('fullscreen').fadeIn('fast');
	} );
}

function loadTree()
{
	// Nur, wenn ein Baum auch angezeigt werden soll.
	if	( $('div#tree li.action').data('action')=='tree' )
	{
		// Oberstes Tree-Element erzeugen
		$('div#tree div.window div.content > div.sheet.action-tree.method-tree').html("&nbsp;");
		
		// Wurzel des Baums laden
		//loadBranch( $('div#tree ul.tree > li'),'root',0);
		$('div#tree div.content > div.sheet.action-tree.method-tree').orTree( { type:'root',id:0,onSelect:function(name,type,id) {
			openNewAction( name,type,id, '' );
		} });
		
		// Die ersten 2 Hierarchien öffnen:
		$('div#tree div.content > div.sheet.action-tree.method-tree > ul.tree > div.tree').delay(500).click();
		$('div#tree div.content > div.sheet.action-tree.method-tree > ul.tree > div.tree').delay(500).click();
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
			$('div.window div.status div.loader').html('&nbsp;');
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
	var action = $(element).closest('div.frame').find('li.active').data('action');
	var id     = $(element).closest('div.frame').find('li.active').data('id'    );
	
	loadView( $(element).closest('div.frame').find('div.content'), action,method,id );
	
	// Alle refresh-fähigen Views mit dem neuen Objekt laden.
	// refreshAllRefreshables();
}


/**
 * Setzt neuen modalen Dialog und aktualisiert alle Fenster.
 * @param element
 * @param action Action
 * @param id Id
 */
function startDialog( element,method,action,modal )
{
	var action = $(element).closest('div.frame').find('li.active').data('action');
	var id     = $(element).closest('div.frame').find('li.active').data('id'    );
	
	$('div#filler').fadeTo(500,0.5);
	//$('div#dialog').html('<div class="frame" data-action="'+action+'" data-method="'+method+'" data-id="'+id+'"><div class="window"><div class="content" /></div></div>');
	$('div#dialog').html('<div class="frame"><div class="window"><div class="content" /></div></div>');
	$('div#dialog').show();
	
	loadView( $('div#dialog div.content'), action,method,id );
	
	//$('div#workbench div.frame.modal').parent().addClass('modal');
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
	var action = $(element).closest('div.frame').find('li.active').attr('data-action');
	var method = $(element).closest('div.frame').find('li.active').attr('data-method');
	var id     = $(element).closest('div.frame').find('li.active').attr('data-id'    );
	$(element).closest('div.content').modal( { "overlayClose":"true","xxxonClose":function(){alert("close)");} } );
	loadView( $(element).closest('div.content'), action, method,id );
	
	// Alle refresh-fähigen Views mit dem neuen Objekt laden.
	// refreshAllRefreshables();
}


/**
 * Setzt neue Action und aktualisiert alle Fenster.
 * 
 * @param action Action
 * @param id Id
 */
function openNewAction( name,action,id,extraId )
{
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
	$('div#content > div.window > div.menu > div.views > ul.views li.active').removeClass('active');
	
	// Tab schon vorhanden?
	if	( $('div#content > div.window > div.menu > div.views > ul.views  li.'+action+'.id'+id).length > 0 )
	{
		// Ja, Tab schon vorhanden
		// Gewünschtes Tab aktiv setzen
		$('div#content > div.window > div.menu > div.views > ul.views li.'+action+'.id'+id).addClass('active');
	}
	else
	{	
		// Neuen Tab in Hauptfenster anlegen
		$('div#content > div.window > div.menu > div.views > ul.views li.active').removeClass('active');
		
		// Wenn max. Anzahl überschritten, dann den ersten entfernen.
		var maxTabs = 7;
		if	( $('div#content > div.window > div.menu > div.views > ul.views > li.action').size() >= maxTabs )
			$('div#content > div.window > div.menu > div.views > ul.views > li.action').first().remove();
				
		$('div#content > div.window > div.menu > div.views > ul.views').append('<li class="action active '+action+' id'+id+'" title="'+name+'" data-action="'+action+'"  data-id="'+id+'" data-method="'+DEFAULT_CONTENT_ACTION+'"><img class="icon" src="'+OR_THEMES_EXT_DIR+'default/images/icon_'+action+'.png" title="" /><div class="tabname">'+name+'</div><img class="close icon" src="'+OR_THEMES_EXT_DIR+'default/images/icon/close.gif" title="" /></li>');
		resizeTabs( $('div#contentbar'),true);
		$('div#content > div.window > div.menu > div.views > ul.views').scrollLeft(9999);
		$('div#content > div.window > div.menu > div.views > ul.views img.close').click( function()
				{
					// Schließen
					// Wenn aktiver Tab, dann den Inhalt loeschen
					if	( $(this).closest('li.action').hasClass('active') )
					{
						//$(this).closest('div.window').find('div.content').html(''); // Inhalt entfernen
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
					
					resizeTabs( $('div#contentbar'),true);
				} );
		$('div#content > div.window > div.menu > div.views > ul.views li.active').click( function()
			{
				// Action-Tab wurde angeklickt
				$('div#content > div.window > div.menu > div.views > ul.views li.active').removeClass('active'); // Andere Tabs auf inaktiv setzen
				$(this).addClass('active'); // Angeklicktes Tab auf aktiv setzen
				
				// Zum angeklickten Tab scrollen
				//$('div#content > div.window > div.menu > div.views > ul.views').scrollTo(this);
			
				setNewAction(action,id,extraId);
			} );
		
		/*
		 * Eventhandler hängt schon auf div.menu
		$('div#content > div.window > div.menu > div.views > ul.views li.active').dblclick( function()
				{
					fullscreen( this );
				} );
				*/

	}
	
	// Zum angeklickten Tab scrollen
	
	//$('div#content > div.window > div.menu > div.views > ul.views').scrollTo(this);
	setNewAction( action,id,extraId );
}


/**
 * Setzt neue Action und aktualisiert alle Fenster.
 * 
 * @param action Action
 * @param id Id
 */
function setNewAction( action,id,extraId )
{
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




function submitLink(element,data)
{
	var params = jQuery.parseJSON( data );
	var url = './dispatcher.php';
	params.output = 'json';
	$.ajax( { 'type':'POST',url:url, data:params, success:function(data, textStatus, jqXHR)
		{
		$('div.window div.status div.loader').html('&nbsp;');
		doResponse(data,textStatus,element);
		} } );
	
}

function formSubmit(form)
{
	// Login-Hack
	if ( $('div.window form input[type=password]').length>0 )
	{
		$('#uname'    ).attr('value',$('div.window form input[name=login_name]'    ).attr('value'));
		$('#upassword').attr('value',$('div.window form input[name=login_password]').attr('value'));
		
		$('#uname'    ).closest('form').submit();
	}
	
	if ( $('#pageelement_edit_editor').length>0 )
	{
		var instance = CKEDITOR.instances['pageelement_edit_editor'];
	    if(instance)
	    {
	        var value = instance.getData();
	        $('#pageelement_edit_editor').html( value );
	    }
	}
	

	
	
	var status = $(form).parent().parent().parent().find('div.bottom div.status');
	
	$(status).html('<div class="loader" />');
	
	// Alle vorhandenen Error-Marker entfernen.
	// Falls wieder ein Fehler auftritt, werden diese erneut gesetzt.
	$(form).find('.error').removeClass('error');

	var params = $(form).serializeArray();
	var url    = './dispatcher.php'; // Alle Parameter befinden sich im Formular
	
	var method = $(form).attr('method').toUpperCase();
	
	if	( method == 'GET' )
	{
		var method  = $(form).closest('div.frame').attr('data-method');
		var p       = $(form).closest('div.frame');
		var action  = p.attr('data-action');
		var id      = p.attr('data-id');
		params.output = 'html';
		//alert(method+'/'+action+'/'+id);
		loadView(  $(form).closest('div.content'),createUrl(action,method,id,params));
	}
	else
	{
		$(form).closest('div.content').addClass('loader');
		url += '?output=json';
		params['output'] = 'json';// Irgendwie geht das nicht.
		$.ajax( { 'type':'POST',url:url, data:params, success:function(data, textStatus, jqXHR)
			{
				$(form).closest('div.content').removeClass('loader');
				$(status).find('div.loader').remove();
				doResponse(data,textStatus,form);
			},
			error:function(jqXHR, textStatus, errorThrown) {
				$(form).closest('div.content').removeClass('loader');
				$(status).find('div.loader').remove();
				
				var msg;
				try
				{
					var error = jQuery.parseJSON( jqXHR.responseText );
					msg = error.error + '/' + error.description + ': ' + error.reason;
				}
				catch( e )
				{
					msg = jqXHR.responseText;
				}
				
				// Notice-Bar mit dieser Meldung erweitern.
				var notice = $('<div class="notice error"><div class="text">'+msg+'</div></div');
				$('#noticebar').prepend(notice); // Notice anhängen.
				
				// Per Klick wird die Notice entfernt.
				$(notice).fadeIn().click( function()
				{
					$(this).fadeOut('fast',function() { $(this).remove(); } );
				} );
				
			}
			
		} );
		$(form).fadeIn();
	}
}


/**
 * HTTP-Antwort auf einen POST-Request auswerten.
 * 
 * @param data Formulardaten
 * @param status Status
 * @param element
 */
function doResponse(data,status,element)
{
	if	( status != 'success' )
	{
		alert('Server error: ' + status);
		return;
	}
	
	// Hinweismeldungen in Statuszeile anzeigen
	$.each(data['notices'], function(idx,value) {
		
		// Notice-Bar mit dieser Meldung erweitern.
		var notice = $('<div class="notice '+value.status+'"><div class="text">'+value.text+'</div></div');
		$.each(value.log, function(name,value) {
			$(notice).append('<div class="log">'+value+'</div>');
		});
		$('#noticebar').prepend(notice); // Notice anhängen.
		
		// Per Klick wird die Notice entfernt.
		$(notice).fadeIn().click( function()
		{
			$(this).fadeOut('fast',function() { $(this).remove(); } );
		} );
		
		var timeoutSeconds;
		if	( value.status == 'ok' )
			timeoutSeconds = 3;
		else
			timeoutSeconds = 8;
		
		// Und nach einem Timeout entfernt sich die Notice von alleine.
		setTimeout( function() { $(notice).fadeOut('slow').remove(); },timeoutSeconds*1000 );
	});
	
	$.each(data['errors'], function(idx,value) {
		$('input[name='+value+']').addClass('error');
		$('input[name='+value+']').parent().addClass('error');
	});
	
	// Jetzt das erhaltene Dokument auswerten.
	
	// Hinweismeldungen in Statuszeile anzeigen
	if	( ! data.control ) {
		/*
		$('div.window div.status').html('<div />');
		$('div.window div.status div').append( data );
		$('div.window div.status div').delay(3000).fadeOut(2500);
		*/
		//alert( value.text );
	};
	
	
	if	( data.control.redirect )
		// Redirect
		window.location.href = data.control.redirect;
	
	if	( data.control.new_style )
		// CSS-Datei setzen
		setUserStyle( data.control.new_style );
	
	if	( data.control.refresh )
		// Views aktualisieren
		refreshAll();
	
	else if	( data.control.next_view )
		// Nächste View aufrufen
		startView( $(element).closest('div.content'),data.control.next_view );
	
	else if ( data.errors.length==0 )
		// Aktuelle View neu laden
		$(element).closest('div.frame').find('li.action.active').orLoadView();

}



function setUserStyle( url )
{
	$('#userstyle').attr('href',url);
}


/*
$(function(){ //Document ready shorthand

var $search = $('#search');//Cache the element for faster DOM searching since we are using it more than once
original_val = $search.val(); //Get the original value to test against. We use .val() to grab value="Search"
$search.focus(function(){ //When the user tabs/clicks the search box.
	if($(this).val()===original_val){ //If the value is still the default, in this case, "Search"
		$(this).val('');//If it is, set it to blank
	}
})
.blur(function(){//When the user tabs/clicks out of the input
	if($(this).val()===''){//If the value is blank (such as the user clicking in it and clicking out)...
		$(this).val(original_val); //... set back to the original value
	}
});

});

 */






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
	//   E d i t o r
	var editorConfig = {
			skin : 'v2',
			baseHref: OR_THEMES_EXT_DIR+'../editor/editor/',
			customConfig : 'config-openrat.js',
			filebrowserUploadUrl:'./dispatcher.php?action=filebrowser&subaction=directupload&name=upload',
			filebrowserBrowseUrl:'./dispatcher.php?action=filebrowser&subaction=browse'
	};
	
	var main = $(el).parent().parent().parent('div.window').children('div.content').first();
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



function loadWindow( el, actionName, subactionName )
{

	// Zeichnet das Fenster-Gerüst, erstmal ohne Inhalt.
	$(el).html('<div class="window"><div class="title"></div><ul class="menu"></div><div class="content"></div><div class="status"></div></div>');

	// Icon
	$(el).find('div.title').html('<img src="'+image_dir+'icon_'+icon+'.'+IMG_ICON_EXT+'" align="left" />');

	/* Pfad
			<span class="path"><?php echo langHtml($actionName) ?></span>&nbsp;<strong>&rarr;</strong>&nbsp;
				<a javascript:void(0);" onclick="javascript:loadViewByName('<?php echo $view ?>','<?php echo $url ?>'); return false; " title="<?php echo $title ?>" class="path"><?php echo (!empty($key)?langHtml($key):$name) ?></a>
				&nbsp;&rarr;&nbsp;
			<?php } ?>
			<span class="title"><?php echo langHtml(@$windowTitle) ?></span>
	 */

	
	/*
	 * Menü
		if	( !isset($windowMenu) || !is_array($windowMenu) ) $windowMenu = array();
	    foreach( $windowMenu as $menu )
	          {
	          	$tmp_text = langHtml($menu['text']);
	          	$tmp_key  = strtoupper(langHtml($menu['key' ]));
				$tmp_pos = strpos(strtolower($tmp_text),strtolower($tmp_key));
				if	( $tmp_pos !== false )
					$tmp_text = substr($tmp_text,0,max($tmp_pos,0)).'<span class="accesskey">'. substr($tmp_text,$tmp_pos,1).'</span>'.substr($tmp_text,$tmp_pos+1);

				$liClass  = (isset($menu['url'])?'':'no').'action'.($this->subActionName==$menu['subaction']?'_active':'');
				$icon_url = $image_dir.'icon/'.$menu['subaction'].'.png';
				
				?><li class="<?php echo $liClass?>"><?php
	          	if	( isset($menu['url']) )
	          	{
	          		$link_url = Html::url($actionName,$menu['subaction'],$this->getRequestId() );
	          		?><a href="javascript:void(0);" onclick="javascript:loadViewByName('<?php echo $view ?>','<?php echo $link_url ?>'); return false; " accesskey="<?php echo $tmp_key ?>" title="<?php echo langHtml($menu['text'].'_DESC') ?>"><img src="<?php echo $icon_url ?>" /><?php echo $tmp_text ?></a><?php
	          	}
	          	else
	          	{
	          		?><span><img src="<?php echo $icon_url ?>" /><?php echo $tmp_text ?></span><?php
	          	}
	          }
	          	?></li><?php
	 */

	/*
	 * Hilfe
	 * if ( false && @$conf['help']['enabled'] )
	          	{
	             ?><a class="help" href="<?php echo $conf['help']['url'].$actionName.'/'.$subActionName.@$conf['help']['suffix'] ?> " target="_new" title="<?php echo langHtml('MENU_HELP_DESC') ?>"><img src="<?php echo $image_dir.'icon/help.png' ?>" /><?php echo @$conf['help']['only_question_mark']?'?':langHtml('MENU_HELP') ?></a><?php
	          	}
	          	?><?php
	          	*/
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
	
	var horizontal = container.hasClass('axle-x');
	
	if	( horizontal )
	{
		// Container ist horizontal geteilt.
		var size = Math.floor(availableWidth * factor);
		container.find('div.resizable > div.frame > div.window').css('width',''+size                   +'px');
		container.find('div.resizable > div.frame > div.window > div.content').css('height',''+(availableHeight-27)+'px');
		container.find('div.autosize  > div.frame > div.window').css('width',''+(availableWidth-size-9)+'px');
		container.find('div.autosize  > div.frame > div.window > div.content').css('height',''+(availableHeight-27)+'px');

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
		container.find('div.resizable > div.frame > div.window').css('width',''+availableWidth +'px');
		container.find('div.resizable > div.frame > div.window > div.content').css('height',''+(size-27)+'px');
		container.find('div.autosize  > div.frame > div.window').css('width',''+availableWidth  +'px');
		container.find('div.autosize  > div.frame > div.window > div.content').css('height',''+(availableHeight-size-27)+'px');
		
		container.children('div.resizable').css('width',''+availableWidth +'px');
		container.children('div.resizable').css('height',''+size+'px');
		container.children('div.autosize').css('width',''+availableWidth+'px');
		container.children('div.autosize').css('height',''+(availableHeight-size-20)+'px');

		container.children('div.divider').css('width',''+availableWidth+'px');
	}

	container.children('div.bar').each( function()
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
	
	var container = $('div#workbench > div.container')
	
	// Verfügbare Breite der Workbench ist Fensterbreite - Innenabstand der Workbench (2*3px)
	container.css('width' ,''+viewportWidth-6+'px');
	
	// Verfügbare Höhe   der Workbench ist Fensterhöhe - Höhe der Titelleiste - Innenabstand der Workbench (2*3px)
	container.css('height',''+(viewportHeight-61)+'px');
	
	resizeWorkbenchContainer( container );
}


/**
 * Größe der TABs pro Frame neu berechnen.
 */
function resizeTabs( bar ) 
{
	var tabCount = $(bar).find('div.views li.action').size();
	//alert("Breite ist"+$(bar).width()+ " und Count ist "+tabCount + " sind "+(($(bar).width()-50)/tabCount));
	var tabWidth = Math.min(90,Math.max(30,(($(bar).width()-60)/tabCount)-15 ));
	$(bar).find('li.action div.tabname').width(tabWidth);
}


function help(el,url,suffix)
{
	var method = $(el).closest('div.frame').find('li.action.active').attr('data-method');
	var action = $(el).closest('div.frame').attr('data-action');
	
	window.open(url + action + '/'+ method + suffix, 'OpenRat_Help', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');
}