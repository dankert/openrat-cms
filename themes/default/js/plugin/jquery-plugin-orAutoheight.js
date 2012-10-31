/**
 * Input-Hints
 */
jQuery.fn.orAutoheight = function()
{

	var resize = function( element )
	{
		var lines = $(element).val().split("\n").length;
		$(element).attr('rows',lines+3);
	};
	
	$(this).each(function(i)
	{
		resize(this);
	});

	return $(this).keypress(function()
	{
		resize(this);
	});
};