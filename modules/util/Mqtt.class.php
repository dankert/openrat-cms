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


namespace util;
use cms\base\DB;
use logger\Logger;
use withPraefixQuestionMark;

/**
 * MQTT client.
 *
 * @author Jan Dankert
 */
class Mqtt {

	const TYPE_CONNECT    =  1;
	const TYPE_CONNACK    =  2;
	const TYPE_PUBLISH    =  3;
	const TYPE_PUBACK     =  4;
	const TYPE_SUBSCRIBE  =  8;
	const TYPE_SUBACK     =  9;
	const TYPE_DISCONNECT = 14;

	const FORMAT_1_BYTE = 'C';
	const FORMAT_2_BYTE = 'n';

	const CONNECT_ACCEPTED = 0;
	const CONNECT_WRONG_PROTOCOL_VERSION = 1;
	const CONNECT_IDENTIFIER_REJECTED = 2;
	const CONNECT_SERVER_UNAVAILABLE = 3;
	const CONNECT_BAD_USERNAME_OR_PASSWORD = 4;
	const CONNECT_NOT_AUTHORIZED = 5;

	protected $connection;


	public function __construct( $url ) {

		$urlParts = parse_url( $url );

		$port = @$urlParts['port'] ?: (@$urlParts['scheme']=='mqtts'?8883:1883);

		if ( @$urlParts['scheme'] == 'mqtts' )
			$proto = 'ssl://'; // SSL
		else
			$proto = 'tcp://'; // Default

		if   ( !@$urlParts['host'] )
			throw new \Exception('MQTT-Host must be present');

		$this->connection = @fsockopen($proto . $urlParts['host'], $port, $errno, $errstr, 5);

		if (!$this->connection || !is_resource($this->connection))
			// Keine Verbindung zum Host moeglich.
			throw new \Exception("Connection refused: '" . $proto . $urlParts['host'] . ':' . $port . " - $errstr ($errno)" );
	}


	public function connect( $username,$password ) {

		$clientID     = 'CMS';
		$proto        = 'MQTT';
		$protoVersion = 4; // MQTT 3.x
		$connectFlag  = 0b11000010; // Username,Password,new session
		$timeout      = 10;

		$variableHeader =
			pack(self::FORMAT_2_BYTE,strlen($proto)).
			$proto.
			pack(self::FORMAT_1_BYTE,$protoVersion).
			pack(self::FORMAT_1_BYTE,$connectFlag ).
			pack(self::FORMAT_2_BYTE,$timeout     );

		$payload = array_reduce( [ $clientID,$username,$password ],function($carry,$item) {
			return $carry.$this->wrapWithLength($item);
		},'');

		$this->sendCommand( self::TYPE_CONNECT,0,$variableHeader,$payload);
		$r = $this->readPacketFromServer();

		list( $commandType,$flags,$response ) = $r;

		if   ( $commandType != self::TYPE_CONNACK )
			throw new \Exception('Server did not respond with CONNACK after CONNECT but with: '.$commandType);

		$connectAcknowledgeFlags = ord($response[0]);
		$connectReturnCode = ord($response[1]);

		switch( $connectReturnCode ) {

			case self::CONNECT_ACCEPTED:
				return;
			case self::CONNECT_BAD_USERNAME_OR_PASSWORD:
				throw new \Exception('Bad username or password');
			case self::CONNECT_IDENTIFIER_REJECTED:
				throw new \Exception('Identifier rejected');
			case self::CONNECT_NOT_AUTHORIZED:
				throw new \Exception('Not authorized');
			case self::CONNECT_SERVER_UNAVAILABLE:
				throw new \Exception('Server unavailable');
			case self::CONNECT_WRONG_PROTOCOL_VERSION:
				throw new \Exception('Wrong protocol version');
			default:
				throw new \Exception('CONNECT/CONNACK return code is : '.$connectReturnCode);
		}
	}


	public function subscribe( $topic ) {

		$packetId = 1;
		$qos      = 0b01; // at least once.

		$variableHeader = pack(self::FORMAT_2_BYTE,$packetId);
		$payload        = $this->wrapWithLength($topic).pack(self::FORMAT_1_BYTE,$qos );

		$this->sendCommand( self::TYPE_SUBSCRIBE,2,$variableHeader,$payload);
		$r = $this->readPacketFromServer();

		list( $commandType,$flags,$response ) = $r;

		if   ( $commandType != self::TYPE_SUBACK )
			throw new \Exception('Server did not respond with SUBACK after SUBSCRIBE but with: '.$commandType);

		$returnCode = ord($response[2]);

		switch( $returnCode ) {
			case 0: // Success - Maximum QoS 0
			case 1: // Success - Maximum QoS 1
			case 2: // Maximum QoS 2
				break;
			default:
				throw new \Exception('Returncode of SUBACK is not 0-2, but: '.$returnCode);
		}

		//if   ( $packetId != bindec($response[0].$response[1] ) )
		//	throw new \Exception('Packet-Id does not match: '.$packetId.' vs '.bindec($response[0].$response[1])) ;





		$r = $this->readPacketFromServer(); // get a retained message (hopefully)

		list( $commandType,$flags,$response ) = $r;

		if   ( $commandType != self::TYPE_PUBLISH )
			throw new \Exception('Server did not sent a PUBLISH packet after SUBSCRIBE, but: '.$commandType);

		$lengthTopic = hexdec(bin2hex(substr($response,0,2)));
		$response = substr($response,2);

		Logger::debug("Length of topic is ".$lengthTopic);

		$topic = substr($response,0,$lengthTopic);
		$response = substr($response,$lengthTopic);

		$packetId = hexdec(bin2hex(substr($response,0,2)));
		$response = substr($response,2);
		Logger::debug("packet id ".$packetId);

		return $response;

		$lengthPayload = hexdec(bin2hex(substr($response,0,2)));
		Logger::debug("Length of payload is ".$lengthPayload);
		$response = substr($response,2);

		$value = substr($response,0,$lengthPayload);
		$response = substr($response,$lengthPayload);

		if   ( strlen($response ) )
			throw new \Exception("response has more bytes than expected");

		return $value;
	}


	public function publish( $topic,$value ) {

		$packetId = 1;
		$variableHeader = $this->wrapWithLength($topic).pack(self::FORMAT_2_BYTE,$packetId);
		$payload        = $this->wrapWithLength($value);
		$controlFlags   = 0b0011; // at least once, retain
		$this->sendCommand( self::TYPE_PUBLISH,$controlFlags,$variableHeader,$payload );
		$r = $this->readPacketFromServer();

		list( $commandType,$flags,$response ) = $r;

		if   ( $commandType != self::TYPE_PUBACK )
			throw new \Exception('Server did not respond with PUBACK after publishing but with: '.$commandType);
	}


	/**
	 * @param $commandType integer
	 * @param $controlFlag
	 * @param $variableHeader
	 * @param $payloads String[]
	 * @throws \Exception
	 */
	protected function sendCommand($commandType, $controlFlag, $variableHeader, $payloadValue ) {

		$controlHeader = ($commandType << 4) + $controlFlag;

		//$payload  = pack(self::FORMAT_2_BYTE,strlen($payloadValue)) . $payloadValue;
		$payload  = $payloadValue;

		$remainingLength = $this->encodeMessageLength(strlen( $variableHeader ) + strlen( $payload ));

		$packet = pack(self::FORMAT_1_BYTE,$controlHeader) . $remainingLength . $variableHeader . $payload;
		Logger::debug( "MQTT Sending packet\n"         . Text::hexDump($packet) );
		$writtenBytes = fwrite($this->connection, $packet );
		if   ( $writtenBytes === false )
			throw new \Exception('Could not write to MQTT tcp socket' );
		Logger::debug( "MQTT Sent bytes: "         . $writtenBytes );
	}


	public function readPacketFromServer() {

		if (!is_resource($this->connection))
			throw new \Exception('Connection lost during transfer' );

		if (feof($this->connection))
			throw new \Exception('Unexpected EOF while reading HTTP-Response');

		// read the response
		$responseControlHeader   = fread( $this->connection, 1);

		if ($responseControlHeader === false || $responseControlHeader === '')
			throw new \Exception('Could not read control header from response');

		Logger::debug( "MQTT got response control header: ".$responseControlHeader.' ('.gettype($responseControlHeader).')'."\n".Text::hexDump($responseControlHeader) );

		$responseCommandType     = ( ord($responseControlHeader) >> 4 );
		$responseControlFlags    = ( ord($responseControlHeader) & 0b00001111 ); // get 4 bits from right
		Logger::debug( "MQTT Getting response control Header : " . bin2hex($responseControlHeader).' => command type: '.$responseCommandType.', control flags: '.decbin($responseControlFlags) );

		$responseRemainingLength  = $this->readRemainingLengthFromSocket();
		Logger::debug( "MQTT Response length                 : " . $responseRemainingLength );

		$response = fread( $this->connection, $responseRemainingLength );

		if ($response === false || $response === '')
			throw new \Exception('Could not read response data from socket');

		Logger::debug( "MQTT Getting response packet\n" . Text::hexDump($response) );

		return( [ $responseCommandType, $responseControlFlags,$response ] );
	}

	public function disconnect() {
		$r = $this->sendCommand( self::TYPE_DISCONNECT,0,null,null );
		fclose( $this->connection );
	}


	/**
	 * Prepend a value with a 2-byte length header.
	 *
	 * @param $value
	 * @return string
	 */
	protected function wrapWithLength( $value ) {

		return pack(self::FORMAT_2_BYTE,strlen($value)).$value;
	}


	/**
	 * Encodes the length of a message as string, so it can be transmitted
	 * over the wire.
	 *
	 * @param int $length
	 * @return string
	 */
	protected function encodeMessageLength(int $length): string
	{
		$result = '';

		do {
			$digit  = $length % 128;
			$length = $length >> 7;

			// if there are more digits to encode, set the top bit of this digit
			if ($length > 0) {
				$digit = ($digit | 0x80);
			}

			$result .= chr($digit);
		} while ($length > 0);

		return $result;
	}



	protected function readRemainingLengthFromSocket()
	{
		$byteIndex       = 1;
		$remainingLength = 0;
		$multiplier      = 1;

		do {
			// we can take seven bits to calculate the length and the remaining eighth bit
			// as continuation bit.
			$digit = fread( $this->connection,1 );
			if   ( $digit === false || $digit === '' )
				throw new \Exception('Cannot read the remaining length from the socket.');

			$remainingLength += ( ord($digit) & 127) * $multiplier;
			$multiplier *= 128;
			$byteIndex++;
		} while ((ord($digit) & 128) !== 0);

		return $remainingLength;
	}
}