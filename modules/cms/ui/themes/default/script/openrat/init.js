
// Create own namespace.

window.Openrat = {};

let originalAddClass = jQuery.fn.addClass;
jQuery.fn.addClass = function (styleClass) {
	return originalAddClass.call(this,'or-'+styleClass);
}

let originalRemoveClass = jQuery.fn.removeClass;
jQuery.fn.removeClass = function (styleClass) {
	return originalRemoveClass.call(this,'or-'+styleClass);
}

/*
let originalToggleClass = jQuery.fn.toggleClass;
jQuery.fn.toggleClass = function (styleClass) {
	return originalToggleClass.call(this,'or-'+styleClass);
}
*/

let originalHasClass = jQuery.fn.hasClass;
jQuery.fn.hasClass = function (styleClass) {
	return originalHasClass.call(this,'or-'+styleClass);
}
