#/bin/sh
#
# Example:
#
# You have following 2 files in your document root:
# - page.de.html
# - page.en.html
#
# Now, if a browser comes with an Accept-Language-Header other than "de" or "en" an
# often unwanted page is shown where the user must select his language.
#
# Go to your document-root and execute this script:
# "$ ./default-lang.sh en.html html.html"
#
# Now you have 2 pages and 1 symlink in your document root:
# - page.de.html
# - page.en.html
# - page.html.html -> page.en.html
#
# Now, if a browser comes with an Accept-Language-Header other than "de" or "en" the
# english version will be taken by the webserver
#
# Notes:
# - Option "FollowSymLinks" (or "FollowSymLinksIfOwnerMatch") must be set
#
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.
#
# Author: Jan Dankert, http://www.jandankert.de
# $Id: $


if [ "$1" == "" -o "$2" == "" ]; then
        echo "Usage: $0 <orig-ext> <link-ext>"
        exit
fi

orig=$1
link=$2

for oldlink in `find -type l -name "*$link"`
do
        if [ ! -r "$oldlink" ]; then
                rm -v $oldlink
        fi
done


for file in `find -type f -name *$orig`
do
        #echo found $file
        sf=`echo $file|sed -e "s/\$orig$//g"`
        file=`basename $file`
        sf=$sf$link
        ln -v -s $file $sf
done