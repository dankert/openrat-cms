<?php

class ElseComponent extends Component
{

	public function begin()
	{
		echo '<?php if(!$if'.$this->getDepth().'){?>';
	}


	public function end() {
		echo '<?php } ?>';
	}
}

?>