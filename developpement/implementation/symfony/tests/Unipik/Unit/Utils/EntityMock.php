<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 30/09/16
 * Time: 08:58
 */

namespace Tests\Unipik\Unit\Utils;


abstract class EntityMock
{

    /**
     * @param $nb
     * @return object[]
     */
    public static function createMultiple($nb)
    {
        $res = array();

        for ($i = 0; $i < $nb; $i++) {
            $res[$i] = static::create();
        }
        return $res;
    }
}
