#!/bin/bash
#
# This script minimizes the OpenRat Installation. It
# - minimizes CSS files while removing all whitespace
# - minimizes PHP files
# - deletes directories which are only for development
#
# The whole installation is copied to a new subdirectory
# named 'compact'.
#
# Usage:
# Call 'compact.sh' in the openrat installation directory

minimize_php() {
	#cat $1 | sed -e 's/\/\/.*$//g' | tr -d \\t | tr -d \\r | tr -d \\n | sed -e 's/\/\*.*\*\///g' > $1
	cat $1 | sed -e 's/\/\/.*$//g' | tr -d \\t | tr -d \\r > $1
}


minimize_css() {
	cat $1 | tr -d \\n | tr -d [:blank:] > $1 
}

if [ ! -d themes/default/pages ]; then
  echo "not an openrat directory. please execute this script in openrat program directory"
  exit 4
fi

if [ -d compact ]; then
  echo "please delete compact-dir"
  exit 4
fi

mkdir compact

cp -r * compact
cd compact

rm -r themes/default/templates
rm -r themes/default/include

for i in `find -name "*.php"`; do
	minimize_php $i
done 

for i in `find -name *.css`; do
	minimize_css $i
done 

cd ..

exit 0


