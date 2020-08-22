#!/bin/bash
#
#
VERSION=$1

if   [ -z "$VERSION" ]; then
  echo "Usage: $0 <version>" 1>&2;
  exit 1;
fi

DATE=`date -R`
OUTFILE=../modules/cms-core/version.php

echo "<?php DEFINE('OR_VERSION','$VERSION'); DEFINE('OR_DATE','$DATE');" > $OUTFILE

git commit -m "New version tag $VERSION" $OUTFILE
git tag $VERSION

echo "<?php DEFINE('OR_VERSION','dev-snapshot'); DEFINE('OR_DATE',date('r') );" > $OUTFILE

git commit -m "Setting development status" $OUTFILE
