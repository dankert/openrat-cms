<?php
	$value = '';
	if(!empty($config))
	{
		global $conf;
		$c = $conf;
		$path = explode('/',$config);
		$url = '<?php echo $'."conf['".implode("']['",$path)."'] ?>"; 

		$value = "<a href=\"$url\" class=\"$class\" target=\"$target\" title=\"$title\">"; 
	}  
	elseif(!empty($url))
		$value = "<a href=\"$url\" class=\"$class\" target=\"$target\" title=\"$title\">";
	elseif(!empty($var))
		$value = "<a href=\"<?php echo $$var ?>\" class=\"$class\" target=\"$target\" title=\"$title\">";
	else
		$value = '';
?>