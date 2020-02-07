<?php

namespace template_engine\components;

use cms\action\RequestParams;
use modules\template_engine\Element;

abstract class Component
{

	private $depth;

    /**
     * @var RequestParams
     */
    public $request;

	/**
	 * @var Element
	 */
    private $element;

    public function __construct()
	{
		$this->element = $this->createElement();
	}

	public function getDepth()
	{
		return $this->depth;
	}

	public function setDepth($depth)
	{
		$this->depth = $depth;
	}

	public function createElement() {
    	return null;
	}


	/**
	 * Gets the beginning of this component.
	 * @return string
	 */
	public function getBegin()
	{
		if   ( $this->element )
			return $this->element->getBegin();

		ob_start();
		$this->begin();
		$src = ob_get_contents();
		ob_end_clean();
		return $src;
	}

	public function getEnd()
	{
		if   ( $this->element )
			return $this->element->getEnd();

		ob_start();
		$this->end();
		$src = ob_get_contents();
		ob_end_clean();
		return $src;
	}

	/**
	 * Outputs the beginning of this component.
	 */
	protected function begin()
	{}

	protected function end()
	{}
	
	
	protected function textasvarname($value)
	{
		$expr = new Expression($value);
		return $expr->getTextAsVarName();
		
	}
	
	
	protected function varname($value)
	{
		$expr = new Expression($value);
		return $expr->getVarName();
	}
	
	
	
	protected function htmlvalue($value)
	{
		$expr = new Expression($value);
		return $expr->getHTMLValue();
	}
	
	
	
	protected function value( $value )
	{
		$expr = new Expression($value);
		return $expr->getPHPValue();
	}
	

	protected function includeResource($file )
	{
		echo "<?php include_once( 'modules/template-engine/components/html/".$file."') ?>";
	}
	
}



class Expression
{
	public $type;
	public $value;
	public $invert = false;
	
	public function __construct( $value )
	{
		// Falls der Wert 'true' oder 'false' ist.
		if	( is_bool($value))
			$value = $value?'true':'false';
		
		// Negierung berücksichtigen.
		if	( substr($value,0,4)=='not:' )
		{
			$value = substr($value,4);
			$this->invert = true;
		}
		
		// Trennung 'type:value'
		$parts = explode( ':', $value, 2 );
		
		if	( count($parts) < 2 )
			$parts = array('',$value);
			
		list( $this->type,$this->value ) = $parts;
		
		// Fallback: Typ = 'text'.
		if	( empty($this->type))
			$this->type = 'text';
		
	}

	
	
	public function getHTMLValue()
	{
		switch( $this->type )
		{
			case 'text':
				return $this->value;
				
			default:
				return '<'.'?php echo '.$this->getPHPValue().' ?>';
		}
	}
	
	
	public function getVarName()
	{
		switch( $this->type )
		{
			case 'var':
				return '$'.$this->value;
			case 'text':
				return $this->value;
			default:
				throw new \LogicException("Invalid expression type '$this->type' in attribute value. Allowed: text|var");
		}
	}
	
	
	public function getTextAsVarName()
	{
		switch( $this->type )
		{
			case 'var':
				return '$$'.$this->value;
			case 'text':
				return '$'.$this->value;
			default:
				return $this->getPHPValue();
		}
	}
	
	
	public function getPHPValue()
	{
		$value = $this->value;
		
		$invert = $this->invert?'!':'';
		
		switch( $this->type )
		{
			case 'text':
				// Sonderf�lle f�r die Attributwerte "true" und "false".
				// Hinweis: Die Zeichenkette "false" entspricht in PHP true.
				// Siehe http://de.php.net/manual/de/language.types.boolean.php
				if	( $value == 'true' || $value == 'false' )
					return $value;
				else
					return "'".$value."'";
			case 'tpl':
				// macht aus "text1{var}text2" => "text1".$var."text2"
				$value = preg_replace('/{(\w+)\}/','\'.$\\1.\'',$value);
				return "'".$value."'";
			case 'var':
				return $invert.'$'.$value;
			case 'size':
				return '@count($'.$value.')';
			case 'message':
				// macht aus "text1{var}text2" => "text1".$var."text2"
				$value = preg_replace('/{(\w+)\}/','\'.$\\1.\'',$value);
				return 'lang('."'".$value."'".')';
			case 'arrayvar':
				list($arr,$key) = explode(':',$value.':none');
				return $invert.'@$'.$arr.'['.$key.']';
			case 'config':
				$config_parts = explode('/',$value);
				return $invert.'config('."'".implode("'".','."'",$config_parts)."'".')';
				
			default:
				throw new \LogicException("Unknown expression type '{$this->type}' in attribute value. Allowed: var|function|method|text|size|property|message|messagevar|arrayvar|config or none");
		}
	}
	
	
}



?>