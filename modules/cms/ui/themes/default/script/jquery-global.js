/*
import './jquery.min.js';

let jQuery = $;
export default jQuery;
window.$ = $;

import autoheight from './plugin/jquery-plugin-orAutoheight.js';
import button     from './plugin/jquery-plugin-orButton.js';
import linkify    from './plugin/jquery-plugin-orLinkify.js';
import search     from './plugin/jquery-plugin-orSearch.js';
import tree       from './plugin/jquery-plugin-orTree.js';
import toggleAttr from './plugin/jquery-plugin-toggleAttr.js';

jQuery.fn.orAutoheight = autoheight;
jQuery.fn.orButton = button;
jQuery.fn.orLinkify = linkify;
jQuery.fn.orSearch = search;
jQuery.fn.orTree = tree;
jQuery.fn.toggleAttr = toggleAttr;

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
*/

import $, {OQuery} from './Oquery.js';

export default $;

import autoheight from './plugin/jquery-plugin-orAutoheight.js';
import button     from './plugin/jquery-plugin-orButton.js';
import linkify    from './plugin/jquery-plugin-orLinkify.js';
import search     from './plugin/jquery-plugin-orSearch.js';
import tree       from './plugin/jquery-plugin-orTree.js';
import toggleAttr from './plugin/jquery-plugin-toggleAttr.js';

OQuery.fn.orAutoheight = autoheight;
OQuery.fn.orButton = button;
OQuery.fn.orLinkify = linkify;
OQuery.fn.orSearch = search;
OQuery.fn.orTree = tree;
OQuery.fn.toggleAttr = toggleAttr;

let originalAddClass = OQuery.fn.addClass;
OQuery.fn.addClass = function (styleClass) {
	return originalAddClass.call(this,'or-'+styleClass);
}

let originalRemoveClass = OQuery.fn.removeClass;
OQuery.fn.removeClass = function (styleClass) {
	return originalRemoveClass.call(this,'or-'+styleClass);
}

let originalHasClass = OQuery.fn.hasClass;
OQuery.fn.hasClass = function (styleClass) {
	return originalHasClass.call(this,'or-'+styleClass);
}
