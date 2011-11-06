

$(document).ready(function()
{
	
	refreshAll();
	
});



function refreshAll()
{

	refreshHeader();
	refreshWorkbench();
}


function refreshAllRefreshables() {

	// Default-Inhalte der einzelnen Views laden.
	$('div#workbench div.refreshable li.active').each( function() {
		var method = $(this).attr('data-method');
		var p = $(this).parent().parent().parent().parent().parent();
		var action = p.attr('data-action');
		var id     = p.attr('data-id');
		//alert(method+' '+action);
		
		
		//alert('go2');
		loadView( p.find('div.filler'),createUrl(action,method,id));
	});

}



/**
 * Lade die Workbench neu.
 */
function refreshWorkbench()
{
	// Workbench laden
	$('div#workbench').empty().load(createUrl('workbench','show',0),null,function() {
		
		// Default-Inhalte der einzelnen Views laden.
		$(this).fadeIn('fast').find('li.active').each( function() {
			var method = $(this).attr('data-method');
			var p = $(this).parent().parent().parent().parent().parent();
			var action = p.attr('data-action');
			//alert(method+' '+action);
			
			
			//alert('go2');
			loadView( p.find('div.filler'),createUrl(action,method,0));
		});
		
		// OnClick-Handler für Klick auf einen Tab-Reiter.
		$('ul.views > li.action').click( function() {
			var method = $(this).attr('data-method');
			var p = $(this).parent().parent().parent().parent().parent();
			var action = p.attr('data-action');
			var id     = p.attr('data-id');
			p.find('ul.views li.active').removeClass('active');
			$(this).addClass('active');
			loadView( p.find('div.filler'),createUrl(action,method,id));
		});
	});
	//alert('go');
	
	
	loadTree(); // ??
	
	// Modale Dialoge
	//$('form.login, form.profile').dialog( { modal:true, resizable:false, width:760, height:600, draggable: false } );
}


/**
 * Laedt den Header neu.
 */
function refreshHeader()
{
	$('div#header').each( function(index){
		loadView( $(this),createUrl('title','show',0 ) );
	});
	
	registerHeaderEvents();
	
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
	
	$(jo).fadeOut('fast').empty().load(url,function() {
			$(jo).fadeIn(100);
			var o=CKEDITOR.instances[ $('textarea.editor').attr('name') ];
			if (o) o.destroy();
			
			//alert("o ist "+o);
			//$('textarea.editor').ckeditor( function() { /*alert("editor ready");*/ /* callback code */ }, editorConfig );
			//CKEDITOR.replace('text',{
		    //    customConfig : 'config-openrat.js'
		    //});
			if ( $(jo).find('form').length > 0 )
				$(jo).parent().parent().find('div.bottom > div.command > input').removeClass('invisible');
			else
				$(jo).parent().parent().find('div.bottom > div.command > input').addClass('invisible');
				
			
		});
}



function registerHeaderEvents()
{
	//   S u c h e
	$('div.search input').blur( function(){
		$('div.search input div.dropdown').fadeOut();
	});

	
	$('div.search input').keyup( function(){
		var val = $(this).val();
		if	( val.length > 3 )
		{
			$('div.search div.dropdown').html('');
			$.ajax( { 'type':'GET',url:'./dispatcher.php?action=search&subaction=quicksearch&search='+val, data:null, success:function(data, textStatus, jqXHR)
				{
					for( id in data.result )
					{
						var result = data.result[id];
						
						//$('div.search input div.dropdown').append('Hallo '+result);
						// Suchergebnis-Zeile in das Ergebnis schreiben.
						$('div.search div.dropdown').append('<div title="'+result.desc+'"><a href="javascript:loadViewByName(\'content\',\''+result.url+'\');"><img src="'+OR_THEMES_EXT_DIR+'default/images/icon_'+result.type+'.png" />'+result.name+'</a></div>');
					}
				} } );
			$('div.search div.dropdown').fadeIn();
			
			
		}
		else
		{
			$('div.search input div.dropdown').fadeOut();
		}
	});
	
	
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

function fullscreen( element ) {
	$(element).fadeOut('fast', function()
	{
		$(this).toggleClass('fullscreen').fadeIn('fast');
	} );
}

function loadTree()
{
	// Oberstes Tree-Element erzeugen
	$('div#tree div.window div.content div.filler').html("&nbsp;");
	//$('div#tree div.window div.content').append('<ul class="tree"><li class="root"><div>Baum</div></li></ul>');
	
	// Wurzel des Baums laden
	//loadBranch( $('div#tree ul.tree > li'),'root',0);
	loadBranch( $('div#tree div.content div.filler'),'root',0);
	$('div#tree div.content div.filler > ul.tree > li > div.tree').delay(500).click();
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
					$('div#workbench div.refreshable').attr('data-action',line.action).attr('data-id',line.id);
					// Alle refresh-fähigen Views mit dem neuen Objekt laden.
					refreshAllRefreshables();
				});
			}
				
		});
		//$(ul).children('li:last-child').addClass('last');
		$(ul).fadeIn('fast'); // Einblenden
	});
	
	$(li).children('div.tree').unbind('click');
	$(li).children('div.tree').removeClass('closed').addClass('open');
	$(li).children('div.tree').click( function(e) { closeBranch($(e.target).parent(),type,id) } );
	//$(li).children('img.tree').attr('src',OR_THEMES_EXT_DIR+'default/images/tree_minus.gif');
}


/**
 * 
 * @param li JQuery-Objekt
 * @return
 */
function closeBranch(li,type,id)
{
	//alert("schließen:"+$(li).html() );
	$(li).children('ul').fadeOut('slow').remove();
	$(li).children('div.tree').unbind('click');
	$(li).children('div.tree').removeClass('open').addClass('closed');
	//alert( "wieder öffnen: "+$(li).children('div').first().html());
	$(li).children('div.tree').click( function() { loadBranch($(this).parent(),type,id) });
	//$(li).children('img.tree').attr('src',OR_THEMES_EXT_DIR+'default/images/tree_plus.gif');
}


function linkSubmit(data)
{
	var params = jQuery.parseJSON( data );
	var url = './dispatcher.php';
	$.ajax( { 'type':'POST',url:url, data:params, success:function(data, textStatus, jqXHR)
		{
			$('div.window div.status div.loader').html('&nbsp;');
			doResponse(data,textStatus);
		} } );
	
}



function formSubmit(form)
{
	$('div.window div.status').html('<div class="loader" />');
	$('.error').removeClass('error');

	$(form).fadeTo(0.5);
	var params = $(form).serializeArray();
	//params['json'] = 'true';
	//alert(params);
	var url    = $(form).attr('action');
	
	$.ajax( { 'type':'POST',url:url, data:params, success:function(data, textStatus, jqXHR)
		{
			$('div.window div.status div.loader').html('&nbsp;');
			doResponse(data,textStatus);
		} } );
	$(form).fadeIn();
	
}

function doResponse(data,status)
{
	if	( status != 'success' )
	{
		alert('Server error: ' + status);
		return;
	}
	
	// Hinweismeldungen in Statuszeile anzeigen
	$.each(data['notices'], function(idx,value) {
		$('div.window div.status').html('<div />');
		$('div.window div.status div').addClass( value.status );
		$('div.window div.status div').append( value.text );
		$('div.window div.status div').delay(3000).fadeOut(2500);
		//alert(value.text);
	});
	
	$.each(data['errors'], function(idx,value) {
		$('input[name='+value+']').addClass('error');
	});
	
	if	( 'refresh' in data )
		refreshAll();
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


function createUrl(action,subaction,id) 
{
	return './dispatcher.php?action='+action+'&subaction='+subaction+'&id='+id;
}