#!/bin/bash


function read_section {
    local id=$1
    while IFS= read -r p ; do
        if [[ "$p" == *"function $id"* ]] ; then
            # Read data here
            while IFS= read -r p ; do
                # Check for end of section - empty line
                if [ "$p" = "    }" -o "$p" = $'\t}' ] ; then
                    break
                fi
                # Do something with '$p'
                echo "$p"
            done
            # Indicate section was found
            return
        fi
    done
    # Indicate section not found
    return
}


for act in `ls -1 *Action.class.php|grep -o '^[A-Z][a-z]*'`; do
  mkdir -v ${act,,}

  for mth in `grep "function " ${act}Action.class.php|grep -E -o '[A-Z]*[a-z]*(View|Post)'|grep -o '^[a-z]*'|uniq`; do

    out=${act,,}/$act${mth^}Action.class.php
    touch $out

    echo "act: $act method: $mth"

    echo "<?php" > $out
    echo "namespace cms\\action\\${act,,};" >> $out
    echo "use cms\\action\\${act}Action;" >> $out
    echo "use cms\\action\\Method;" >> $out
    echo "class ${act}${mth^}Action extends ${act}Action implements Method {" >> $out
    echo "    public function view() {" >> $out
    read_section "${mth}View" >> $out < ${act}Action.class.php

    echo "    }" >> $out
    echo "    public function post() {" >> $out
    read_section "${mth}Post" >> $out < ${act}Action.class.php
    echo "    }" >> $out
    echo "}" >> $out
  done
done