<?php
// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
namespace cms\generator\target;

use cms\base\Startup;
use logger\Logger;
use util\exception\PublisherException;


/**
 * Publishing a file to Amazon S3 "simple storage system".
 *
 * Support for: AWS Signature Version 4.
 *
 * @author Jan Dankert
 */
class S3Target extends BaseTarget
{
	const SERVICE = 's3';

	/**
	 * @var false|resource
	 */
	private $socket;

	public function checkConnection()
	{
		$socket = $this->createSocket();
		fclose( $socket );
	}


	public function put($source, $dest, $time)
	{
		$dateIso   = date('r',Startup::getStartTime());
		$dateShort = date('Ymd');
		$timeStamp = date('Ymd\THise',Startup::getStartTime());
		$dest = $this->url->path . '/' . $dest;

		$accessKeyId = $this->url->user;
		$secretAccessKey = $this->url->pass;

		$domain = explode('.',$this->url->host);
		if   ( sizeof($domain)<3 )
			throw new PublisherException('S3 Hostname should be <bucket>.s3.<region>...');

		list($bucket,$service,$region) = $domain;
		$scope = $dateShort.'/'.$region.'/'.$service.'/aws4_request';
		$credential = $this->url->user.'/'.$scope;

		$headers = [];
		$hashedPayload = hash_file('SHA256',$source);
		$headers['x-amz-content-sha256'] = $hashedPayload;
		//$headers['x-amz-date'] = $timeStamp;
		//$content .= "Content-Length: ".filesize($source)."\r\n";
		//$content .= "Connection: Close\r\n";

		$headers['Host'] = $this->url->host;
		$headers['Date'] = $dateIso;

		$signedHeaders    = $this->getSignedHeaders($headers);
		$canonicalHeaders = $this->getCanonicalHeaders($headers);
		$canonicalRequest = "PUT\n".$dest."\n\n".$canonicalHeaders."\n\n".$signedHeaders."\n".$hashedPayload;

		$stringToSign = 'AWS4-HMAC-SHA256'."\n".$timeStamp."\n".$scope."\n".hash('SHA256',$canonicalRequest);

		$signatureParts = [
			$dateIso,
			$region,
			's3',
			'aws4_request',
		];
		$signingKey = array_reduce(array_reverse($signatureParts),function ($initial,$value){
			return hash_hmac('SHA256',$initial,$value);
		},'AWS4'.$secretAccessKey);

		$signature = hash_hmac( 'SHA256',$stringToSign, $signingKey );
		$authorizationParts = [
			'Credential'=>$credential,
			'SignedHeaders'=>$signedHeaders,
			'Signature'=>$signature,
		];
		array_walk($authorizationParts,function(&$value,$key){$value=$key.'='.$value;});
		$headers['Authorization'] = 'AWS4-HMAC-SHA256'." ".implode(",",$authorizationParts);
		$headers['Connection'   ] = 'Close';

		$content  = "PUT $dest HTTP/1.1\r\n";

		foreach( $headers as $key=>$value )
			$content .= $key.': '.$value."\r\n";

		fwrite($this->socket, $content."\r\n".file_get_contents($source));

		$response = '';
		while (!feof($this->socket)) {
			$line = fgets($this->socket, 1028);
			$response .= $line;
		}

		$response .= "\n\n\n\n".$content;
		Logger::debug( "S3 Request:\n".$content );
		throw new PublisherException($response);
	}


	public function close()
	{
		fclose($this->socket);
	}

	public function open()
	{
		$this->socket = $this->createSocket();
	}

	/**
	 * @return false|resource
	 */
	protected function createSocket()
	{
		// Amazon S3 is only working with SSL
		$socket = fsockopen('ssl://'.$this->url->host, 443, $errno, $errstr, 5);

		if(!$socket)
			throw new PublisherException("cannot connect to DAV server: $errno -> $errstr");

		return $socket;

	}

	private function getSignedHeaders( $headers )
	{
		$headers = array_keys( $headers );

		$header = array_map(
			function ($header) {
				return strtolower($header);
			}, $headers );

		asort($header );

		return implode( ';',$header );
	}


	private function getCanonicalHeaders( $headers )
	{
		// map to lowerkeys header names
		$header = [];
		foreach( $headers as $key=>$value )
			$header[ strtolower($key) ] = $value;

		ksort($header );

		return implode( "\n",$header );
	}
}