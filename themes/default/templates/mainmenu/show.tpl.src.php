page
	table padding:5 space:0 width:100% rowclasses:a,b columnclasses:a,b
	
		row
			cell class:menu
				image type:var:type

				list list:path extract:true value:xy

					link url:var:url title:var:title class:path target:cms_main
						text value:var:name maxlength:20
					char type:filesep

				text value:var:text title:var:text class:title
			cell class:menu style::text-align:right;
				list list:windowIcons extract:true
					link url:var:url target:_top
						image type:var:type align:middle
						
		row
			cell class:subaction colspan:2
			
				# Schleife über alle Menüpunkte
				list list:windowMenu extract:true value:xy
			
					if not:true empty:url
					# Menüpunkt
						link url:var:url target:cms_main_main title:title
							text var:text
					if empty:url
							text var:text class:inactive
						
					# Trenner zwischen Menüpunkten
					text raw:__

RAW
<!--
//<?php
//			if	( hasLang('MENU_'.$act.'_KEY' ) )
//			{
//				$attrAccesskey = ' accesskey="'.lang('MENU_'.$act.'_KEY').'"';
//				$title.=' ('.lang('GLOBAL_KEY').': ALT+'.lang('MENU_'.$act.'_KEY').')';
//			}
//			else
//				$attrAccesskey = '';
// ?>
-->
END