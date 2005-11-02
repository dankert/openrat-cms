#!/bin/sh
# Sorting the language file in alphabetic order

if [ ! -f $1 ]; then
	echo ""
	echo "usage: $0 <filename>"
	echo ""
	echo "This script is sorting a Openrat language file in alphabetic order."
	echo "Just give it the filename of the language file and it puts the sorted file on stdout."
	echo ""
	exit
fi

if [ ! -r $1 ]; then
	echo "$1 is not readable"
	exit
fi

cat $1|grep "^;"
cat $1|grep "^;" -v|sort


