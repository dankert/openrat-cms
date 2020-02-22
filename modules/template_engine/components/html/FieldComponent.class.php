<?php

namespace template_engine\components\html;


use template_engine\components\html\HtmlComponent;
use template_engine\element\Element;

abstract class FieldComponent extends HtmlComponent
{

    public $prefix;
    public $name;
    public $readonly = false;
}
