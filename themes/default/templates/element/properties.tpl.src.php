dummy
	form
		window name:GLOBAL_PREFS widths:30%,70%
			if present:subtype
				row
					cell
						text text:ELEMENT_SUBTYPE
					cell
					
						# Subtype ist eine Auswahlliste
						if present:subtypes
							selectbox name:subtype list:subtypes addempty:true
							
						# Subtype ist ein einfaches Eingabefeld
						if not:true present:subtypes
							input name:subtype
			
			if present:with_icon
				row
					cell
						text text:EL_PROP_WITH_ICON
					cell
						checkbox name:with_icon

			if present:all_languages
				row
					cell
						text text:EL_PROP_ALL_LANGUAGES
					cell
						checkbox name:all_languages
			
			if present:writable
				row
					cell
						text text:EL_PROP_writable
					cell
						checkbox name:writable

			if present:width
				row
					cell
						text text:width
					cell
						input size:10 name:width

			if present:height
				row
					cell
						text text:height
					cell
						input size:10 name:height

			if present:dateformat
				row
					cell
						text text:EL_PROP_DATEFORMAT
					cell
						selectbox name:dateformat list:dateformats
			
			if present:format
				row
					cell
						text text:EL_PROP_FORMAT
					cell
						radiobox name:format list:formatlist

			if present:decimals
				row
					cell
						text text:EL_PROP_DECIMALS
					cell
						input size:10 maxlength:2 name:decimals

			if present:dec_point
				row
					cell
						text text:EL_PROP_DEC_POINT
					cell
						input size:10 maxlength:5 name:dec_point

			if present:thousand_sep
				row
					cell
						text text:EL_PROP_thousand_sep
					cell
						input size:10 maxlength:1 name:thousand_sep

			if present:default_text
				row
					cell
						text text:EL_PROP_default_text
					cell
						input size:40 maxlength:255 name:default_text

			if present:default_longtext
				row
					cell
						text text:EL_PROP_default_longtext
					cell
						inputarea rows:10 cols:40 name:default_longtext

			if present:parameters
				row
					cell
						text text:EL_PROP_DYNAMIC_PARAMETERS
					cell
						inputarea rows:15 cols:40 name:parameters
				row
					cell
					cell
						list list:dynamic_class_parameters key:paramName value:defaultValue
							text var:paramName
							text raw:_(
							text text:GLOBAL_DEFAULT
							text raw:)_=_
							text var:defaultValue
							newline

			if present:select_items
				row
					cell
						text text:EL_PROP_select_items
					cell
						inputarea rows:15 cols:40 name:select_items

			if present:linkelement
				row
					cell
						text text:EL_LINK
					cell
						selectbox name:linkelement list:linkelements

			if present:name
				row
					cell
						text text:ELEMENT_NAME
					cell
						selectbox name:name list:names

			if present:folderobjectid
				row
					cell
						text text:EL_PROP_DEFAULT_FOLDEROBJECT
					cell
						selectbox name:folderobjectid list:folders

			if present:default_objectid
				row
					cell
						text text:EL_PROP_DEFAULT_OBJECT
					cell
						selectbox name:default_objectid list:objects addempty:true

			if present:code
				row
					cell
						text text:EL_PROP_code
					cell
						inputarea name:code rows:35 cols:60

			row
				cell colspan:2 class:act
					button type:ok
	focus field:name
