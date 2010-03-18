<?php


	function checkbox( $name,$value=false,$writable=true,$params=Array() )
	{
		$src = '<input type="checkbox" id="id_'.$name.'" name="'.$name.'"';

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
		echo '<td><noscript>'.checkbox($type).'</noscript><label for="id_'.$type.'"><a href="javascript:'.$type.'();" title="'.langHtml('PAGE_EDITOR_ADD_'.$type).'"><img src="'.$image_dir.'/editor/'.$image.'" border"0" /></a></label>';
	}
	
	
 ?><?php

switch( $attr_type )
{
	case 'fckeditor':
	case 'html':
		
		if	( $this->isEditMode() )
		{
			include_once('./editor/editor/ckeditor.php');
			
			$editor = new CKeditor() ;
			
			
			//$editor->Value = $$attr_name;
			//$editor->Height = '290';
			//$editor->Config['CustomConfigurationsPath'] = '../../'.Html::url('filemanager','config');
			//$editor->Config['CustomConfigurationsPath'] = '../openrat-fckconfig.js';
			//$editor->Create();
			
			$url = FileUtils::slashify(dirname($_SERVER['SCRIPT_NAME']));
			
			$base = defined('OR_BASE_URL')?slashify(OR_BASE_URL).'editor/editor/':'./editor/editor/';
			$editor->basePath = $base;
			$editor->config['skin' ] = 'v2';
			$editor->config['language' ] = config('language','language_code');
			$editor->config['toolbar' ] = 'Openrat';
			$editor->config['toolbar_Openrat' ] =  array( 
	array('Save','Preview','-'/*,'Templates'*/),
    array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'),
    array('Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
    array('Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'),
    '/',
    array('Bold','Italic',/*'Underline',*/'Strike','-','Subscript','Superscript'),
    array('NumberedList','BulletedList','-','Outdent','Indent','Blockquote'),
    array('JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
    array('Link','Unlink','Anchor'),
    array('Image','Flash','Table','HorizontalRule','SpecialChar','PageBreak'),
    '/',
    array(/*'Styles',*/'Format','Font','FontSize'),
    array('TextColor','BGColor'),
    array('Source','-', 'ShowBlocks','Maximize') );
			
			$editor->config['filebrowserUploadUrl' ] = str_replace('&amp;','&',Html::url('filebrowser','upload','-',array(REQ_PARAM_TOKEN=>token(),'name'=>'upload')));
			$editor->config['filebrowserBrowseUrl' ] = str_replace('&amp;','&',Html::url('filebrowser','browse','-'));
			
			$editor->editor($attr_name,$$attr_name);
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
		t = window.prompt('<?php echo langHtml('EDITOR_PROMPT_LIST_ENTRY') ?>','');
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
			text='<?php echo langHtml('EDITOR_PROMPT_TABLE_CELL_FIRST_COLUMN') ?>';
		else
			text='<?php echo langHtml('EDITOR_PROMPT_TABLE_CELL') ?>';
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
    <fieldset><legend><?php echo langHtml('EDITOR') ?></legend></fieldset>
    <table>
      <tr>
      	<td><noscript><input type="text" name="addtext" size="30" /></noscript></td>
        <td><?php add_control('strong'  ,'bold.png'  )?></td>
        <td><?php add_control('emphatic','italic.png') ?></td>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td><?php add_control('table','table.png') ?></td>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td><?php add_control('list'   ,'list.png')  ; ?></td>
        <td><?php add_control('numlist','numlist.png') ?></td>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td><?php add_control('image','image.png') ?></td>
        <td><?php add_control('link' ,'link.png' ) ?></td>
        <!-- <td><?php echo selectBox('objectid',$objects) ?></td> -->
        <td><input name="objectid" size="6" title="<?php echo langHtml('LINK_TO') ?>"></td>
        <td><noscript>&nbsp;&nbsp;<input type="submit" class="submit" name="addmarkup" value="<?php echo langHtml('ADD') ?>"/></noscript></td>
      </tr>
    </table>
    <fieldset><legend><?php echo langHtml('CONTENT') ?></legend></fieldset>
			
	<textarea name="<?php echo $attr_name ?>" class="editor" style="width:100%;height:300px;"><?php echo $$attr_name ?></textarea>
			
<?php
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