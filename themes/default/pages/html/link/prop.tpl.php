<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<?php echo Html::form('link','save') ?>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('GLOBAL_PROP') ?></th>
</tr>

<?php $tabnr=0 ?>
  <tr>
    <td width="50%" class="f1" rowspan="2"><?php echo lang('GLOBAL_name') ?></a></td>
    <td width="50%" class="f1"><input type="text" class="name" name="name" size="50" value="<?php echo $name ?>" tabindex="<?php echo ++$tabnr ?>"/></td>
  </tr>
  <tr>
    <td width="50%" class="help"><?php echo lang('GLOBAL_NAME_DESC') ?></td>
  </tr>
  <tr>
    <td width="50%" class="f2"><?php echo lang('GLOBAL_description') ?></a></td>
    <td width="50%" class="f2"><textarea class="desc" cols="40" rows="10" name="desc" tabindex="<?php echo ++$tabnr ?>"/><?php echo $desc ?></textarea></td>
  </tr>
<?php $typenr=0 ?>
  <tr>
    <td class="f1"><input type="radio" name="type" value="link"<?php if ($type=='link') echo ' checked="checked"'; ?> onClick="document.forms[0].linkobjectid.focus();" /><?php echo lang('LINK_TARGET') ?></a></td>
    <td class="f1"><?php echo Html::selectBox('linkobjectid',$objects,$act_linkobjectid,array('tabindex'=>++$tabnr,'onFocus'=>'document.forms[0].type['.$typenr++.'].checked=true;')) ?></td>
  </tr>
  <tr>
    <td class="f1"><input type="radio" name="type" value="url"<?php if ($type=='url') echo ' checked="checked"'; ?> onClick="document.forms[0].url.focus();" /><?php echo lang('LINK_URL') ?></a></td>
    <td class="f1"><input type="text" name="url" size="50" maxlength="255" value="<?php echo $url; ?>" onFocus="document.forms[0].type[<?php echo $typenr++ ?>].checked=true;" tabindex="<?php echo ++$tabnr ?>"></td>
  </tr>
  <tr>
    <td width="50%" class="f2"><?php echo lang('GLOBAL_created') ?></a></td>
    <td width="50%" class="f2"><?php echo date(lang('DATE_FORMAT'),$create_date) ?>, <?php Html::printUser($create_user) ?></td>
  </tr>
  <tr>
    <td width="50%" class="f2"><?php echo lang('GLOBAL_lastchange') ?></a></td>
    <td width="50%" class="f2"><?php echo date(lang('DATE_FORMAT'),$lastchange_date) ?>, <?php Html::printUser($lastchange_user) ?></td>
  </tr>
  <tr>
    <td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>" /></td>
  </tr>

</table>

</form>



</center>

<?php Html::focusField('name') ?>

<?php include( $tpl_dir.'footer.tpl.php') ?>