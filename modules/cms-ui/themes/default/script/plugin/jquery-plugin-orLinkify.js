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
					submitLink(this,$(this).attr('data-data') );
					break;


				case 'dialog':
					startDialog($(this).attr('data-name'),$(this).attr('data-action'),$(this).attr('data-method'),$(this).attr('data-id'),$(this).attr('data-extra') );
					break;

				case 'url':
					submitUrl(this,$(this).attr('data-url') );
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
					openNewAction( $(this).attr('data-name'),$(this).attr('data-action'),$(this).attr('data-id'),jQuery.parseJSON($(this).attr('data-extra').replace(/'/g,'"')));
					break;

				default:
					alert('Fatal: Cannot open link: '+$(this).html() );
            }
		} );
	});
};


$(document).on('orViewLoaded',function(event, data) {

	// Refresh already opened popup windows.
    if   ( typeof popupWindow != "undefined" )
    	$(event.target).find("a[data-type='popup']").each( function() {
            popupWindow.location.href = $(this).attr('data-url');
		});

});

$(document).on('orDataChanged',function(event, data) {
    if   ( typeof popupWindow != "undefined" )
       popupWindow.location.reload();
} );

