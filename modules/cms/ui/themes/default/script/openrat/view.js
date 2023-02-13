import $ from  '../jquery-global.js';
import Callback from "./callback.js";
import Form     from "./form.js";
import Notice   from "./notice.js";
import Workbench from "./workbench.js";

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

        let url     = View.createUrl(this.action, this.method, this.id, this.params); // URL für das Laden erzeugen.
        let element = this.element;
        let view    = this;

		//$(this.element).addClass('loader');
		console.debug( view );

		try {
			let response = await fetch( url,{
				method: 'GET',
				headers: {
					'Accept': 'text/html',
				}
			} );
			$(element).html("");

			if   ( ! response.ok ) {

				$(element).html('<div class="or-view-central"><i class="or-image-icon or-image-icon--method-logout" /></div>');

				if   ( response.status == 403 ) {
					throw "Permission denied";
				}
				else if   ( response.status == 503 ) {

					let data = await response.text();
					if   ( ! data )
						data = '';
					const errorDoc = new DOMParser().parseFromString(data,"text/html");
					const error    = errorDoc.getElementById("cms-error-log");
					throw "CMS Service unavailable\n" + error.innerText;
				}
				else if   ( response.status == 500 ) {

					let data = await response.text();
					if   ( ! data )
						data = '';
					const errorDoc = new DOMParser().parseFromString(data,"text/html");
					const error    = errorDoc.getElementById("cms-error-log");
					throw "CMS Server Error\n" + error.innerText;
				}
				else
					throw "Failed to load the view: " + response.status + " " + response.statusText;

			}

			let data = await response.text();

			if   ( ! data )
				data = '';

			$(element).html(data);

			$(element).find('form').each( function() {

				let form = new Form();

				form.onChangeHandler.add( () => { view.onChangeHandler.fire() } );
				form.onSaveHandler  .add( () => { view.onSaveHandler  .fire() } );
				form.onCloseHandler .add( () => { view.close()                } );

				form.forwardHandler.add( (action, subaction, id, data) => {
					view.action = action;
					view.method = subaction;
					view.id     = id;
					view.params = data;
					view.loadView();
				} );

				form.initOnElement(this);
			});

			view.fireViewLoadedEvents( element );
		}
		catch( cause ) {

			console.error( {view:view, url:url, cause: cause} );

			let notice = new Notice();
			notice.setStatus('error');
			//notice.msg = Workbench.language.ERROR;
			notice.msg = Workbench.language.NOTHING_DONE;
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
	 * @returns string
	 */
    static createUrl(action, subaction, id= 0, extraid = {}) {
        let url = './?';

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

        return url;
    }


}
