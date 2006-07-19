page
	table padding:5 space:0 width:100%
	
		row
			cell class:menu
				image type:type

				list list:path extract:true value:xy
					#image type:icon
					link url:url title:title class:path target:cms_main
						text var:name maxlength:20
					char type:filesep

				text var:text title:text class:title
		row
			cell class:subaction
			
				# Schleife über alle Menüpunkte
				list list:windowMenu extract:true
			
					# Menüpunkt
					link url:url target:cms_main_main title:title
						text var:text
						
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