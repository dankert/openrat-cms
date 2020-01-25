

Openrat.Workbench = new function()
{
    'use strict'; // Strict mode


    this.state = {};


    /**
	 * Initializes the Workbench.
     */
	this.initialize = function() {

		// Initialze Ping timer.
		this.initializePingTimer();
        this.initializeState();
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

        Openrat.Workbench.state = state;

        // TODO: Remove this sometimes.... only state.
        $('#editor').attr('data-action',state.action);
        $('#editor').attr('data-id'    ,state.id    );
        $('#editor').attr('data-extra' ,'{}'  );

        Openrat.Navigator.toActualHistory( state );

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
            $.ajax( Openrat.View.createUrl('title','ping',0, {}, false) );
            //window.console && console.log("session-ping");
        }

        // Alle 5 Minuten pingen.
		var timeoutMinutes = 5;

        window.setInterval( ping, timeoutMinutes*60*1000 );
    }



    this.loadNewActionState = function(state) {

        Openrat.Workbench.state = state;
        Openrat.Workbench.loadNewAction(state.action,state.id,state.data);

        this.afterNewActionHandler.fire();
	}


    this.afterNewActionHandler = $.Callbacks();


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

        Openrat.Workbench.loadViews( $('#workbench section.open .view-loader') );
    }


    this.reloadAll = function() {

    	// View in geschlossenen Sektionen löschen, damit diese nicht stehen bleiben.
        $('#workbench .view').empty();

        Openrat.Workbench.loadViews( $('#workbench .view.view-loader, #workbench .view.view-static') );

        this.loadUserStyle();
    }


    this.loadUserStyle = function() {

        let url = Openrat.View.createUrl('index','userinfo',0, {},false );

        // Die Inhalte des Zweiges laden.
        $.getJSON(url, function (themeData) {

            let style = themeData['style'];
            Openrat.Workbench.setUserStyle(style);

            let color = themeData['theme-color'];
            Openrat.Workbench.setThemeColor(color);
        });
    }



    this.loadViews = function( $views )
    {

        $views.each(function (idx) {

            let $targetDOMElement = $(this);

            Openrat.Workbench.loadNewActionIntoElement( $targetDOMElement )
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

        let view = new Openrat.View( action,method,id,params );
        view.start( $viewElement );
    }




    /**
     * Sets a new theme.
     * @param styleName
     */
    this.setUserStyle = function( styleName )
    {
        var html = $('html');
        var classList = html.attr('class').split(/\s+/);
        $.each(classList, function(index, item) {
            if (item.startsWith('theme-')) {
                html.removeClass(item);
            }
        });
        html.addClass( 'theme-' + styleName.toLowerCase() );
    }


    /**
     * Sets a new theme color.
     * @param color Theme-color
     */
    this.setThemeColor = function( color )
    {
        $('#theme-color').attr('content',color);
    }




    /**
     * Show a notification in the browser.
     * Source: https://developer.mozilla.org/en-US/docs/Web/API/notification
     * @param text text of message
     */
    let notifyBrowser = function(text)
    {
        // Let's check if the browser supports notifications
        if (!("Notification" in window)) {
            return;
        }

        // Let's check if the user is okay to get some notification
        else if (Notification.permission === "granted") {
            // If it's okay let's create a notification
            let notification = new Notification(text);
        }

        // Otherwise, we need to ask the user for permission
        else if (Notification.permission !== 'denied') {
            Notification.requestPermission(function (permission) {
                // If the user is okay, let's create a notification
                if (permission === "granted") {
                    let notification = new Notification(text);
                }
            });
        }

        // At last, if the user already denied any notification, and you
        // want to be respectful there is no need to bother them any more.
    }



    /**
     * Show a notice bubble in the UI.
     * @param type
     * @param name
     * @param status
     * @param msg
     * @param log
     */
    this.notify = function( type,name,status,msg,log=[],notifyTheBrowser=false )
    {
        // Notice-Bar mit dieser Meldung erweitern.

        if   ( notifyTheBrowser )
            notifyBrowser( msg );  // Notify browser if wanted.

        let notice = $('<div class="notice '+status+'"></div>');

        let toolbar = $('<div class="or-notice-toolbar"></div>');
        if   ( log.length )
            $(toolbar).append('<i class="or-action-full image-icon image-icon--menu-fullscreen"></i>');
        $(toolbar).append('<i class="or-action-close image-icon image-icon--menu-close"></i>');
        $(notice).append(toolbar);

        let id = 0; // TODO id of objects to click on
        if	(name)
            $(notice).append('<div class="name clickable"><a href="" data-type="open" data-action="'+type+'" data-id="'+id+'"><i class="or-action-full image-icon image-icon--action-'+type+'"></i> '+name+'</a></div>');

        $(notice).append( '<div class="text">'+htmlEntities(msg)+'</div>');

        if (log.length) {

            let logLi = log.reduce((result, item) => {
                result += '<li><pre>'+htmlEntities(item)+'</pre></li>';
                return result;
            }, '');
            $(notice).append('<div class="log"><ul>'+logLi+'</ul></div>');
        }

        $('#noticebar').prepend(notice); // Notice anhängen.
        $(notice).orLinkify(); // Enable links


        // Toogle Fullscreen for notice
        $(notice).find('.or-action-full').click( function() {
            $(notice).toggleClass('full');
        });

        // Close the notice on click
        $(notice).find('.or-action-close').click( function() {
            $(notice).fadeOut('fast',function() { $(notice).remove(); } );
        });

        // Fadeout the notice after a while.
        let timeout = 1;
        if ( status == 'ok'     ) timeout = 20;
        if ( status == 'info'   ) timeout = 60;
        if ( status == 'warning') timeout = 120;
        if ( status == 'error'  ) timeout = 120;

        if (timeout > 0)
            setTimeout( function() {
                $(notice).fadeOut('slow', function() { $(this).remove(); } );
            },timeout*1000 );
    }



	this.dataChangedHandler = $.Callbacks();

	this.dataChangedHandler.add( function() {
		if   ( popupWindow !== undefined )
			popupWindow.location.reload();
	} );

    this.afterViewLoadedHandler = $.Callbacks();

    let afterViewFunctions = [];

    this.registerAfterViewLoaded = function( f ) {
        afterViewFunctions.push( f );
    }

    this.afterViewLoaded = function( element ) {

        afterViewFunctions.forEach( function( f ) {
           f(element);
        });
    }

}


