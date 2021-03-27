/**
 * Simple Callback.
 */
export default class Callback {

	// internal callbacks.

	constructor() {
		this.list = [];
	}

	/**
	 * Add a callback to the list
	 *
	 * @param callable the new callback
	 */
	add( callable ) {
		this.list.push( callable );
	}

	/**
	 * Fire all callbacks.
	 */
	fire() {
		for( let c of this.list)
			c.apply(null,arguments);
	}

}

console.debug("registering callbacks");
Callback.afterViewLoadedHandler = new Callback();
Callback.dataChangedHandler     = new Callback();
Callback.afterNewActionHandler  = new Callback();
Callback.afterAllViewsLoaded    = new Callback();
