page class:treemenu
	form action:index subaction:project target:_parent method:get
		selectbox name:projectid list:projects onchange:submit() title:PROJECT_SELECT_DESC class:treemenu default:act_projectid
		text raw:_
RAW
<noscript>
END
		button type:ok
RAW
</noscript>
END
		