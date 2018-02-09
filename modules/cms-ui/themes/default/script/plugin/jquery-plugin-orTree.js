/**
 * Baum darstellen.
 */
jQuery.fn.orTree = function( options )
{
    // Create some defaults, extending them with any options that were provided
    var settings = $.extend( {
      'onSelect': function(){},
      'type':'root',
      'id':0,
	  'extraId':Array(),
      'selectable':Array()
    }, options);
	
	$(this).each(function(idxx,treeEl)
	{
		$(treeEl).closest('div.content').addClass('loader');

        var loadBranchUrl = './api/?action=tree&subaction=loadBranch&id='+settings.id+'&type='+settings.type+'&output=json';

        // Extra-Id ergänzen.
        if	( typeof settings.extraId === 'string')
        {
            jQuery.each(jQuery.parseJSON(settings.extraId), function(name, value) {
                loadBranchUrl = loadBranchUrl + '&' + name + '=' + value;
            });
        }
        else if	( typeof settings.extraId === 'object')
        {
            jQuery.each(settings.extraId, function(name, field) {
                loadBranchUrl = loadBranchUrl + '&' + name + '=' + field;
            });
        }
        else
        {
        	;
        }

		$.getJSON(loadBranchUrl, function(json) {
			$(treeEl).append('<ul class="tree"/>');
			var ul = $(treeEl).children('ul').first();
			var output = json['output'];
			$.each(output['branch'],function(idx,line)
			{
				if	( !line.action || line.action=='folder' || settings.selectable.length==0 || settings.selectable[0]=='' || jQuery.inArray(line.action, settings.selectable)!=-1 )
				{
					//var img = (line.url!==undefined?'tree_plus':'tree_none');
                    var new_li = $('<li class="object" data-id="'+line.internalId+'" data-type="'+line.type+'"><div class="tree">&nbsp;</div><div class="entry" data-extra="'+JSON.stringify(line.extraId).replace(/"/g, "'")+'" data-id="'+line.internalId+'" data-type="'+line.type+'" title="'+ line.description + '"><img src="modules/cms-ui/themes/default/images/icon_'+line['icon']+'.png" />'+ line.text + '</div></li>');
					$(ul).append( new_li );
					//var new_li = $(ul).children('li').last();
					//$(new_li).children('div').unbind('click');

					// Wenn ein Type vorhanden ist, dann kann man den Zweig öffnen
					if ( line.type )
					{
						$(new_li).children('div.tree').addClass('closed');

						// Klick-Funktion zum Öffnen des Zweiges.
						$(new_li).children('div.tree').click( function() { $(this).parent().orTree( {type:line.type,id:line.internalId,extraId:line.extraId,onSelect:settings.onSelect,selectable:settings.selectable} );} ); // Zweig öffnen
					}
					
					if	( line.action && ( settings.selectable.length==0 || settings.selectable[0]=='' || jQuery.inArray(line.action, settings.selectable)!=-1 ))
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
							
							settings.onSelect( $(this).text(), line.action, line.id, line.extraId );
						});
						
						// Drag and drop für die Baum-Inhalte.
						//$(new_li).children('div.entry').draggable( {cursor:'move',revert: 'invalid' });
					}
					
					if	($(new_li).parents('ul.tree').length <= 1 )
					{
						// Falls eine bestimmte Tiefe nicht erreicht ist, dann
						// den Pfad auch gleich öffnen.
						$(new_li).children('div.tree').click();
					}
				}
					
			});
			//$(ul).children('li:last-child').addClass('last');
			$(ul).slideDown('fast'); // Einblenden
			
		}).fail( function() {
			//
		}).always( function() {
			$(treeEl).closest('div.content').removeClass('loader');
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