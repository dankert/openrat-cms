<?php

class EditorComponent extends Component
{
	public $type;
	public $name;
	
	protected function begin()
	{
		switch( $this->type )
		{
			case 'fckeditor':
			case 'html':
				echo '<textarea name="'.$this->htmlvalue($this->name).'" class="editor__html-editor" id="pageelement_edit_editor"><?php echo ${'.$this->value($this->name).'} ?></textarea>';
				
				break;
				
			case 'wiki':
				echo '<textarea name="'.$this->htmlvalue($this->name).'" class="editor__wiki-editor"><?php echo ${'.$this->value($this->name).'} ?></textarea>';
				break;
				
			case 'text':
			case 'raw':
				echo '<textarea name="'.$this->htmlvalue($this->name).'" class="editor__text-editor"><?php echo ${'.$this->value($this->name).'} ?></textarea>';
				break;
		
			case 'ace':
			case 'code':
				echo '<textarea name="'.$this->htmlvalue($this->name).'" data-mode="'.$attr_mode.'" class="editor__code-editor"><?php echo ${'.$this->value($this->name).'} ?></textarea>';
		        break;
	            
	            
			case 'dom':
			case 'tree':
				echo <<<HTML
		<?php
		$attr_tmp_doc = new DocumentElement();
		$attr_tmp_text = $$attr_name;
		if	( !is_array($attr_tmp_text))
			$attr_tmp_text = explode("\n",$attr_tmp_text);
			
		$attr_tmp_doc->parse($attr_tmp_text);
		echo $attr_tmp_doc->render('application/html-dom');
		?>
HTML;
				break;
		
			default:
				throw new LogicException("Unknown editor type: ".$this->type);
		}
	}
}


?>