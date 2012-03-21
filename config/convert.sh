#!/bin/bash
#
# converting openrat-1.0-configurations to the 1.1 single-file-format.
#
# This is a dirty quick-coding-tool.
#
# Usage:
# - Start dos2unix.sh to kill the windows line endings.
# - Start this script in the config-directory. The new file will be written to stdout.
# - save standardout to a file named config.new
# - rename config.ini.php to config.ini.orig.php
# - rename config.new to config.ini.php or config-<domain>.ini.php
# - Edit the file: replace '.ini.php.' with '.#
# - Edit the file: replace '].'        with '.' (sorry about that)
#
# Alternative: Do not use this script and start a new configuration
#              with config.ini.php ;) 
#
echo "; `date`"
echo ";"

for fn in *.ini.php; do

	fn="${fn:-8}"
	echo ";"
	echo "; converted from $fn"
	echo ";;PHP \$conf['${fn}'] = array();"
	
	ru=
	sec="${fn}."
	
	while read line; do
		if [ "${line:0:1}" == "[" ]; then
			sec="${fn}.${line:1}."
			ru="$line"
			echo "; next section: $line"
		elif [ "${line:0:2}" == ";[" ]; then
			sec="${fn}.${line:2}."
			ru="${line:1}"
			echo "; next unused section: $line"
		elif [ "$line" == "" ]; then
			echo ""
		elif [ "${line:0:2}" == "; " ]; then
			echo "$line"
		elif [ "${line:0:1}" == ";" ]; then
			echo ";${sec}${line:1}"
		else
			echo "${sec}${line}"
		fi
	done < $fn
done