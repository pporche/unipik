<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 21/09/16
 * Time: 08:05
 */
namespace Tests\Unipik\UserBundle\Entity;

use Unipik\UserBundle\Entity\Pays;

class PaysMock {

    public static function createPays() {
        $p = new pays();

        $p
            ->setNom("France")
        ;

        return $p;
    }
}
