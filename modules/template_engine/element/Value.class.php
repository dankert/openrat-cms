<?php

namespace template_engine\element;

class Value
{
    private $value;
    private $expressions = [];

    const CONTEXT_PHP = 0;
    const CONTEXT_HTML = 1;
    const CONTEXT_RAW = 2;

    public static function createExpression($type, $name)
    {
        return $type . '{' . $name . '}';
    }

    public function __construct($value)
    {
        while (true) {
            if (!$value)
                break;

            $epos = strpos($value, '{', 1);
            $fpos = strpos($value, '}', 1);

            if ($epos === false || $fpos === false)
                break;

            $type = substr($value, $epos - 1, 1);
            $name = substr($value, $epos + 1, $fpos - $epos - 1);

            $this->expressions[] = new ValueExpression($type, $name, $epos - 1);
            $value = substr($value, 0, $epos - 1) . substr($value, $fpos + 1);
        }
        $this->value = $value;
    }


    public function render($context)
    {
        switch ($context) {
            case Value::CONTEXT_PHP:
                return "'" . array_reduce(array_reverse($this->expressions), function ($carry, $expr) {
                        return substr($carry, 0, $expr->position) . "'." . $expr->render() . '.\'' . substr($carry, $expr->position);
                    }, $this->value) . "'";

            case Value::CONTEXT_HTML:
            case Value::CONTEXT_RAW:
                $escape = function ($expr) use ($context) {
                    if ($context == self::CONTEXT_HTML)
                        return 'encodeHtml(htmlentities(' . $expr . '))';
                    else
                        return $expr;
                };
                return array_reduce(array_reverse($this->expressions), function ($carry, $expr) use ($escape) {
                    //echo "carry:".$carry.";expr:".$expr->position.':'.$expr->name;
                    return substr($carry, 0, $expr->position) . "<?php echo " . $escape($expr->render()) . ' ?>' . substr($carry, $expr->position);
                }, $this->value);
        }
    }
}