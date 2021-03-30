import $ from "../jquery-global.js";

export default function(attr, attr1, attr2) {
	return this.each(function() {
		let self = $(this);
		if (self.attr(attr) == attr1)
			self.attr(attr, attr2);
		else
			self.attr(attr, attr1);
	});
};