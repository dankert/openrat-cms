Openrat.Workbench.afterViewLoadedHandler.add( function(element ) {

    $(element).find('textarea').orAutoheight();

	
	// Codemirror-Editor anzeigen
	$(element).find("textarea.or-editor.or-code-editor").each( function() {

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
	$(element).find("textarea.or-editor.or-markdown-editor").each( function() {

	    let textarea = this;
	    let toolbar = [{
                name: "bold",
                action: SimpleMDE.toggleBold,
                className: "image-icon image-icon--editor-bold",
                title: "Bold",
            },
            {
                name: "italic",
                action: SimpleMDE.toggleItalic,
                className: "image-icon image-icon--editor-italic",
                title: "Italic",
            },
            {
                name: "heading",
                action: SimpleMDE.toggleHeadingBigger,
                className: "image-icon image-icon--editor-headline",
                title: "Headline",
            },
            "|", // Separator
            {
                name: "quote",
                action: SimpleMDE.toggleBlockquote,
                className: "image-icon image-icon--editor-quote",
                title: "Quote",
            },
            {
                name: "code",
                action: SimpleMDE.toggleCodeBlock,
                className: "image-icon image-icon--editor-code",
                title: "Code",
            },
            "|", // Separator
            {
                name: "generic list",
                action: SimpleMDE.toggleUnorderedList,
                className: "image-icon image-icon--editor-unnumberedlist",
                title: "Unnumbered list",
            },
            {
                name: "numbered list",
                action: SimpleMDE.toggleOrderedList,
                className: "image-icon image-icon--editor-numberedlist",
                title: "Numbered list",
            },
            "|", // Separator
            {
                name: "table",
                action: SimpleMDE.drawTable,
                className: "image-icon image-icon--editor-table",
                title: "Table",
            },
            {
                name: "horizontalrule",
                action: SimpleMDE.drawHorizontalRule,
                className: "image-icon image-icon--editor-horizontalrule",
                title: "Horizontal rule",
            },
            "|", // Separator
            {
                name: "undo",
                action: SimpleMDE.undo,
                className: "image-icon image-icon--editor-undo",
                title: "Undo",
            },
            {
                name: "redo",
                action: SimpleMDE.redo,
                className: "image-icon image-icon--editor-redo",
                title: "Redo",
            },
            "|", // Separator
            {
                name: "link",
                action: SimpleMDE.drawLink,
                className: "image-icon image-icon--editor-link",
                title: "Link",
            },
            {
                name: "image",
                action: SimpleMDE.drawImage,
                className: "image-icon image-icon--editor-image",
                title: "Image",
            },

            /*
            "|", // Separator
            {
                name: "preview",
                action: SimpleMDE.togglePreview,
                className: "image-icon image-icon--editor-preview",
                title: "Preview",
            },
            {
                name: "sidebyside",
                action: SimpleMDE.toggleSideBySide,
                className: "image-icon image-icon--editor-sidebyside",
                title: "Side by side",
            },
            {
                name: "fullscreen",
                action: SimpleMDE.toggleFullScreen,
                className: "image-icon image-icon--editor-fullscreen",
                title: "Fullscreen",
            },
            */
            "|", // Separator
            {
                name: "guide",
                action: "https://simplemde.com/markdown-guide",
                className: "image-icon image-icon--editor-help",
                title: "Howto markdown",
            },
        ];

        let mde = new SimpleMDE(
            {
                element: $(this)[0],
                toolbar: toolbar,
                autoDownloadFontAwesome: false
            }
        );

        let codemirror = mde.codemirror;

        $(codemirror.getWrapperElement()).droppable({
            accept: '.or-draggable',
            hoverClass: 'or-droppable--hover',
            activeClass: 'or-droppable--active',

            drop: function (event, ui) {

                let dropped = ui.draggable;

                let insertText = '';
                let id = dropped.data('id');
                let url = '__OID__'+id+'__';
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
	$(element).find("textarea.or-editor.or-html-editor").each( function() {

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
                let url = './?_='+dropped.data('type')+'-'+id+'&subaction=show&embed=1&__OID__'+id+'__='+id;
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