/**
 * Navigation.
 */
var Navigator = new function () {
	'use strict';

	/**
	 * Navigiert zu einer Action, aber ohne ein neues History-Element einzufügen.
	 */
	this.navigateTo = function(state) {
		Workbench.loadNewActionState(state);
	}


    /**
	 *
     * Navigiert zu einer neue Action und fügt einen neuen History-Eintrag hinzu.
     */
	this.navigateToNew = function(obj) {

		Workbench.loadNewActionState(obj);
		window.history.pushState(obj,obj.name,'./#/'+obj.action+(obj.id?'/'+obj.id:'') );
    }

    this.navigateToNewAction = function(action, method, id, params ) {
        var state = {action:action,method:method,id:id.replace(/[^0-9_]/gim,""),data:params};
        this.navigateToNew(state);
	}

    /**
	 * Setzt den State für den aktuellen History-Eintrag.
     * @param obj
     */
    this.toActualHistory = function(obj) {
        window.history.replaceState(obj,obj.name,createUrl(obj.action,null,obj.id,obj.data,false) );
    }
}

openrat.navigator = Navigator;