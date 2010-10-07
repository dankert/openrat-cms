page class:tree

	table space:0 padding:0 class:tree
		list list:zeilen extract:true
			row class:var:class
				list list:cols value:i
					cell class:treecol
						image tree:var:i
				if present:image
					cell class:treeimage
						if present:image_url
							link url:var:image_url class:tree target:_self title:var:image_url_desc anchor:var:name
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
					if not: present:image
						text raw:__
						link action:tree subaction:refresh
							text key:refresh
							//image icon:refresh align:left
						text raw:__
						link action:tree subaction:openall
							text key:all
							//image icon:openall align:left
				set var:url
				set var:image
