class Callback {

	constructor() {
		this.list = [];
	}

	// Add a callback or a collection of callbacks to the list
	add( callable ) {
		this.list.push( callable );
	}

	fire() {
		for( let c of this.list)
			c.apply(null,arguments);
	}

}