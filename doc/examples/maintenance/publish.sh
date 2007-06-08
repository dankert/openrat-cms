#!/bin/bash
#
# en:
# Example for publishing a page via batch.
#
# de:
# Beispiel für eine batchgesteuerte Veröffentlichung.

URL=http://example.com/~user/openrat
COOKIEFILE=tmpcookie.txt
LOGFILE=publish.log

echo "" > $COOKIEFILE
echo "---" > $LOGFILE
echo "Do Login..."

wget --save-cookies $COOKIEFILE \
	--keep-session-cookies \
	-O testlogin.html \
	--post-data='action=index&subaction=login&dbid=pgsql&login_name=publisher&login_password=xxxxxxxx' \
	-a $LOGFILE \
	$URL/do.php

echo "Cookie:"
cat $COOKIEFILE

echo "Selecting project..."
wget --load-cookies $COOKIEFILE \
	-O testproject.html \
	-a $LOGFILE \
	--post-data='action=index&subaction=project&id=2' \
	$URL/do.php

echo "Do publish page now... please wait"
wget --load-cookies $COOKIEFILE \
	-O testpagepubnow.html \
	-a $LOGFILE \
	--post-data='action=page&subaction=pubnow&id=6' \
	$URL/do.php

echo "Logout..."
wget --load-cookies $COOKIEFILE \
	-O testlogout.html \
	-a $LOGFILE \
	--post-data='action=index&subaction=logout' \
	$URL/do.php

echo "finished"
rm $COOKIEFILE

exit
