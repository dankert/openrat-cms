import Notice from "./notice.js";

/**
 * Api.
 */
export default class Api {

	/**
	 * Sending data to the server.
	 *
	 * @param formData formular data
	 * @returns a promise
	 */
    sendData = function( formData ) {

		console.debug( "API form data", formData );

		let api = this;
		return new Promise( (resolve, reject) => {

			let load = fetch( './', {
				'method':'POST',
				headers: {
					'Accept': 'application/json',
				},
				body:formData
			} );

			load.then( response => {
				if   ( ! response.ok )
					reject( "Failed to post" );

				return response.json();
			}).then( data => {

				for( let value of data['notices'] ) {

					let notice = new Notice();
					notice.setContext( value.type, value.id, value.name );
					notice.log = value.log;
					notice.setStatus( value.status );
					notice.msg = value.text;
					notice.show();

					if	( api.notifyBrowser )
						notice.notifyBrowser()
				};

				if	( data.success ) { // Kein Fehler?
					resolve();
				}
				else {
					// Validation errors
					for( name of data['errors'] )
						this.validationErrorForField( name );

					reject('API request failed');
				}

			} ).catch( cause => {

				console.warn( {
					message: 'API request failed',
					cause  : cause,
					data   : formData,
				} );

				let msg = '';
				try {
					msg = JSON.parse( cause ).message;
				}
				catch( e ) {
					msg = cause;
				}

				let notice = new Notice();
				notice.setStatus('error');
				notice.msg = msg;
				notice.log = cause; //JSON.stringify( $.parseJSON(jqXHR.responseText),null,2);
				notice.show();

				reject( msg );
			} );
		} );

	}


	validationErrorForField = function( nameOfField ) {
	}

}

