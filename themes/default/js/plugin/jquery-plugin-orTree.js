/**
 * Input-Hints
 */
jQuery.fn.orTree = function( options )
{
    // Create some defaults, extending them with any options that were provided
    var settings = $.extend( {
      'onSelect': function(){},
      'type':'root',
      'id':0,
      'selectable':Array()
    }, options);
	
	
	$(this).each(function(idxx,treeEl)
	{
		
		$.getJSON('./dispatcher.php?action=tree&subaction=loadBranch&id='+settings.id+'&type='+settings.type+'&output=json', function(json) {
			$(treeEl).append('<ul class="tree" style="display:none;"/>');
			var ul = $(treeEl).children('ul').first();
			var output = json['output'];
			$.each(output['branch'],function(idx,line)
			{
				if	( settings.selectable.length==0 ||  settings.selectable[0]=='' || jQuery.inArray(line.type, settings.selectable)!=-1)
				{
					//var img = (line.url!==undefined?'tree_plus':'tree_none');
					$(ul).append( '<li class="object" data-id="'+line.internalId+'" data-type="'+line.type+'"><div class="tree">&nbsp;</div><div class="entry" data-id="'+line.internalId+'" data-type="'+line.type+'" title="'+ line.description + '"><img src="'+OR_THEMES_EXT_DIR+'default/images/icon_'+line['icon']+'.png" />'+ line.text + '</div></li>' );
					var new_li = $(ul).children('li').last();
					//$(new_li).children('div').unbind('click');
					if ( line.type )
					{
						$(new_li).children('div.tree').addClass('closed');
						$(new_li).children('div.tree').click( function() { $(this).parent().orTree( {type:line.type,id:line.internalId,onSelect:settings.onSelect,selectable:settings.selectable} );} ); // Zweig öffnen
					}
					
					if	( line.action )
					{
						// Onclick-Handler für auswählbare Objekte setzen
						$(new_li).children('div.entry').click( function() {
							//loadViewByName('content',line.url.replace(/&amp;/g,'&'));
							//var url = './dispatcher.php';
							//$.ajax( { 'type':'POST',url:url, data:{'action':'tree','subaction':'select','id':line.id,'type':line.type},success:function(data, textStatus, jqXHR)
	//							{
	//								doResponse(data,textStatus);
	//							} } );
							// Den Objekt-Typ und die Objekt-Id für alle Views setzen (die dies zulassen)
	
							// Neue Action starten.
							$(this).closest('div.content').find('div.entry').removeClass('selected');
							$(this).addClass('selected');
							
							settings.onSelect( $(this).text(), line.action, line.id );
						});
						
						// Drag and drop für die Baum-Inhalte.
						//$(new_li).children('div.entry').draggable( {cursor:'move',revert: 'invalid' });
					}
				}
					
			});
			//$(ul).children('li:last-child').addClass('last');
			$(ul).slideDown('fast'); // Einblenden
		});
		
		$(treeEl).children('div.tree').unbind('click');
		$(treeEl).children('div.tree').removeClass('closed').addClass('open');
		$(treeEl).children('div.tree').click( function(e) { closeBranch($(e.target).parent(),settings.type,settings.id); } );
	});

	
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
			$(li).children('div.tree').click( function() { $(this).parent().orTree( {type:type,id:id,onSelect:settings.onSelect,selectable:settings.selectable}); });
			//$(li).children('img.tree').attr('src',OR_THEMES_EXT_DIR+'default/images/tree_plus.gif');
		} );
	}

};