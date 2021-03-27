/**
 * Navigation.
 *
 * Controls the history API.
 */
export default class WorkbenchNavigator {
	'use strict';

    /**
	 *
     * Creates a new history entry.
     */
	static navigateToNew(obj) {

		window.history.pushState(obj,obj.name,WorkbenchNavigator.createShortUrl(obj.action,obj.id) );
    }

    /**
	 * Setzt den State für den aktuellen History-Eintrag.
     * @param obj
     */
    static toActualHistory(obj) {
        window.history.replaceState(obj,obj.name,WorkbenchNavigator.createShortUrl(obj.action,obj.id) );
    }


	/**
	 * Creates the URL for the browser adress bar.
	 *
	 * @param action action
	 * @param id ID
	 * @return string
	 */
    static createShortUrl(action,id) {
		return './#/'+action+(id?'/'+id:'');
	}
}
