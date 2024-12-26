<?php
namespace modbusy\request;


class MultipleHoldingRegistersWriter extends  MultibyteRequest
{
    public function __construct()
    {
        parent::__construct();
        $this->functionCode = 16;
    }

    /**
     * @param $startReference
     * @param $value
     * @return false|string
     */
    public function write($startReference,$value )
    {
        return parent::request(
            pack('n',$startReference). // 2 bytes: start address
            pack("n",ceil(strlen($value)/2)).pack("C",strlen($value)).$value);
    }
}