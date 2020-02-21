<?php

namespace template_engine\components;

use modules\template_engine\CMSElement;use modules\template_engine\HtmlElement;
use modules\template_engine\Value;
use modules\template_engine\ValueExpression;

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
	public $maxlength; // DEPRECATED - use CSS.
	public $accesskey;
	public $cut = 'both';
	public $label;
	public $newline = true;

	public function createElement()
	{

		switch( $this->type )
		{
			case 'none':
			case 'raw':
				$tag = '';
				break;
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

		$text = new CMSElement($tag);

		$text->setEscaping($this->escape);


        if	( $this->class)
			$text->addStyleClass( $this->class);

       if	( $this->title )
            $text->addAttribute('title',$this->title);

        //if   ( $this->newline)
		//    $functions[] = 'nl2br(@)';

		
		//if	( !empty($this->accesskey) )
		//	$functions[] = "Text::accessKey('".$this->accesskey."',@)";

		if	( $this->key )
			$text->content( Value::createExpression(ValueExpression::TYPE_MESSAGE,$this->key) );

		elseif	( $this->text )
			$text->content( Value::createExpression(ValueExpression::TYPE_MESSAGE,$this->text) );

		elseif	( $this->var )
			$text->content( Value::createExpression(ValueExpression::TYPE_DATA_VAR,$this->var) );

		elseif	( $this->raw )
			$text->content( str_replace('_',' ',$this->raw) );
				
		elseif	( $this->value )
			$text->content( $this->value );


		if   ( $this->label ) {
			$span  = (new HtmlElement('span' ))->addStyleClass('or-form-input');
			$label = (new HtmlElement('label'))->addChild($span)->addStyleClass('or-form-row')->addChild( (new CMSElement('span'))->addStyleClass('or-form-label')->content('message:'.$this->label));

			$this->adoptiveElement = $text;
			return $label;

		}else {
			return $text;
		}

	}
}


