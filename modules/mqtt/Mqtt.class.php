<?php
namespace mqtt;

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

    /**
     * @var Callable
     */
    protected $log;

    protected $clientId = "MQTTWEBCLIENT";

    public function setLog( $log )
    {
        $this->log = $log;
        return $this;
    }

	public function open( $url='mqtt://localhost' ) {

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

        return $this;
	}


    public function setClientId( $clientId )
    {
        $this->clientId = $clientId;
        return $this;
    }


    /**
     * Connect to the server.
     * @param $username
     * @param $password
     * @return $this
     * @throws \Exception
     */
	public function connect( $username='',$password='' ) {

		$proto        = 'MQTT';
		$protoVersion = 4; // MQTT 3.x

		$connectFlag  = 0b00000010; // with new session
        $payload = $this->wrapWithLength($this->clientId);

        if   ( $username ) {
            $connectFlag  |= 0b10000000;
            $payload .= $this->wrapWithLength($username);

            if   ( $password ) {
                $connectFlag  |= 0b01000000;
                $payload   .= $this->wrapWithLength($password);
            }
        }
		$timeout      = 10;

		$variableHeader =
			pack(self::FORMAT_2_BYTE,strlen($proto)).
			$proto.
			pack(self::FORMAT_1_BYTE,$protoVersion).
			pack(self::FORMAT_1_BYTE,$connectFlag ).
			pack(self::FORMAT_2_BYTE,$timeout     );

		$this->sendCommand( self::TYPE_CONNECT,0,$variableHeader,$payload);
		$r = $this->readPacketFromServer();

		list( $commandType,$flags,$response ) = $r;

		if   ( $commandType != self::TYPE_CONNACK )
			throw new \Exception('Server did not respond with CONNACK after CONNECT but with: '.$commandType);

		$connectAcknowledgeFlags = ord($response[0]);
		$connectReturnCode = ord($response[1]);

		switch( $connectReturnCode ) {

			case self::CONNECT_ACCEPTED:
				return $this;
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

        if   ( $this->log ) $this->log("Length of topic is ".$lengthTopic);

		$topicFromResponse = substr($response,0,$lengthTopic);

        if   ( $topic != $topicFromResponse )
            throw new \Exception('Topic from Server does not match');

		$response = substr($response,$lengthTopic);

        // if QOS 1 there is a package identifier
        if   ( $flags & 0b10 ) {
            $packetId = hexdec(bin2hex(substr($response,0,2)));
            if   ( $this->log ) $this->log("packet id ".$packetId);

            $response = substr($response,2); // Truncate package identifier from response
        }

        // if QOS 1 there is a payload length header
        /*
        if   ( $flags & 0b10 ) {

            $lengthPayload = hexdec(bin2hex(substr($response, 0, 2)));
            if ($this->log) $this->log("Length of payload is " . $lengthPayload);
            $response = substr($response, 2);
            $value = substr($response,0,$lengthPayload);
            $response = substr($response,$lengthPayload);

            if   ( strlen($response ) )
                throw new \Exception("response has more bytes than expected");
            return $value;
        } else {*/
            return $response;
        /*}*/


	}


    /**
     * Publishing a value to a MQTT topic.
     *
     * @param $topic
     * @param $value
     * @return void
     * @throws \Exception
     */
	public function publish( $topic,$value ) {

		$packetId = 1;
		$variableHeader = $this->wrapWithLength($topic).pack(self::FORMAT_2_BYTE,$packetId);
        // The length of the payload can be calculated by subtracting the length of the variable header
        // from the Remaining Length field that is in the Fixed Header.
        // It is valid for a PUBLISH Packet to contain a zero length payload.
		$payload        = $value; // do not prepend
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

        // Control Header is the 1-byte header which contains
        // - Command type (4 bit)
        // - Control flag (4 bit)
		$controlHeader = pack(self::FORMAT_1_BYTE,($commandType << 4) + $controlFlag);

		//$payload  = pack(self::FORMAT_2_BYTE,strlen($payloadValue)) . $payloadValue;
		$payload  = $payloadValue;

		$remainingLength = $this->encodeMessageLength(strlen( $variableHeader ) + strlen( $payload ));

        // Control Header : 1 byte
        // Packet Length  : 1 to 4 bytes (using 7 bits, 8th bit is continuation bit)
        // Variable Header: 0..n bytes
        // Payload        : 0..n bytes
		$packet = $controlHeader . $remainingLength . $variableHeader . $payload;
        if   ( $this->log ) $this->log( "MQTT Sending packet\n"         . self::hexDump($packet) );

        if   ( ! $this->connection )
            throw new \Exception("There is no open connection");

		$writtenBytes = fwrite($this->connection, $packet );
		if   ( $writtenBytes === false )
			throw new \Exception('Could not write to MQTT tcp socket' );
        if   ( $this->log ) $this->log( "MQTT Sent bytes: "         . $writtenBytes );
	}


	protected function readPacketFromServer() {

		if (!is_resource($this->connection))
			throw new \Exception('Connection lost during transfer' );

		if (feof($this->connection))
			throw new \Exception('Unexpected EOF while reading HTTP-Response');

		// read the response
		$responseControlHeader   = fread( $this->connection, 1);

		if ($responseControlHeader === false || $responseControlHeader === '')
			throw new \Exception('Could not read control header from response');

		if   ( $this->log ) $this->log( "MQTT got response control header: ".$responseControlHeader.' ('.gettype($responseControlHeader).')'."\n".self::hexDump($responseControlHeader) );

		$responseCommandType     = ( ord($responseControlHeader) >> 4 );
		$responseControlFlags    = ( ord($responseControlHeader) & 0b00001111 ); // get 4 bits from right
		if   ( $this->log ) $this->log( "MQTT Getting response control Header : " . bin2hex($responseControlHeader).' => command type: '.$responseCommandType.', control flags: '.str_pad(decbin($responseControlFlags),4,'0',STR_PAD_LEFT) );

		$responseRemainingLength  = $this->readRemainingLengthFromSocket();
		if   ( $this->log ) $this->log( "MQTT Response length                 : " . $responseRemainingLength );

		$response = fread( $this->connection, $responseRemainingLength );

		if ($response === false || $response === '')
			throw new \Exception('Could not read response data from socket');

		if   ( $this->log ) $this->log( "MQTT Getting response packet\n" . self::hexDump($response) );

		return( [ $responseCommandType, $responseControlFlags,$response ] );
	}

	public function disconnect() {
		$r = $this->sendCommand( self::TYPE_DISCONNECT,0,'','' );
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
	 * Encodes the length of a message.
	 *
	 * @param int $length
	 * @return string
	 */
	protected function encodeMessageLength(int $length): string
	{
		$result = '';

		do {
			$digit  = $length % 128;
			$length = $length >> 7; // 7 bits are used with the 8th bit being a continuation bit.

			// if there are more digits to encode, set the top bit of this digit
			if ($length > 0) {
				$digit |= 0x80;
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


    protected static function hexDump( $data, $newline="\n")
    {
        $width =  16; # number of bytes per line
        $pad   = '.'; # padding for non-visible characters

        $from   = '';
        $to     = '';
        $output = '';

        for ($i=0; $i<=0xFF; $i++)
        {
            $from .= chr($i);
            $to   .= ($i >= 0x20 && $i <= 0x7E) ? chr($i) : $pad;
        }

        $hex   = str_split(bin2hex($data), $width*2);
        $chars = str_split(strtr($data, $from, $to), $width);

        foreach ($hex as $i=>$line)
            $output .=
                implode('  ',array_pad(str_split($chars[$i]),16,' ')     ) . '   ['.str_pad($chars[$i],16).']' . $newline .
                implode(' ' ,array_pad(str_split($line ,2),16,'  ') ) . $newline;
        return $output;
    }


    protected function log( $log )
    {
        if   ( $this->log )
            call_user_func($this->log,$log );
    }

}