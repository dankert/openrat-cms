/**
 * Navigation.
 */
class WorkbenchNavigator {
	'use strict';

	constructor( workbench ) {
		this.workbench = workbench;
	}
	/**
	 * Navigiert zu einer Action.
	 */
	navigateTo(state) {

		console.debug('Navigating to ',state);
		this.workbench.loadNewActionState(state);
	}


    /**
	 *
     * Navigiert zu einer neue Action und fügt einen neuen History-Eintrag hinzu.
     */
	navigateToNew(obj) {

		this.navigateTo(obj);

		window.history.pushState(obj,obj.name,WorkbenchNavigator.createShortUrl(obj.action,obj.id) );
    }

    /**
	 * Setzt den State für den aktuellen History-Eintrag.
     * @param obj
     */
    toActualHistory(obj) {
        window.history.replaceState(obj,obj.name,WorkbenchNavigator.createShortUrl(obj.action,obj.id) );
    }



    static createShortUrl(action,id) {
		return './#/'+action+(id?'/'+id:'');
	}
}
