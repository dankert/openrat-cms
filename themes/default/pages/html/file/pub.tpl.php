<?php include( $tpl_dir.'header.tpl.php') ?>

<center>

<?php echo Html::form('file','pubnow','-' ) ?>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('GLOBAL_PUBLISH') ?></th>
</tr>

<tr>
  <td width="50%" class="f1">&nbsp;</td>
  <td width="50%" class="f1">&nbsp;</td>
</tr>

<tr>
  <td class="act" colspan="2"><input type="submit"  class="submit" value="<?php echo lang('GLOBAL_PUBLISH') ?>"></td>
</tr>

</table>

</form>


</center>


<?php include( $tpl_dir.'footer.tpl.php') ?>