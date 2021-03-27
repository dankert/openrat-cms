import "../jquery.min.js";

/**
 * Input-Hints
 */
export default function() {

	let resize = function( element )
	{
		let lines = jQuery(element).val().split("\n").length;
		jQuery(element).attr('rows',lines+3);
	};
	
	$(this).each(function(i)
	{
		resize(this);
	});

	return jQuery(this).keypress(function()
	{
		resize(this);
	});
};