#!/bin/bash

# Calling the template compiler if a template or a component was modified.
#
# Need for:
# - inotify-tools
# - curl
#
# On Ubuntu/Debian install them with 'apt-get install inotify-tools curl'.
#

CMS_URL=$1

function update {
  echo "update started at $(date)"
  curl -X POST -d "type=all" $1/dev-helper/update.php
  retVal=$?
  if [ $retVal -ne 0 ]; then
    echo "An error occured! Returncode was $retVal"
  else
    echo "Sucessful update."
  fi
exit $retVal
  echo "update ended   at $(date)"
}

while true; do
  # Calling compiler first
  update

  echo "waiting for changes ..."
  inotifywait --event modify -r ../modules/template_engine/ ../modules/cms/ui/themes/default/html/views/
  echo "a file was changed. updating ..."
done


