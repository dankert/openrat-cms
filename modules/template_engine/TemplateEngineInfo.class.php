<?php

namespace template_engine;

class TemplateEngineInfo
{

    public static function getComponentList()
    {
        $components = parse_ini_file(__DIR__.'/components/components.ini');

        return array_keys($components);
    }

}
