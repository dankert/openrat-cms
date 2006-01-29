<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<?php echo Html::form('link','save') ?>

<?php windowOpen( 'GLOBAL_PROP',2,'link') ?>

<?php $tabnr=0 ?>
  <tr>
    <td width="50%" class="f1" rowspan="2"><?php echo lang('GLOBAL_name') ?></a>
    </td>
    <td width="50%" class="f1"><?php echo Html::inputText('name',$name,array('size'=>'50','tabindex'=>++$tabnr)) ?>
    </td>
  </tr>
  <tr>
    <td width="50%" class="help"><?php echo lang('GLOBAL_NAME_DESC') ?></td>
  </tr>
  <tr>
    <td width="50%" class="f2"><?php echo lang('GLOBAL_description') ?></a>
    </td>
    <td width="50%" class="f2"><?php echo Html::inputTextArea('desc',$desc,array('class'=>'desc','cols'=>'40','rows'=>'10','tabindex'=>++$tabnr)) ?>
    </td>
  </tr>
  <tr>
    <td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>" /></td>
  </tr>

<?php windowClose() ?>

</form>


<?php Html::focusField('name') ?>

<?php include( $tpl_dir.'footer.tpl.php') ?>