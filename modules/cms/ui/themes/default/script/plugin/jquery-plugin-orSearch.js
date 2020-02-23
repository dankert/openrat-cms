/**
 * Suche mit Dropdown
 */
jQuery.fn.orSearch = function( options )
{
    // Create some defaults, extending them with any options that were provided
    var settings = $.extend( {
      'dropdown': $(), // empty element
      'select'  : function( obj ) {}
    }, options);
	
	
	return $(this).on('input', function()
	{
		let searchArgument = $(this).val();
		let dropdownEl     = $( settings.dropdown );

		if	( searchArgument.length > 3 )
		{
			$(dropdownEl).empty(); // Leeren.

			$.ajax( { 'type':'GET',url:'./api/?action=search&subaction=quicksearch&output=json&search='+searchArgument, data:null, success:function(data, textStatus, jqXHR)
				{
					for( id in data.output.result )
					{
						let result = data.output.result[id];
						
						// Suchergebnis-Zeile in das Ergebnis schreiben.

						let div = $('<div class="entry or-search-result" title="'+result.desc+'"></div>');
						div.data('object',{
							'name':result.name,
						    'action':result.type,
							'id':result.id
						} );
						let link = $('<a />').attr('href',Openrat.Navigator.createShortUrl(result.type, result.id));
						link.click( function(e) {
							e.preventDefault();
						});
						$(link).append('<i class="image-icon image-icon--action-'+result.type+'" />');
						$(link).append('<span>'+result.name+'</span>');

						$(div).append(link);
						$(dropdownEl).append(div);
					}

					// Open the menu
                    $(dropdownEl).closest('.or-menu').addClass('open');

					// Register clickhandler for search results.
					$(dropdownEl).find('.or-search-result').click( function(e) {
						settings.select( $(this).data('object') );
					} );

				} } );

			
		}
		else
		{
			// No search argument.
            $(dropdownEl).empty(); // Leeren.
		}
	});
};