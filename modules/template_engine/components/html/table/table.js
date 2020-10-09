Openrat.Workbench.afterViewLoadedHandler.add(  function(element ) {


    // Manuelles Sortieren von Tabellen per Drag and drop.
	$(element).find('.or-table--sortable > tbody').sortable();


    $(element).find('.or-table--sortable > tbody').closest('form').submit( function() {

            // Analyse the order of the objects in this folder.
            var order = new Array();

            $(this).find('.or-table--sortable').find('tbody > tr.data').each(function () {
                let objectid = $(this).data('id');
                order.push(objectid);
            });

            // Set the comma-separated list of objects into a input field.
            $(this).find('input[name=order]').val(order.join(','));
        }
    );


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
            table.find('tr:not(.headline)').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(filterExpression) > -1)
            })
            table.removeClass('loader');
        }, 50);

	} );


    /**
	 * Table-Sortierung.
     */
	$(element).find('table > tbody > tr.headline > td, table > tbody > tr > th').click( function() {

		let column = $(this);
        let table = column.parents('table');
        table.addClass('loader');

        let isAscending = !column.hasClass('sort-asc');
        table.find('tr.headline > td, tr > th').removeClass('sort-asc').removeClass('sort-desc');
        if ( isAscending ) column.addClass('sort-asc'); else column.addClass('sort-desc');

        setTimeout(function () {  // Sorting should be asynchronous, because we do not want to block the UI.

            let rows = table.find('tr:gt(0)').toArray().sort(comparer(column.index()))
            if (!isAscending) {
                rows = rows.reverse()
            }
            for (var i = 0; i < rows.length; i++) {
                table.append(rows[i])
            }
            table.removeClass('loader');
        }, 50);

	} );

    function comparer(index) {
        return function(a, b) {
            let valA = getCellValue(a, index), valB = getCellValue(b, index)
            return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
        }
    }

    function getCellValue(row, index) {
        return $(row).children('td').eq(index).text();
    }

});