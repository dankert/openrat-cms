#!/bin/sh
#
# This is for developers only.
# Do not run this script, until you know what you are doing :)
#
# This script
# - orders the language files
# - analyses the missing keys (first german->english, then english->es,fr,it,ru)
#
pgmdir=../doc/examples/maintenance

echo "Step 1: Backup"
for i in de en es fr it ru; do
	echo "Language: $i"
	cp -v $i.ini.php $i.ini.php.orig
done

echo "Step 2: Ordering"
for i in de en es fr it ru; do
	echo "Language: $i"
	$pgmdir/sort-lang.sh $i.ini.php.orig > $i.ini.php
done

echo "Step 3: Copying missing keys"
echo "de > en"
$pgmdir/compare-lang.sh de.ini.php en.ini.php > en.ini.php.missing

for i in es fr it ru; do
	echo "en > $i"
	$pgmdir/compare-lang.sh en.ini.php $i.ini.php > $i.ini.php.missing
done