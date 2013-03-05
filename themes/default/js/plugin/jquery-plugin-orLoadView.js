/**
 * Laden einer View.
 */
jQuery.fn.orLoadView = function()
{
	$(this).each(function(idx,treeEl)
	{
		var method = $(this).data('method');
		var action = $(this).data('action');
		var id     = $(this).data('id');
		
		var frame  = $(this).closest('div.frame');
		frame.find('ul.views li.active').removeClass('active');
		$(this).addClass('active');
		
		loadView( frame.find('div.content'),action,method,id);
	});

	
};