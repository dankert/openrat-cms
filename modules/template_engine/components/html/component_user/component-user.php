<?php
function component_user( $user )
{
	extract( $user );
	
	if	( empty($name) )
		$name = \cms\base\Language::lang('UNKNOWN');
	if	( empty($fullname) )
		$fullname = \cms\base\Language::lang('NO_DESCRIPTION_AVAILABLE');

	if	( isset($mail) && $mail && \cms\base\Configuration::subset(['security','user'])->is('show_mail',false ) )
		echo "<a href=\"mailto:$mail\" title=\"$fullname\">$name</a>";
	else
		echo "<span title=\"$fullname\">$name</span>";
}
?>