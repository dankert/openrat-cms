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
			$.ajax( { 'type':'GET',url:'./?action=search&subaction=quicksearch&output=json&search='+val, data:null, success:function(data, textStatus, jqXHR)
				{
					for( id in data.output.result )
					{
						var result = data.output.result[id];
						
						// Suchergebnis-Zeile in das Ergebnis schreiben.
						$(settings.dropdown).append('<div class="entry clickable" title="'+result.desc+'"><a href="javascript:void(0);" data-type="open" data-name="'+result.name+'" data-action="'+result.type+'" data-id="'+id+'"><img src="'+OR_THEMES_EXT_DIR+'default/images/icon_'+result.type+'.png" />'+result.name+'</a></div>');
					}
					$(settings.dropdown).orLinkify();
				} } );
			$(settings.dropdown).fadeIn();
			
			
		}
		else
		{
			$(settings.dropdown).fadeOut();
		}
	});
};