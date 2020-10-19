#!/bin/bash

cd "$(dirname "$0")"

# Calling the template compiler if a template or a component was modified.
#
# Need for:
# - inotify-tools
# - curl
# - getopt
#
# On Ubuntu/Debian install them with 'apt-get install inotify-tools curl'.
#


usage() {
  echo "Usage: $0 [-t <theme>] [-w] [-x <type>] [-u <host/path>]" 1>&2;
  exit 1;
}

url="http://localhost/"
watch=
type=
theme="default"

while getopts "wt:x:hu:" o; do
    case "${o}" in
        t)
            theme=${OPTARG}
            ;;
        w)
            watch=true
            ;;
        h)
            usage; exit 1;
            ;;
        u)
            url=${OPTARG}
            ;;
        x)
            type=${OPTARG}
            ;;
        *)
            usage
            ;;
    esac
done
shift $((OPTIND-1))

if [ -z "${type}" ]; then
  echo "Select a type"
  select type in "tpl" "xsd" "css" "js" "lang" "all"; do
    break;
  done
fi

if [ "${type}" == "all" ]; then
  types=(tpl xsd css js lang)
else
  types=($type)
fi

function update {
  url=$1
  type=$2
  echo "update started at $(date)"
  curl --fail -X POST -d "type=$type" $url/dev-helper/update.php
  retVal=$?
  if [ $retVal -ne 0 ]; then
    echo "An error occured! Returncode was $retVal"
    exit 4;
  else
    echo "Sucessful update."
  fi
  echo "update ended   at $(date)"
}

function make_writable {
  type=$1
  theme=$2
  case $type in
        lang ) chmod -v a+w ../modules/language/lang-*.php ../modules/language/Messages*;;
        xsd  ) chmod -v a+w ../modules/template_engine/components/template.xsd ../modules/template_engine/components/components.ini;;
        css  ) chmod -v a+w ../modules/cms/ui/themes/$theme/style/openrat*.css;;
        js   ) chmod -v a+w ../modules/cms/ui/themes/$theme/script/openrat*.js;;
        tpl  ) find ../modules/cms/ui/themes/$theme/html/views/ -type f -name "*.php" -exec chmod -v a+w {} \; ;;
        * ) echo "unknown type";exit;;
  esac
}


function get_file_to_watch {
  type=$1
  theme=$2
  case $type in
        lang )
          watchfiles+=' ../modules/language/';;
        xsd  )
          watchfiles+=' ../modules/template_engine/components/html';;
        css  )
          watchfiles+=" ../modules/cms/ui/themes/$theme/style";;
        js   )
          watchfiles+=" ../modules/cms/ui/themes/$theme/script";;
        tpl  )
          watchfiles+=" ../modules/template_engine/components/html ../modules/cms/ui/themes/$theme/html/views";;

        * ) echo "unknown type";exit;;
  esac
}


for type in ${types[*]}; do
  make_writable $type $theme
done

while true; do

  # Calling update first
  for type in ${types[*]}; do
    update $url $type
  done


  if [ -z "${watch}" ]; then
    echo "not watching, exiting."
    exit 0; # Exit, because watching is not enabled
  fi;

  watchfiles=
  for type in ${types[*]}; do
    get_file_to_watch $type $theme
  done

  echo "Watching for files in $watchfiles"
  inotifywait --event modify -r $watchfiles &

  echo "Watching ..."
  wait
  echo "File change detected, updating ..."
done


