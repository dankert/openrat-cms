// View loaded...
$(document).on('orViewLoaded',function(event, data) {

    // Clickable Columns.
    $(event.target).find('td.clickable').click(function () {
        openNewAction($(this).data('name'), $(this).data('action'), $(this).data('id'), 0);
    })

});