Workbench.afterViewLoadedHandler.add(  function(element ) {


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

});


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
		notice.setContext('folder',0,'' );
		notice.inProgress();
		notice.show();

		$.ajax( { 'type':'POST',url:'./api/', cache:false,contentType: false, processData: false, data:form_data, success:function(data, textStatus, jqXHR)
			{
				notice.close();
				let oform = new Form();
				oform.doResponse(data,textStatus,form);
			},
			error:function(jqXHR, textStatus, errorThrown) {
				$(form).closest('div.content').removeClass('loader');
				notice.close();
				
				let msg;
				console.error(jqXHR);
				try
				{
					let error = jQuery.parseJSON( jqXHR.responseText );
					msg = error.error + '/' + error.description + ': ' + error.reason;
				}
				catch( e )
				{
					msg = jqXHR.responseText;
				}

				let notice = new Notice();
				notice.setStatus('error');
				notice.msg = 'Upload error: ' + msg;
				notice.show();
			}
			
		} );
	}
}
