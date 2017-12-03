<?php

namespace template_engine\components;

class FocusComponent extends Component
{

	public function begin()
	{
		/*
		echo <<<'HTML'
<script name="JavaScript" type="text/javascript"><!--
// Auskommentiert, da JQuery sonst abbricht und die Success-Function des LoadEvents nicht mehr ausführt.
//document.forms[0].<?php echo $attr_field ?>.focus();
//document.forms[0].<?php echo $attr_field ?>.select();
// -->
</script>
HTML;
		 */
	}


	public function end() {
	}
}

?>