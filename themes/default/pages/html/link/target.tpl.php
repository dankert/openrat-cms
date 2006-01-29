<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<?php echo Html::form('link','save') ?>

<?php windowOpen( 'GLOBAL_PROP',2,'link') ?>

<?php $tabnr=0 ?>
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
    <td class="f1" colspan="2"><a href="<?php echo $edittarget_url ?>"><?php echo lang('GLOBAL_CHANGE') ?></a></td>
  </tr>

<?php windowClose() ?>

</form>

<?php include( $tpl_dir.'footer.tpl.php') ?>