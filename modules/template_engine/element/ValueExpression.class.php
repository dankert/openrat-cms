<?php

namespace template_engine\element;

class ValueExpression
{

    public $type;
    public $name;
    public $position;

    const TYPE_DATA_VAR = 1;
    const TYPE_MESSAGE  = 2;
    const TYPE_CONFIG   = 3;

    /**
     * ValueExpression constructor.
     * @param $type
     * @param $name
     * @param $position
     */
    public function __construct($type, $name, $position)
    {
        $this->type = $type;
        $this->name = $name;
        $this->position = $position;
    }

    public function getAsString() {
		switch($this->type) {
			case ValueExpression::TYPE_CONFIG:
				$ns = 'config:';
				break;
			case ValueExpression::TYPE_MESSAGE:
				$ns = 'message:';
				break;
			case ValueExpression::TYPE_DATA_VAR:
			default:
				$ns = '';
				break;
		}
		return '$'.'{' . $ns . $this->name . '}';
	}

}