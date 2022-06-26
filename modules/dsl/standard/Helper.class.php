<?php


namespace dsl\standard;


class Helper
{
    public static function getHelp( $obj ) {

        return 'Object properties: '.implode(', ',array_map(function($property) { return ''.$property; },get_object_vars($obj))).';'.
            ' methods: '.implode(', ',array_map(function($property) { return ''.$property.'()'; },get_class_methods($obj)));
    }
}