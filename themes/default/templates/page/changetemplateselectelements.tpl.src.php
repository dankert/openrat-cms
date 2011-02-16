dummy
	form
		hidden name:newTemplateId default:newTemplateId
		window
			list list:elements extract:true
				row
					cell
						text var:name
					cell
						selectbox name:var:newElementsName list:newElementsList
			row
				cell class:act colspan:2
					button type:ok