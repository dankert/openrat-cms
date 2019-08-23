<?php

namespace template_engine\components;

use Html;
use JSON;

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

	public $afterSuccess;

	/**
	 * Link-Beginn
	 * {@inheritDoc}
	 * @see Component::begin()
	 */
	public function begin()
	{
		echo '<a';
		
		if ( $this->afterSuccess )
			echo ' data-after-success="' . $this->htmlvalue($this->afterSuccess) . '"';
		
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
			echo ' data-method="'.$this->request->method.'"';
		
		if (isset($this->id))
			echo ' data-id="' . $this->htmlvalue($this->id) . '"';
		else
			echo ' data-id="<?php echo OR_ID ?>"';

		$json = new JSON();
        $arrayvalues = array();
        foreach( $this->getExtraParamArray() as $varname => $varvalue )
            $arrayvalues[ $this->htmlvalue($varname) ] = $this->htmlvalue($varvalue);
        echo ' data-extra="'.str_replace('"',"'",str_replace(array("\t", "\r", "\n"),'',$json->encode($arrayvalues))).'"';

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
					echo $this->htmlvalue($this->request->action);
				echo "&quot;,";
				
				echo "&quot;subaction&quot;:&quot;";
				if (! empty($this->subaction))
					echo $this->htmlvalue($this->subaction);
				else
					echo $this->request->method;
				echo "&quot;,";
				
				echo "&quot;id&quot;:&quot;";
				if (! empty($this->id))
					echo $this->htmlvalue($this->id);
				else
					echo "<?php echo OR_ID ?>";
				echo "&quot;,";
				
				echo '&quot;'.REQ_PARAM_TOKEN . "&quot;:&quot;" . '<?php echo token() ?>' . "&quot;,";

                foreach( $this->getExtraParamArray() as $varname => $varvalue )
					echo "&quot;".$this->htmlvalue($varname)."&quot;:&quot;" . $this->htmlvalue($varvalue) . "&quot;,";

                echo "&quot;none&quot;:&quot;0&quot;}\"";
				
				break;
			
			case 'html':
				
				echo ' href="' . $this->htmlvalue($this->url) . '"';
				break;
			
			case 'external':

				echo ' href="' . $this->htmlvalue($this->url) . '"';
				break;

			default:
				echo ' href="<?php echo Html::url('.$this->value($this->action).','.$this->value($this->subaction).','.$this->value($this->id);

				$arrayvalues = array();
				foreach( $this->getExtraParamArray() as $varname => $varvalue )
                    $arrayvalues[] = $this->value($varname) . '=>'.$this->value($varvalue);

                echo ',array('.implode(',',$arrayvalues).')';

				echo ') ?>"';
		}
		
		echo '>';
	}

	public function end()
	{
		echo '</a>
';
	}


	private function getExtraParamArray()
	{
		$vars = array();
		if (! empty($this->var1))		$vars[$this->var1] = $this->value1;
		if (! empty($this->var2))		$vars[$this->var2] = $this->value2;
		if (! empty($this->var3))		$vars[$this->var3] = $this->value3;
		if (! empty($this->var4))		$vars[$this->var4] = $this->value4;
		if (! empty($this->var5))		$vars[$this->var5] = $this->value5;

		// Bei Dialogen kann der Dialog auch beim Öffnen in einem neuen Fenster direkt geöffnet werden.
		if ( $this->type=='dialog')
			$vars += array('dialogAction'=>$this->action,'dialogMethod'=>$this->subaction);

		return $vars;
	}
}
?>
