<?php

namespace Unipik\ArchitectureBundle\Utils;

/**
 * Created by PhpStorm.
 * User: fleriche
 * Date: 29/09/16
 * Time: 09:52
 */

/**
 * Conversion tools between PHP arrays and Postgresql arrays
 *
 * Class ArrayConverter
 *
 * @package Unipik\ArchitectureBundle\Utils
 */
class ArrayConverter {

    /**
     * Convert a PHP array into a string formatted for the database's domain
     * http://stackoverflow.com/a/5632171/6612380
     *
     * @param  $array
     * @return String
     */
    public static function phpArrayToPgArray($set) {
        settype($set, 'array'); // can be called with a scalar or array
        $result = array();
        foreach ($set as $t) {
            if (is_array($t)) {
                $result[] = static::phpArrayToPgArray($t);
            } else {
                //$t = str_replace('"', '\\"', $t); // escape double quote
                $t = '(' . $t . ')';
                $result[] = $t;
            }
        }
        return '{' . implode(",", $result) . '}'; // format
    }


    /**
     * Convert a string formatted for the database's domain into a PHP array
     * http://stackoverflow.com/a/27964420/6612380
     *
     * @param  $s
     * @param  int  $start
     * @param  null $end
     * @return array|null
     */
    public static function pgArrayToPhpArray($s, $start = 0, &$end = null)
    {
        if (empty($s) || $s[0] != '{') {
            return null;
        }
        $return = array();
        $string = false;
        $quote = '';
        $len = strlen($s);
        $v = '';
        for ($i = $start + 1; $i < $len; $i++) {
            $ch = $s[$i];

            if (!$string && $ch == '}') {
                if ($v !== '' || !empty($return)) {
                    $return[] = $v;
                }

                $end = $i;
                break;
            } else if (!$string && $ch == '{') {
                $v = static::pgArrayToPhpArray($s, $i, $i);
            } else if (!$string && $ch == ',') {
                $return[] = $v;
                $v = '';
            } else if (!$string && ($ch == '"' || $ch == "'")) {
                $string = true;
                $quote = $ch;
            } else if (!$string && ($ch = '(')) {
                $string = true;
                $quote = ')';
            } else if ($string && $ch == $quote && $s[$i - 1] == "\\") {
                $v = substr($v, 0, -1) . $ch;
            } else if ($string && $ch == $quote && $s[$i - 1] != "\\") {
                $string = false;
            } else {
                $v .= $ch;
            }
        }
        return $return;
    }


    /**
     * Ajoute un élément dans un array Postgresql
     *
     * L'array est passé en valeur, le nouveau tableau
     * est passé en sortie.
     *
     * @param String  $pgArray
     * @param $element
     *
     * @return String
     */
    static function addIntoPgArray($pgArray, $element) {
        $array = array();
        if (!is_null($pgArray)) {
            $array = ArrayConverter::pgArrayToPhpArray($pgArray);
        }
        $array[] = $element;
        array_unique($array);
        return ArrayConverter::phpArrayToPgArray($array);
    }

    /**
     * Retire un élément d'un array Postgresql
     *
     * L'array est passé en valeur, le nouveau tableau
     * est passé en sortie.
     *
     * @param String  $pgArray
     * @param $element
     *
     * @return String
     */
    static function removeFromPgArray($pgArray, $element) {
        $array = ArrayConverter::pgArrayToPhpArray($pgArray);
        $id = array_search($element, $array);
        unset($array[$id]);
        return ArrayConverter::phpArrayToPgArray($array);
    }
}
