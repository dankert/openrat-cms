<?php

namespace util\text\variables;

class ValueExpression
{
    public $prefix;
    public $name;
    public $default;

    /**
     * ValueExpression constructor.
     * @param $prefix
     * @param $name
     * @param $default
     */
    public function __construct($prefix, $name, $default)
    {
        $this->prefix  = $prefix;
        $this->name    = $name;
        $this->default = $default;
    }
}