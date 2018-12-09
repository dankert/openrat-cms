<?php

namespace template_engine\components;

class EditorComponent extends FieldComponent
{
	public $type;
	public $name;
	public $mode='htmlmixed';
	public $extension='';
	public $mimetype = '';

	protected function begin()
	{
		switch( $this->type )
		{
			case 'html':
				echo '<textarea '.$this->outputNameAttribute().' class="editor html-editor" id="pageelement_edit_editor"><?php echo ${'.$this->value($this->name).'} ?></textarea>';

				break;

			case 'wiki':
				echo '<textarea '.$this->outputNameAttribute().' class="editor wiki-editor"><?php echo ${'.$this->value($this->name).'} ?></textarea>';
				break;

			case 'text':
			case 'raw':
				echo '<textarea '.$this->outputNameAttribute().' class="editor text-editor"><?php echo ${'.$this->value($this->name).'} ?></textarea>';
				break;

			case 'markdown':
				echo '<textarea '.$this->outputNameAttribute().' class="editor markdown-editor"><?php echo htmlentities(${'.$this->value($this->name).'}) ?></textarea>';
		        break;
	            
			case 'code':
				echo '<textarea '.$this->outputNameAttribute().' data-extension="'.$this->htmlvalue($this->extension).'" data-mimetype="'.$this->htmlvalue($this->mimetype).'" data-mode="'.$this->htmlvalue($this->mode).'" class="editor code-editor"><?php echo htmlentities(${'.$this->value($this->name).'}) ?></textarea>';
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