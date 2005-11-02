#!/bin/sh
# Sorting the language file in alphabetic order

if [ ! -f $1 ]; then
	echo ""
	echo "usage: $0 <filename> <filename>"
	echo ""
	echo "This script prints out the language element of file 1 which are not in file 2."
	echo ""
	exit
fi

if [ ! -r $1 ]; then
	echo "$1 is not readable"
	exit
fi

if [ ! -r $2 ]; then
	echo "$2 is not readable"
	exit
fi

cat $1|egrep "^;" -v|while read line
do
  #echo "Zeile:"
  anfline=`echo $line|sed s/=.*/=/`
  #echo "$anfline"   # Output the line itself.
  #echo Hat `cat $2|grep "$anfline"`
  if [ "`cat $2|grep \"$anfline\"`" == "" ]; then
    echo $line
    #echo ";not in $2: $anfline"
  fi

done


