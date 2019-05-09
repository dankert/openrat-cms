$(document).on('orViewLoaded',function(event, data) {
	


	$(event.target).find('textarea').orAutoheight();

	
	// ACE-Editor anzeigen
	$(event.target).find("textarea.editor.ace-editor").each( function() {
	    alert('ACE is not supported')
        throw new Error('No ACE available');

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

		let mode = $(this).data('mode');

        let mimetype = $(this).data('mimetype');
		if(mimetype.length>0)
			mode = mimetype;

        let textareaEl = this;

        let editor = CodeMirror.fromTextArea( textareaEl, {
            lineNumbers: true,
            viewportMargin: Infinity,
			mode: mode
            /** settings **/ })

        editor.on('change',function() {
            // copy back to textarea on form submit...
            let newValue = editor.getValue();
            $(textareaEl).val( newValue );
        } );


        $(editor.getWrapperElement()).droppable({
            accept: '.or-draggable',
            hoverClass: 'or-droppable--hover',
            activeClass: 'or-droppable--active',

            drop: function (event, ui) {

                let dropped = ui.draggable;

                // Insert id of dragged element into cursor position
                let pos = editor.getCursor();
                editor.setSelection(pos, pos);
                let insertText = dropped.data('id')
                let toInsert = ''+insertText;
                editor.replaceSelection(toInsert);
                //editor.setCursor(pos+toInsert.length); geht nicht.
            }

        });


    } );

	// Markdown-Editor anzeigen
	$(event.target).find("textarea.editor.markdown-editor").each( function() {

	    let textarea = this;
        let mde = new SimpleMDE({ element: $(this)[0] });

        let codemirror = mde.codemirror;

        $(codemirror.getWrapperElement()).droppable({
            accept: '.or-draggable',
            hoverClass: 'or-droppable--hover',
            activeClass: 'or-droppable--active',

            drop: function (event, ui) {

                let dropped = ui.draggable;

                let insertText = '';
                let id = dropped.data('id');
                let url = 'object:'+id;
                if   ( dropped.data('type') == 'image')
                    insertText = '![]('+url+')';
                else
                    insertText = '['+id+']('+url+')';

                // Insert id of dragged element into cursor position
                let pos = codemirror.getCursor();
                codemirror.setSelection(pos, pos);
                codemirror.replaceSelection( insertText);
            }
        });

        codemirror.on('change',function() {
            // copy back to textarea on form submit...
            let newValue = codemirror.getValue();
            $(textarea).val( newValue );
        } );
    } );

	// HTML-Editor anzeigen
	$(event.target).find("textarea.editor.html-editor").each( function() {

	    let textarea = this;

        $.trumbowyg.svgPath = './modules/editor/trumbowyg/ui/icons.svg';
        $(textarea).trumbowyg();

        $(textarea).closest('form').find('.trumbowyg-editor').droppable({
            accept: '.or-draggable',
            hoverClass: 'or-droppable--hover',
            activeClass: 'or-droppable--active',

            drop: function (event, ui) {

                let dropped = ui.draggable;
                let id = dropped.data('id');
                let url = './?_='+dropped.data('type')+'-'+id+'&subaction=show&embed=1&oid='+dropped.data('id');
                let insertText = '';
                if   ( dropped.data('type') == 'image')
                    insertText = '<img src="'+url+'" alt="" />';
                else
                    insertText = '<a href="'+url+'" />'+id+'</a>';

                $(textarea).trumbowyg('execCmd', {
                    cmd: 'insertHTML',
                    param: insertText,
                    forceCss: false,
                });
            }
        });





    } );


});