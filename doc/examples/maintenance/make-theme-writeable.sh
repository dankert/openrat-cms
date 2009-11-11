#!/bin/bash
if [ ! -d themes/default/pages ]; then
  echo "not an openrat directory. please execute this script in openrat program directory"
  exit 4
fi
find themes/default/pages |xargs chmod -v a+w