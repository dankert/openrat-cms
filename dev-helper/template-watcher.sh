#!/bin/bash

# Calling the template compiler if a template or a component was modified.
#
# Need for:
# - inotify-tools
#

CMS_URL=$1

while true; do
  # Calling compiler first
  echo "compiling started at $(date)"
  curl $1/modules/template_engine/TemplateCompiler.php
  echo "compiling ended at $(date)"

  inotifywait --event modify -r ../modules/template_engine/ ../modules/cms/ui/themes/default/html/views/
  echo File was changed.

done


