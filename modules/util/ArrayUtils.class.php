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




    public static function getSubValue( $array, $keys ) {

        $a = $array;
        foreach( $keys as $k )
        {
            if   ( ! isset($a[$k]) )
                return null;

            $a = $a[$k];
        }

        return $a;
    }



    public static function flattenArray( $prefix, $arr, $split= '.' )
    {
        $new = array();
        foreach( $arr as $key=>$val)
        {
            if	( is_array($val) )
            {
                $new[$prefix.$key] = '';

                $new += self::flattenArray($prefix.$key.$split, $val, $split );
            }
            else
                $new[$prefix.$key] = $val;
        }
        return $new;
    }
}