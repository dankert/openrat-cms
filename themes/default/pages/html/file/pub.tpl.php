<?php include( $tpl_dir.'header.tpl.php') ?>

<center>

<?php echo Html::form('file','pubnow','-' ) ?>

<?php windowOpen( 'GLOBAL_PUBLISH',2,'folder') ?>

<tr>
  <td width="50%" class="f1">&nbsp;</td>
  <td width="50%" class="f1">&nbsp;</td>
</tr>

<tr>
  <td class="act" colspan="2"><input type="submit"  class="submit" value="<?php echo lang('GLOBAL_PUBLISH') ?>"></td>
</tr>

<?php windowClose() ?>
</form>




<?php include( $tpl_dir.'footer.tpl.php') ?>