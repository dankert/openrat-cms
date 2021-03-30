import $ from "../jquery-global.js";

/**
 * Input-Hints
 */
export default function() {

	let resize = function( element )
	{
		let lines = $(element).val().split("\n").length;
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