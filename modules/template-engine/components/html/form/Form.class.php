<?php

namespace template_engine\components;

class FormComponent extends Component
{

	public $method = 'POST';

	public $name = '';

	public $action = '<?php echo OR_ACTION ?>';

	public $subaction = '<?php echo OR_METHOD ?>';

	public $id = '<?php echo OR_ID ?>';

	public $label;

	public $cancel = false;

	public $visible = false;

	public $target = '_self';

	public $enctype = 'application/x-www-form-urlencoded';

	public $async = false;

	public $autosave = false;

	public $type = '';

	private $submitFunction = 'formSubmit( $(this) ); return false;';

	protected function begin()
	{
		if (empty($this->label))
			$this->label = lang('BUTTON_OK');
		
		if ($this->type == 'upload')
			$this->submitFunction = '';
		
		echo '<form';
		echo ' name="' . $this->htmlvalue($this->name) . '"';
		
		echo ' target="' . $this->htmlvalue($this->target) . '"';
		echo ' action="' . $this->htmlvalue($this->action) . '"';
		echo ' data-method="' . $this->htmlvalue($this->subaction) . '"';
		echo ' data-action="' . $this->htmlvalue($this->action) . '"';
		echo ' data-id="' . $this->htmlvalue($this->id) . '"';
		echo ' method="' . $this->htmlvalue($this->method) . '"';
		echo ' enctype="' . $this->htmlvalue($this->enctype) . '"';
		echo ' class="' . $this->htmlvalue($this->action) . '"';
		echo ' data-async="' . $this->htmlvalue($this->async) . '"';
		echo ' data-autosave="' . $this->htmlvalue($this->autosave) . '"';
		echo ' onSubmit="' . $this->htmlvalue($this->submitFunction) . '">';
		
		echo '<input type="submit" class="invisible" />'; // why this?
		
		echo '<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />';
		echo '<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="' . $this->htmlvalue($this->action) . '" />';
		echo '<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="' . $this->htmlvalue($this->subaction) . '" />';
		echo '<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="' . $this->htmlvalue($this->id) . '" />';
	}

	protected function end()
	{
		$label = $this->htmlvalue($this->label);
		
		echo '<div class="bottom">';
		echo "<div class=\"command {$this->visible}\">";

		echo "<input type=\"button\" class=\"submit ok\" value=\"{$label}\" onclick=\"$(this).closest('div.sheet').find('form').submit(); \" />";

        // Cancel-Button nicht anzeigen, wenn cancel==false.
		if ($this->cancel)
		{
			echo '<input type="button" class="submit cancel" value="<?php echo lang("CANCEL") ?>" onclick="' . "$(div#dialog').hide(); $('div#filler').fadeOut(500); $(this).closest('div.panel').find('ul.views > li.active').click();" . '" />';
        }
        echo '</div>';
        echo '</div>';
        echo '</form>';

    }
}

?>