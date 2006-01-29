page
	form
		hidden name:newTemplateId default:newTemplateId
		window
			list list:oldTemplateElements key:oldId value:oldName
				row
					cell class:fx
						text var:oldName
					cell class:fx
RAW
<?php $listName = 'newTemplateElementsOf'.$oldId; echo Html::selectBox('from'.$oldId,$$listName) ?>
END
			row
				cell class:act colspan:2
					button type:ok