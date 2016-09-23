<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 21/09/16
 * Time: 08:16
 */
namespace Tests\Unipik\Unit\UserBundle\Entity\Mocks;

use Unipik\UserBundle\Entity\Region;

class RegionMock {

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
