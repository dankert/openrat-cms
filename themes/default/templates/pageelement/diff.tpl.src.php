page
	window
		row
			cell
			cell
				text type:emphatic text:GLOBAL_COMPARE
				text raw:_
				text type:strong var:title_left
			cell
			cell
//			cell colspan:2
				text type:emphatic text:GLOBAL_WITH
				text raw:_
				text type:strong var:title_right
	
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