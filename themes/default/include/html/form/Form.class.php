<?php

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
		if	( empty($this->label) )
			$this->label = lang('BUTTON_OK');
		
		if	( empty($this->id) )
			$this->id = '<?php echo OR_ID ?>';
		
		if ( $this->type == 'upload')
			$this->submitFunction = '';
		
		echo <<<HTML
<form name="{$this->name}"
      target="{$this->target}"
      action="{$this->action}"
      data-method="{$this->subaction}"
      data-action="{$this->action}"
      data-id="{$this->id}"
      method="{$this->subaction}"
      enctype="{$this->enctype}"
      class="{$this->action}"
      data-async="{$this->async}"
      data-autosave="{$this->autosave}"
      onSubmit="{$this->submitFunction}"><input type="submit" class="invisible" />
      
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="{$this->action}" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="{$this->subaction}" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="{$this->id}" />

HTML;
		echo <<<'HTML'
<?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?>

HTML;
	}

	
	
	
	protected function end()
	{
		echo <<<HTML

<div class="bottom">
	<div class="command {$this->visible}">
	
		<input type="button" class="submit ok" value="{$this->label}" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->
HTML;
	if ($this->cancel) { 
		echo <<<HTML
		<input type="button" class="submit cancel" value="{lang('CANCEL')}" onclick="$('div#dialog').hide(); $('div#filler').fadeOut(500); $(this).closest('div.panel').find('ul.views > li.active').click();" />
HTML;
	}
		echo <<<HTML
	</div>
</div>

</form>

HTML;
	}
}

?>