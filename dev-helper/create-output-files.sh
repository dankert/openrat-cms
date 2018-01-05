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
for jsfile in `find modules/cms-ui/themes -name "*.js" -not -name "*.min.js"`; do
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


# Template files
for tpldir in `find modules/cms-ui/themes/default/templates -type d`; do
    for tplfile in `find ${tpldir} -name "*.src.xml"`; do

        tplfile="${tplfile%.*}"
        tplfile="${tplfile%.*}"
        tplfile=`basename ${tplfile}`

        outfile=modules/cms-ui/themes/default/html/${tpldir}/${tplfile}.php
        if	[ ! -f $outfile ]; then touch -d '2000-01-01' $outfile;
            fi
         chmod a+rw -v $outfile
	 done
done


# Language files

for lang in `egrep ^[[:space:]]*[[:alpha:]]{2}: modules/language/language.yml|cut -d ':' -f 1|awk '{$1=$1};1'|sort|uniq`; do
    outfile=modules/language/lang-$lang.php
	if	[ ! -f $outfile ]; then touch -d '2000-01-01' $outfile;
		fi
	chmod a+rw -v $outfile
done

# CSS-Files
for lessfile in `find modules/cms-ui/themes -name "*.less"`; do
	lessfile="${lessfile%.*}" # cut extension
	lessfile=`basename ${lessfile}`
	outfile=modules/cms-ui/themes/default/html/${lessfile}

	if	[ ! -f $outfile ]; then touch -d '2000-01-01' $outfile;
		fi
	chmod a+rw -v $outfile
done



for lessfile in `find modules/cms-ui/themes -name "*.less"`; do
	lessfile="${lessfile%.*}" # cut extension
	lessfile=`basename ${lessfile}`
	outfile=modules/cms-ui/themes/default/html/${lessfile}

	if	[ ! -f $outfile ]; then touch -d '2000-01-01' $outfile;
		fi
	chmod a+rw -v $outfile
done

# Production files
touch     modules/cms-ui/themes/default/html/openrat-all.min.css
chmod a+w modules/cms-ui/themes/default/html/openrat-all.min.css

touch     modules/cms-ui/themes/default/html/openrat-all.min.js
chmod a+w modules/cms-ui/themes/default/html/openrat-all.min.js
