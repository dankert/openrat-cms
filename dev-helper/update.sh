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
  select type in "tpl" "xsd" "css" "js" "lang"; do
    break;
  done
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

# Kill child processes on CTRL+C
trap 'echo "Terminating child processes"; pkill -P $$; exit' SIGINT SIGTERM

while true; do
  # Calling compiler first
  make_writable $type $theme
  update $url $type

  if [ -z "${watch}" ]; then
    echo "not watching, exiting."
    exit 0; # Exit, because watching is not enabled
  fi;

  echo "Enabling the watcher ..."
  case $type in
        lang ) watchfiles="../modules/language/language.yml";;
        xsd  ) watchfiles="../modules/template_engine/components/html";;
        css  ) watchfiles="../modules/cms/ui/themes/$theme/style/";;
        js   ) watchfiles="../modules/cms/ui/themes/$theme/script/";;
        tpl  ) watchfiles="../modules/cms/ui/themes/$theme/html/views/";;
        * ) echo "unknown type";exit;;
  esac
  inotifywait --event modify -r $watchfiles &
  echo "Waiting for watcher ..."
  wait
  echo "a file was changed. updating ..."
done


