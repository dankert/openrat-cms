<?php

namespace template_engine\components;

use template_engine\components\html\HtmlComponent;
use template_engine\element\CMSElement;use template_engine\element\HtmlElement;
use template_engine\element\Value;
use template_engine\element\ValueExpression;

class TextComponent extends HtmlComponent
{
	public $title;
	public $type;
	public $escape = true;
	public $value;
	public $label;

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

		if	( $this->value )
			$text->content( $this->value );


		if   ( $this->label ) {
			$span  = (new HtmlElement('span' ))->addStyleClass('or-form-input');
			$label = (new HtmlElement('label'))->addChild($span)->addStyleClass('or-form-row')->addChild( (new CMSElement('span'))->addStyleClass('or-form-label')->content('${message:'.$this->label.'}'));

			$this->adoptiveElement = $text;
			return $label;

		}else {
			return $text;
		}

	}
}


