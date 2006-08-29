page
	table padding:5 space:0 width:100% rowclasses:a,b columnclasses:a,b
	
		row
			cell class:menu
				image type:type

				list list:path extract:true value:xy

					link var:url title:title class:path target:cms_main
						text var:name maxlength:20
					char type:filesep

				text var:text title:text class:title
			cell class:menu style:text-align:right;
				list list:windowIcons extract:true
					#text raw:_
					link var:url target:_top
						image type:type align:middle
		row
			cell class:subaction colspan:2
			
				# Schleife über alle Menüpunkte
				list list:windowMenu extract:true value:xy
			
					if empty:url invert:true
					# Menüpunkt
						link var:url target:cms_main_main title:title
							text var:text
					if empty:url
							text var:text class:inactive
						
					# Trenner zwischen Menüpunkten
					text raw:__

RAW
//<?php
//			if	( hasLang('MENU_'.$act.'_KEY' ) )
//			{
//				$attrAccesskey = ' accesskey="'.lang('MENU_'.$act.'_KEY').'"';
//				$title.=' ('.lang('GLOBAL_KEY').': ALT+'.lang('MENU_'.$act.'_KEY').')';
//			}
//			else
//				$attrAccesskey = '';
// ?>
END