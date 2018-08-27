$(document).on('orViewLoaded',function(event, data) {
	


	$(event.target).find('textarea').orAutoheight();

	
	// ACE-Editor anzeigen
	$(event.target).find("textarea.editor.ace-editor").each( function() {
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
	$(event.target).find("textarea.editor.code-editor").each( function() {

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

	// Markdown-Editor anzeigen
	$(event.target).find("textarea.editor.markdown-editor").each( function() {

        var editor = new SimpleMDE({ element: $(this)[0] });
    } );

	// Markdown-Editor anzeigen
	$(event.target).find("textarea.editor.html-editor").each( function() {


        $(this).trumbowyg();

        // copy back to textarea on form submit...
		/*
        $(textareaEl).closest('form').submit(function() {
            var newValue = editor.getValue();
            $(textareaEl).val( newValue );
        })
        */
    } );


});