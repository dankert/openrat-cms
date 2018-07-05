$(document).on('orViewLoaded',function(event, data) {
	
	// Links aktivieren...
	$(event.target).find('.clickable').orLinkify();
	$(event.target).find('.clickable a').click( function(event) {
		event.preventDefault();
	} );

});


$(document).on('orHeaderLoaded',function(event, data) {
	
	// Links aktivieren...
	$('#title .clickable').orLinkify();

    $(event.target).find('.clickable a').click( function(event) {
        event.preventDefault();
    } );

});



/**
 * Wird aus dem Plugin 'orLinkify' aufgerufen, wenn auf einen Link mit type='post' geklickt wird.
 * 
 * @param element
 * @param data
 * @returns
 */
function submitLink(element,data)
{
	var params = jQuery.parseJSON( data );
	var url = './api/';
	params.output = 'json';
	$.ajax( { 'type':'POST',url:url, data:params, success:function(data, textStatus, jqXHR)
		{
		$('div.panel div.status div.loader').html('&nbsp;');
		doResponse(data,textStatus,element);
		} } );
	
}
