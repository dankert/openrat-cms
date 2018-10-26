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

        $(this).parents('.table-wrapper').find('tr').filter( function() {
            $(this).toggle( $(this).text().toLowerCase().indexOf(filterExpression) > -1 )
        } );

	} );
});