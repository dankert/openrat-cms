import $ from "../jquery-global.js";
import WorkbenchNavigator from "../openrat/navigator.js";

/**
 * Suche mit Dropdown
 */
export default function( options )
{
    // Create some defaults, extending them with any options that were provided
    let settings = $.extend( {
      'dropdown': $(), // empty element
      'select'  : function( obj ) {},
      'afterSelect' : function() {},
      'onSearchActive' : function() {},
      'onSearchInactive' : function() {},
	  'openDropdown' : true,
	  'action': 'search',
	  'method': 'quicksearch',
	  'resultEntryClass': 'dropdown-entry',
    }, options);
	
	
	return $(this).input(async function()
	{
		let searchInput    = $(this)
		let searchArgument = searchInput.val();
		let dropdownEl     = $( settings.dropdown );

		if	( searchArgument.length )
		{
			settings.onSearchActive();
			$('.or-search').addClass('search--is-active');
			dropdownEl.addClass('search-result--is-active');

			let url = './api/?action='+settings.action+'&subaction='+settings.method+'&output=json&search='+searchArgument;
			let response = await fetch( url, {
				method: 'GET',
				headers: {
					'Content-Type': 'application/json',
				} } );
			if   ( ! response.ok )
				throw "Search request getting an error";
			let data = await response.json();
			$(dropdownEl).empty(); // Leeren.

			for (let id in data.output.result) {
				let result = data.output.result[id];

				// Suchergebnis-Zeile in das Ergebnis schreiben.

				let div = $.create('div')
					.addClass( settings.resultEntryClass )
					.addClass( settings.resultEntryClass + '--active' )
					.attr('title',result.desc);
				div.data('object', {
					'name': result.name,
					'action': result.type,
					'id': result.id
				});
				let link = $.create('a')
					.addClass('link')
					.attr('href', WorkbenchNavigator.createShortUrl(result.type, result.id));
				link.click(function (e) {
					e.preventDefault();
				});
				$(link).append(
					$.create('i').addClass('image-icon').addClass('image-icon--action-' + result.type)
				);
				$(link).append(
					$.create('span').addClass('dropdown-text').text(result.name)
				);

				$(div       ).append(link);
				$(dropdownEl).append(div);
			}

			if (data.output.result && settings.openDropdown) {
				// Open the menu
				//$(dropdownEl).closest('.or-menu').addClass('menu--is-open');
				$(dropdownEl).addClass('dropdown--is-open');
			} else {
				$(dropdownEl).removeClass('dropdown--is-open');
			}

			// Register clickhandler for search results.
			$(dropdownEl).find('.or-search-result-entry').click(function (e) {
				settings.select($(this).data('object'));
				settings.afterSelect();
				searchInput.val('');
			});
		}
		else
		{
			settings.onSearchInactive();

			// No search argument.
			$(dropdownEl).empty(); // Leeren.

			dropdownEl.removeClass('search-result--is-active');
		}
	});
};