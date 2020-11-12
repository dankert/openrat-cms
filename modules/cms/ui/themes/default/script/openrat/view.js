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

	/**
	 * @param element
	 * @returns {Promise}
	 */
	this.start = function( element ) {
        this.before();
        this.element = element;
        return this.loadView();
    }

    this.afterLoad = function() {

    }

    this.close = function() {
    }


    function fireViewLoadedEvents(element) {

        Openrat.Workbench.afterViewLoadedHandler.fire( element );
    }


	/**
	 * Loads the content of this view
	 * @returns Promise
	 */
	this.loadView = function() {

        let url = Openrat.View.createUrl( this.action,this.method,this.id,this.params,false); // URL für das Laden erzeugen.
        let element = this.element;
        let view = this;

        let loadViewHtmlPromise = $.ajax( url );

		$(this.element).addClass('loader');

        loadViewHtmlPromise.done( function(data,status){

        	if   ( ! data )
        		data = '';

        	$(element).html(data).removeClass("loader");

			$(element).find('form').each( function() {

				let form = new Openrat.Form();

				form.close = function() {
					view.close();
				}

				form.forwardTo = function (action, subaction, id, data) {
					view.action = action;
					view.method = subaction;
					view.id     = id;
					view.params = data;
					view.loadView();
				}

				form.initOnElement(this);
			});

			fireViewLoadedEvents( element );
		} );

		loadViewHtmlPromise.fail( function(jqxhr,status,cause) {
			$(element).html("");

			Openrat.Workbench.notify('', 0, '', 'error', 'Server Error', ['Server Error while requesting url ' + url, status]);
		});

		// Load the data for this view.
		let apiUrl = Openrat.View.createUrl( this.action,this.method,this.id,this.params,true);

		return loadViewHtmlPromise;
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
