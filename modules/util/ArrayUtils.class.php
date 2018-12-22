<?php
/**
 * Created by PhpStorm.
 * User: dankert
 * Date: 22.12.18
 * Time: 21:36
 */

class ArrayUtils
{

    public static function getSubArray( $array, $keys ) {

        $a = $array;
        foreach( $keys as $k )
        {
            if   ( ! isset($a[$k]) )
                return array();

            if   ( ! is_array($a[$k]) )
                return array();

            $a = $a[$k];
        }

        return $a;
    }
}