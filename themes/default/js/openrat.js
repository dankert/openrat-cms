
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
	window.console && console.log("session-ping");
}



function refreshAll()
{
	//$('ul#history').sortable();
	
	refreshTitleBar();
	refreshWorkbench();
}


function refreshAllRefreshables() {
	
	// Default-Inhalte der einzelnen Views laden.
	$('div#workbench div.refreshable li.active').each( function() {
		var method  = $(this).attr('data-method');
		var p       = $(this).closest('div.frame');
		
		var action  = p.attr('data-action');
		var id      = p.attr('data-id');
		var extraid = p.attr('data-extra');
		//alert(method+' '+action);
		
		loadView( p.find('div.content'),createUrl(action,method,id,extraid));
	});
	
}



function refreshActualView(element) {

	// Default-Inhalte der einzelnen Views laden.
	$(element).closest('div.frame').find('li.active').each( function() {
		var method = $(this).attr('data-method');
		var p = $(this).closest('div.frame');
		var action = p.attr('data-action');
		var id     = p.attr('data-id');
		//alert(method+' '+action);
		
		
		loadView( p.find('div.content'),createUrl(action,method,id));
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
			var p = $(this).closest('div.frame');
			var action = p.attr('data-action');
			//alert(method+' '+action);
			
			
			//alert('go2');
			loadView( p.find('div.content'),createUrl(action,method,0));
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
			//alert("klicke auf "+$(this).html() );
			var method = $(this).attr('data-method');
			var p = $(this).closest('div.frame');
			var action = p.attr('data-action');
			var id     = p.attr('data-id');
			p.find('ul.views li.active').removeClass('active');
			$(this).addClass('active');
			loadView( p.find('div.content'),createUrl(action,method,id));
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
	loadView( $('div#'+viewName),url );
}

function loadView(jo, url )
{
	//alert("Lade "+url + " in Objekt "+jo);
	//   E d i t o r
	var editorConfig = {
			skin : 'v2',
			baseHref: OR_THEMES_EXT_DIR+'../editor/editor/',
			customConfig : 'config-openrat.js',
			filebrowserUploadUrl:'./dispatcher.php?action=filebrowser&subaction=directupload&name=upload',
			filebrowserBrowseUrl:'./dispatcher.php?action=filebrowser&subaction=browse'
	};

	/*
	if	( $(jo).find('textarea#pageelement_edit_editor').size() > 0 )
	{
	var o=CKEDITOR.instances[ $('textarea.editor').attr('name') ];
	if (o) o.destroy();
	}
	*/

	// Untermenü ermitteln.
	var submenu = "";
	var action = $(jo).closest("div.frame").attr("data-action");
	var method = $(jo).closest("div.frame").find("li.active").attr("data-method");

	/*
	 * 
	var menuEntries = menus[action];
	if	( menuEntries != null )
	{
	}
	 */
		
	//alert(action+"_"+method);
	
	$(jo).empty().fadeTo(1,0.7).html('<div class="loader" />'+submenu).load(url,function(response, status, xhr) {
			//$(jo).slideDown('fast');
			$(jo).fadeTo(350,1);
			
			if	( status == "error" )
			{
				// Seite nicht gefunden.
				$(this).html("");
				// OK-button Ausblenden.
				$(jo).closest('div.frame').find('div.bottom > div.command > input').addClass('invisible');
				// var msg = "Sorry but there was an error: ";
				//$(this).html(msg + xhr.status + " " + xhr.statusText);
				return;
			}

			//alert("o ist "+o);
			//$('textarea.editor').ckeditor( function() { /*alert("editor ready");*/ /* callback code */ }, editorConfig );
			//CKEDITOR.replace('text',{
		    //    customConfig : 'config-openrat.js'
		    //});
			
			var $formVorhanden = $(jo).find('form').size() > 0;
			var $formInput     = $(jo).closest('div.frame').find('div.bottom > div.command > input')
			if	( $formVorhanden )
				$formInput.removeClass('invisible');
			else
				$formInput.addClass('invisible');

			if ( $('div.window form input[type=password]').length>0 )
			{
				$('div.window form input[name=login_name]    ').attr('value',$('#uname'    ).attr('value'));
				$('div.window form input[name=login_password]').attr('value',$('#upassword').attr('value'));
			}
				//$.get( createUrl('login','ping',0) );
			//alert( "user: "+$('#uname').attr('value') );
			//alert( "up: "+$('#upassword').attr('value') );
			
			// Fokus nicht setzen, da mehrere Views sich sonst um den Fokus streiten.
			//$(jo).find('input.focus').focus();
			
			// Sortieren von Tabellen
			$(jo).find('table.sortable > tbody').sortable({
				   update: function(event, ui)
				   {
						var order = [];
						$(ui.item).closest('table.sortable').find('tbody > tr.data').each( function() {
							var objectid = $(this).data('id').substring(2);
							order.push( objectid );
						});
						var url    = './dispatcher.php';
						var params = {};
						params.action    = 'folder';
						params.subaction = 'order';
						params.token     = $('#id_token').attr('value');
						params.order     = order.join(',');
						
						$.ajax( { 'type':'POST',url:url, data:params, success:function(data, textStatus, jqXHR)
							{
								doResponse(data,textStatus,form);
							},
							error:function(jqXHR, textStatus, errorThrown) {
								alert( errorThrown );
							}
							
						} );
				   }
			});
			
			if	( $(jo).find('textarea#pageelement_edit_editor').size() > 0 )
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
			$(jo).find('.wikieditor').markItUp(markitupSettings);
			
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
			//$(jo).find('.htmleditor').wymeditor(wymSettings);
			//resizeWorkbench();
			
			// Eingabefeld-Hints aktivieren...
			$(jo).find('input[data-hint]').orHint();
			
			// Untermenüpunkte aus der View in das Fenstermenü kopieren...
			$(jo).closest('div.frame').find('div.menu div.dropdown div.entry.perview').remove(); // Alte Einträge löschen
			
			$(jo).find('div.headermenu > a').each( function(idx,el)
			{
				// Jeden Untermenüpunkt zum Fenstermenü hinzufügen.
				$(el).wrap('<div class="entry clickable perview" />').parent().appendTo( $(jo).closest('div.frame').find('div.menu div.dropdown').first() );
			} );
			
			$(jo).find('div.header > a.back').each( function(idx,el)
			{
				// Zurück-Knopf zum Fenstermenü hinzufügen.
				$(el).removeClass('button').wrap('<div class="entry perview" />').parent().appendTo( $(jo).closest('div.frame').find('div.menu div.dropdown').first() );
			} );
			$(jo).find('div.header').html('<!-- moved to window-menu -->');
			
			$(jo).find('input,select,textarea').focus( function() {
				$(this).closest('div.frame').find('div.command').css('visibility','visible').fadeIn('slow');
			});

			$(jo).find('fieldset.open > legend').click( function() {
				$(this).parent().find('div').first().toggleClass('invisible');
			});

			// Links aktivieren...
			$(jo).closest('div.frame').find('.clickable').orLinkify();
		});
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
	if	( $('div#tree').attr('data-action')=='tree' )
	{
		// Oberstes Tree-Element erzeugen
		$('div#tree div.window div.content').html("&nbsp;");
		//$('div#tree div.window div.content').append('<ul class="tree"><li class="root"><div>Baum</div></li></ul>');
		
		// Wurzel des Baums laden
		//loadBranch( $('div#tree ul.tree > li'),'root',0);
		loadBranch( $('div#tree div.content'),'root',0);
		$('div#tree div.content > ul.tree > li > div.tree').delay(500).click();
	}
}


/**
 * Zweig laden.
 * @param li JQuery-Objekt, in welches der Inhalt des neuen Zweiges geladen werden soll.
 * @param type Typ
 * @param id Id
 * @return
 */
function loadBranch(li,type,id)
{
	//alert("hier rein: "+$(li).html() );
	$.getJSON('./dispatcher.php?action=tree&subaction=loadBranch&id='+id+'&type='+type, function(json) {
		$(li).append('<ul class="tree" style="display:none;"/>');
		//alert("öffne: "+$(li).html()+"                     neu: "+$(li).html());
		var ul = $(li).children('ul').first();
		$.each(json['branch'],function(idx,line)
		{
			//var img = (line.url!==undefined?'tree_plus':'tree_none');
			$(ul).append( '<li><div class="tree">&nbsp;</div><div class="entry" title="'+ line.description + '"><img src="'+OR_THEMES_EXT_DIR+'default/images/icon_'+line['icon']+'.png" />'+ line.text + '</div></li>' );
			var new_li = $(ul).children('li').last();
			//$(new_li).children('div').unbind('click');
			if ( line.type )
			{
				$(new_li).children('div.tree').addClass('closed');
				$(new_li).children('div.tree').click( {},function(e) {loadBranch( $(e.target).parent(),line.type,line.internalId) }); // Zweig öffnen
			}
			
			if	( line.action )
			{
				// Onclick-Handler für auswählbare Objekte setzen
				$(new_li).children('div.entry').click( function() {
					//loadViewByName('content',line.url.replace(/&amp;/g,'&'));
					//var url = './dispatcher.php';
					//$.ajax( { 'type':'POST',url:url, data:{'action':'tree','subaction':'select','id':line.id,'type':line.type},success:function(data, textStatus, jqXHR)
//						{
//							doResponse(data,textStatus);
//						} } );
					// Den Objekt-Typ und die Objekt-Id für alle Views setzen (die dies zulassen)

					// Neue Action starten.
					$('div#tree div.entry').removeClass('selected');
					$(this).addClass('selected');
					openNewAction( $(this).text(), line.action, line.id, line.extraId );
				});
				
				// Drag and drop für die Baum-Inhalte.
				//$(new_li).children('div.entry').draggable( {cursor:'move',revert: 'invalid' });
			}
				
		});
		//$(ul).children('li:last-child').addClass('last');
		$(ul).slideDown('fast'); // Einblenden
	});
	
	$(li).children('div.tree').unbind('click');
	$(li).children('div.tree').removeClass('closed').addClass('open');
	$(li).children('div.tree').click( function(e) { closeBranch($(e.target).parent(),type,id) } );
	//$(li).children('img.tree').attr('src',OR_THEMES_EXT_DIR+'default/images/tree_minus.gif');
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
function startView( element,view )
{
	//alert( "startView: "+$(element).html() );
	var action = $(element).closest('div.frame').attr('data-action');
	var id     = $(element).closest('div.frame').attr('data-id'    );
	var url    = createUrl(action, view, id);
	//alert( "startView: "+action+"/"+view+"#"+id );
	loadView( $(element).closest('div.frame').find('div.content'), url );
	
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
	//alert( "startView: "+$(element).html() );
	var action = $(element).closest('div.frame').attr('data-action');
	var id     = $(element).closest('div.frame').attr('data-id'    );
	var url    = createUrl(action, view, id);
	$(element).closest('div.content').modal( { "overlayClose":"true","xxxonClose":function(){alert("close)");} } );
	loadView( $(element).closest('div.content'), url );
	
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
				
		$('div#content > div.window > div.menu > div.views > ul.views').append('<li class="action active '+action+' id'+id+'" title="'+name+'" data-method="'+DEFAULT_CONTENT_ACTION+'"><img class="icon" src="'+OR_THEMES_EXT_DIR+'default/images/icon_'+action+'.png" title="" /><div class="tabname">'+name+'</div><img class="close icon" src="'+OR_THEMES_EXT_DIR+'default/images/icon/close.gif" title="" /></li>');
		resizeTabs( $('div#contentbar'),true);
		$('div#content > div.window > div.menu > div.views > ul.views').scrollLeft(9999);
		$('div#content > div.window > div.menu > div.views > ul.views img.close').click( function()
				{
					// Schließen
					// Wenn aktiver Tab, dann den Inhalt loeschen
					if	( $(this).closest('li.action').hasClass('active') )
						$(this).closest('div.window').find('div.content').html(''); // Inhalt entfernen
					// Und jetzt den Tab entfernen
					$(this).parent().remove(); // Tab entfernen
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
	$('div#workbench div.refreshable').attr('data-action',action).attr('data-id',id).attr('data-extra',JSON.stringify(extraId));
	
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
 * 
 * @param li JQuery-Objekt
 * @return
 */
function closeBranch(li,type,id)
{
	//alert("schließen:"+$(li).html() );
	$(li).children('ul').slideUp('fast', function() {
		
		$(li).children('ul').remove();
		$(li).children('div.tree').unbind('click');
		$(li).children('div.tree').removeClass('open').addClass('closed');
		//alert( "wieder öffnen: "+$(li).children('div').first().html());
		$(li).children('div.tree').click( function() { loadBranch($(this).parent(),type,id) });
		//$(li).children('img.tree').attr('src',OR_THEMES_EXT_DIR+'default/images/tree_plus.gif');
	} );
}


function submitLink(element,data)
{
	var params = jQuery.parseJSON( data );
	var url = './dispatcher.php';
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
		//alert(method+'/'+action+'/'+id);
		loadView(  $(form).closest('div.content'),createUrl(action,method,id,params));
	}
	else
	{
		$.ajax( { 'type':'POST',url:url, data:params, success:function(data, textStatus, jqXHR)
			{
				$(status).find('div.loader').remove();
				doResponse(data,textStatus,form);
			},
			error:function(jqXHR, textStatus, errorThrown) {
				$(status).find('div.loader').remove();
				alert( 'OpenRat: Error while performing the POST request: ' + errorThrown );
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
		$('#noticebar').prepend(notice);
		$('#noticebar div.notice').fadeIn();
		$(notice).fadeIn().click( function()
		{
			$(this).fadeOut('fast',function() { $(this).remove(); } );
		} );
		
		var timeoutSeconds;
		if	( value.status == 'ok' )
			timeoutSeconds = 2;
		else
			timeoutSeconds = 8;
			
		
		$(notice).delay(timeoutSeconds*1000).fadeOut( function() { $(this).remove(); } );
		
		/*
		$('div.window div.status').html('<div />');
		$('div.window div.status div').addClass( value.status );
		$('div.window div.status div').append( value.text );
		$('div.window div.status div').delay(3000).fadeOut(2500, function() { $(this).remove(); });
		*/
		//alert( value.text );
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
	
	
	// Redirect
	if	( data.control.redirect )
		window.location.href = data.control.redirect;

	// Views aktualisieren
	if	( data.control.refresh )
		refreshAll();
	
	// CSS-Datei setzen
	if	( data.control.new_style )
		setUserStyle( data.control.new_style );
	
	// Nächste View aufrufen
	if	( data.control.next_view )
		startView( $(element).closest('div.content'),data.control.next_view );
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
 * Fenstergröße wurde verändert, nun die Größe der DIVs neu berechnen.
 */
function resizeWorkbench()
{
	// Größe des Anzeige-Bereiches im Browser ermitteln.
	var viewportWidth  = $(window).width();
	var viewportHeight = $(window).height();
	
	// OpenRat-spezifische Ermittlung der einzelnen DIV-Größen
	var titleBarHeight = 55; // Title:35px
	var viewBorder     = 33; // Padding 2x3px, Rand 2x1px, View-Kopf:25px
	var singleHeight = viewportHeight - titleBarHeight - viewBorder;
	var upperHeight  = Math.ceil((viewportHeight - titleBarHeight - viewBorder)*(2/3));
	var lowerHeight  = viewportHeight - upperHeight - titleBarHeight - (2*viewBorder);
	
	var outerWidth = Math.floor(viewportWidth/4);
	var innerWidth = viewportWidth-(3*8)-(2*outerWidth);
	$('div#workbench > div#navigationbar > div.frame > div.window').css('width',outerWidth+'px');
	resizeTabs( $('div#navigationbar'),false);
	$('div#workbench > div#contentbar    > div.frame > div.window').css('width',innerWidth+'px');
	resizeTabs( $('div#contentbar'),true);
	$('div#workbench > div#sidebar       > div.frame > div.window').css('width',outerWidth+'px');
	resizeTabs( $('div#sidebar'),false);
	$('div#workbench > div#bottombar     > div.frame > div.window').css('width',(outerWidth+innerWidth+8)+'px');
	resizeTabs( $('div#bottombar'),false);

	$('div#workbench > div#navigationbar > div.frame > div.window > div.content').css('height',singleHeight+'px');
	$('div#workbench > div#contentbar    > div.frame > div.window > div.content').css('height',upperHeight +'px');
	$('div#workbench > div#sidebar       > div.frame > div.window > div.content').css('height',upperHeight +'px');
	$('div#workbench > div#bottombar     > div.frame > div.window > div.content').css('height',lowerHeight +'px');
}


/**
 * Größe der TABs pro Frame neu berechnen.
 */
function resizeTabs( el, closable ) 
{
	var windowsize = parseInt($(el).find('div.frame > div.window').css('width'));
	var count = $(el).find('ul.views > li').size();
	var width = Math.floor(Math.min(((windowsize-24)/count)-(closable?24:0)-24-8-1,100));
	$(el).find('li.action div.tabname').css('width',width+'px');
}


function help(el,url,suffix)
{
	var method = $(el).closest('div.frame').find('li.action.active').attr('data-method');
	var action = $(el).closest('div.frame').attr('data-action');
	
	window.open(url + action + '/'+ method + suffix, 'OpenRat_Help', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');
}