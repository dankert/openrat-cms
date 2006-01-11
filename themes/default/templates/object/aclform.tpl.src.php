insert file:header

form action:action subaction:addacl id:objectid

	window title:GLOBAL_ADD

		row
			cell class:fx
				text text:GLOBAL_ALL
			cell class:fx
				radio name:type value:all default:true
			cell class:fx
				text raw:_
		row
			cell class:fx
				text text:GLOBAL_USER
			cell class:fx
				radio name:type value:user
			cell class:fx
				selectbox name:userid list:users
		if invert:true empty:groups
			row
				cell class:fx
					text text:GLOBAL_GROUP
				cell class:fx
					input type:radio name:type value:group
				cell class:fx
					selectbox name:groupid list:groups
		row
			cell colspan:3 class:help
				text raw:_
		row
			cell class:fx
				text text:GLOBAL_LANGUAGE
			cell class:fx
				text raw:_
			cell class:fx
				selectbox name:languageid list:languages
		row
			cell colspan:3 class:help
				text raw:_

		list list:show value:t
			row
RAW
<td class="<?php echo $fx ?>"><?php echo lang('ACL_'.strtoupper($t)) ?></td>
<td class="<?php echo $fx ?>" width="20"><?php echo lang('ACL_'.strtoupper($t).'_ABBREV') ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox($t,($t=='read'),($t!='read'),array('title'=>lang('ACL_'.strtoupper($t) )) ) ?></td>
END
		dummy
		row
			cell
				link url:javascript:mark();
					text text:FOLDER_MARK_ALL
				text raw:_|_
				link url:javascript:unmark();
					text text:FOLDER_UNMARK_ALL
				text raw:_|_
				link url:javascript:flip();
					text text:FOLDER_FLIP_MARK
		row
			cell colspan:3
				button type:ok

dummy
RAW			

<script name="JavaScript">
<!--
function mark()
{
<?php foreach( $show as $t ) { if($t=='read') continue; ?>
document.forms[0].elements['<?php echo $t ?>'].checked=true;
function unmark()
<?php } ?>
}
{
<?php foreach( $show as $t ) { if($t=='read') continue; ?>
document.forms[0].elements['<?php echo $t ?>'].checked=false;
<?php } ?>
}
function flip()
{
<?php foreach( $show as $t ) { if($t=='read') continue; ?>
if	(document.forms[0].elements['<?php echo $t ?>'].checked==false)
 document.forms[0].elements['<?php echo $t ?>'].checked=true;
else document.forms[0].elements['<?php echo $t ?>'].checked=false;
<?php } ?>
}
//-->
</script>
END

insert file:footer