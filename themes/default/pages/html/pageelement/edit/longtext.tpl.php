<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<?php echo Html::form('page','elsave') ?>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo $name ?></th>
</tr>

<tr>
  <td colspan="2" class="help"><?php echo $desc ?></td>
</tr>

<?php if (isset($preview_text)) { ?>
<tr>
  <td colspan="2" class="f1"><?php echo $preview_text ?></td>
</tr>
<?php } ?>

<tr>
  <td colspan="2" class="f1"><br><textarea class="longtext" name="text"><?php echo $text ?></textarea></td>
</tr>

<!--
<tr>
  <td class="f2" colspan="2"><?php echo Html::checkBox('preview',false).' '.lang('PAGE_PREVIEW') ?></td>
</tr>-->

<tr>
  <td class="f2"><?php if ( $release ) echo Html::checkBox('release',true).' '.lang('GLOBAL_RELEASE') ?></td>
  <td class="f2"><?php echo Html::checkBox('html',$html,false) ?> <span title="<?php echo lang('EL_PROP_HTML_DESC') ?>"><?php echo lang('EL_PROP_HTML') ?></span></td>
</tr>

<tr>
  <td class="f2"><?php if	( $publish ) echo Html::checkBox('publish',false).' '.lang('PAGE_PUBLISH_AFTER_SAVE') ?>&nbsp;</td>
  <td class="f2" rowspan="2"><?php echo Html::checkBox('wiki',$wiki,false) ?> <span title="<?php echo lang('EL_PROP_WIKI_DESC') ?>"><?php echo lang('EL_PROP_WIKI') ?></span><?php if ($wiki) echo '<br/>'.lang('PAGE_LONGTEXT_WIKI_DESC') ?></td>
</tr>

<tr>
  <td class="act"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>" />
                  <input type="submit" class="submit" name="preview" value="<?php echo lang('PAGE_PREVIEW') ?>" /></td>
</tr>

</table>

</form>

</center>

<?php Html::focusField('text') ?>

<?php include( $tpl_dir.'footer.tpl.php') ?>