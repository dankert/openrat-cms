#!/bin/bash
#
#
for fn in *.ini.php; do
	tr -d '\015' < $fn > $fn.new
	rm $fn
	mv $fn.new $fn
done;