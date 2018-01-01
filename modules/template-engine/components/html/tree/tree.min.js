// View loaded...
$(document).on('orViewLoaded',function(event, data) {

    // Clickable.
    $(event.target).find('div.entry.clickable').click(function () {
        openNewAction($(this).data('name'), $(this).data('action'), $(this).data('id'), 0);
    })
});