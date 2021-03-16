
// Create own namespace.

let workbench = new Workbench();
window.Openrat = {
	workbench: workbench,
	navigator: new WorkbenchNavigator(workbench)
};

let originalAddClass = jQuery.fn.addClass;
jQuery.fn.addClass = function (styleClass) {
	return originalAddClass.call(this,'or-'+styleClass);
}

let originalRemoveClass = jQuery.fn.removeClass;
jQuery.fn.removeClass = function (styleClass) {
	return originalRemoveClass.call(this,'or-'+styleClass);
}

let originalHasClass = jQuery.fn.hasClass;
jQuery.fn.hasClass = function (styleClass) {
	return originalHasClass.call(this,'or-'+styleClass);
}
