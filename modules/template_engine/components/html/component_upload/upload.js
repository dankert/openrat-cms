import Workbench from "../../../../cms/ui/themes/default/script/openrat/workbench.js";
import $ from  '../../../../cms/ui/themes/default/script/jquery-global.js';

export default function (element ) {


	var form = $(element).find('form');

	// Dateiupload über Drag and Drop
	var dropzone = $(element).find('div.or-dropzone-upload > div.input');
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
		 var files = e.originalEvent.dataTransfer.files;

		 //We need to send dropped files to Server
		Workbench.handleFileUpload(form,files);
	});
	
	
	// Dateiupload über File-Input-Button
	$(element).find('input[type=file]').change( function() {
		
		var files = $(this).prop('files');

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
	for (let i = 0, f; f = files[i]; i++)
	{
	    let form_data = new FormData();
	    form_data.append('file'     , f);
	    form_data.append('action'   ,'folder');
	    form_data.append('subaction',$(form).data('method'));
	    form_data.append('output'   ,'json');
	    form_data.append('token'    ,$(form).find('input[name=token]').val() );
	    form_data.append('id'       ,$(form).find('input[name=id]'   ).val() );
	    
		let notice = new Notice();
		notice.inProgress();
		notice.show();

		let url ='./api/';
		let load = fetch( url, {
			method: 'POST'
		} );

		load.then( response => {
			return response.json();
		}).then( data => {

				notice.close();
				let oform = new Form();
				oform.doResponse(data,"",form);
			} ).catch( error => {

				notice.close();
				
				console.error(error);
				let notice = new Notice();
				notice.setStatus('error');
				notice.msg = 'Upload error';
				notice.log = error;
				notice.show();
			}
		);
	}
}
