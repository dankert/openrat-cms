

$(document).ready(function()
{
	
	refreshAll();
	
});


function refreshAll()
{
	// Initial die Views über AJAX befüllen.
	$('div#header, div#content').each( function(index){
		loadView( $(this),'./dispatcher.php?target='+this.id );
		//$(this).fadeIn();
	});
	
	loadTree();
	
	// Modale Dialoge
	//$('form.login, form.profile').dialog( { modal:true, resizable:false, width:760, height:600, draggable: false } );
}


function loadViewByName(viewName, url )
{
	loadView( $('div#'+viewName),url );
}

function loadView(jo, url )
{
	//   E d i t o r
	var editorConfig = {
			skin : 'v2',
			baseHref: OR_THEMES_EXT_DIR+'../editor/editor/',
			filebrowserUploadUrl:'./dispatcher.php?action=filebrowser&subaction=directupload&name=upload',
			filebrowserBrowseUrl:'./dispatcher.php?action=filebrowser&subaction=browse'
	};
	
	$(jo).fadeOut('fast').load(url,null, function() {
			$(jo).fadeIn(100);
			var o=CKEDITOR.instances[ $('textarea.editor').attr('name') ];
			if (o) o.destroy();
			
			//alert("o ist "+o);
			$('textarea.editor').ckeditor( function() { /*alert("editor ready");*/ /* callback code */ }, editorConfig );
		});
	
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

function loadTree()
{
	// Oberstes Tree-Element erzeugen
	$('div#tree div.window div.content').html("&nbsp;");
	//$('div#tree div.window div.content').append('<ul class="tree"><li class="root"><div>Baum</div></li></ul>');
	
	// Wurzel des Baums laden
	//loadBranch( $('div#tree ul.tree > li'),'root',0);
	loadBranch( $('div#tree div.content'),'root',0);
	$('div#tree div.content > ul.tree > li > div.tree').delay(500).click();
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
			
			if	( line.url )
			{
				$(new_li).children('div.entry').click( function() { loadViewByName('content',line.url.replace(/&amp;/g,'&')); }); // Objekt laden
			}
				
		});
		//$(ul).children('li:last-child').addClass('last');
		$(ul).fadeIn(600); // Einblenden
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


function formSubmit(form)
{
	$('.error').removeClass('error');

	$(form).fadeTo(0.5);
	var params = $(form).serializeArray();
	//params['json'] = 'true';
	//alert(params);
	var url    = $(form).attr('action');
	
	$.ajax( { 'type':'POST',url:url, data:params, success:function(data, textStatus, jqXHR)
		{
			doResponse(data,textStatus);
		} } );
	$(form).fadeIn();
	
}

function doResponse(data,status)
{
	if	( status != 'success' )
		alert('Error while saving the values: ' + status);
	
	$.each(data['notices'], function(idx,value) {
		$('div.window div.status').html('<div>');
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





