<?php
namespace modbusy\request;


abstract class MultibyteRequest extends  Request
{
    const ERRORS = [
1 =>	'Illegal Function 	Function code received in the query is not recognized or allowed by server',
2 =>	'Illegal Data Address 	Data address of some or all the required entities are not allowed or do not exist in server',
3 =>	'Illegal Data Value 	Value is not accepted by server',
4 =>	'Server Device Failure 	Unrecoverable error occurred while server was attempting to perform requested action',
5 =>	'Acknowledge 	Server has accepted request and is processing it, but a long duration of time is required. This response is returned to prevent a timeout error from occurring in the client. client can next issue a Poll Program Complete message to determine whether processing is completed',
6 =>	'Server Device Busy 	Server is engaged in processing a long-duration command; client should retry later',
7 =>	'Negative Acknowledge 	Server cannot perform the programming functions; client should request diagnostic or error information from server',
8 =>	'Memory Parity Error 	Server detected a parity error in memory; client can retry the request',
10=> 	'Gateway Path Unavailable 	Specialized for Modbus gateways: indicates a misconfigured gateway',
11=> 	'Gateway Target Device Failed to Respond',
    ];

    protected function request($command )
    {
        $this->log("Sending");
        $this->transactionId = rand(0,65535);
        $transaction = pack("n",$this->transactionId);

        $this->logHex("Sending transaction",$transaction);
        //  When sending a Modbus TCP frame, the frame is split into 6 different sections:
        //1)      Transaction Identifier ( 2 bytes )
        //2)      Protocol Identifier (2 bytes)
        //3)      Length Field (2 bytes)
        //4)      Unit Identifier (1 byte)
        //5)      Function Code (1 byte)
        //6)      Data bytes (n bytes)
        $bytes = fwrite($this->socket,$transaction);
        if   ( $bytes !== 2 )
            throw new \InvalidArgumentException("could not write transaction id to socket");

        $bytes = fwrite($this->socket,self::PROTOCOL_IDENTIFIER);
        $this->logHex("Sending protocol",self::PROTOCOL_IDENTIFIER);
        if   ( $bytes !== 2 )
            throw new \InvalidArgumentException("could not write 00 to socket");

        // length
        $length = strlen($command)+2;
        $this->logHex("sending length",pack("n",$length));
        fwrite($this->socket,pack("n",$length) ); // 2 bytes

        $this->logHex("sending unit",pack("C",$this->unitId));
        fwrite($this->socket,pack("C",$this->unitId) ); // unit identifier 1 byte

        $this->logHex("sending function code",pack("C",$this->functionCode));
        fwrite($this->socket,pack("C",$this->functionCode) );

        $this->logHexDump( "sending command",$command);
        fwrite($this->socket,$command );

        $this->log("now getting data...");
        $transactionResponse = fgets($this->socket,2+1);
        $this->logHex("Transaction",$transactionResponse);
        if   ( $transaction != $transactionResponse )
            throw new \InvalidArgumentException("transaction from modbus slave '".bin2hex($transactionResponse)."' does not match ours '".bin2hex($transaction)."'");
        $protocol = fgets($this->socket,2+1);
        if   ( $protocol != self::PROTOCOL_IDENTIFIER )
            throw new \InvalidArgumentException("protocol does not match");
        $this->logHex("Protocol",$protocol);
        $length = unpack("n",fgets($this->socket,2+1))[1];
        $this->log("Response-Length ".$length.' bytes');
        $response = fgets($this->socket,$length+1);

        $unitResponse = unpack("C",substr($response,0,1))[1];
        $this->log("Unit ".$unitResponse);

        $functionResponse = unpack("C",substr($response,1,1))[1];
        $this->log("Function code ".$functionResponse);

        $data = substr($response,2); // truncate unitId and functionCode (1+1=2 bytes)
        $this->logHexDump("Result",$data);

        if   ( $functionResponse == $this->functionCode ) {
            // success

            return $data;
        }
        elseif   ( $functionResponse == $this->functionCode + 128 ) {

            if   ( strlen($data) == 1 ) {
                $errorCode = unpack("C",$data)[1];
                if   ( isset(self::ERRORS[$errorCode]) )
                    throw new \InvalidArgumentException("server error: ".self::ERRORS[$errorCode]);

                else
                    throw new \InvalidArgumentException("server error with unknown error code ".$errorCode);
            }
            else
                throw new \InvalidArgumentException("server error with unknown error data: '".bin2hex($data));
        }
        else {
            throw new \InvalidArgumentException("server error: function in response is ".$functionResponse." and not the called function ".$function.". Data is '".bin2hex($data)."'");
        }
    }
}