<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 22/09/16
 * Time: 17:48
 */

namespace Tests\Unipik\Unit\UserBundle\Entity\Mocks;

use Tests\Unipik\Unit\Utils\Mock;
use Unipik\UserBundle\Entity\Comite;

class ComiteMock extends Mock {

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
