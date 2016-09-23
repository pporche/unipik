<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 22/09/16
 * Time: 17:48
 */

namespace Tests\Unipik\UserBundle\Entity\Mocks;

use Unipik\UserBundle\Entity\Comite;

class ComiteMock {

    public static function create() {
        $c = new Comite();

        $c = new Comite();
        $c
            ->setRegion(null)
            ->setNomDepartement("Saone-et-Loire")
        ;

        return $c;
    }
}
