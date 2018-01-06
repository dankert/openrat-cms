#!/bin/bash
#
# -- Only for OpenRat-Developers! --
# 
# Sets file permission bits to World-Readable that the CMS is able to write to these files!
#
# Do NOT use this in production environments! 
#
#
echo "Starting ("as `whoami` ")"

# Language files
for file in `find modules/language -name "lang-*.php" -type f`; do
	chmod a+rw -v $file
done

# Theme files
for file in `find modules/cms-ui/themes/default/html -type f`; do
	chmod a+rw -v $file
done

echo "End"