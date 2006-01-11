page
	form action:folder subaction:multiple
		window name:bla title:titelso widths:5%,75%,20%
			row
				cell colspan:7 class:help
					text text:GLOBAL_FOLDER_DESC
			if present:up_url
				row
					cell width:50% colspan:8 class:fx
						link url:up_url target:cms_main
							image type:folder
							text raw:_...
			row
				cell class:help
					text raw:_
				cell class:help
					text text:GLOBAL_TYPE
					text raw:_/_
					text text:GLOBAL_NAME
				cell class:help
					text text:GLOBAL_LASTCHANGE
					
			list list:object extract:true
				row
					cell class:fx
						if true:writable
							checkbox prefix:obj name:id
						if false:writable
							text raw:_

					cell class:fx
						link url:url target:cms_main title:desc
							image type:icon
							text var:name
							text raw:_
					cell class:fx
						text var:date

			if true:writable

RAW			
<tr>
  <td colspan="7" class="<?php echo $fx; ?>">
    <img src="<?php echo $image_dir ?>tree_none_end.gif" align="left" />&nbsp;
    <a href="javascript:mark();"><?php echo lang('FOLDER_MARK_ALL') ?></a> | <a href="javascript:unmark();"><?php echo lang('FOLDER_UNMARK_ALL') ?></a> | <a href="javascript:flip();"><?php echo lang('FOLDER_FLIP_MARK') ?></a>
  </td>
</tr>
<tr>
  <td></td>
  <td colspan="1" class="<?php echo $fx; ?>">
  <table>
  <tr>
  <td>
  <input type="radio" name="type" value="move" />
  <?php echo lang('GLOBAL_MOVE') ?> <?php echo lang('GLOBAL_TO') ?>
  <br/>
  <input type="radio" name="type" value="copy" />
  <?php echo lang('GLOBAL_COPY') ?> <?php echo lang('GLOBAL_TO') ?>
  <br/>
  <input type="radio" name="type" value="link" />
  <?php echo lang('GLOBAL_LINK') ?> <?php echo lang('GLOBAL_TO') ?>
  <br/>
  <input type="radio" name="type" value="delete" />
  <?php echo lang('GLOBAL_DELETE') ?>
  </td><td>
  <?php echo Html::selectBox('targetobjectid',$folder,$act_objectid) ?>
  </td><td>
  </td></tr>
  </table> 
</td>
</tr>
END
			if empty:object
			
				row
					cell class:fx colspan:2
						text text:GLOBAL_NOT_FOUND
	dummy
			
RAW

<script name="JavaScript">
<!--
function mark()
{
<?php foreach( $object as $id=>$z ) { ?>
document.forms[0].obj<?php echo $id ?>.checked=true;
<?php } ?>
}
function unmark()
{
<?php foreach( $object as $id=>$z ) { ?>
document.forms[0].obj<?php echo $id ?>.checked=false;
<?php } ?>
}
function flip()
{
<?php foreach( $object as $id=>$z ) { ?>
if	(document.forms[0].obj<?php echo $id ?>.checked==false)
 document.forms[0].obj<?php echo $id ?>.checked=true;
else document.forms[0].obj<?php echo $id ?>.checked=false;
<?php } ?>
}
//-->
</script>
END

