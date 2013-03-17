/**
 * Input-Hints
 */
jQuery.fn.orLinkify = function()
{

	return $(this).click(function()
	{
		$(this).find('a').first().each( function() {
			
			var type = $(this).attr('data-type');
			
			// Inaktive Menüpunkte sind natürlich nicht anklickbar.
			if	( $(this).parent().hasClass('inactive') )
				return;
			
			if	( type == 'post' )
			{
				//alert('data:  '+$(this).attr('data-data'))
				submitLink(this,$(this).attr('data-data') );
			}
			
			else if	( type == 'view' )
			{
				startView(this, $(this).attr('data-method') );
			}

			else if	( type == 'modal' )
			{
				startDialog($(this).attr('data-method'),true );
			}

			else if	( type == 'dialog' )
			{
				startDialog($(this).attr('data-name'),$(this).attr('data-method'),false );
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
				window.open( $(this).attr('data-url'), 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');
			}
			
			else if	( type == 'help' )
			{
				help(this,$(this).attr('data-url'),$(this).attr('data-suffix') );
			}
			
			else if	( type == 'fullscreen' )
			{
				//alert('fullscreen fuer: '+$(this).html() );
				fullscreen(this);
			}
			
			else if	( type == 'open' )
			{
				openNewAction( $(this).attr('data-name'),$(this).attr('data-action'),$(this).attr('data-id'),0);
			}
			else
			{
				alert('Fatal: Cannot open link: '+$(this).html() );
			}
		} );
	});
};