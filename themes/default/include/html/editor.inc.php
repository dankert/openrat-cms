<?php

if	($attr_type=='fckeditor' || $attr_type=='html')
{
	include('./editor/fckeditor.php');
	$editor = new FCKeditor( $attr_name ) ;
	$editor->BasePath	= './editor/';
	$editor->Value = $$attr_name;
	$editor->Height = '290';
	$editor->Config['CustomConfigurationsPath'] = '../openrat-fckconfig.js';
	$editor->Create();
}
elseif	($attr_type=='wiki')
{
	?>
<script name="Javascript" type="text/javascript" src="<?php echo $tpl_dir ?>../js/editor.js"></script>
<script name="JavaScript" type="text/javascript">
<!--

function strong()
{
	insert('text','*','*');
}


function emphatic()
{
	insert('text','_','_');
}


function link()
{
	insert('text','"','"->"'+document.forms[0].objectid.value+'"');
}


function image()
{
	insert('text','','{"'+document.forms[0].objectid.value+'"}');
}


function list()
{
	insert('text',"\n\n- ","\n- \n- \n");
}


function numlist()
{
	insert('text',"\n\n# ","\n# \n# \n");
}


function table()
{
	insert('text',"\n|","| |\n| | |\n");
}


//-->
-->
</script>
	<?php
		global $image_dir,$objects;
		?>
<tr>
  <td colspan="2" class="f1">
    <table>
      <tr>
        <noscript><input type="text" name="addtext" size="10" /></noscript>
        <td><noscript><?php echo Html::Checkbox('strong') ?></noscript><a href="javascript:strong();" title="<?php echo lang('PAGE_EDITOR_ADD_STRONG') ?>"><img src="<?php echo $image_dir ?>/editor/bold.png" border"0"   /></a></td>
        <td><noscript><?php echo Html::Checkbox('emphatic') ?></noscript><a href="javascript:emphatic();" title="<?php echo lang('PAGE_EDITOR_ADD_EMPHATIC') ?>"><img src="<?php echo $image_dir ?>/editor/italic.png" border"0" /></a></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><noscript><?php echo Html::Checkbox('table') ?></noscript><a href="javascript:table();" title="<?php echo lang('PAGE_EDITOR_ADD_TABLE') ?>"><img src="<?php echo $image_dir ?>/editor/table.png" border"0" /></a></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><noscript><?php echo Html::Checkbox('list') ?></noscript><a href="javascript:list();" title="<?php echo lang('PAGE_EDITOR_ADD_LIST') ?>"><img src="<?php echo $image_dir ?>/editor/list.png" border"0" /></a></td>
        <td><noscript><?php echo Html::Checkbox('numlist') ?></noscript><a href="javascript:numlist();" title="<?php echo lang('PAGE_EDITOR_ADD_NUMLIST') ?>"><img src="<?php echo $image_dir ?>/editor/numlist.png" border"0" /></a></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><noscript><?php echo Html::Checkbox('image') ?></noscript><a href="javascript:image();" title="<?php echo lang('PAGE_EDITOR_ADD_IMAGE') ?>"><img src="<?php echo $image_dir ?>/editor/image.png" border"0" /></a></td>
        <td><noscript><?php echo Html::Checkbox('link') ?></noscript><a href="javascript:link();" title="<?php echo lang('PAGE_EDITOR_ADD_LINK') ?>"><img src="<?php echo $image_dir ?>/editor/link.png" border"0" /></a></td>
        <td><?php echo Html::selectBox('objectid',$objects) ?><noscript>&nbsp;&nbsp;&nbsp;<input type="submit" class="submit" name="addmarkup" value="<?php echo lang('GLOBAL_ADD') ?>"/></noscript></td>
      </tr>
    </table>
  </td>
</tr>
<?php
	echo '<textarea name="'.$attr_name.'" class="editor">'.$$attr_name.'</textarea>';
}
elseif	($attr_type=='text' || $attr_type=='raw')
{
	echo '<textarea name="'.$attr_name.'" class="editor">'.$$attr_name.'</textarea>';
}
else
{
	echo "Unknown editor type: ".$attr_type;
}
?>
