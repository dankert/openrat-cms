<?php
namespace modbusy\request;


class MultipleHoldingRegistersReader extends  MultibyteRequest
{
    public function __construct()
    {
        parent::__construct();
        $this->functionCode = 3;
    }

    /**
     * @param $startAdress
     * @param $byteCount
     * @return false|string
     */
    public function readFrom($startAdress,$byteCount )
    {
        return parent::request(
            pack('n',$startAdress). // 2 bytes: start address
            pack("n",ceil((9+$byteCount)/2)) // 2 bytes: number of bytes to read
        );
    }
}