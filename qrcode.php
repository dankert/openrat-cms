<?php
require('util/qrcode/qrlib.php');


$value = urldecode($_GET['value']);

// outputs image directly into browser, as PNG stream

switch( $_GET['type'] )
{
    case 'text':
        ?>
<html lang="de">
<head>
<title>Test</title>
<meta content="text/html; charset=UTF-8" http-equiv="content-type" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body style="color:gray; background-color:brown;"><hr>TEXT:
        <pre style="line-height:14px; font-size:14px;">
        QR-Code:<br/><?php
        $bytes = QRcode::text($value);
        $out = strtr( join("<br/>",$bytes ),array(
          '0' => '&nbsp;',
          '1' => '&#9608;' ));
        echo $out;
?>
</pre>
Länge: <?php echo strlen($out)?> bytes, raw: <?php echo strlen(join("",$bytes)) ?> bytes

<hr>
PNG:

<img src="./qrcode.php?type=png&value=<?php echo $value ?>" />
<hr>
SVG:
<img src="./qrcode.php?type=svg&value=<?php echo $value ?>" />

</body></html><?php 
        break;
    case 'svg':
        echo  QRcode::svg($value,false,QR_ECLEVEL_L,3,4,false,0xFF0000,0xBBBBBB);
        break;
    default: 
       
        QRcode::png($value,false,QR_ECLEVEL_L,3,4,false,0xFF0000,0xBBBBBB);
}

?>