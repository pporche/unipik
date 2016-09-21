<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 21/09/16
 * Time: 08:16
 */
namespace Tests\Unipik\UserBundle\Entity;

use Unipik\UserBundle\Entity\Pays;
use Unipik\UserBundle\Entity\Region;

class RegionMock {

    public static function createRegion() {

        $r = new region();
        $p = PaysMock::createPays();

        $r
            ->setNom("Aquitaine Limousin Poitou-Charentes")
            ->setPays($p)
        ;

        return $r;
    }
}
