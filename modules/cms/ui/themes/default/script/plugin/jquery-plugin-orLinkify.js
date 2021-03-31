import $ from "../jquery-global.js";
import Workbench from "../openrat/workbench.js";
import Dialog    from "../openrat/dialog.js";

/**
 * JQuery-Plugin, enable clicking on an area.
 * It searches for an anchor (<a href="..." />) in the child elements and virtually clicks on it.
 */
export default function( options )
{
	// Create some defaults, extending them with any options that were provided
	var settings = $.extend( {
		'openAction' : function(name,action,id) {
			Workbench.getInstance().openNewAction( name,action,id );
		}
	}, options);

	$(this).addClass('linkified');

    // Disable all links in this linkified area.
    // The user is already able to open the link in a new tab.
	if  ( $(this).is('a') )
		$(this).addClass('act-prevented-link').click( function(event) {
			event.preventDefault();
		} );
	else
		$(this).find('a').addClass('act-prevented-sublink').click( function(event) {
			event.preventDefault();
		} );

    return $(this).click(function(event)
	{

		// Searching for the first link in all children.
		let $el = $(this);
		let $link;

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
				let $form = $('<form />').attr('method','POST').addClass('invisible');
				$form.data('afterSuccess', $link.data('afterSuccess'));
				let params = JSON.parse( $link.attr('data-data')  );
				params.output = 'json';

				// Add input elements...
				$.each( params, function(key,value) {
					let $input = $('<input />').attr('type','hidden').attr('name',key).attr('value',value);
					$form.append( $input );
				} );

				// Submit the form.
				let form = new Form();
				form.initOnElement( $form );
				form.submit();

				break;

			case 'edit':
			case 'dialog':
				let dialog = new Dialog();
				let name   = $link.attr('data-name');
				if   ( !name )
					name = $link.text(); // get the name from the combined text of all children.

				let extraValue = Workbench.htmlDecode($link.attr('data-extra'));
				let extraData  = JSON.parse(extraValue);

				dialog.start(name,$link.attr('data-action'),$link.attr('data-method'),$link.attr('data-id'),extraData );
				break;

			case 'external':
				window.open( $link.attr('data-url'),' _blank' );
				break;
			case 'window':
				window.location.href = View.createUrl($link.attr('data-action'),$link.attr('data-method'),$link.attr('data-id'));
				break;

			case 'popup':
				Workbench.popupWindow = window.open( $link.attr('data-url'), 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');
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



