<?php include( $tpl_dir.'header.tpl.php') ?>

<script name="JavaScript" type="text/javascript">
<!--
// Quelle:
// http://aktuell.de.selfhtml.org/tippstricks/javascript/bbcode/
function insert(aTag, eTag)
{
  var input = document.forms[0].elements['text'];
  input.focus();
  /* IE */
  if(typeof document.selection != 'undefined') {
    /* Einfgen des Formatierungscodes */
    var range = document.selection.createRange();
    var insText = range.text;
    range.text = aTag + insText + eTag;
    /* Anpassen der Cursorposition */
    range = document.selection.createRange();
    if (insText.length == 0) {
      range.move('character', -eTag.length);
    } else {
      range.moveStart('character', aTag.length + insText.length + eTag.length);      
    }
    range.select();
  }
  /* Gecko */
  else if(typeof input.selectionStart != 'undefined')
  {
    /* Einfgen des Formatierungscodes */
    var start = input.selectionStart;
    var end = input.selectionEnd;
    var insText = input.value.substring(start, end);
    input.value = input.value.substr(0, start) + aTag + insText + eTag + input.value.substr(end);
    /* Anpassen der Cursorposition */
    var pos;
    if (insText.length == 0) {
      pos = start + aTag.length;
    } else {
      pos = start + aTag.length + insText.length + eTag.length;
    }
    input.selectionStart = pos;
    input.selectionEnd = pos;
  }
  /* fbrigen Browser */
  else
  {
    /* Abfrage der Einfgeposition */
    var pos;
    var re = new RegExp('^[0-9]{0,3}$');
    while(!re.test(pos)) {
      pos = prompt("Einfuegen an Position (0.." + input.value.length + "):", "0");
    }
    if(pos > input.value.length) {
      pos = input.value.length;
    }
    /* Einfen des Formatierungscodes */
    var insText = prompt("Bitte geben Sie den zu formatierenden Text ein:");
    input.value = input.value.substr(0, pos) + aTag + insText + eTag + input.value.substr(pos);
  }
}


function strong()
{
	insert('*','*');
}


function emphatic()
{
	insert('_','_');
}


function link()
{
	insert('"','"->"'+document.forms[0].objectid.value+'"');
}


function image()
{
	insert('','{"'+document.forms[0].objectid.value+'"}');
}


function list()
{
	insert("\n\n- ","\n- \n- \n");
}


function numlist()
{
	insert("\n\n# ","\n# \n# \n");
}


function table()
{
	insert("\n|","| |\n| | |\n");
}


//-->
</script>

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
  <td colspan="2" class="f1">
    <table>
      <tr>
        <td><a href="javascript:strong();"><img src="<?php echo $image_dir ?>/editor/bold.png" border"0"   /></a></td>
        <td><a href="javascript:emphatic();"><img src="<?php echo $image_dir ?>/editor/italic.png" border"0" /></a></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><a href="javascript:table();"><img src="<?php echo $image_dir ?>/editor/table.png" border"0" /></a></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><a href="javascript:list();"><img src="<?php echo $image_dir ?>/editor/list.png" border"0" /></a></td>
        <td><a href="javascript:numlist();"><img src="<?php echo $image_dir ?>/editor/numlist.png" border"0" /></a></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><a href="javascript:image();"><img src="<?php echo $image_dir ?>/editor/image.png" border"0" /></a></td>
        <td><a href="javascript:link();"><img src="<?php echo $image_dir ?>/editor/link.png" border"0" /></a></td>
        <td><?php echo Html::selectBox('objectid',$objects) ?></td>
      </tr>
    </table>
  </td>
</tr>

<tr>
  <td colspan="2" class="f1"><br><textarea class="longtext" name="text"><?php echo $text ?></textarea></td>
</tr>

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