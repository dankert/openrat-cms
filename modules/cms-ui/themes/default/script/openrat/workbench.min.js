

var Workbench = new function()
{
    'use strict'; // Strict mode


    /**
	 * Initializes the Workbench.
     */
	this.initialize = function() {

		// Initialze Ping timer.
		this.initializePingTimer();
        this.initializeState();
        this.initializeMenues();
        this.openModalDialog();
    }


    /**
     * Starts a dialog, if necessary.
     */
    this.openModalDialog = function () {

        if   ( $('#dialog').data('action') ) {
            startDialog('',$('#dialog').data('action'),$('#dialog').data('action'),0,{})
        }
    }


    this.initializeMenues = function () {

        filterMenus();
    }


    /**
     * Sets the workbench state with action/id.
     *
     * Example: #/name/1 is translated to the state {action:name,id:1}
     */
    this.initializeState = function () {

        let parts = window.location.hash.split('/');
        let state = { action:'index',id:0 };

        if   ( parts.length >= 2 )
            state.action = parts[1].toLowerCase();

        if   ( parts.length >= 3 )
            // Only numbers and '_' allowed in the id.
            state.id = parts[2].replace(/[^0-9_]/gim,"");

        Workbench.state = state;

        // TODO: Remove this sometimes.... only state.
        $('#editor').attr('data-action',state.action);
        $('#editor').attr('data-id'    ,state.id    );
        $('#editor').attr('data-extra' ,'{}'  );

    }

    /**
	 *  Registriert den Ping-Timer für den Sitzungserhalt.
     */
	this.initializePingTimer = function() {

        /**
         * Ping den Server. Führt keine Aktion aus, aber sorgt dafür, dass die Sitzung erhalten bleibt.
         *
         * "Geben Sie mir ein Ping, Vasily. Und bitte nur ein einziges Ping!" (aus: Jagd auf Roter Oktober)
         */
        var ping = function()
        {
            $.ajax( createUrl('title','ping',0) );
            //window.console && console.log("session-ping");
        }

        // Alle 5 Minuten pingen.
		var timeoutMinutes = 5;

        window.setInterval( ping, timeoutMinutes*60*1000 );
    }



    this.loadNewActionState = function(state) {

	    Workbench.state = state;
		Workbench.loadNewAction(state.action,state.id,state.data);


        filterMenus();

        $(document).trigger('orNewAction');
	}

    /**
	 *
     */

    this.loadNewAction = function(action, id, params ) {

    	$('#editor').attr('data-action',action);
    	$('#editor').attr('data-id'    ,id    );
    	$('#editor').attr('data-extra' ,JSON.stringify(params));

        this.reloadViews();
    }


    /**
     *
     */

    this.reloadViews = function() {

        // View in geschlossenen Sektionen löschen, damit diese nicht stehen bleiben.
        $('#workbench section.closed .view-loader').empty();

        Workbench.loadViews( $('#workbench section.open .view-loader') );
    }


    this.reloadAll = function() {

    	// View in geschlossenen Sektionen löschen, damit diese nicht stehen bleiben.
        $('#workbench .view').empty();

        Workbench.loadViews( $('#workbench .view') );
    }



    this.loadViews = function( $views )
    {

        $views.each(function (idx) {

            let $targetDOMElement = $(this);

            Workbench.loadNewActionIntoElement( $targetDOMElement )
        });
    }



    this.loadNewActionIntoElement = function( $viewElement )
    {
        let action;
        if   ( $viewElement.is('.view-static') )
            // Static views have always the same action.
            action = $viewElement.attr('data-action');
        else
            action = $('#editor').attr('data-action');

        let id     = $('#editor').attr('data-id'    );
        let params = $('#editor').attr('data-extra' );

        let method = $viewElement.data('method');

        let view = new View( action,method,id,params );
        view.start( $viewElement );
    }


}


