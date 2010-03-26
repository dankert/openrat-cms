#!/bin/bash

if [ ! -d .hg ]; then
    echo no .hg directory found. Is this a mercurial controlled directory?
    exit 4
fi

for sf in `find -type f -not -path "./.hg*"`; do
    d=`hg log $sf -l1 --template '{date|isodate}'`
    echo setze Datum $d für Datei $sf
    touch $sf -d "$d"
done
