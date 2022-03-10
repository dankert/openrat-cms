import $ from  '../../../../cms/ui/themes/default/script/jquery-global.js';
import Workbench from "../../../../cms/ui/themes/default/script/openrat/workbench.js";


export default function(element ) {

	// Wrapper Checkboxes will control the "hidden checkbox".
	// So unchecked checkboxes will posted too.
	$(element).find('.or-form-checkbox').change(function(e) {
		this.nextElementSibling.value = this.checked ? '1' : '0';
	});

	// Restore the remembered check flag
	$(element).find('.or-form-checkbox.or-remember').each( function() {
		let key = 'preset.'+Workbench.state.action+'.'+this.dataset['name'];
		if   ( window.localStorage )
			this.checked = !!localStorage.getItem(key);
			this.nextElementSibling.value = this.checked ? '1' : '0';
	});

	// Store the check flag
	$(element).find('.or-form-checkbox.or-remember').change(function() {
		let key = 'preset.'+Workbench.state.action+'.'+this.dataset['name'];
		if   ( window.localStorage )
			window.localStorage.setItem(key,this.checked?'1':'');
	});

};


