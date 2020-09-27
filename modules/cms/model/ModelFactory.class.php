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
        $className = '\\cms\\model\\'.ucfirst(strtolower($type));

        if   ( ! class_exists($className))
        	return null;

        return new $className( $id );
   }
}