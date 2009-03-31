<?php


	function checkbox( $name,$value=false,$writable=true,$params=Array() )
	{
		$src = '<input type="checkbox" name="'.$name.'"';

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


	
 ?><?php

switch( $attr_type )
{
	case 'fckeditor':
	case 'html':
		
		if	( $this->isEditMode() )
		{
			include('./editor/fckeditor.php');
			$editor = new FCKeditor( $attr_name ) ;
			$editor->BasePath	= defined('OR_BASE_URL')?slashify(OR_BASE_URL).'editor/':'./editor/';
			$editor->Value = $$attr_name;
			$editor->Height = '290';
			$editor->Config['CustomConfigurationsPath'] = '../openrat-fckconfig.js';
			$editor->Create();
		}
		else
		{
			echo ($$attr_name);
		}

		break;
	
	case 'wiki':
		$conf_tags = $conf['editor']['text-markup'];
		if	( $this->isEditMode() )
		{
		
		?>
<script name="Javascript" type="text/javascript" src="<?php echo $tpl_dir ?>../../js/editor.js"></script>
<script name="JavaScript" type="text/javascript">
<!--

function strong()
{
	insert('<?php echo $attr_name ?>','<?php echo $conf_tags['strong-begin'] ?>','<?php echo $conf_tags['strong-end'] ?>');
}


function emphatic()
{
	insert('<?php echo $attr_name ?>','<?php echo $conf_tags['emphatic-begin'] ?>','<?php echo $conf_tags['emphatic-end'] ?>');
}


function link()
{
	objectid = document.forms[0].objectid.value;
	if	(objectid=="" ||objectid=="0"||objectid==null)
		objectid = window.prompt("Id","");
	if	(objectid=="" ||objectid=="0"||objectid==null)
		return;
	insert('<?php echo $attr_name ?>','"','"<?php echo $conf_tags['linkto'] ?>"'+objectid+'"');
}


function image()
{
	objectid = document.forms[0].objectid.value;
	if	(objectid=="" ||objectid=="0"||objectid==null)
		objectid = window.prompt("Id","");
	if	(objectid=="" ||objectid=="0"||objectid==null)
		return;
	insert('<?php echo $attr_name ?>','','<?php echo $conf_tags['image-begin'] ?>"'+objectid+'"<?php echo $conf_tags['image-end'] ?>');
}


function list()
{
 	insert('<?php echo $attr_name ?>',"","\n");
	while( true )
	{
		t = window.prompt('<?php echo lang('EDITOR_PROMPT_LIST_ENTRY') ?>','');
		if	( t != '' && t != null )
		 	insert('<?php echo $attr_name ?>',"<?php echo $conf_tags['list-unnumbered'] ?> "+t+"\n","");
		else
			break;
	}
}


function numlist()
{
	insert('<?php echo $attr_name ?>',"\n\n<?php echo $conf_tags['list-numbered'] ?> ","\n<?php echo $conf_tags['list-numbered'] ?> \n<?php echo $conf_tags['list-numbered'] ?> \n");
}


function table()
{
	column=1;
	while( true )
	{
		if	( column==1 )
			text='<?php echo lang('EDITOR_PROMPT_TABLE_CELL_FIRST_COLUMN') ?>';
		else
			text='<?php echo lang('EDITOR_PROMPT_TABLE_CELL') ?>';
		t = window.prompt(text,'');
		if	( t != '' && t != null )
		{
		 	insert('<?php echo $attr_name ?>',"<?php echo $conf_tags['table-cell-sep'] ?>"+t,"");
		 	column++;
		}
		else
		{
			if (column==1)
			{
				break;
			}
			else
			{
			 	insert('text',"\n","");
			 	column=1;
			 }
		}
	}
}

//-->
</script>
    <table>
      <tr>
        <noscript><input type="text" name="addtext" size="10" /></noscript>
        <td><noscript><?php echo checkbox('strong') ?></noscript><a href="javascript:strong();" title="<?php echo lang('PAGE_EDITOR_ADD_STRONG') ?>"><img src="<?php echo $image_dir ?>/editor/bold.png" border"0"   /></a></td>
        <td><noscript><?php echo checkbox('emphatic') ?></noscript><a href="javascript:emphatic();" title="<?php echo lang('PAGE_EDITOR_ADD_EMPHATIC') ?>"><img src="<?php echo $image_dir ?>/editor/italic.png" border"0" /></a></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><noscript><?php echo checkbox('table') ?></noscript><a href="javascript:table();" title="<?php echo lang('PAGE_EDITOR_ADD_TABLE') ?>"><img src="<?php echo $image_dir ?>/editor/table.png" border"0" /></a></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><noscript><?php echo checkbox('list') ?></noscript><a href="javascript:list();" title="<?php echo lang('PAGE_EDITOR_ADD_LIST') ?>"><img src="<?php echo $image_dir ?>/editor/list.png" border"0" /></a></td>
        <td><noscript><?php echo checkbox('numlist') ?></noscript><a href="javascript:numlist();" title="<?php echo lang('PAGE_EDITOR_ADD_NUMLIST') ?>"><img src="<?php echo $image_dir ?>/editor/numlist.png" border"0" /></a></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><noscript><?php echo checkbox('image') ?></noscript><a href="javascript:image();" title="<?php echo lang('PAGE_EDITOR_ADD_IMAGE') ?>"><img src="<?php echo $image_dir ?>/editor/image.png" border"0" /></a></td>
        <td><noscript><?php echo checkbox('link') ?></noscript><a href="javascript:link();" title="<?php echo lang('PAGE_EDITOR_ADD_LINK') ?>"><img src="<?php echo $image_dir ?>/editor/link.png" border"0" /></a></td>
        <td><?php echo selectBox('objectid',$objects) ?><noscript>&nbsp;&nbsp;&nbsp;<input type="submit" class="submit" name="addmarkup" value="<?php echo lang('GLOBAL_ADD') ?>"/></noscript></td>
        <td>&nbsp;&nbsp;&nbsp;<input type="submit" class="submit" name="preview" value="<?php echo lang('PAGE_PREVIEW') ?>" style="width:200px;"/></td>
      </tr>
    </table>
	<?php ?>
    
<?php
		
			//echo $attr_tmp_doc->render('application/html-editor');
			echo '<textarea name="'.$attr_name.'" class="editor" style="width:100%;height:300px;">'.$$attr_name.'</textarea>';
		}
		else
		{
			// Anzeige des Inhaltes
			$attr_tmp_text = $$attr_name;
//			$attr_tmp_doc = new DocumentElement();
			if	( !is_array($attr_tmp_text))
				$attr_tmp_text = explode("\n",$attr_tmp_text);
//			$attr_tmp_doc->parse($attr_tmp_text);
//			echo $attr_tmp_doc->render('text/html');
			echo implode('',$attr_tmp_text);
		}
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