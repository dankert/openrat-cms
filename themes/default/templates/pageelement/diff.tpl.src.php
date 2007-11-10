page
	form
		window
			row
				cell
				cell
					text type:emphatic text:GLOBAL_COMPARE
					text raw:_
					date date:var:date_left
				cell
				cell
	//			cell colspan:2
					text type:emphatic text:GLOBAL_WITH
					text raw:_
					date date:var:date_right
			row
				cell colspan:4
					fieldset
		
			list list:diff extract:true
				row class:diff
					if present:left
						cell width:5% class:line 
							text text:arrayvar:left:line type:tt
						cell width:45% class:arrayvar:left:type
							text text:arrayvar:left:text
					else
						cell colspan:2 class:help width:50%
							text raw:_
					if present:right
						cell width:5% class:line
							text text:arrayvar:right:line type:tt
						cell width:45% class:arrayvar:right:type
							text text:arrayvar:right:text
					else
						cell colspan:2 class:help width:50%
							text raw:_
	
				set var:left
				set var:right
			row
				cell colspan:4 class:act
					button text:BUTTON_BACK
			