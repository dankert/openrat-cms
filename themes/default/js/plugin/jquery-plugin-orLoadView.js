/**
 * Baum darstellen.
 */
jQuery.fn.orLoadView = function()
{
	$(this).each(function(idx,treeEl)
	{
		var method = $(this).attr('data-method');
		var frame  = $(this).closest('div.frame');
		var action = frame.attr('data-action');
		var id     = frame.attr('data-id');
		frame.find('ul.views li.active').removeClass('active');
		$(this).addClass('active');
		loadView( frame.find('div.content'),createUrl(action,method,id));
	});

	
};