import $ from "../jquery-global.js";

/**
 * JQuery-Plugin, enable opening an area.
 */
export default function( options )
{
	// Create some defaults, extending them with any options that were provided
	let settings = $.extend( {
		'selectorForClose': '.or-view'
	}, options);

	let button = this;

	$( settings.selectorForClose ).click( function() {
		// Closing all dropdowns on any click.
		//$(button).removeClass('button--is-active');
	});

	return $(this)
		.addClass('button--is-watched')
		.click( function() {
			$(this).toggleClass('button--is-active');
		} ) ;

};



