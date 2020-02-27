<?php

namespace template_engine\element;

class ValueExpression
{

    public $type;
    public $name;
    public $position;

    const TYPE_DATA_VAR = '$';
    const TYPE_MESSAGE = '#';
    const TYPE_CONFIG = '%';

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

    public function render()
    {

        switch ($this->type) {
            case self::TYPE_DATA_VAR:
				if   ( $this->name instanceof Value )
					return '@$' . $this->name->render( Value::CONTEXT_PHP ) . '';
				else
				{
					$parts = explode('.', $this->name);

					return array_reduce($parts, function ($carry, $item) {
						if (!$carry)
							return '@$' . $item;
						else
							return $carry . '[\'' . $item . '\']';
					}, '');
				}
            case self::TYPE_MESSAGE:
				if   ( $this->name instanceof Value )
					return '@lang(' . $this->name->render( Value::CONTEXT_PHP ) . ')';
				else
                	return '@lang(\'' . $this->name . '\')';

            case self::TYPE_CONFIG:
                $config_parts = explode('/', $this->name);
                return 'config(' . "'" . implode("'" . ',' . "'", $config_parts) . "'" . ')';
        }
    }

}