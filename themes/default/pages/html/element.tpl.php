<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<span style="text-align:center; ">

<center>
<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="action"    value="template"      />
<input type="hidden" name="subaction" value="elementrename" />

<table class="main" width="90%" cellspacing="0" cellpadding="4">

  <tr>
    <th colspan="2"><?php echo lang('NAME') ?></th>
  </tr>
  <tr>
    <td class="f1" rowspan="2"><?php echo lang('NAME') ?></td>
    <td class="f1"><input type="text" name="name" class="name" value="<?php echo $name ?>"></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('ELEMENT_NAME_DESC') ?></td>
  </tr>

  <tr>
    <td class="f2" rowspan="2"><?php echo lang('DESCRIPTION') ?></td>
    <td class="f2"><textarea name="desc" rows="5" cols="50"><?php echo $desc ?></textarea></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('ELEMENT_DESC_DESC') ?></td>
  </tr>

  <tr>
    <td class="f1" rowspan="2"><?php echo lang('ELEMENT_DELETE_VALUES') ?></a></td>
    <td class="f1"><input type="checkbox" name="deletevalues" value="1"></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('ELEMENT_DELETE_VALUES_DESC') ?></td>
  </tr>
  <tr>
    <td class="f1" rowspan="2"><?php echo lang('DELETE') ?></a></td>
    <td class="f1"><input type="checkbox" name="delete" value="1"></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('ELEMENT_DELETE_DESC') ?></td>
  </tr>

  <tr>
    <td colspan="2" class="act"><input type="submit" class="submit" value="<?php echo lang('SAVE') ?>"></td>
  </tr>

</table>

</form>


<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="action"    value="element">
<input type="hidden" name="subaction" value="changetype">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

  <tr>
    <th colspan="2"><?php echo lang('TYPE') ?></th>
  </tr>
  <tr>
    <td class="f1" width="30%"><?php echo lang('TYPE') ?></td>
    <td class="f1" width="70%"><?php echo Html::selectBox('type',$type,$default_type,Array('onChange'=>'submit();')) ?> <noscript><input type="submit" class="submit" value="<?php echo lang('CHANGE') ?>"></noscript></td>
  </tr>
  <tr>
    <td></td>
    <td class="help" width="70%"><?php echo lang('EL_'.$default_type.'_DESC') ?></td>
  </tr>

</table>

</form>


<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="action"    value="template">
<input type="hidden" name="subaction" value="elementsave">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

  <tr>
    <th colspan="2"><?php echo lang('PREFS') ?></th>
  </tr>


  <?php $fx = '';
        if (isset($subtype))
        {  $fx = fx($fx); ?>
  <tr>
    <td class="<?php echo $fx ?>"><?php echo lang('SUBTYPE') ?></td>
    <td class="<?php echo $fx ?>"><?php echo Html::selectBox('subtype',$subtype,$act_subtype) ?></td>
  </tr>
  <?php } ?>


  <?php 
        if   ( isset($with_icon) )
        {
	        $fx = fx($fx); ?>
  <tr>
    <td class="<?php echo $fx ?>"><?php echo lang('EL_PROP_WITH_ICON') ?></td>
    <td class="<?php echo $fx ?>"><?php echo Html::checkBox('with_icon',$with_icon) ?></td>
  </tr>
  <tr>
    <td></td>
    <td class="help"><?php echo lang('EL_PROP_WITH_ICON_DESC') ?></td>
  </tr>
  <?php } ?>


  <?php 
        if   ( isset($all_languages) )
        {
	        $fx = fx($fx); ?>
  <tr>
    <td class="<?php echo $fx ?>"><?php echo lang('EL_PROP_ALL_LANGUAGES') ?></td>
    <td class="<?php echo $fx ?>"><?php echo Html::checkBox('all_languages',$all_languages) ?></td>
  </tr>
  <tr>
    <td></td>
    <td class="help"><?php echo lang('EL_PROP_ALL_LANGUAGES_DESC') ?></td>
  </tr>
  <?php } ?>


  <?php 
        if   ( isset($writable) )
        {
	        $fx = fx($fx); ?>
  <tr>
    <td class="<?php echo $fx ?>"><?php echo lang('EL_PROP_WRITABLE') ?></td>
    <td class="<?php echo $fx ?>"><?php echo Html::checkBox('writable',$writable) ?></td>
  </tr>
  <tr>
    <td></td>
    <td class="help"><?php echo lang('EL_PROP_WRITABLE_DESC') ?></td>
  </tr>
  <?php } ?>


  <?php 
        if   ( isset($width) && isset($height) )
        {
	        $fx = fx($fx); ?>
  <tr>
    <td class="<?php echo $fx ?>"><?php echo lang('WIDTH') ?></td>
    <td class="<?php echo $fx ?>"><input type="text" size="10" name="width" value="<?php echo $width ?>"></td>
  </tr>
  <?php $fx = fx($fx); ?>
  <tr>
    <td class="<?php echo $fx ?>"><?php echo lang('HEIGHT') ?></td>
    <td class="<?php echo $fx ?>"><input type="text" size="10" name="height" value="<?php echo $height ?>"></td>
  </tr>
  <?php } ?>


  <?php if (isset($dateformat))
        {  $fx = fx($fx); ?>
  <tr>
    <td class="<?php echo $fx ?>"><?php echo lang('EL_PROP_DATEFORMAT') ?></td>
    <td class="<?php echo $fx ?>"><?php echo Html::selectBox('dateformat',$dateformat,$act_dateformat) ?></td>
  </tr>
  <tr>
    <td></td>
    <td class="help"><?php echo lang('EL_PROP_DATEFORMAT_DESC') ?></td>
  </tr>
  <?php } ?>


  <?php 
        if   ( isset($wiki) )
        {
	        $fx = fx($fx); ?>
  <tr>
    <td class="<?php echo $fx ?>"><?php echo lang('EL_PROP_WIKI') ?></td>
    <td class="<?php echo $fx ?>"><input type="checkbox" name="wiki" <?php if ($wiki) echo ' checked' ?>></td>
  </tr>
  <tr>
    <td></td>
    <td class="help"><?php echo lang('EL_PROP_WIKI_DESC') ?></td>
  </tr>
   <?php } ?>


  <?php 
        if   ( isset($html) )
        {
	        $fx = fx($fx); ?>
  <tr>
    <td class="<?php echo $fx ?>"><?php echo lang('EL_PROP_HTML') ?></td>
    <td class="<?php echo $fx ?>"><input type="checkbox" name="html" <?php if ($html) echo ' checked' ?>></td>
  </tr>
   <tr>
    <td></td>
    <td class="help"><?php echo lang('EL_PROP_HTML_DESC') ?></td>
  </tr>
  <?php } ?>


  <?php if   ( isset($decimals) )
        {
	        $fx = fx($fx); ?>
  <tr>
    <td class="<?php echo $fx ?>"><?php echo lang('EL_PROP_DECIMALS') ?></td>
    <td class="<?php echo $fx ?>"><input type="text" size="10" maxlength="2" name="decimals" value="<?php echo $decimals ?>"></td>
  </tr>
   <tr>
    <td></td>
    <td class="help"><?php echo lang('EL_PROP_DECIMALS_DESC') ?></td>
  </tr>
  <?php } ?>


  <?php if   ( isset($dec_point) )
        {
	        $fx = fx($fx); ?>
  <tr>
    <td class="<?php echo $fx ?>"><?php echo lang('EL_PROP_DEC_POINT') ?></td>
    <td class="<?php echo $fx ?>"><input type="text" size="10" maxlength="5" name="dec_point" value="<?php echo $dec_point ?>"></td>
  </tr>
   <tr>
    <td></td>
    <td class="help"><?php echo lang('EL_PROP_DEC_POINT_DESC') ?></td>
  </tr>
  <?php } ?>


  <?php if   ( isset($thousand_sep) )
        {
	        $fx = fx($fx); ?>
  <tr>
    <td class="<?php echo $fx ?>"><?php echo lang('EL_PROP_THOUSAND_SEP') ?></td>
    <td class="<?php echo $fx ?>"><input type="text" size="10" maxlength="1" name="thousand_sep" value="<?php echo $thousand_sep ?>"></td>
  </tr>
   <tr>
    <td></td>
    <td class="help"><?php echo lang('EL_PROP_THOUSAND_SEP_DESC') ?></td>
  </tr>
  <?php } ?>


  <?php if   ( isset($default_text) )
        {
	        $fx = fx($fx); ?>
  <tr>
    <td class="<?php echo $fx ?>"><?php echo lang('EL_PROP_DEFAULT_TEXT') ?></td>
    <td class="<?php echo $fx ?>"><input type="text" size="40" maxlength="255" name="default_text" value="<?php echo $default_text ?>"></td>
  </tr>
  <tr>
    <td></td>
    <td class="help"><?php echo lang('EL_PROP_DEFAULT_TEXT_DESC') ?></td>
  </tr>
  <?php } ?>


  <?php if   ( isset($default_longtext) )
        {
	        $fx = fx($fx); ?>
  <tr>
    <td class="<?php echo $fx ?>"><?php echo lang('EL_PROP_DEFAULT_LONGTEXT') ?></td>
    <td class="<?php echo $fx ?>"><textarea name="default_text" rows="10" cols="40"><?php echo $default_longtext ?></textarea></td>
  </tr>
  <tr>
    <td></td>
    <td class="help"><?php echo lang('EL_PROP_DEFAULT_LONGTEXT_DESC') ?></td>
  </tr>
  <?php } ?>


  <?php if   ( isset($parameters) )
        {
	        $fx = fx($fx); ?>
  <tr>
    <td></td>
    <td class="help"><?php echo $dynamic_class_description ?></td>
  </tr>
  <?php if	( count($dynamic_class_parameters) > 0 )
        { ?>
  <tr>
    <td class="<?php echo $fx ?>"><?php echo lang('EL_PROP_DYNAMIC_PARAMETERS') ?></td>
    <td class="<?php echo $fx ?>"><textarea name="code" rows="15" cols="40"><?php echo $parameters ?></textarea></td>
  </tr>
  <tr>
    <td></td>
    <td class="help"><ul><?php foreach( $dynamic_class_parameters as $paramName=>$paramDesc )
                           { ?>
                     <li><strong><?php echo $paramName ?></strong>: <?php echo $paramDesc ?></li> 
                     <?php } ?>
                     </ul>
    </td>
  </tr>
  <tr>
    <td></td>
    <td class="help"><?php echo lang('EL_PROP_DYNAMIC_PARAMETERS_DESC') ?></td>
  </tr>
  <?php } ?>
  <?php } ?>


  <?php if   ( isset($select_items) )
        {
	        $fx = fx($fx); ?>
  <tr>
    <td class="<?php echo $fx ?>"><?php echo lang('EL_PROP_SELECT_ITEMS') ?></td>
    <td class="<?php echo $fx ?>"><textarea name="code" rows="15" cols="40"><?php echo $select_items ?></textarea></td>
  </tr>
  <tr>
    <td></td>
    <td class="help"><?php echo lang('EL_PROP_SELECT_ITEMS_DESC') ?></td>
  </tr>
  <?php } ?>


  <?php if (isset($act_folderobjectid))
        {  $fx = fx($fx); ?>
  <tr>
    <td class="<?php echo $fx ?>"><?php echo lang('EL_PROP_DEFAULT_FOLDEROBJECT') ?></td>
    <td class="<?php echo $fx ?>"><?php echo Html::selectBox('folderobjectid',$folders,$act_folderobjectid) ?></td>
  </tr>
  <tr>
    <td></td>
    <td class="help"><?php echo lang('EL_PROP_DEFAULT_FOLDEROBJECT_DESC') ?></td>
  </tr>
  <?php } ?>


  <?php if (isset($act_default_objectid))
        {  $fx = fx($fx); ?>
  <tr>
    <td class="<?php echo $fx ?>"><?php echo lang('EL_PROP_DEFAULT_OBJECT') ?></td>
    <td class="<?php echo $fx ?>"><?php echo Html::selectBox('default_objectid',$objects,$act_default_objectid) ?></td>
  </tr>
  <tr>
    <td></td>
    <td class="help"><?php echo lang('EL_PROP_DEFAULT_OBJECT_DESC') ?></td>
  </tr>
  <?php } ?>



  <?php if   ( isset($code) )
        {
	        $fx = fx($fx); ?>
  <tr>
    <td class="<?php echo $fx ?>"><?php echo lang('EL_PROP_CODE') ?></td>
    <td class="<?php echo $fx ?>"><textarea name="code" rows="35" cols="60"><?php echo $code ?></textarea></td>
  </tr>
  <?php } ?>


  <tr>
    <td colspan="2" class="act"><input type="submit" class="submit" value="<?php echo lang('SAVE') ?>"></td>
  </tr>

</table>

</form>

</center>
</span>

<script name="JavaScript" type="text/javascript"><!--
document.forms[0].name.focus();
//--></script>

<?php include( $tpl_dir.'footer.tpl.php') ?>