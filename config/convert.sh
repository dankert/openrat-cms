#!/bin/bash
echo "; `date`"
echo ";"
echo ";;PHP \$conf = array();"

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
			echo ";;PHP \$conf['${fn}']['${ru}'] = array();"
			echo "; next section: $line"
		elif [ "${line:0:2}" == ";[" ]; then
			sec="${fn}.${line:2}."
			ru="${line:1}"
			echo ";;PHP \$conf['${fn}']['${ru}'] = array();"
			echo "; next unused section: $line"
		elif [ "$line" == "" ]; then
			echo ""
		elif [ "${line:0:2}" == "; " ]; then
			echo "$line"
		elif [ "${line:0:1}" == ";" ]; then
			echo ";${sec}${line:1}"
			echo ";;PHP \$conf['${fn}']['${ru}']=${line:1};"
		else
			echo ";;PHP \$conf['${fn}']['${ru}']=$line;"
			echo "${sec}${line}"
		fi
	done < $fn
done