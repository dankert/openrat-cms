import $ from  '../../../../cms/ui/themes/default/script/jquery-global.js';

export default function(element ) {


	let calculateOrderList = function() {

		// Analyse the order of the objects in this folder.
		let order = new Array();

		$(element).find('.or-table--sortable').find('tbody > tr.or-data').each(function () {
			let objectid = $(this).data('id');
			order.push(objectid);
		});

		// Set the comma-separated list of objects into a input field.
		$(element).find('input[name=order]').val(order.join(','));
	};

	calculateOrderList();

    // Manuelles Sortieren von Tabellen per Drag and drop.

	let sortableElement = $(element).find('.or-table--sortable > tbody').get(0);

	if   ( sortableElement ) {

		let sortable = import( './sortable.min.js' );
		sortable.then( Sortable => {
			new Sortable(sortableElement, {onUpdate: calculateOrderList})
		} );

	}

	// Alle Checkboxen setzen oder nicht setzen.
	$(element).find('tr.headline > td > input.checkbox').click( function() {
		$(this).closest('table').find('tr.or-data > td > input.or-checkbox').attr('checked',Boolean( $(this).attr('checked') ) );
	});

    /**
	 * Table-Filter.
     */
	$(element).find('.or-table-filter > input').keyup( function() {

		let filterExpression = $(this).val().toLowerCase();

        let table = $(this).parents('.or-table-wrapper').find('table');
        table.addClass('loader');

        setTimeout( () => {
            table.find('tr:not(.or-table-header)').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(filterExpression) > -1)
            })
            table.removeClass('loader');
        }, 50);

	} );


    /**
	 * Table-Sortierung.
     */
	$(element).find('table > tbody > tr.or-table-header > td, table > tbody > tr > th').click( function() {

		let column = $(this);
        let table = column.closest('table');
        table.addClass('loader');

        let isAscending = !column.hasClass('sort-asc');
        table.find('tr.or-table-header > td, tr > th').removeClass('sort-asc').removeClass('sort-desc');
        if ( isAscending ) column.addClass('sort-asc'); else column.addClass('sort-desc');

        Promise.resolve().then( () => {  // Sorting should be asynchronous, because we do not want to block the UI.

			let rows = table.find('tr:not(.or-table-header)').toArray().sort(comparer(column.index()))
			if (!isAscending) {
				rows = rows.reverse()
			}
			for (let i = 0; i < rows.length; i++) {
				table.append( $(rows[i]) );
			}
			table.removeClass('loader');
		});

	} );

    function comparer(index) {
        return function(a, b) {
            let valA = getCellValue(a, index), valB = getCellValue(b, index)
            return isNumeric(valA) && isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
        }
    }

    function getCellValue(row, index) {
        let x = $(row).children('td').eq(index);
        return $(row).children('td').eq(index).text();
    }

	function isNumeric(n) {
		return !isNaN(parseFloat(n)) && isFinite(n);
	}

};