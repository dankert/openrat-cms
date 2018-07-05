<?php

namespace template_engine\components;

use Html;

/**
 * Erzeugt einen HTML-Link.
 * 
 * @author dankert
 *
 */
class LinkComponent extends Component
{

	public $var1;

	public $var2;

	public $var3;

	public $var4;

	public $var5;

	public $value1;

	public $value2;

	public $value3;

	public $value4;

	public $value5;

	public $target;

	public $type;

	public $action;

	public $subaction;

	public $title;

	public $class;

	public $url;

	public $config;

	public $id;

	public $accesskey;

	public $name;

	public $anchor;

	public $frame = '_self';

	public $modal = false;

	/**
	 * Link-Beginn
	 * {@inheritDoc}
	 * @see Component::begin()
	 */
	public function begin()
	{
		echo '<a';
		
		if (isset($this->class))
			echo ' class="' . $this->htmlvalue($this->class) . '"';
		
		if (isset($this->title))
			echo ' title="' . $this->htmlvalue($this->title) . '"';
		
		if (isset($this->accesskey))
			echo ' accesskey="' . $this->htmlvalue($this->accesskey) . '"';
		
		if (isset($this->frame))
			echo ' target="' . $this->htmlvalue($this->frame) . '"';
		
		if (isset($this->name))
			echo ' date-name="' . $this->htmlvalue($this->name) . '" name="' . $this->htmlvalue($this->name) . '"';
		
		if (isset($this->url))
			echo ' data-url="' . $this->htmlvalue($this->url) . '"';
		
		if (isset($this->type))
			echo ' data-type="' . $this->htmlvalue($this->type) . '"';
		
		if (!empty($this->action))
			echo ' data-action="' . $this->htmlvalue($this->action) . '"';
		else
			echo ' data-action=""';
		
		if (isset($this->subaction))
			echo ' data-method="' . $this->htmlvalue($this->subaction) . '"';
		else
			echo ' data-method="<?php echo OR_METHOD ?>"';
		
		if (isset($this->id))
			echo ' data-id="' . $this->htmlvalue($this->id) . '"';
		else
			echo ' data-id="<?php echo OR_ID ?>"';
		
		switch ($this->type)
		{
			case 'post':
				
				// Zusammenbau eines einzeligen JSON-Strings.
				// Aufpassen: Keine doppelten Hochkommas, keine Zeilenumbrüche.
				echo ' data-data="{';
				
				echo "&quot;action&quot;:&quot;";
				if (! empty($this->action))
					echo $this->htmlvalue($this->action);
				else
					echo "<?php echo OR_ACTION ?>";
				echo "&quot;,";
				
				echo "&quot;subaction&quot;:&quot;";
				if (! empty($this->subaction))
					echo $this->htmlvalue($this->subaction);
				else
					echo "<?php echo OR_METHOD ?>";
				echo "&quot;,";
				
				echo "&quot;id&quot;:&quot;";
				if (! empty($this->id))
					echo $this->htmlvalue($this->id);
				else
					echo "<?php echo OR_ID ?>";
				echo "&quot;,";
				
				echo '&quot;'.REQ_PARAM_TOKEN . "&quot;:&quot;" . '<?php echo token() ?>' . "&quot;,";
				
				if (! empty($this->var1))
					echo "&quot;var1&quot;:&quot;" . $this->htmlvalue($this->value1) . "&quot;,";
				if (! empty($this->var2))
					echo "&quot;var2&quot;:&quot;" . $this->htmlvalue($this->value2) . "&quot;,";
				if (! empty($this->var3))
					echo "&quot;var3&quot;:&quot;" . $this->htmlvalue($this->value3) . "&quot;,";
				if (! empty($this->var4))
					echo "&quot;var4&quot;:&quot;" . $this->htmlvalue($this->value4) . "&quot;,";
				if (! empty($this->var5))
					echo "&quot;var5&quot;:&quot;" . $this->htmlvalue($this->value5) . "&quot;,";
				
				echo "&quot;none&quot;:&quot;0&quot;}\"";
				
				break;
			
			case 'html':
				
				echo ' href="' . $this->htmlvalue($this->url) . '"';
				break;
			
			default:
				echo ' href="<?php echo Html::url('.$this->value($this->action).','.$this->value($this->subaction).','.$this->value($this->id).') ?>"';
		}
		
		echo '>';
	}

	public function end()
	{
		echo '</a>
';
	}
}
?>
