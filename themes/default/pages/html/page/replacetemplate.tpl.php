<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<?php echo Html::form('page','replacetemplate','',array('newTemplateId'=>$newTemplateId)) ?>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

  <tr>
    <th colspan="2"><?php echo lang('PAGE_REPLACE_TEMPLATE') ?></th>
  </tr>

<?php foreach( $oldTemplateElements as $oldId=>$oldName )
      { ?>
  <tr>
    <td width="50%" class="f1"><?php echo $oldName ?></a></td>
    <td width="50%" class="f1"><?php $listName = 'newTemplateElementsOf'.$oldId; echo Html::selectBox('from'.$oldId,$$listName) ?></td>
  </tr>
<?php } ?>

  <tr>
    <td class="act" colspan="2"><input class="submit" type="submit" value="<?php echo lang('PAGE_REPLACE_TEMPLATE') ?>" /></td>
  </tr>

</table>

</form>


<script name="JavaScript" type="text/javascript"><!--
document.forms[0].name.focus();
//--></script>

</center>

<?php include( $tpl_dir.'footer.tpl.php') ?>