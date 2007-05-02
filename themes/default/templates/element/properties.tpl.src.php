page
	form
		window name:GLOBAL_PREFS widths:30%,70%
			if present:subtype
				row
					cell class:fx
						text text:ELEMENT_SUBTYPE
					cell class:fx
					
						# Subtype ist eine Auswahlliste
						if present:subtypes
							selectbox name:subtype list:subtypes
							
						# Subtype ist ein einfaches Eingabefeld
						if not:true present:subtypes
							input name:subtype
			
			if present:with_icon
				row
					cell class:fx
						text text:EL_PROP_WITH_ICON
					cell class:fx
						checkbox name:with_icon

			if present:all_languages
				row
					cell class:fx
						text text:EL_PROP_ALL_LANGUAGES
					cell class:fx
						checkbox name:all_languages
			
			if present:writable
				row
					cell class:fx
						text text:EL_PROP_writable
					cell class:fx
						checkbox name:writable

			if present:width
				row
					cell class:fx
						text text:width
					cell class:fx
						input size:10 name:width

			if present:height
				row
					cell class:fx
						text text:height
					cell class:fx
						input size:10 name:height

			if present:dateformat
				row
					cell class:fx
						text text:EL_PROP_DATEFORMAT
					cell class:fx
						selectbox name:dateformat list:dateformats
			
			if present:format
				row
					cell class:fx
						text text:EL_PROP_FORMAT
					cell class:fx
						radiobox name:format list:formatlist

			if present:decimals
				row
					cell class:fx
						text text:EL_PROP_DECIMALS
					cell class:fx
						input size:10 maxlength:2 name:decimals

			if present:dec_point
				row
					cell class:fx
						text text:EL_PROP_DEC_POINT
					cell class:fx
						input size:10 maxlength:5 name:dec_point

			if present:thousand_sep
				row
					cell class:fx
						text text:EL_PROP_thousand_sep
					cell class:fx
						input size:10 maxlength:1 name:thousand_sep

			if present:default_text
				row
					cell class:fx
						text text:EL_PROP_default_text
					cell class:fx
						input size:40 maxlength:255 name:default_text

			if present:default_longtext
				row
					cell class:fx
						text text:EL_PROP_default_longtext
					cell class:fx
						inputarea rows:10 cols:40 name:default_longtext

			if present:parameters
				row
					cell class:fx
						text text:EL_PROP_DYNAMIC_PARAMETERS
					cell class:fx
						inputarea rows:15 cols:40 name:parameters
				row
					cell class:fx
					cell class:fx
						list list:dynamic_class_parameters key:paramName value:defaultValue
							text var:paramName
							text raw:_(
							text text:GLOBAL_DEFAULT
							text raw:)_=_
							text var:defaultValue
							newline

			if present:select_items
				row
					cell class:fx
						text text:EL_PROP_select_items
					cell class:fx
						inputarea rows:15 cols:40 name:select_items

			if present:linkelement
				row
					cell class:fx
						text text:EL_LINK
					cell class:fx
						selectbox name:linkelement list:linkelements

			if present:name
				row
					cell class:fx
						text text:ELEMENT_NAME
					cell class:fx
						selectbox name:name list:names

			if present:folderobjectid
				row
					cell class:fx
						text text:EL_PROP_DEFAULT_FOLDEROBJECT
					cell class:fx
						selectbox name:folderobjectid list:folders

			if present:default_objectid
				row
					cell class:fx
						text text:EL_PROP_DEFAULT_OBJECT
					cell class:fx
						selectbox name:default_objectid list:objects

			if present:code
				row
					cell class:fx
						text text:EL_PROP_code
					cell class:fx
						inputarea name:code rows:35 cols:60

			row
				cell colspan:2 class:act
					button type:ok
	focus field:name
