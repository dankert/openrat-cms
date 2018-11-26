<?php

namespace template_engine\components;


abstract class FieldComponent extends HtmlComponent
{

    public $prefix;
    public $name;
    public $readonly = false;


    protected function outputNameAttribute() {

        $out = ' name="';

        if(isset($this->readonly))
            $out .= '<?php if ('.$this->value($this->prefix).') '."echo ".$this->value($this->prefix).".'_' ?>";
        $out .= $this->htmlvalue($this->name);

        if(isset($this->readonly))
            $out .= '<?php if ('.$this->value($this->readonly).') '."echo '_disabled' ?>";
        $out .= '"';

        return $out;
    }
}
