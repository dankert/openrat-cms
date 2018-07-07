$(document).on('orViewLoaded',function(event, data) {

	$(event.target).find('fieldset > legend').click( function() {
			$(this).parent().toggleClass('open closed');
		});
});