import query, {OQuery} from './Oquery.js';

import autoheight from './plugin/jquery-plugin-orAutoheight.js';
import button     from './plugin/jquery-plugin-orButton.js';
import linkify    from './plugin/jquery-plugin-orLinkify.js';
import search     from './plugin/jquery-plugin-orSearch.js';
import tree       from './plugin/jquery-plugin-orTree.js';
import toggleAttr from './plugin/jquery-plugin-toggleAttr.js';

query.createQuery = (nodeList) => new CMSQuery(nodeList);

export default query;

class CMSQuery extends OQuery {

	createNew(nodeList) {
		return new CMSQuery(nodeList);
	}

	static classPrefix = 'or-';

	addClass( styleClass ) {
		return super.addClass( CMSQuery.classPrefix + styleClass )
	}
	removeClass( styleClass ) {
		return super.removeClass( CMSQuery.classPrefix + styleClass )
	}
	hasClass( styleClass ) {
		return super.hasClass( CMSQuery.classPrefix + styleClass )
	}

	orAutoheight() {
		return autoheight.call(this);
	};

	orButton() {
		return button.call(this);
	};

	orLinkify() {
		return linkify.call(this);
	};

	orSearch() {
		return search.call(this);
	};

	orTree() {
		return tree.call(this);
	};

	toggleAttr() {
		return toggleAttr.call(this);
	};
}


