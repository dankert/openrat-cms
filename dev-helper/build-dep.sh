#!/bin/bash

echo "Searching for dependencies ..."

for depfile in $(find . -name "dependency.txt"); do
  echo
  echo "--- Building dependency for ${depfile} ---"
  url=""
  files="*.php"
  target="./"
  source ${depfile}
  tmpfile=$(mktemp)
  echo ">>> Downloading $url"
  curl -s $url -o $tmpfile
  dir=$(dirname ${depfile})
  echo ">>> Extracting $files in $dir"
  dircount=$(tr -dc '/' <<<"$files" | awk '{ print length; }')
  tar vxfz ${tmpfile} -C ${dir} --wildcards $files --strip-components=$dircount
  echo -e "Downloaded from \`$url\`\n\n**DO NOT CHANGE ANY FILES HERE**" > $dir/README.md
  rm -v $tmpfile
done