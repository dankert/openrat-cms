page

	form

		window title:GLOBAL_ADD
	
			row
				cell class:fx
					text text:GLOBAL_ALL
				cell class:fx
					set var:type value:all
					radio name:type value:type default:true
				cell class:fx
					text raw:_
			row
				cell class:fx
					text text:GLOBAL_USER
				cell class:fx
					set var:type value:user
					radio name:type value:type
				cell class:fx
					selectbox name:userid list:users
			if present:groups
				row
					cell class:fx
						text text:GLOBAL_GROUP
					cell class:fx
						set var:type value:group
						radio name:type value:type
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
			row
				cell colspan:3 class:act
					button type:ok

