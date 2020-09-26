<?php
function component_user( $user )
{
	extract( $user );
	
	if	( empty($name) )
		$name = \cms\base\Language::lang('UNKNOWN');
	if	( empty($fullname) )
		$fullname = \cms\base\Language::lang('NO_DESCRIPTION_AVAILABLE');

	if	( !empty($mail) && config('security','user','show_mail' ) )
		echo "<a href=\"mailto:$mail\" title=\"$fullname\">$name</a>";
	else
		echo "<span title=\"$fullname\">$name</span>";
}
?>