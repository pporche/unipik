<?php

namespace Unipik\ArchitectureBundle\Tools;

/**
 * Created by PhpStorm.
 * User: fleriche
 * Date: 29/09/16
 * Time: 09:52
 */
class ToolBoxDatabase {

    /**
     * @param $array
     * @return String La string formatée pour les domains en DB
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