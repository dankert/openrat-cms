<?php

namespace template_engine\components;

class GroupComponent extends Component
{

	public $open = true;
	public $show = true;
	public $title;
	public $icon;
	
	public function begin()
	{
		echo '<fieldset';
		echo ' class="';
		echo '<?php echo '.$this->value($this->open).'?" open":" closed" ?>';
		echo '<?php echo '.$this->value($this->show).'?" show":"" ?>';
		echo '">';
		
		if	( !empty($this->title))
		{
			echo '<legend>';
			if	( !empty($this->icon))
				echo  '<img src="/themes/default/images/icon/method/'.$this->htmlvalue($this->icon).'.svg" />';
			
			echo '<div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div>';
			echo $this->htmlvalue($this->title);
			echo '</legend>';
		}
		echo '<div>';
	}


	public function end() {
		echo '</div></fieldset>';
	}
}

?>