#!/bin/bash

# Calling the template compiler if a template or a component was modified.
#
# Need for:
# - inotify-tools
#

CMS_URL=$1

while true; do

  inotifywait --event modify -r ../modules/template-engine/ ../modules/cms-ui/themes/default/html/views/
  echo File was changed.

  curl $1/modules/template-engine/TemplateCompiler.php
done


