#!/bin/sh
# Sorting the language file in alphabetic order

if [ ! -f $1 ]; then
	echo ""
	echo "usage: $0 <filename>"
	echo ""
	echo "This script is sorting a Openrat language file in alphabetic order."
	echo "Just give it the filename of the language file."
	echo ""
	exit
fi

if [ ! -w $1 ]; then
	echo "$1 is not writable"
	exit
fi

cp $1 $1.orig

cat $1.orig|grep "^;" > $1
cat $1.orig|grep "^;" -v|sort >> $1


