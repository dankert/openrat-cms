import $ from  '../../../../cms/ui/themes/default/script/jquery-global.js';


export default function(element ) {

	// Wrapper Checkboxes will control the "hidden checkbox".
	// So unchecked checkboxes will posted too.
	$(element).find('.or-form-checkbox').change(function(e) {
		this.nextElementSibling.value = this.checked ? 'on' : 'off';
	});

};


