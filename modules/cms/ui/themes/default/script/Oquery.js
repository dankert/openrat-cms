/*! OQuery */
/**
 * OQuery is a very light ES6-ready replacement for JQuery
 *
 */
let query = function (selector ) {

	if   ( typeof selector === 'string' )
		return query.createQuery( document.querySelectorAll(selector) );
	else if ( selector instanceof HTMLElement )
		return query.createQuery([selector] );
	else if ( selector instanceof OQuery )
		return selector;
	else
		//console.warn( new Error("Illegal argument '"+selector+"' of type "+(typeof selector)) );
		return query.createQuery( [] );

}

query.createQuery = function(nodeList ) {
	return new OQuery( nodeList );
}

query.create = function(tagName ) {
	return query.createQuery( [document.createElement( tagName )] );
};

query.id = function(id ) {
	let el = document.getElementById( id );
	if   ( el )
		return query.createQuery( [el] );
	else
		return query.createQuery( [] );
};

query.one = function(selector ) {
	return query.createQuery( [document.querySelector( selector )] );
};

query.extend = function() {
	for(let i=1; i<arguments.length; i++)
		for(let key in arguments[i])
			if(arguments[i].hasOwnProperty(key))
				arguments[0][key] = arguments[i][key];
	return arguments[0];
}

export default query;


export class OQuery {

	static fn = OQuery.prototype;
	
	createNew(nodeList) {
		return new OQuery(nodeList)
	};

	constructor( nodeList ) {

		this.nodes = Array.isArray(nodeList) ? nodeList : Array.from(nodeList)
	}

	get( idx ) {
		return this.nodes[idx];
	}
	first() {
		return this.createNew( this.nodes.length > 0 ? [this.nodes[0]] : [] );
	};


	/**
	 * 'length' property is the size of all nodes in this object.
	 * this property is readonly.
	 *
	 * @return size of all elements
	 */
	get length() {
		return this.nodes.length;
	}


	/**
	 * Reads the direct parent of all nodes, optionally filtered by a selector.
	 * @param selector
	 * @return {OQuery}
	 */
	parent( selector = null ) {
		return this.createNew(
			this.nodes.map(node => node.parentElement )
				.filter( node => !!node ) // Filter non-existent parents
				.filter( node => !selector || node.matches(selector) )
		);
	};


	/**
	 * Reads all parents of all nodes, optionally filtered by a selector.
	 *
	 * @param selector
	 * @return {OQuery}
	 */
	parents( selector = null ) {
		let parents = [];
		for( let node of this.nodes )
			while (node) {
				node = node.parentElement;
				if   ( node && (!selector || node.matches(selector)) )
					parents.unshift(node);
			}
		return this.createNew( parents );
	};


	/**
	 * reads the closest anchestor that meets the selector.
	 *
	 * @param selector
	 * @return {OQuery}
	 */
	closest( selector ) {
		return this.createNew( this.nodes.map(node => node.closest( selector ) ).filter( node => node !== null ) );
	};

	children( selector ) {
		let result = [];
		for( let node of this.nodes )
			result = result.concat( Array.from(node.children).filter( node => !selector || node.matches(selector) ) );
		return this.createNew( result );
	};

	find(selector) {
		let result = [];
		for( let node of this.nodes )
			result = result.concat( Array.from(node.querySelectorAll(selector)) );
		return this.createNew( result );
	};

	text( value ) {

		if   ( typeof value !== 'undefined'  ) {
			this.nodes.forEach(node => node.textContent = value );
			return this;
		}
		else {
			return this.nodes[0].textContent;
		}
	};

	addClass( name ) {
		this.nodes.forEach(node => node.classList.add( name ) );
		return this;
	};

	removeClass ( name )  {

		this.nodes.forEach(
			node => node.classList.remove( name )
		);
		return this;
	};

	hasClass( name ) {
		for( let node of this.nodes )
			if  ( node.classList.contains( name ) )
				return true;

		return false;
	};

	toggleClass( name ) {
		if   ( this.hasClass( name ) )
			this.removeClass( name );
		else
			this.addClass( name );

		return this;
	};


	remove() {
		this.nodes.forEach(node => node.remove() );
		return this;
	};



	click ( handler ) {
		this.on( 'click',handler );
		return this;
	};
	dblclick ( handler ) {
		this.on( 'dblclick',handler );
		return this;
	};
	mouseover( handler ) {
		this.on( 'mouseover',handler );
		return this;
	};
	keypress( handler ) {
		this.on( 'keypress',handler );
		return this;
	};
	keyup( handler ) {
		this.on( 'keyup',handler );
		return this;
	};
	submit( handler ) {
		this.on( 'submit',handler );
		return this;
	}
	change( handler ) {
		this.on( 'change',handler )
		return this;
	}
	input( handler ) {
		this.on( 'input',handler )
		return this;
	}



	on ( event,handler ) {
		if   ( typeof handler !== 'undefined')
			this.nodes.forEach(node => node.addEventListener( event,handler.bind(node) ) );
		else
			this.nodes.forEach(node => node.dispatchEvent( new Event(event) ) );
		return this;
	};

	each( handler ) {
		let idx = -1;
		for( let node of this.nodes )
			if   ( handler.call(node,idx,node) === false )
				break;

		return this;
	}

	toggle( handler ) {
		let idx = -1;
		for( let node of this.nodes )
			if   ( handler.call(node,idx,node) === false )
				node.style.display = 'none';
			else
				node.style.display = '';

		return this;
	}

	hide() {
		this.nodes.forEach(node => node.style.display = 'none' );
		return this;
	}

	show() {
		this.nodes.forEach(node => node.style.display = '' );
		return this;
	}

	append( el ) {
		this.nodes.forEach(node => el.nodes.forEach(elnode => node.appendChild(elnode) ) );
		return this;
	}

	appendTo( el ) {
		let to = query( el );
		to.append( this )
		return this;
	}

	attr( name,value ) {
		if   ( typeof value === 'undefined' )
			return this.nodes.length > 0 ? this.nodes[0].getAttribute(name) : '';

		this.nodes.forEach(node => node.setAttribute(name,value) );
		return this;
	}

	data( name,value) {
		if   ( typeof value === 'undefined' )
			if   ( typeof name === 'undefined' )
				return this.nodes.length > 0 ? this.nodes[0].dataset : {};
			else
				return this.nodes.length > 0 ? this.nodes[0].dataset[name] : null;

		this.nodes.forEach(node => node.dataset[name] = value );
		return this;

	}

	html( value ) {
		if   ( typeof value === 'undefined')
			return this.nodes.length > 0 ? this.nodes[0].innerHTML : '';

		this.nodes.forEach(node => node.innerHTML = value );
		return this;
	}

	val( value = null ) {
		if   ( value !== null ) {
			this.nodes.forEach(node => node.value = value );
			return this;
		}
		else
			return this.nodes.length > 0 ? this.nodes[0].value : '';
	}

	empty() {
		this.nodes.forEach(node => {
			while (node.firstChild) {
				node.removeChild(node.firstChild);
			}
		} );

		return this;
	}

	is( selector ) {
		for( let node of this.nodes )
			if   ( node.matches(selector) )
				return true;

		return false;
	}

	toArray() {
		return this.nodes;
	}

	eq( index ) {
		return this.createNew( [ this.nodes[index] ] );
	}

	index() {
		if   ( this.nodes.length == 0 )
			return -1;

		let node = this.nodes[0];

		let children = node.parentNode.childNodes;
		let num = 0;
		for (let i=0; i<children.length; i++) {
			if ( children[i] == node) return num;
			if ( children[i].nodeType==1) num++;
		}
		return -1;
	}

}