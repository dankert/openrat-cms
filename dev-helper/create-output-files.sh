#!/bin/bash
#
# -- Only for OpenRat-Developers! --
# 
# Creates files for minified/compiled version of CSS/LESS, JS and XML-Template files.
# Sets file permission bits to World-Readable that the CMS is able to write to these files!
#
# Do NOT use this in production environments! 
#
#
echo "Preparing for developer mode"
echo "----------------------------"
echo
echo "Start ("as `whoami` ")"


function language
{
    for iso in de en es fr it ru cn; do

        touch ../modules/language/lang-$iso.php
        chmod -v a+w ../modules/language/lang-$iso.php
    done
}



function check
{
    for jsfile in `find modules/cms-ui/themes -name "*.js" -not -name "*.min.js"`; do
        jsfile="${jsfile%.*}"
        createfile $jsfile.min.js $jsfile.js
    done
    for jsfile in `find modules/template-engine/components -name "*.js" -not -name "*.min.js"`; do
        jsfile="${jsfile%.*}"
        createfile $jsfile.min.js $jsfile.js
    done

    for jsfile in `find modules/editor/codemirror -name "*.js" -not -name "*.min.js"`; do
        jsfile="${jsfile%.*}"
        createfile $jsfile.min.js $jsfile.js
    done


    for tplfile in `find modules/cms-ui/themes/ -name "*.tpl.src.xml"`; do

        tplfile="${tplfile%.*}"
        tplfile="${tplfile%.*}"
        tplfile="${tplfile%.*}"
        createfile $tplfile.php;
    done

    # CSS-Files
    for lessfile in `find modules/cms-ui/themes -name "*.less"`; do
        lessfile="${lessfile%.*}"
        createfile $lessfile.css
        createfile $lessfile.min.css;
    done

    # CSS-Files
    for lessfile in `find modules/template-engine/components -name "*.less"`; do
        lessfile="${lessfile%.*}"
        createfile $lessfile.css
        createfile $lessfile.min.css;
    done

    createfile modules/cms-ui/themes/default/production/combined.min.css
    createfile modules/cms-ui/themes/default/production/combined.min.js

}


function createfile
{
    file=$1
    copy=$2
	if	[ ! -f $file ]; then
	    if [ ! -z $copy ]; then
	        cp -v $copy $file
	    else
	        touch -d '2000-01-01' $file;
	    fi
	    echo "OK: Created $file"
	fi


	if [ -e /etc/apache2/mods-enabled/php7.2.load ] && [ `stat -c %a $file` -ne "666" ]; then
	    chmod 666 -v $file
	fi
}

language
check
