#!/bin/bash

cd "$(dirname "$0")"

# Calling the update script for all types.
#
# Need for:
# - inotify-tools
# - curl
# - getopt
#
# On Ubuntu/Debian install them with 'apt-get install inotify-tools curl'.
#


usage() {
  echo "Usage: $0 [-u <host/path>]" 1>&2;
  exit 1;
}

url="http://localhost/"
type=

while getopts "hu:" o; do
    case "${o}" in
        h)
            usage; exit 1;
            ;;
        u)
            url=${OPTARG}
            ;;
        *)
            usage
            ;;
    esac
done
shift $((OPTIND-1))

# Kill child processes on CTRL+C
trap 'echo "Terminating child processes... ";pkill -P $$' SIGINT SIGTERM

for type in "tpl" "xsd" "css" "js" "lang"; do
    ./update.sh -u $url -x $type -w 2>&1 &
    echo "Started watcher for $type in background with PID $!"
done

echo "."
echo "All Watches are started."

echo "Waiting for child processes - Press CTRL + C to exit."

wait # wait for child processes (forever, so the script must be canceled with SIGINT (ctrl+c) or SIGTERM)

echo "All child processes are terminated. Exiting ..."
