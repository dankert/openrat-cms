<?php

namespace template_engine\components;

class EditorComponent extends Component
{
	public $type;
	public $name;
	public $mode='html';
	
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
				echo '<textarea name="'.$this->htmlvalue($this->name).'" data-mode="'.$this->htmlvalue($this->mode).'" class="editor__code-editor"><?php echo ${'.$this->value($this->name).'} ?></textarea>';
		        break;
	            
	            
			case 'dom':
			case 'tree':
				echo '<?php ';
		        echo '$doc = new DocumentElement();';
		        echo '$tmp_text = '.$this->textasvarname($this->name).';';
		        echo 'if( !is_array($tmp_text))$tmp_text = explode("\n",$tmp_text);';
		        echo '$doc->parse($tmp_text);';
		        echo 'echo $doc->render(\'application/html-dom\');';
		        echo '?>';
				break;
		
			default:
				throw new \LogicException("Unknown editor type: ".$this->type);
		}
	}
}


?>