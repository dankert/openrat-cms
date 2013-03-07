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
		
		var panel  = $(this).closest('div.panel');
		panel.find('ul.views li.active').removeClass('active');
		$(this).addClass('active');
		
		loadView( panel.find('div.content'),action,method,id);
	});

	
};