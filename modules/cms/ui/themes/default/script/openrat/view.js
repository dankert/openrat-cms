import $ from  '../jquery-global.js';
import Callback from "./callback.js";
import Form     from "./form.js";
import Notice   from "./notice.js";

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
export default class View {

	constructor( action,method,id,params ) {
		this.action = action;
		this.method = method;
		this.id = id;
		this.params = params;

		this.onCloseHandler = new Callback();

		this.onChangeHandler = new Callback();
		this.onSaveHandler = new Callback();
	}

    before() {

	};

	/**
	 * @param element
	 * @returns {Promise}
	 */
	start( element ) {

        this.before();
        this.element = element;
        return this.loadView();
    }

    afterLoad() {

    }

    close() {

		this.onCloseHandler.fire();
    }


    fireViewLoadedEvents(element) {

		Callback.afterViewLoadedHandler.fire( element );
    }


	/**
	 * Loads the content of this view
	 *
	 * @returns Promise
	 */
	async loadView() {

        let url = View.createUrl( this.action,this.method,this.id,this.params,false); // URL für das Laden erzeugen.
        let element = this.element;
        let view = this;

		//$(this.element).addClass('loader');
		console.debug( view );

		try {
			let response = await fetch( url,{} );

			if   ( ! response.ok )
				throw "failed to load the view";

			let data = await response.text();

			if   ( ! data )
				data = '';

			$(element).html(data);

			$(element).find('form').each( function() {

				let form = new Form();

				form.onChangeHandler.add( () => { view.onChangeHandler.fire() } );
				form.onSaveHandler  .add( () => { view.onSaveHandler  .fire() } );
				form.onCloseHandler .add( () => { view.close()                } );

				form.forwardTo = function (action, subaction, id, data) {
					view.action = action;
					view.method = subaction;
					view.id     = id;
					view.params = data;
					view.loadView();
				}

				form.initOnElement(this);
			});

			view.fireViewLoadedEvents( element );
		}
		catch( cause ) {
			$(element).html("");

			console.error( {view:view, url:url, cause: cause} );

			let notice = new Notice();
			notice.setStatus('error');
			//notice.msg = Workbench.language.ERROR;
			notice.msg = "View error";
			notice.log = cause;
			notice.show();
		}
		finally {
			//$(element).removeClass("loader");
		}
	}




    /**
	 * Erzeugt eine URL, um die gewünschte Action vom Server zu laden.
	 *
	 * @param action
	 * @param subaction
	 * @param id
	 * @param extraid
	 * @param api
	 * @returns string
	 */
    static createUrl(action,subaction,id,extraid={},api=false )
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

        if   ( extraid instanceof FormData ) {
			for (let pair of extraid.entries()) {
				// value is already encoded.
				// this does not support multiple values.
				url += '&' + pair[0] + '=' + pair[1];
			}
		}
        else if	( extraid instanceof Object ) {

			Object.keys(extraid).forEach( (key) =>  {
				url += '&' + key + '=' + extraid[key];
			});
        }
        else
        	throw "Illegal argument";

        if   ( api )
        	url += '&output=json';

        return url;
    }


}
