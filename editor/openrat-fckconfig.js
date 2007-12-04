
FCKConfig.ToolbarSets["Default"] = [
	['Save','NewPage','Preview','Templates','-','Source','DocProps','ShowBlocks'],
	['Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'],
	['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
	['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField'],
	'/',
	['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
	['OrderedList','UnorderedList','-','Outdent','Indent','Blockquote'],
	['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
	['Link','Unlink','Anchor'],
	['Image','Flash','Table','Rule','Smiley','SpecialChar','PageBreak'],
	'/',
	['Style','FontFormat','FontName','FontSize'],
	['TextColor','BGColor'],
	['FitWindow']		// No comma for the last row.
] ;


// ---
var _FileBrowserLanguage	= 'php' ;	// asp | aspx | cfm | lasso | perl | php | py
var _QuickUploadLanguage	= 'php' ;	// asp | aspx | cfm | lasso | php

// Don't care about the following line. It just calculates the correct connector 
// extension to use for the default File Browser (Perl uses "cgi").
var _FileBrowserExtension = _FileBrowserLanguage == 'perl' ? 'cgi' : _FileBrowserLanguage ;

FCKConfig.LinkBrowser = true;
FCKConfig.LinkBrowserURL = FCKConfig.BasePath + 'filemanager/browser/default/browser.html?Connector=../../../../../do.php?action=filemanager';

FCKConfig.ImageBrowser = true ;
FCKConfig.ImageBrowserURL = FCKConfig.BasePath + 'filemanager/browser/default/browser.html?Type=Image&Connector=../../../../../do.php?action=filemanager';

FCKConfig.FlashBrowser = true ;
FCKConfig.FlashBrowserURL = FCKConfig.BasePath + 'filemanager/browser/default/browser.html?Type=Flash&Connector=../../../../../do.php?action=filemanager';

FCKConfig.LinkUpload = true;
FCKConfig.ImageUpload = true;
FCKConfig.FlashUpload = true;
