part class:breadcrumb
	if present:projectname
		link action:start subaction:projectmenu target:content
			image icon:project align:left
			text title:message:project var:projectname maxlength:20

link action:tree subaction:openall class:action
	image icon:open
	text key:open_all
link action:start subaction:projectmenu class:action target:content
	image icon:project
	text key:change_to

table space:0 padding:0 class:tree
	list list:zeilen extract:true
		row class:var:class
			list list:cols value:i
				cell class:treecol
					image tree:var:i
			if present:image
				cell class:treeimage
					if present:image_url
						link url:var:image_url class:tree target:_self title:var:image_url_desc
							image tree:var:image
					else
						image tree:var:image
			cell colspan:var:colspan class:treevalue
				link name:var:name
				if present:url
					link url:var:url title:var:desc class:tree target:var:target
						image icon:var:icon
						text var:text maxlength:20 cut:right 
				else
					image icon:var:icon
					text var:text maxlength:20 cut:right title:var:desc
			set var:url
			set var:image
