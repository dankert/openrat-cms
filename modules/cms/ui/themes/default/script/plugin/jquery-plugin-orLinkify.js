/**
 * JQuery-Plugin, enable clicking on an area.
 * It searches for an anchor (<a href="..." />) in the child elements and virtually clicks on it.
 */
jQuery.fn.orLinkify = function( options )
{
	// Create some defaults, extending them with any options that were provided
	var settings = $.extend( {
		'openAction' : function(name,action,id) {
			Openrat.Workbench.openNewAction( name,action,id );
		}
	}, options);

	$(this).addClass('linkified');

    // Disable all links in this linkified area.
    // The user is already able to open the link in a new tab.
	if  ( $(this).is('a') )
		$(this).click( function(event) {
			event.preventDefault();
		} );
	else
		$(this).find('a').click( function(event) {
			event.preventDefault();
		} );

    return $(this).click(function(event)
	{

		// Searching for the first link in all children.
		$el = $(this);
		if   ( $el.is('a') )
			$link = $el;
		else
			$link = $el.find('a').first();

		let type = $link.attr('data-type');

		// Inaktive Menüpunkte sind natürlich nicht anklickbar.
		if	( $link.parent().hasClass('dropdown-entry--inactive') )
			return;

		switch( type )
		{
			/**
			 * Creating a temporary form element for submitting a POST request.
			 */
			case 'post':

				// Create a temporary form element.
				$form = $('<form />').attr('method','POST').addClass('invisible');
				$form.data('afterSuccess', $link.data('afterSuccess'));
				let params = jQuery.parseJSON( $link.attr('data-data')  );
				params.output = 'json';

				// Add input elements...
				$.each( params, function(key,value) {
					let $input = $('<input />').attr('type','hidden').attr('name',key).attr('value',value);
					$form.append( $input );
				} );

				// Submit the form.
				let form = new Openrat.Form();
				form.initOnElement( $form );
				form.submit();

				break;

			case 'edit':
			case 'dialog':
				Openrat.Workbench.startDialog($link.attr('data-name'),$link.attr('data-action'),$link.attr('data-method'),$link.attr('data-id'),$link.attr('data-extra') );
				break;

			case 'external':
				window.open( $link.attr('data-url'),' _blank' );
				break;
			case 'window':
				window.location.href = Openrat.Workbench.createUrl($link.attr('data-action'),$link.attr('data-method'),$link.attr('data-id'));
				break;

			case 'popup':
				Openrat.Workbench.popupWindow = window.open( $link.attr('data-url'), 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');
				break;

			case 'help':
				help($link,$link.attr('data-url'),$link.attr('data-suffix') );
				break;

			case 'fullscreen':
				fullscreen($link);
				break;

			case 'open':
				settings.openAction( $link.text().trim(),$link.attr('data-action'),$link.attr('data-id') );
				break;

			default:
				throw "UI error: Unknown link type: "+type+" in link "+$link.html();
		}
	});
};



