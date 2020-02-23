<?php

namespace cms\model;

class ModelFactory
{
    /**
     * @param $type
     * @param $id
     * @return ModelBase
     */
    public static function create($type, $id) {

        // 'aBc' => 'Abc'
        $className = ucfirst(strtolower($type));

        $filename = __DIR__.'/model/'.$className.'.class.php';
        if   ( is_file($filename))
            require_once ($filename);
        else
            return null;

        $nsClassName = '\cms\model\\'.$className;
        return new $nsClassName( $id );
   }
}