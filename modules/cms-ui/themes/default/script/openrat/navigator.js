/**
 * Navigation.
 */
Openrat.Navigator = new function () {
	'use strict';

	/**
	 * Navigiert zu einer Action.
	 */
	this.navigateTo = function(state) {
		Openrat.Workbench.loadNewActionState(state);
	}


    /**
	 *
     * Navigiert zu einer neue Action und fügt einen neuen History-Eintrag hinzu.
     */
	this.navigateToNew = function(obj) {

		this.navigateTo(obj);

		window.history.pushState(obj,obj.name,'./#/'+obj.action+(obj.id?'/'+obj.id:'') );
    }

    /**
	 * Setzt den State für den aktuellen History-Eintrag.
     * @param obj
     */
    this.toActualHistory = function(obj) {
        window.history.replaceState(obj,obj.name,createUrl(obj.action,null,obj.id,obj.data,false) );
    }
}
