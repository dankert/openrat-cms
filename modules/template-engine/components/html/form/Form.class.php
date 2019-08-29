<?php

namespace template_engine\components;

class FormComponent extends Component
{

	public $method = 'POST';

	public $name = '';

	public $action = null;

	public $subaction = null;

	public $id = '<?php echo OR_ID ?>';

	public $languageid = null;
	public $modelid    = null;

	public $label;

	public $cancel = true;
	public $readonly = false;

    /**
     * 'view' = Loads Action in the same view
     * 'top' = Replaces whole workbench.
     * @var string
     */
	public $target = 'view';

	public $enctype = 'application/x-www-form-urlencoded';

	public $async = false;

	public $autosave = false;

	public $type = '';

	public $afterSuccess;

	protected function begin()
	{
		if (empty($this->label))
			$this->label = lang('BUTTON_OK');
		
		if ($this->type == 'upload')
			$this->submitFunction = '';

		// Default: Target is the actual action/method-pair.
		if(empty($this->action))
		    $this->action = $this->request->action;
		if(empty($this->subaction))
		    $this->subaction = $this->request->method;

		echo '<form';
		echo ' name="' . $this->htmlvalue($this->name) . '"';

		echo ' target="_self"';
		echo ' data-target="' . $this->htmlvalue($this->target) . '"';
		echo ' action="./"';
		echo ' data-method="' . $this->htmlvalue($this->subaction) . '"';
		echo ' data-action="' . $this->htmlvalue($this->action) . '"';
		echo ' data-id="' . $this->htmlvalue($this->id) . '"';
		echo ' method="' . $this->htmlvalue($this->method) . '"';
		echo ' enctype="' . $this->htmlvalue($this->enctype) . '"';
		echo ' class="or-form ' . $this->htmlvalue($this->action) . '"';
		echo ' data-async="' . $this->htmlvalue($this->async) . '"';
		echo ' data-autosave="' . $this->htmlvalue($this->autosave) . '"';

        if ( $this->afterSuccess )
            echo ' data-after-success="' . $this->htmlvalue($this->afterSuccess) . '"';

        echo '>';

        // Enable Submit on Enter - no need for...we have a submit button at the end.
		// echo '<input type="submit" class="invisible" />';

        if ( !empty($this->languageid))
            echo '<input type="hidden" name="'.REQ_PARAM_LANGUAGE_ID.'" value="' . $this->htmlvalue($this->languageid) . '" />';
        if ( !empty($this->modelid))
            echo '<input type="hidden" name="'.REQ_PARAM_MODEL_ID.'" value="' . $this->htmlvalue($this->modelid) . '" />';
		echo '<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />';
		echo '<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="' . $this->htmlvalue($this->action) . '" />';
		echo '<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="' . $this->htmlvalue($this->subaction) . '" />';
		echo '<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="' . $this->htmlvalue($this->id) . '" />';
	}

	protected function end()
	{
		$label = $this->htmlvalue($this->label);
		
		echo '<div class="or-form-actionbar">';
		//echo "<div class=\"command {$this->visible}\">";

        // Cancel-Button nicht anzeigen, wenn cancel==false.
        if ($this->cancel)
        {
            echo '<input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" />';
        }

        if ( !$this->readonly )
            echo "<input type=\"submit\" class=\"or-form-btn or-form-btn--primary\" value=\"{$label}\" />";

        //echo '</div>';
        echo '</div>';
        echo '</form>';

    }
}

?>