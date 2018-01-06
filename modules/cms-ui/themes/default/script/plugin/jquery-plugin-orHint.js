/**
 * Input-Hints
 */
jQuery.fn.orHint = function()
{

	$(this).each(function(i)
	{
		if ($(this).val() == '')
			$(this).val($(this).attr('data-hint')).addClass('hint');
	});

	return $(this).focus(function()
	{
		if ($(this).val() == $(this).attr('data-hint'))
			$(this).val('').removeClass('hint');
	}).blur(function()
	{
		if ($(this).val() == '')
			$(this).val($(this).attr('data-hint')).addClass('hint');
	});
};