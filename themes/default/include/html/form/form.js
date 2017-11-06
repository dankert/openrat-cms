$(document).on('orViewLoaded',function(event, data) {

	if ( $('div.panel form input[type=password]').length>0 && $('#uname').attr('value')!='' )
	{
		$('div.panel form input[name=login_name]    ').attr('value',$('#uname'    ).attr('value'));
		$('div.panel form input[name=login_password]').attr('value',$('#upassword').attr('value'));
	}


	// Autosave in Formularen. Bei Veränderungen wird das Formular sofort abgeschickt.
	$(event.target).find('form[data-autosave="true"] input[type="checkbox"]').click( function() {
		formSubmit( $(this).closest('form') );
	});

} );