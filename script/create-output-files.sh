#!/bin/bash
#
# -- Only for OpenRat-Developers! --
# 
# Creating a minified/compiled version of CSS/LESS, JS and XML-Template files.
# Sets file permission bits to World-Readable that the CMS is able to write to these files!
#
# Do NOT use this in production environments! 
#
#
echo "Start ("as `whoami` ")"
for jsfile in `find themes -name "*.js" -not -name "*.min.js"`; do
	jsfile="${jsfile%.*}"
	echo "JS found: $jsfile"
	if	[ ! -f $jsfile.min.js ]; then cp -v $jsfile.js $jsfile.min.js; 
		fi 
	chmod a+rw -v $jsfile.min.js;
done

for jsfile in `find modules/editor/codemirror -name "*.js" -not -name "*.min.js"`; do
	jsfile="${jsfile%.*}"
	echo "JS found: $jsfile"
	if	[ ! -f $jsfile.min.js ]; then cp -v $jsfile.js $jsfile.min.js;
		fi
	chmod a+rw -v $jsfile.min.js;
done


for tplfile in `find themes -name "*.src.xml"`; do
	 
	tplfile="${tplfile%.*}"
	tplfile="${tplfile%.*}"
	echo "Template found: $tplfile"
	if	[ ! -f $tplfile.out.php ]; then touch -d '2000-01-01' $tplfile.out.php; 
		fi
	 chmod a+rw -v $tplfile.out.php 
done

# CSS-Files
for lessfile in `find themes -name "*.less"`; do
	lessfile="${lessfile%.*}"
	echo "LESS found: $lessfile"
	if	[ ! -f $lessfile.css ]; then touch -d '2000-01-01' $lessfile.css;
		fi
	chmod a+rw -v $lessfile.css 
	if	[ ! -f $lessfile.min.css ]; then touch -d '2000-01-01' $lessfile.min.css;
		fi
	chmod a+rw -v $lessfile.min.css 
done

touch     themes/default/production/combined.min.css
chmod a+w themes/default/production/combined.min.css

touch     themes/default/production/combined.min.js
chmod a+w themes/default/production/combined.min.js
