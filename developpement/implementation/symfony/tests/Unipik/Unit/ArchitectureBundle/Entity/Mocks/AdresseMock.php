<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 23/09/16
 * Time: 17:18
 */

namespace Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks;

use Unipik\ArchitectureBundle\Entity\Adresse;

class AdresseMock {

    public static function create() {
        $r = new Adresse();

        $r
            ->setville("Rouen")
            ->setCodePostal("7600")
        ;

        return $r;
    }
}
