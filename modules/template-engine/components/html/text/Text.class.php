<?php

namespace template_engine\components;

class TextComponent extends HtmlComponent
{
	public $prefix = '';
	public $suffix = '';
	public $title;
	public $type;
	public $escape = true;
	public $var;
	public $text;
	public $key;
	public $raw;
	public $value;
	public $maxlength;
	public $accesskey;
	public $cut = 'both';
	public $label;

	public function begin()
	{
        if   ( $this->label )
            echo '<label class="or-form-row"><span class="or-form-label">'.'<?php echo lang('.$this->value($this->label).') ?>'.'</span><span class="or-form-input">';

        if	( $this->raw )
			$this->escape = false;
		
		switch( $this->type )
		{
			case 'emphatic':
				$tag = 'em';
				break;
			case 'italic':
				$tag = 'em';
				break;
			case 'strong':
				$tag = 'strong';
				break;
			case 'bold':
				$tag = 'strong';
				break;
			case 'tt':
				$tag = 'tt';
				break;
			case 'teletype':
				$tag = 'tt';
				break;
			case 'preformatted':
				$tag = 'pre';
				break;
			case 'code':
				$tag = 'code';
				break;
			default:
				$tag = 'span';
		}
		
		echo '<'.$tag;
		
		if	( !empty($this->class))
			echo ' class="'.$this->htmlvalue($this->class).'"';
			
		if	( !empty($this->title))
			echo ' title="'.$this->htmlvalue($this->title).'"';
		
		echo '><?php ';
		
		
		$functions = array(); // Funktionen, durch die der Text gefiltert wird.
		
		$functions[] = 'nl2br(@)';

		
		if	( $this->escape )
		{
			// When using UTF-8 as a charset, htmlentities will only convert 1-byte and 2-byte characters.
			// Use this function if you also want to convert 3-byte and 4-byte characters:
			// converts a UTF8-string into HTML entities
			$functions[] = 'encodeHtml(@)';
			$functions[] = 'htmlentities(@)';
		}

		if	( !empty($this->maxlength) )
			$functions[] = 'Text::maxLength( @,'.intval($this->maxlength).",'..',constant('STR_PAD_".strtoupper($this->cut)."') )";
	
		if	( !empty($this->accesskey) )
			$functions[] = "Text::accessKey('".$this->accesskey."',@)";
		

		
		
		$value ='';
		
		if	( isset($this->key))
		{
			$value = "'".$this->prefix."'.".$this->value($this->key).".'".$this->suffix."'";
			$functions[] = "lang(@)";
		}
		elseif	( isset($this->text))
		{
			$value = $this->value($this->text);
			$functions[] = "lang(@)";
		}
		elseif	( isset($this->var))
			$value = '$'.$this->varname($this->var);
		
		elseif	( isset($this->raw))
			$value = "'".str_replace('_','&nbsp;',$this->raw)."'";
				
		elseif	( isset($this->value))
			$value = $this->value($this->value);

		foreach( array_reverse($functions) as $f )
		{
			list($before,$after) = explode('@',$f);
			$value = $before.$value.$after; 
		}
		echo "echo $value;";
			
		echo ' ?></'.$tag.'>';  // Tag schliessen.

        if   ( $this->label )
            echo '</span></label>';
    }
}


?>