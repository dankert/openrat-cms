/**
 * OQuery is a very light ES6-ready replacement for JQuery
 *
 */
let selector = function ( selector ) {

	let node;

	if   ( typeof selector === 'string' )
		node = document.querySelectorAll(selector);
	else if ( selector instanceof HTMLElement )
		node = [selector];
	else
		return selector;

	return new OQuery( node );
}

selector.create = function(tagName ) {
	return new OQuery( [document.createElement( tagName )] );
};


selector.extend = function() {
	for(var i=1; i<arguments.length; i++)
		for(var key in arguments[i])
			if(arguments[i].hasOwnProperty(key))
				arguments[0][key] = arguments[i][key];
	return arguments[0];
}

export default selector;


export class OQuery {

	static fn = OQuery.prototype;

	constructor( nodeList ) {

		this.node = Array.isArray(nodeList) ? nodeList : Array.from(nodeList)
	}

	parent() {
		return this.node[0].parentNode;
	};

	closest( selector ) {
		return new OQuery( [this.node[0].closest( selector )] );
	};

	children() {
		return new OQuery( this.node[0].children );
	};

	find(selector) {
		return new OQuery(this.node[0].querySelectorAll(selector));
	};

	text( value = null ) {

		if   ( value ) {
			this.node.forEach( node => node.textContent = value );
			return this;
		}
		else {
			return this.node[0].textContent;
		}
	};

	addClass( name ) {
		this.node.forEach( node => node.classList.add( name ) );
		return this;
	};

	remove() {
		this.node.forEach( node => node.remove() );
		return this;
	};

	hasClass( name ) {
		return this.node[0].classList.contains( name );
	};

	toggleClass( name ) {

		this.node.forEach( node => {
			if (node.classList.contains( name ) )
				node.classList.remove( name )
			else
				node.classList.add( name )
		} );
		return this;
	};


	removeClass ( name )  {
		this.node.forEach(
			node => node.classList.remove( name )
		);
		return this;
	};

	click ( handler ) {
		this.node.forEach( node => node.addEventListener( 'click',handler.call(node)) );
		return this;
	};

	on ( event,handler ) {
		this.node.forEach( node => node.addEventListener( event,handler.call(node)) );
		return this;
	};

	each( handler ) {
		this.node.forEach(
			node => handler.call(node)
		);
		return this;
	}

	hide() {
		this.node.forEach( node => node.style.display = 'none' );
		return this;
	}

	show() {
		this.node.forEach( node => node.style.display = '' );
		return this;
	}

	append( el ) {
		this.node.forEach( node => el.node.forEach( elnode => node.appendChild(elnode) ) );
		return this;
	}

	appendTo( el ) {
		let to = selector( el );
		to.append( this )
		return this;
	}

	attr( name,value = null) {
		if   ( ! value )
			return this.node[0].getAttribute(name);
		else
			this.node.forEach( node => node.setAttribute(name,value) );

	}

	data( name,value = null) {
		if   ( value === null )
			return this.node[0].dataset[name];
		else
			this.node.forEach( node => node.dataset[name] = value );

	}

	html( value ) {
		if   ( ! value)
			return this.node[0].innerHTML;
		else
			this.node.forEach( node => node.innerHTML = value );
	}

	val( value = null ) {
		if   ( value !== null ) {
			this.node.forEach( node => node.value = value );
			return this;
		}
		else
			return this.node[0].value;
	}

	empty() {
		this.node.forEach( node => {
			while (node.firstChild) {
				node.removeChild(node.firstChild);
			}
		} );

		return this;
	}

	change() {
		this.node.forEach( node => {
			//node.fireEvent("onchange");
		} );
		return this;
	}


	is( selector ) {
		let el = this.node[0];
		return el.matches(selector)
	}

}