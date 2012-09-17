/**
 * Suche mit Dropdown
 */
jQuery.fn.orSearch = function( options )
{
    // Create some defaults, extending them with any options that were provided
    var settings = $.extend( {
      'dropdown': 'unknown'
    }, options);
	
	
	return $(this).keyup( function()
	{
		var val = $(this).val();
		if	( val.length > 3 )
		{
			$(settings.dropdown).html('');
			$.ajax( { 'type':'GET',url:'./dispatcher.php?action=search&subaction=quicksearch&search='+val, data:null, success:function(data, textStatus, jqXHR)
				{
					for( id in data.result )
					{
						var result = data.result[id];
						
						// Suchergebnis-Zeile in das Ergebnis schreiben.
						$(settings.dropdown).append('<div title="'+result.desc+'"><a href="javascript:openNewAction(\''+result.name+'\',\''+result.type+'\','+id+',0);"><img src="'+OR_THEMES_EXT_DIR+'default/images/icon_'+result.type+'.png" />'+result.name+'</a></div>');
					}
				} } );
			$(settings.dropdown).fadeIn();
			
			
		}
		else
		{
			$(settings.dropdown).fadeOut();
		}
	});
};