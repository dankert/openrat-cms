$(document).on('orViewLoaded',function(event, data) {
	
	if	( $(event.target).find('textarea#pageelement_edit_editor').length > 0 )
	{
		var instance = CKEDITOR.instances['pageelement_edit_editor'];
	    if(instance)
	    {
	        CKEDITOR.remove(instance);
	    }
	    CKEDITOR.replace( 'pageelement_edit_editor',{customConfig:'config-openrat.js'} );
	}
	
	// Wiki-Editor
	var markitupSettings = {	markupSet:  [ 	
	                        	     		{name:'Bold', key:'B', openWith:'*', closeWith:'*' },
	                        	    		{name:'Italic', key:'I', openWith:'_', closeWith:'_'  },
	                        	    		{name:'Stroke through', key:'S', openWith:'--', closeWith:'--' },
	                        	    		{separator:'-----------------' },
	                        	    		{name:'Bulleted List', openWith:'*', closeWith:'', multiline:true, openBlockWith:'\n', closeBlockWith:'\n'},
	                        	    		{name:'Numeric List', openWith:'#', closeWith:'', multiline:true, openBlockWith:'\n', closeBlockWith:'\n'},
	                        	    		{separator:'---------------' },
	                        	    		{name:'Picture', key:'P', replaceWith:'{[![Source:!:http://]!]" alt="[![Alternative text]!]" }' },
	                        	    		{name:'Link', key:'L', openWith:'""->"[![Link:!:http://]!]"', closeWith:'"', placeHolder:'Your text to link...' },
	                        	    		{separator:'---------------' },
	                        	    		{name:'Clean', className:'clean', replaceWith:function(markitup) { return markitup.selection.replace(/<(.*?)>/g, "") } },		
	                        	    		{name:'Preview', className:'preview',  call:'preview'}
	                        	    	]};
	//$(event.target).find('.wikieditor').markItUp(markitupSettings);
	
	// HTML-Editor
	var wymSettings = {lang: 'de',basePath: 'modules/cms-ui/editor/wymeditor/wymeditor/',
			  toolsItems: [
			               {'name': 'Bold', 'title': 'Strong', 'css': 'wym_tools_strong'}, 
			               {'name': 'Italic', 'title': 'Emphasis', 'css': 'wym_tools_emphasis'},
			               {'name': 'Superscript', 'title': 'Superscript', 'css': 'wym_tools_superscript'},
			               {'name': 'Subscript', 'title': 'Subscript', 'css': 'wym_tools_subscript'},
			               {'name': 'InsertOrderedList', 'title': 'Ordered_List', 'css': 'wym_tools_ordered_list'},
			               {'name': 'InsertUnorderedList', 'title': 'Unordered_List', 'css': 'wym_tools_unordered_list'},
			               {'name': 'Indent', 'title': 'Indent', 'css': 'wym_tools_indent'},
			               {'name': 'Outdent', 'title': 'Outdent', 'css': 'wym_tools_outdent'},
			               {'name': 'Undo', 'title': 'Undo', 'css': 'wym_tools_undo'},
			               {'name': 'Redo', 'title': 'Redo', 'css': 'wym_tools_redo'},
			               {'name': 'CreateLink', 'title': 'Link', 'css': 'wym_tools_link'},
			               {'name': 'Unlink', 'title': 'Unlink', 'css': 'wym_tools_unlink'},
			               {'name': 'InsertImage', 'title': 'Image', 'css': 'wym_tools_image'},
			               {'name': 'InsertTable', 'title': 'Table', 'css': 'wym_tools_table'},
			               {'name': 'Paste', 'title': 'Paste_From_Word', 'css': 'wym_tools_paste'},
			               {'name': 'ToggleHtml', 'title': 'HTML', 'css': 'wym_tools_html'},
			               {'name': 'Preview', 'title': 'Preview', 'css': 'wym_tools_preview'}
			             ]
			          };
	
	
	$(event.target).find('textarea').orAutoheight();
	

	
	
	
	// ACE-Editor anzeigen
	$(event.target).find("textarea.editor__ace-editor").each( function() {
		var textareaEl = $(this);
		var aceEl = $("<div class=\"editor__code-editor\" />").insertAfter(textareaEl);
		var editor = ace.edit( aceEl.get(0) );
		var mode = textareaEl.data('mode');
		
		editor.renderer.setShowGutter(true);
		editor.setTheme("ace/theme/github");
		
//		editor.setReadOnly(true);
		editor.getSession().setTabSize(4);
		editor.getSession().setUseWrapMode(true);
		editor.setHighlightActiveLine(true);
		editor.getSession().setValue( textareaEl.val() );
		editor.getSession().setMode("ace/mode/" + mode);
		editor.getSession().on('change', function(e) {
			textareaEl.val(editor.getSession().getValue());
		} );
		
		// copy back to textarea on form submit...
		textareaEl.closest('form').submit(function() {
			textareaEl.val( editor.getSession().getValue() );
		})		
	} );
	
	// Codemirror-Editor anzeigen
	$(event.target).find("textarea.editor__code-editor").each( function() {

		var mode = $(this).data('mode');

        var mimetype = $(this).data('mimetype');
		if(mimetype.length>0)
			mode = mimetype;


        var editor = CodeMirror.fromTextArea( this, {
            lineNumbers: true,
            viewportMargin: Infinity,
			mode: mode
            /** settings **/ })

        var textareaEl = this;

        // copy back to textarea on form submit...
        $(textareaEl).closest('form').submit(function() {
            var newValue = editor.getValue();
            $(textareaEl).val( newValue );
        })
    } );


});