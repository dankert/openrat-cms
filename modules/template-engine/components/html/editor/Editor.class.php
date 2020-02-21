<?php

namespace template_engine\components;

use modules\template_engine\CMSElement;
use modules\template_engine\Value;
use modules\template_engine\ValueExpression;

class EditorComponent extends FieldComponent
{
	public $type;
	public $name;
	public $mode      ='htmlmixed';
	public $extension ='';
	public $mimetype  = '';

	public function createElement()
	{
		$textarea = new CMSElement('textarea');
		$textarea->addAttribute('name',$this->name);

		$textarea->addStyleClass('editor')->setEscaping(false);

		switch( $this->type )
		{
			case 'html':
				$textarea->addStyleClass('html-editor')->addAttribute('id','pageelement_edit_editor');


				break;

			case 'wiki':
				$textarea->addStyleClass('wiki-editor');
				break;

			case 'text':
			case 'raw':
				$textarea->addStyleClass('text-editor');
				break;

			case 'markdown':
				$textarea->setEscaping(true)->addStyleClass('markdown-editor');
		        break;
	            
			case 'code':
				$textarea->setEscaping(true);
				$textarea->addStyleClass('code-editor')
					->addAttribute('data-extension',$this->extension)
					->addAttribute('data-mimetype',$this->mimetype)
					->addAttribute('data-mode',$this->mode);
		        break;


			default:
				throw new \LogicException("Unknown editor type: ".$this->type);
		}

		$textarea->content(Value::createExpression(ValueExpression::TYPE_DATA_VAR,$this->name));

		return $textarea;
	}
}