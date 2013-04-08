<html>
<head>
<title>OpenRat API-Client</title>
</head>
<body>
<h1>OpenRat API-Client</h1>
<h2>Request</h2>
<form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>">
<table>
<tr>
<th>Parameter</th><th>Value</th>
</tr>
<?php for( $i=1; $i<=10; $i++ ) { ?>
<tr>
<td><input name="param<?php echo $i ?>" value="<?php echo $_REQUEST['param'.$i] ?>"></td>
<td><input name="value<?php echo $i ?>" value="<?php echo htmlentities($_REQUEST['value'.$i]) ?>" size="50"></td>
<!-- 
<td><textarea rows="3" cols="50" name="value<?php echo $i ?>"><?php echo htmlentities($_REQUEST['value'.$i]) ?></textarea></td>
 -->
</tr>
<?php } ?>
</table><br>
<select name="type">
<?php foreach( array('text/html','application/json','application/xml') as $type ) { ?>
<option value="<?php echo $type ?>" <?php echo ($_REQUEST['type']==$type)?'selected':'' ?>><?php echo $type ?></option>
<?php } ?>
</select>

<select name="method">
<option value="GET" <?php echo ($_REQUEST['method']=='GET')?'selected':'' ?>>GET</option>
<option value="POST" <?php echo ($_REQUEST['method']=='POST')?'selected':'' ?>>POST</option>
</select>

<input type="submit">
</form>
<hr>
<h2>Response</h2>
<strong>
<?php if ( !empty($_REQUEST['param1']) ) {

		$error  = '';
		$status = '';

		$errno  = 0;
		$errstr = '';

		$host   = $_SERVER['SERVER_ADDR'];
		$port   = $_SERVER['SERVER_PORT'];
		$path   = substr($_SERVER['SCRIPT_NAME'],0,-22).'/dispatcher.php';
		
		$method = $_REQUEST['method'];
		if	( empty($method))
			$method='GET';

		// Die Funktion fsockopen() erwartet eine Protokollangabe (bei TCP optional, bei SSL notwendig).
		if	( $port == '443' )
			$prx_proto = 'ssl://'; // SSL
		else
			$prx_proto = 'tcp://'; // Default
			
		$fp = fsockopen ($prx_proto.$host,$port, $errno, $errstr, 30);

		if	( !$fp || !is_resource($fp) )
		{
			echo "Connection refused: '".$prx_proto.$host.':'.$port." - $errstr ($errno)";
		}
		else
		{
			$lb = "\r\n";
			$http_get = $path;

			$parameterString = '';

			for( $i = 1;$i<=10;$i++)
			{
				if	(!empty($_REQUEST['param'.$i]))
				{
					if	( strlen($parameterString) > 0)
						$parameterString .= '&';
					elseif	( $withPraefixQuestionMark )
						$parameterString .= '?';
						
					$parameterString .= urlencode($_REQUEST['param'.$i]) . '=' .urlencode($_REQUEST['value'.$i]);
				}
			}
			
			if	( $method == 'GET')
				if	( !empty($parameterString) )
					$http_get .= '?'.$parameterString;

			if	( $method == 'POST' )
			{
				$header[] = 'Content-Type: application/x-www-form-urlencoded';
				$header[] = 'Content-Length: '.strlen($parameterString);
			}
					
			$header[] = 'Host: '.$host;
			$header[] = 'Accept: '.$_REQUEST['type'];
			$request_header = array( $method.' '.$http_get.' HTTP/1.0') + $header;
			$http_request = implode($lb,$request_header).$lb.$lb;
			
			if	( $method == 'POST' )
				$http_request .= $parameterString;

			if (!is_resource($fp)) {
				$error = 'Connection lost after connect: '.$prx_proto.$host.':'.$port;
				return false;
			}
			fputs($fp, $http_request); // Die HTTP-Anfrage zum Server senden.

			// Jetzt erfolgt das Auslesen der HTTP-Antwort.
			$isHeader = true;

			// RFC 1945 (Section 6.1) schreibt als Statuszeile folgendes Format vor
			// "HTTP/" 1*DIGIT "." 1*DIGIT SP 3DIGIT SP
			if (!is_resource($fp)) {
				echo 'Connection lost during transfer: '.$host.':'.$port;
			}
			elseif (!feof($fp)) {
				$line = fgets($fp,1028);
				$status = substr($line,9,3);
			}
			else
			{
				echo 'Unexpected EOF while reading HTTP-Response';
			}
			
			while (!feof($fp)) {
				$line = fgets($fp,1028);
				if	( $isHeader && trim($line)=='' ) // Leerzeile nach Header.
				{
					$isHeader = false;
				}
				elseif( $isHeader )
				{
					list($headerName,$headerValue) = explode(': ',$line) + array(1=>'');
					$responseHeader[$headerName] = trim($headerValue);
				}
				else
				{
					$body .= $line;
				}
			}
			fclose($fp); // Verbindung brav schlie�en.
			$response = $body;

			// 301 Moved Permanently
			// 302 Moved Temporarily
			echo '<span style="background-color:'.($status=='200'?'green':'red').'">HTTP-Status '.$status.'</span>';
		}
	?>
	</strong>
<pre><?php echo htmlentities($response) ?></pre>
<?php } ?>
</body>
</html>