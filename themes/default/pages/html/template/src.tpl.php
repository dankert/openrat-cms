<?php include( $tpl_dir.'header.tpl.php') ?>

<script name="Javascript" type="text/javascript" src="<?php echo $tpl_dir ?>../js/editor.js" ></script>
<script name="JavaScript" type="text/javascript">
<!--
function add_element()
{
	var elementName = document.forms[0].elementid.options[document.forms[0].elementid.selectedIndex].text;
	insert('src',"{{"+elementName+"}}",'');
}
function add_icon()
{
	var elementName = document.forms[0].elementid.options[document.forms[0].iconid.selectedIndex].text;
	insert('src',"{{->"+elementName+"}}",'');
}
function add_ifempty_tag()
{
	var elementName = document.forms[0].elementid.options[document.forms[0].ifemptyid.selectedIndex].text;
	insert('src',"{{<?php echo lang('IFEMPTY') ?>:"+elementName+":<?php echo lang('BEGIN') ?>}}","{{<?php echo lang('IFEMPTY') ?>:"+elementName+":<?php echo lang('END') ?>}}");
}

function add_ifnotempty_tag()
{
	var elementName = document.forms[0].elementid.options[document.forms[0].ifnotemptyid.selectedIndex].text;
	insert('src',"{{<?php echo lang('IFNOTEMPTY') ?>:"+elementName+":<?php echo lang('BEGIN') ?>}}","{{<?php echo lang('IFNOTEMPTY') ?>:"+elementName+":<?php echo lang('END') ?>}}");
}
//-->
</script>

<!-- $Id$ -->
<center>

<?php echo Html::form('template','srcsave',$templateid ) ?>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('TEMPLATE_SOURCE') ?></th>
</tr>

<tr>
<td class="f1" colspan="2"><textarea rows="25" cols="80" name="src"><?php echo $text ?></textarea></td>
</tr>

<?php if ( count($elements)>0 )
      { ?>
<tr>
  <td class="f2" width="30%"><?php echo Html::selectBox('elementid',$elements) ?></td>
  <td class="f2"><input type="submit" name="addelement" class="submit" onClick="add_element(); return false;" value="<?php echo lang('GLOBAL_ADD') ?>" /></td>
</tr>
<?php } ?>

<?php if ( count($icon_elements)>0 )
      { ?>
<tr>
  <td class="f2" width="30%"><?php echo Html::selectBox('iconid',$icon_elements) ?></td>
  <td class="f2"><input type="submit" name="addicon" class="submit" value="<?php echo lang('GLOBAL_ADD') ?>" /></td>
</tr>

<?php } ?>

<?php if ( count($ifempty_elements)>0 )
      { ?>
<tr>
  <td class="f2" width="30%"><?php echo Html::selectBox('ifemptyid',$ifempty_elements) ?></td>
  <td class="f2"><input type="submit" name="addifempty" class="submit" value="<?php echo lang('GLOBAL_ADD') ?>" /></td>
</tr>
<?php } ?>

<?php if ( count($ifnotempty_elements)>0 )
      { ?>
<tr>
  <td class="f2" width="30%"><?php echo Html::selectBox('ifnotemptyid',$ifnotempty_elements) ?></td>
  <td class="f2"><input type="submit" name="addifnotempty" class="submit" value="<?php echo lang('GLOBAL_ADD') ?>" /></td>
</tr>
<?php } ?>

<tr>
<td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>" /></td>
</tr>

</table>

</form>

</center>

<?php echo Html::focusField('src') ?>

<?php include( $tpl_dir.'footer.tpl.php') ?>