/**
 * Enable clicking on '.clickable'-Areas.
 */

var popupWindow;

jQuery.fn.orLinkify = function()
{

    // Das 'echte' Ausführen der Links deaktivieren, da dies schon per Javascript erfolgt.
    // Das Öffnen in einem neuen Tab funktioniert aber weiterhin über die URL.
    $(this).find('a').click( function(event) {
        event.preventDefault();
    } );

    return $(this).click(function()
	{

		$(this).find('a').first().each( function() {

			let type = $(this).attr('data-type');
			
			// Inaktive Menüpunkte sind natürlich nicht anklickbar.
			if	( $(this).parent().hasClass('inactive') )
				return;

			switch( type )
			{
				case 'post':

					// Create a temporary form element.
					$form = $('<form />').attr('method','POST').addClass('invisible');
					$form.data('afterSuccess', $(this).data('afterSuccess'));
					let params = jQuery.parseJSON( $(this).attr('data-data')  );
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
					startDialog($(this).attr('data-name'),$(this).attr('data-action'),$(this).attr('data-method'),$(this).attr('data-id'),$(this).attr('data-extra') );
					break;

				case 'external':
					window.open( $(this).attr('data-url'),' _blank' );
					break;

				case 'popup':
					popupWindow = window.open( $(this).attr('data-url'), 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');
					break;

				case 'help':
					help(this,$(this).attr('data-url'),$(this).attr('data-suffix') );
					break;

				case 'fullscreen':
					fullscreen(this);
					break;

				case 'open':
					openNewAction( $(this).attr('data-name'),$(this).attr('data-action'),$(this).attr('data-id') );
					break;

				default:
					throw "UI error: Unknown link type: "+type+" in link "+$(this).html();
            }
		} );
	});
};



