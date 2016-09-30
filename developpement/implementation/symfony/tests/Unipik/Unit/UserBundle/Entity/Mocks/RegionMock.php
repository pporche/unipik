<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 21/09/16
 * Time: 08:16
 */
namespace Tests\Unipik\Unit\UserBundle\Entity\Mocks;

use Tests\Unipik\Unit\Utils\Mock;
use Unipik\UserBundle\Entity\Region;

class RegionMock extends Mock {

    public static function create() {
        $r = new Region();
        $p = PaysMock::create();

        $r
            ->setNom("Aquitaine Limousin Poitou-Charentes")
            ->setPays($p)
        ;

        return $r;
    }
}
