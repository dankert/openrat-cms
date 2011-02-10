

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
	
	// Oberstes Tree-Element erzeugen
	$('div#tree').html("Wird geladen");
	$('div#tree').append('<ul class="tree" />');
	
	loadTree();
	
	// Modale Dialoge
	$('form.login, form.profile').dialog( { modal:true, resizable:false, width:760, height:600, draggable: false } );
}


function loadViewByName(viewName, url )
{
	loadView( $('div#'+viewName),url );
}

function loadView(jo, url )
{
	$(jo).fadeOut('fast').load(url,null, function() { $(jo).fadeIn(100) });
}

function loadTree()
{
	// Baum initial laden
	$.getJSON("./dispatcher.php?action=tree&subaction=loadAll", function(json) {
		$.each(json['lines'],function(idx,line)
		{
			$('div#tree > ul.tree').append('<li><img src="http://127.0.0.1/~dankert/cms-test/cms09/themes/default/images/icon_'+line['icon']+'.png" /><a href="'+line['url']+'">'+ line['text'] + '</a></li>');
		});
	});
}


function formSubmit(form)
{
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
		alert(value.text);
	});
	
	$.each(data['errors'], function(idx,value) {
		$('input[name='+value+']').addClass('error');
	});
	
	if	( 'refresh' in data )
		refreshAll();
}
