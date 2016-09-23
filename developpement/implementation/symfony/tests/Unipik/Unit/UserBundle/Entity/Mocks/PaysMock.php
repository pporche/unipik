<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 21/09/16
 * Time: 08:05
 */
namespace Tests\Unipik\Unit\UserBundle\Entity\Mocks;

use Unipik\UserBundle\Entity\Pays;

class PaysMock {

    public static function create() {
        $p = new Pays();

        $p
            ->setNom("France")
        ;

        return $p;
    }
}
