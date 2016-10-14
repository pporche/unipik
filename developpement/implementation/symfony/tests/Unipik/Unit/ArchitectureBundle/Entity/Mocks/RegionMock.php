<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 05/10/16
 * Time: 11:29
 */

namespace Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks;

use Tests\Unipik\Unit\Utils\EntityMock;
use Unipik\ArchitectureBundle\Entity\Region;

class RegionMock extends EntityMock {

    /**
     * @return Region
     */
    public static function create() {
        $r = new Region();

        $p = PaysMock::create();

        $r
            ->setNom("Normandie")
            ->setPays($p)
        ;

        return $r;
    }

    /**
     * @param $nb
     * @return Region[]
     */
    public static function createMultiple($nb){
        return parent::createMultiple($nb);
    }
}
