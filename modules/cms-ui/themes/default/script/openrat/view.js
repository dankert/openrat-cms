/**
 * View.
 * A view is a part of the page. An Action is loaded into this view.
 *
 * @param action
 * @param method
 * @param id
 * @param params
 * @constructor
 */
Openrat.View = function( action,method,id,params ) {

    this.action = action;
    this.method = method;
    this.id = id;
    this.params = params;

    this.before = function() {};

    this.start = function( element ) {
        this.before();
        this.element = element;
        this.loadView();
    }

    this.afterLoad = function() {

    }

    this.close = function() {
    }


    function registerViewEvents(element) {

        Openrat.Workbench.afterViewLoadedHandler.fire( element );

        let f = $(element).data('afterViewLoaded');
        if   ( f instanceof Function)
            f(element);
    }


    this.loadView = function() {

		// Load the template
        let url = Openrat.View.createUrl( this.action,this.method,this.id,this.params,false); // URL für das Laden erzeugen.
		let loadViewHtmlPromise = $.ajax( url );

		// Load the data for this view.
		let apiUrl = Openrat.View.createUrl( this.action,this.method,this.id,this.params,true);
		let loadViewApiPromise = $.getJSON( apiUrl );

        let element = this.element;
        let view = this;

        let viewData = {};
        viewData._language = Openrat.Workbench.language;
        viewData._ui       = Openrat.Workbench.settings;
		let updater = $.Callbacks();

		$(this.element).empty().fadeTo(1,0.7).addClass('loader');

        loadViewHtmlPromise.done( function(data,status){

        	$(element).html(data);
			$(element).fadeTo(350,1);

			$(element).removeClass("loader");

			$(element).find('form').each( function() {
				let form = new Openrat.Form();
				form.close = function() {
					view.close();
				}
				form.initOnElement(this);

			});

			$(element).bindify( viewData, {
				prefix        : 'b',
				updateModel   :false, // We only need 1-way-binding here
				updateDOM     :false,
				updateCallback: updater // unused?
			} );

			registerViewEvents( element );
		} );

		loadViewHtmlPromise.fail( function(jqxhr,status,cause) {
			$(element).html("");

			Openrat.Workbench.notify('','','error','Server Error',['Server Error while requesting url '+url, status]);
		});


		loadViewHtmlPromise.done( function() {

			loadViewApiPromise.done( function(data,status){
				// Data-Binding
				// our own updater for informing the binding about data changes.
				$.extend(viewData,data);
				updater.fire();
			} );
		} );

		loadViewApiPromise.fail( function(jqxhr,status,cause) {
			Openrat.Workbench.notify('','','error','Server Error',['Server Error while requesting url '+apiUrl, status]);
		});
	}




    /**
     * Erzeugt eine URL, um die gewünschte Action vom Server zu laden.
     *
     * @param action
     * @param subaction
     * @param id
     * @param extraid
     * @returns URL
     */
    Openrat.View.createUrl = function(action,subaction,id,extraid={},api=false )
    {
        let url = './';

		if   ( api )
			url += 'api/';

		url += '?';

        if(action)
            url += '&action='+action;
        if(subaction)
            url += '&subaction='+subaction;
        if(id)
            url += '&id='+id;

        if	( typeof extraid === 'string')
        {
            extraid = extraid.replace(/'/g,'"'); // Replace ' with ".
            let extraObject = jQuery.parseJSON(extraid);
            jQuery.each(extraObject, function(name, value) {
                url = url + '&' + name + '=' + value;
            });
        }
        else if	( typeof extraid === 'object')
        {
            jQuery.each(extraid, function(name, field) {
                url = url + '&' + name + '=' + field;
            });
        }
        else
        {
        }
        return url;
    }


}
