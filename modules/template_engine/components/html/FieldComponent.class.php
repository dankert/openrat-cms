<?php

namespace template_engine\components;


use template_engine\element\Element;

abstract class FieldComponent extends HtmlComponent
{

    public $prefix;
    public $name;
    public $readonly = false;
}
