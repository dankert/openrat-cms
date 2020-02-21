Openrat.Workbench.afterViewLoadedHandler.add(  function(element ) {


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
		 handleFileUpload(form,files);
	});
	
	
	// Dateiupload über File-Input-Button
	$(element).find('input[type=file]').change( function() {
		
		var files = $(this).prop('files');   

		handleFileUpload(form,files);
	});

});






function handleFileUpload(form,files)
{
	for (var i = 0, f; f = files[i]; i++)
	{
	    var form_data = new FormData();                  
	    form_data.append('file'     , f);
	    form_data.append('action'   ,'folder');
	    form_data.append('subaction',$(form).data('method'));
	    form_data.append('output'   ,'json');
	    form_data.append('token'    ,$(form).find('input[name=token]').val() );
	    form_data.append('id'       ,$(form).find('input[name=id]'   ).val() );
	    
		var status = $('<div class="notice info"><div class="text loader"></div></div>');
		$('#noticebar').prepend(status); // Notice anhängen.
		$(status).show();

		$.ajax( { 'type':'POST',url:'./api/', cache:false,contentType: false, processData: false, data:form_data, success:function(data, textStatus, jqXHR)
			{
				$(status).remove();
				let oform = new Openrat.Form();
				oform.doResponse(data,textStatus,form);
			},
			error:function(jqXHR, textStatus, errorThrown) {
				$(form).closest('div.content').removeClass('loader');
				$(status).remove();
				
				var msg;
				try
				{
					var error = jQuery.parseJSON( jqXHR.responseText );
					msg = error.error + '/' + error.description + ': ' + error.reason;
				}
				catch( e )
				{
					msg = jqXHR.responseText;
				}
				
				Openrat.Workbench.notify('Upload error',msg);
			}
			
		} );
	}
}
