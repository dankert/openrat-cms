/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	//baseHref: OR_THEMES_EXT_DIR+'../editor/editor/'
	config.baseHref = '';
	config.skin = 'v2';
	//config.filebrowserUploadUrl = './dispatcher.php?action=filebrowser&subaction=directupload&name=upload';
	config.filebrowserBrowseUrl = './dispatcher.php?action=filebrowser&subaction=browse';
	
	config.toolbar = 'Openrat';
	config.toolbar_Openrat = [    /* Eigene Toolbar für OpenRat */
	                          ['Preview','-'], /*,'Templates'*/
	                          ['Cut','Copy','Paste','PasteText','PasteFromWord'],
	                          ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
	                          ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
	                          '/',
	                          ['Bold','Italic',/*'Underline',*/'Strike','-','Subscript','Superscript'],
	                          ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
	                          ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	                          ['Link','Unlink','Anchor'],
	                          ['Image','Flash','Table','HorizontalRule','SpecialChar','PageBreak'],
	                          '/',
	                          [/*'Styles',*/'Format','Font','FontSize'],
	                          ['TextColor','BGColor'],
	                          ['Source','-', 'ShowBlocks']
	                         ];
};
