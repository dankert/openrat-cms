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
for jsfile in `find -name "*.js" -not -name "*.min.js"`; do
	jsfile="${jsfile%.*}"
	echo "JS found: $jsfile"
	if	[ ! -f $jsfile.min.js ]; then cp -v $jsfile.js $jsfile.min.js; 
		fi 
	chmod a+rw -v $jsfile.min.js;
done


for tplfile in `find -name "*.src.xml"`; do
	 
	tplfile="${tplfile%.*}"
	tplfile="${tplfile%.*}"
	echo "Template found: $tplfile"
	if	[ ! -f $tplfile.out.php ]; then touch -d '2000-01-01' $tplfile.out.php; 
		fi
	 chmod a+rw -v $tplfile.out.php 
done

for lessfile in `find -name "*.less"`; do
	lessfile="${lessfile%.*}"
	echo "LESS found: $lessfile"
	if	[ ! -f $lessfile.min.css ]; then cp -v $lessfile.less $lessfile.min.css;
		fi
	chmod a+rw -v $lessfile.min.css 
done