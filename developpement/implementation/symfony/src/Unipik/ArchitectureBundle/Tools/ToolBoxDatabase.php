<?php

namespace Unipik\ArchitectureBundle\Tools;

/**
 * Created by PhpStorm.
 * User: fleriche
 * Date: 29/09/16
 * Time: 09:52
 */

/**
 * Tools for the database
 *
 * Class ToolBoxDatabase
 * @package Unipik\ArchitectureBundle\Tools
 */
class ToolBoxDatabase {

    /**
     * Convert an array into a string formated for the database's domain
     *
     * @param $array
     * @return String
     */
    public function arrayToString($array) {
        $string = '{';
        foreach ($array as $value) {
            $string = $string.$value;
            if($value !== end($array)) {
                $string = $string.',';
            }
        }
        return $string.'}';
    }
}