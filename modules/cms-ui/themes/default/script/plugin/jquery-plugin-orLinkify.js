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
			
			if	( type == 'post' )
			{
				submitLink(this,$(this).attr('data-data') );
			}
			
			else if	( type == 'view' )
			{
				//startView(this, $(this).attr('data-method') );
				// gibt es so nicht mehr, kann wohl raus.
				alert('Error: Link type = view not supported.');
			}

			else if	( type == 'modal' )
			{
                alert('Error: Link type = modal not supported.');

                startDialog($(this).attr('data-name'),null,$(this).attr('data-method') );
			}

			else if	( type == 'dialog' )
			{
				startDialog($(this).attr('data-name'),$(this).attr('data-action'),$(this).attr('data-method'),$(this).attr('data-id'),$(this).attr('data-extra') );
			}

			else if	( type == 'url' )
			{
				submitUrl(this,$(this).attr('data-url') );
			}
			
			else if	( type == 'external' )
			{
				window.open( $(this).attr('data-url'),' _blank' );
			}
			
			else if	( type == 'popup' )
			{
				popupWindow = window.open( $(this).attr('data-url'), 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');
			}
			
			else if	( type == 'help' )
			{
				help(this,$(this).attr('data-url'),$(this).attr('data-suffix') );
			}
			
			else if	( type == 'fullscreen' )
			{
				fullscreen(this);
			}
			
			else if	( type == 'open' )
			{
				openNewAction( $(this).attr('data-name'),$(this).attr('data-action'),$(this).attr('data-id'),jQuery.parseJSON($(this).attr('data-extra').replace(/'/g,'"')));
			}
			else
			{
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

