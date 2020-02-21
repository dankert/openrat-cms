<?php

namespace template_engine\components;


use modules\template_engine\Element;

abstract class FieldComponent extends HtmlComponent
{

    public $prefix;
    public $name;
    public $readonly = false;
}
