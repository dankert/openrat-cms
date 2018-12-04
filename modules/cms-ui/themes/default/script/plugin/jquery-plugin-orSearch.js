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
		let searchArgument = $(this).val();
		if	( searchArgument.length > 3 )
		{
			$(settings.dropdown).empty(); // Leeren.

			$.ajax( { 'type':'GET',url:'./api/?action=search&subaction=quicksearch&output=json&search='+searchArgument, data:null, success:function(data, textStatus, jqXHR)
				{
					for( id in data.output.result )
					{
						let result = data.output.result[id];
						
						// Suchergebnis-Zeile in das Ergebnis schreiben.

						let div = $('<div class="entry clickable" title="'+result.desc+'"></div>');
						let link = $('<a href="./?action='+result.type+'&id='+result.id+'"></a>');
						$(link).attr('data-type','open').attr('data-name',result.name).attr('data-action',result.type).attr('data-id',result.id).attr('data-extra','[]');
						$(link).append('<i class="image-icon image-icon--action-'+result.type+'" />');
						$(link).append('<span>'+result.name+'</span>');

						$(div).append(link);
						$(settings.dropdown).append(div);
					}
                    $(settings.dropdown).closest('.toolbar-icon.menu').addClass('open');

					// Register clickhandler for search results.
					$(settings.dropdown).find('.clickable').orLinkify();

				} } );

			
		}
		else
		{
			// No search argument.
            $(settings.dropdown).empty(); // Leeren.
		}
	});
};