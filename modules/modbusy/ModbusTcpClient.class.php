<?php

namespace modbusy;


use modbusy\request\MultibyteRequest;
use modbusy\request\MultipleHoldingRegistersReader;
use modbusy\request\MultipleHoldingRegistersWriter;
use modbusy\request\Request;

/**
 */
class ModbusTcpClient
{
    protected $host = 'localhost';
    protected $port = 502;
    protected $socket;
    protected $timeout = 2;
    protected $log;

    public function __construct()
    {
        $this->log = function ($log) {};
    }

    public function setTimeout( $timeoutInSeconds)
    {
        $this->timeout = $timeoutInSeconds;
        return $this;
    }

    /**
     * Setting the host.
     * Default: localhost.
     * @param $host
     * @return $this
     */
    public function setHost( $host ) {
        $this->host = $host;
        return $this;
    }

    /**
     * Setting the TCP Port. Default: 502 (Modbus TCP standard port)
     * @param $port
     * @return $this
     */
    public function setPort( $port )
    {
        $this->port = $port;
        return $this;
    }


    /**
     * @return \Closure
     */
    public function getLog(): \Closure
    {
        return $this->log;
    }



    public function setLog( $log )
    {
        $this->log = $log;
        return $this;
    }


    /**
     * @return MultipleHoldingRegistersReader
     */
    public function readMultipleHoldingRegisters() {
        return $this->initializeRequest(new MultipleHoldingRegistersReader());
    }

    /**
     * @return MultipleHoldingRegistersWriter
     */
    public function writeMultipleHoldingRegisters() {
        return $this->initializeRequest( new MultipleHoldingRegistersWriter());
    }


    public function open()
    {
        $this->socket = fsockopen($this->host,$this->port);
        socket_set_timeout($this->socket,$this->timeout);
        if   ( $this->socket === false )
            throw new \InvalidArgumentException("no socket to host");
        return $this;
    }


    protected function initializeRequest(Request $request)
    {
        $request->setSocket($this->socket );
        $request->setLog( $this->log );
        return $request;
    }


    public function close()
    {
        if   ( $this->socket ) {
            fclose($this->socket);
            $this->socket = null;
        }
        return $this;

    }

    public function __destruct()
    {
        if   ( $this->socket ) {

            fclose($this->socket);
            $this->socket = null;
        }
    }
}