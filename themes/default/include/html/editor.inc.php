<?php


	function checkbox( $name,$value=false,$writable=true,$params=Array() )
	{
		$src = '<input type="checkbox" id="'.REQUEST_ID.'_'.$name.'" name="'.$name.'"';

		foreach( $params as $name=>$val )
			$src .= " $name=\"$val\"";

		if	( !$writable )
			$src .= ' disabled="disabled"';

		if	( $value )
			$src .= ' value="1" checked="checked"';

		$src .= ' />';

		return $src;
	}
	
	
	function selectBox( $name,$values,$default='',$params=Array() )
	{
		if	( ! is_array($values) )
			$values = array($values);
			
		$src = '<select size="1" name="'.$name.'"';
		foreach( $params as $name=>$value )
			$src .= " $name=\"$value\"";
		$src .= '>';

		foreach( $values as $key=>$value )
		{
			$src .= '<option value="'.$key.'"';
			if ($key == $default)
				$src .= ' selected="selected"';
			$src .= '>'.$value.'</option>';
		}
		$src .= '</select>';

		return $src;
	}


	function add_control($type,$image)
	{
		global $image_dir;
		echo '<td><noscript>'.checkbox($type).'</noscript><label for="'.REQUEST_ID.'_'.$type.'"><a href="javascript:'.$type.'();" title="'.langHtml('PAGE_EDITOR_ADD_'.$type).'"><img src="'.$image_dir.'/editor/'.$image.'" border"0" /></a></label>';
	}
	
	
 ?><?php

switch( $attr_type )
{
	case 'fckeditor':
	case 'html':
		echo '<textarea name="'.$attr_name.'" class="editor htmleditor" id="pageelement_edit_editor">'.$$attr_name.'</textarea>';

		break;
	
	case 'wiki':
		$conf_tags = $conf['editor']['text-markup'];
		
		?><textarea name="<?php echo $attr_name ?>" class="editor wikieditor"><?php echo $$attr_name ?></textarea><?php
		break;
		
	case 'text':
	case 'raw':
		if	( $this->isEditMode() )
			echo '<textarea name="'.$attr_name.'" class="editor" style="width:100%;height:300px;">'.$$attr_name.'</textarea>';
		else
			echo nl2br($$attr_name);
		break;


	case 'dom':
	case 'tree':
		
		$attr_tmp_doc = new DocumentElement();
		$attr_tmp_text = $$attr_name;
		if	( !is_array($attr_tmp_text))
			$attr_tmp_text = explode("\n",$attr_tmp_text);
			
		$attr_tmp_doc->parse($attr_tmp_text);
		echo $attr_tmp_doc->render('application/html-dom');
		break;
		
	default:
		echo "Unknown editor type: ".$attr_type;
}
?>