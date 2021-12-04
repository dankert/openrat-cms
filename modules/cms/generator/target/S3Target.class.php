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
use util\FileUtils;


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
	const AWS_4_HMAC_SHA_256 = 'AWS4-HMAC-SHA256';

	/**
	 * @var false|resource
	 */
	private $socket;

	public function checkConnection()
	{
		$socket = $this->createSocket();
		fclose( $socket );
	}


	/**
	 * @param $source String source file
	 * @param $dest String filename
	 * @param $time int this is ignored, because the date in S3 must be a current date.
	 * @return mixed
	 * @throws PublisherException
	 */
	public function put($source, $dest, $time)
	{
		$dateIso   = date('r',Startup::getStartTime());
		$dateShort = date('Ymd');
		$timeStamp = date('Ymd\THis\Z',Startup::getStartTime());
		//$destPath = FileUtils::unslashifyBegin($this->url->path . '/' . $dest);
		$destPath = $this->url->path . '/' . $dest;

		$accessKeyId     = $this->url->user;
		$secretAccessKey = $this->url->pass;

		$domain = explode('.',$this->url->host);
		if   ( sizeof($domain)<3 )
			throw new PublisherException('S3 Hostname should be <bucket>.s3.<region>...');

		list($bucket,$service,$region) = $domain;
		$scope = $dateShort.'/'.$region.'/'.$service.'/aws4_request';
		$credential = $accessKeyId.'/'.$scope;

		$headers = [];
		$hashedPayload = hash_file('SHA256', $source);
		$headers['x-amz-content-sha256'] = $hashedPayload;
		$headers['x-amz-date']           = $timeStamp;

		$headers['Host'] = $this->url->host;
		$headers['Date'] = $dateIso;


		// Creating the "signedHeaders"
		$signedHeaders    = $this->getSignedHeaders($headers);


		// Creating the "canonicalHeaders"
		$canonicalHeaders = $this->getCanonicalHeaders($headers);


		$canonicalRequestParts = [
			'PUT',
			utf8_encode($destPath),
			'',
			$canonicalHeaders,
			'',
			$signedHeaders,
			$hashedPayload
		];
		$canonicalRequest = implode("\n",$canonicalRequestParts);
		Logger::debug("S3 Canonical request:\n".$canonicalRequest);


		// Create the "StringToSign"
		$stringToSignParts = [
			self::AWS_4_HMAC_SHA_256,
			$timeStamp,
			$scope,
			hash('SHA256',$canonicalRequest )
		];
		$stringToSign = implode("\n",$stringToSignParts);
		Logger::debug("S3 StringToSign:\n".$stringToSign);


		// Create the "Signature"
		$signatureParts = [
			$dateShort,
			$region,
			's3',
			'aws4_request',
		];
		$signingKey = array_reduce($signatureParts,function ($initialKey, $value){
			Logger::debug('S3 Signing "'.$value.'"');
			return hash_hmac('SHA256',$value,$initialKey,true);
		},'AWS4'.$secretAccessKey);
		$signature = hash_hmac( 'SHA256',$stringToSign, $signingKey );
		Logger::debug("S3 Signature: ".$signature);


		// Create the "Authorization" header
		$authorizationParts = [
			'Credential'    => $credential,
			'SignedHeaders' => $signedHeaders,
			'Signature'     => $signature,
		];
		array_walk($authorizationParts,function(&$value,$key){$value=$key.'='.$value;});
		$authorization = self::AWS_4_HMAC_SHA_256 ." ".implode(",",$authorizationParts);
		$headers['Authorization' ] = $authorization;
		Logger::debug("S3 Authorization: ".$authorization);


		// Add some extra headers
		$headers['Connection'    ] = 'Close';
		$headers['Content-Length'] = filesize($source);


		// Creating the HTTP request
		$content  = "PUT $destPath HTTP/1.1\r\n";

		foreach( $headers as $key=>$value )
			$content .= $key.': '.$value."\r\n";
		Logger::trace( "S3 Request:\n".$content );

		fwrite($this->socket, $content."\r\n".file_get_contents($source));

		$response = '';
		if	( !feof($this->socket) ) {
			$line = fgets($this->socket, 14);
			$status = substr($line,9,3);
		}else{
			$status = false;
		}
		while (!feof($this->socket)) {
			$line = fgets($this->socket, 1028);
			$response .= $line;
		}

		$response .= "\n\n\n\n".$content;

		Logger::debug( "S3 Response status: ".$status );

		if ( $status != '200' )
			// Some server error occured.
			throw new PublisherException( "Status is ".$status."\n".$response );
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
		array_walk($header,function(&$value,$key){$value=$key.':'.$value;});

		return implode( "\n",$header );
	}
}