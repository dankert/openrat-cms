page
	form

RAW
<?php
	function editBar()
	{
		global $image_dir,$objects;
		?>
<tr>
  <td colspan="2" class="f1">
    <table>
      <tr>
        <noscript><input type="text" name="addtext" size="10" /></noscript>
        <td><noscript><?php echo Html::Checkbox('strong') ?></noscript><a href="javascript:strong();" title="<?php echo lang('PAGE_EDITOR_ADD_STRONG') ?>"><img src="<?php echo $image_dir ?>/editor/bold.png" border"0"   /></a></td>
        <td><noscript><?php echo Html::Checkbox('emphatic') ?></noscript><a href="javascript:emphatic();" title="<?php echo lang('PAGE_EDITOR_ADD_EMPHATIC') ?>"><img src="<?php echo $image_dir ?>/editor/italic.png" border"0" /></a></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><noscript><?php echo Html::Checkbox('table') ?></noscript><a href="javascript:table();" title="<?php echo lang('PAGE_EDITOR_ADD_TABLE') ?>"><img src="<?php echo $image_dir ?>/editor/table.png" border"0" /></a></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><noscript><?php echo Html::Checkbox('list') ?></noscript><a href="javascript:list();" title="<?php echo lang('PAGE_EDITOR_ADD_LIST') ?>"><img src="<?php echo $image_dir ?>/editor/list.png" border"0" /></a></td>
        <td><noscript><?php echo Html::Checkbox('numlist') ?></noscript><a href="javascript:numlist();" title="<?php echo lang('PAGE_EDITOR_ADD_NUMLIST') ?>"><img src="<?php echo $image_dir ?>/editor/numlist.png" border"0" /></a></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><noscript><?php echo Html::Checkbox('image') ?></noscript><a href="javascript:image();" title="<?php echo lang('PAGE_EDITOR_ADD_IMAGE') ?>"><img src="<?php echo $image_dir ?>/editor/image.png" border"0" /></a></td>
        <td><noscript><?php echo Html::Checkbox('link') ?></noscript><a href="javascript:link();" title="<?php echo lang('PAGE_EDITOR_ADD_LINK') ?>"><img src="<?php echo $image_dir ?>/editor/link.png" border"0" /></a></td>
        <td><?php echo Html::selectBox('objectid',$objects) ?><noscript>&nbsp;&nbsp;&nbsp;<input type="submit" class="submit" name="addmarkup" value="<?php echo lang('GLOBAL_ADD') ?>"/></noscript></td>
      </tr>
    </table>
  </td>
</tr>

<?php } ?>

<script name="Javascript" type="text/javascript" src="<?php echo $tpl_dir ?>../js/editor.js"></script>
<script name="JavaScript" type="text/javascript">
<!--

function strong()
{
	insert('text','*','*');
}


function emphatic()
{
	insert('text','_','_');
}


function link()
{
	insert('text','"','"->"'+document.forms[0].objectid.value+'"');
}


function image()
{
	insert('text','','{"'+document.forms[0].objectid.value+'"}');
}


function list()
{
	insert('text',"\n\n- ","\n- \n- \n");
}


function numlist()
{
	insert('text',"\n\n# ","\n# \n# \n");
}


function table()
{
	insert('text',"\n|","| |\n| | |\n");
}


//-->
-->
</script>
END

		window name:element
			row
				cell colspan:2 class:help
					text var:desc



			if value:var:type equals:date
				table width:85%
					row
						cell colspan:7 class:help
							link url:var:lastmonthurl
								image file:left align:middle
							text raw:_
							text text:var:monthname
							text raw:_
							link url:var:nextmonthurl
								image file:right align:middle
							text raw:_____
							link url:var:lastyearurl
								image file:left align:middle
							text raw:_
							text text:var:yearname
							text raw:_
							link url:var:nextyearurl
								image file:right align:middle
					row
						cell
							text text:message:global_nr
						list list:weekdays value:weekday
							cell
								text text:var:weekday
RAW
<?php #Html::debug($weeklist) ?>
END
					list list:weeklist key:weeknr value:week
						row
							cell width:12%
								text text:var:weeknr
							list list:week extract:true
								cell width:12%
									if empty:url
										text raw:__
										text text:var:nr
										text raw:__
									if not:true empty:url
										link url:var:url
											text raw:__
											text text:var:nr
											text raw:__
									if true:var:today
										text raw:*


					row
						cell class:fx colspan:2
							text text:message:date
						cell class:fx colspan:5
							selectbox name:year list:all_years
							text raw:_-_
							selectbox name:month list:all_months
							text raw:_-_
							selectbox name:day list:all_days
							
					row
						cell class:fx colspan:2
							text text:message:date_time
						cell class:fx colspan:5
							selectbox name:hour list:all_hours
							text raw:_-_
							selectbox name:minute list:all_minutes
							text raw:_-_
							selectbox name:second list:all_seconds





					
			if value:var:type equals:text
				row
					cell colspan:2 class:fx
						input size:50 maxlength:255 class:text name:text
						focus field:text

			if value:var:type equals:longtext

				if true:var:html
RAW
<?php
include('./editor/fckeditor.php');

$editor = new FCKeditor('text') ;
$editor->BasePath	= './editor/';
$editor->Value = $text;
$editor->Height = '290';
$editor->Config['CustomConfigurationsPath'] = '../openrat-fckconfig.js';
$editor->Create();
?>
END
				
				if true:var:wiki
					if present:preview_text
						row
							cell colspan:2 class:fx
								text var:preview_text
						
RAW
<?php editBar() ?>
END

					row
						cell colspan:2 class:fx
							inputarea class:longtext name:text rows:25 cols:70
							focus field:text

			if value:var:type equals:link
				row
					cell colspan:2 class:fx
						selectbox list:objects name:linkobjectid
						focus field:linkobjectid

			if value:var:type equals:list
				row
					cell colspan:2 class:fx
						selectbox list:objects name:linkobjectid
						focus field:linkobjectid

			if value:var:type equals:number
				row
					cell colspan:2 class:fx
						hidden name:decimals default:decimals
						input size:15 maxlength:20 name:number
						focus field:number

			if value:var:type equals:select
				row
					cell colspan:2 class:fx
						selectbox list:items name:text
						focus field:text



			if present:release
				row
					cell colspan:2 class:fx
						checkbox name:release
						text raw:_
						text text:GLOBAL_RELEASE

			if present:publish
				row
					cell colspan:2 class:fx
						checkbox name:publish
						text raw:_
						text text:PAGE_PUBLISH_AFTER_SAVE

			row
				cell colspan:2 class:act
					button type:ok

	focus field:text