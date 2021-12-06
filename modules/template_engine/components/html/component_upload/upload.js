import Workbench from "../../../../cms/ui/themes/default/script/openrat/workbench.js";
import Api       from "../../../../cms/ui/themes/default/script/openrat/api.js";
import $         from "../../../../cms/ui/themes/default/script/jquery-global.js";

export default function (element ) {


	let form = $(element).find('form');

	// Dateiupload über Drag and Drop
	let dropzone = $(element).find('div.or-dropzone-upload');
	dropzone.on('dragenter', function (e) 
	{
		e.stopPropagation();
		e.preventDefault();
		$(this).css('border', '1px dotted gray');
	});
	dropzone.on('dragover', function (e) 
	{
		 e.stopPropagation();
		 e.preventDefault();
	});
	dropzone.on('drop', function (e) 
	{
		 $(this).css('border','1px dotted red');
		 e.preventDefault();
		 let files = e.originalEvent.dataTransfer.files;

		 //We need to send dropped files to Server
		Workbench.handleFileUpload(form,files);
	});
	
	
	// Dateiupload über File-Input-Button
	$(element).find('input[type=file]').change( function() {
		
		let files = this.files;

		Workbench.handleFileUpload(form,files);
	});

};


/**
 * Upload of files.
 * @param form
 * @param files
 */
Workbench.handleFileUpload = function(form,files)
{
	for (let i = 0; i < files.length; i++)
	{
		let f = files[i];
	    let form_data = new FormData();
	    form_data.append('file'     , f);
	    form_data.append('action'   , $(form).data('action'));
	    form_data.append('subaction', $(form).data('method'));
	    form_data.append('token'    , $(form).find('input[name=token]').val() );
	    form_data.append('id'       , $(form).find('input[name=id]'   ).val() );
	    form_data.append('output'   , 'json' );

	    let api = new Api();
	    api.sendData( form_data );
	}
}
