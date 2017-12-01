<?php

class LogoComponent extends Component
{
	public $name;
	
	public function begin()
	{
		echo <<<HTML
<div class="line logo">
	<div class="label">
	<img src="themes/default/images/logo_{$this->name}.png ?>"
	border="0" />
	</div>
	<div class="input">
	<h2>
			<?php echo langHtml('logo_{$this->name}') ?>
		</h2>
		<p>
			<?php echo langHtml('logo_{$this->name}_text') ?>
		</p>

	</div>
</div>
HTML;
	}
	
	public function end()
	{
		echo '</div>';
	}
	
	
	
}


?>