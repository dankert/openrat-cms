$(document).on('orViewLoaded',function(event, data) {

// Sortieren von Tabellen
	$(event.target).find('table.sortable > tbody').sortable({
		   update: function(event, ui)
		   {
			   $(ui).addClass('loader');
				var order = [];
				$(ui.item).closest('table.sortable').find('tbody > tr.data').each( function() {
					var objectid = $(this).data('id');
					order.push( objectid );
				});
				var url    = './api/';
				var params = {};
				params.action    = 'folder';
				params.subaction = 'order';
				params.token     = $('div.action-folder.method-order input[name=token]').attr('value');
				params.order     = order.join(',');
				params.id        = $('div#dialog').data('id');
				params.output    = 'json';
				
				$.ajax( { 'type':'POST',url:url, data:params, success:function(data, textStatus, jqXHR)
					{
					   $(ui).removeClass('loader');
						doResponse(data,textStatus,ui);
					},
					error:function(jqXHR, textStatus, errorThrown) {
						alert( errorThrown );
					}
					
				} );
		   }
	});
	
	// Alle Checkboxen setzen oder nicht setzen.
	$(event.target).find('tr.headline > td > input.checkbox').click( function() {
		$(this).closest('table').find('tr.data > td > input.checkbox').attr('checked',Boolean( $(this).attr('checked') ) );
	});

    /**
	 * Table-Filter.
     */
	$(event.target).find('.table-filter > input').keyup( function() {

		let filterExpression = $(this).val().toLowerCase();

        let table = $(this).parents('.table-wrapper').find('table');
        table.addClass('loader');

        setTimeout( () => {
            table.find('tr').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(filterExpression) > -1)
            })
            table.removeClass('loader');
        }, 50);

	} );


    /**
	 * Table-Sortierung.
     */
	$(event.target).find('table > tbody > tr.headline > td').click( function() {

		let column = $(this);
        let table = column.parents('table');
        table.addClass('loader');

        let isAscending = !column.hasClass('sort-asc');
        table.find('tr.headline > td').removeClass('sort-asc sort-desc');
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