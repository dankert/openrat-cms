; <?php die('no access'); ?>

; date formats
; see http://www.php.net/manual/en/function.date.php for details
[format]

SHORT = ""
ISO8601SHORT = "Ymd"
ISO8601 = "Y-m-d"
ISO8601BAS = "Ymd\THis"
ISO8601EXT = "Y-m-d\TH:i:s"
ISO8601FULL = "Y-m-d\TH:i:sO"
ISO8601WEEK = "Y\WW"
GER1 = "d\.m\.Y"
GER2 = "d\.m\.Y\, H:i"
GER3 = "d\.m\.Y\, H:i:s"
GER4 = "d\. F Y\, H:i:s"
ENGLONG = "l dS of F Y h:i:s A"
GMDATE = "D, d M Y H:i:s \G\M\T"
RFC822 = "r"
UNIX = "U"
LONG = "F j, Y, g:i a"



; database settings for storing timestamps
[database]

; whether to store a timestamp value in UTC (GMT)
utc = true
