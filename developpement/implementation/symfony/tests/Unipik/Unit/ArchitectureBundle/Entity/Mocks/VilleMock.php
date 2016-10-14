<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 03/10/16
 * Time: 16:22
 */

namespace Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks;

use Tests\Unipik\Unit\Utils\EntityMock;
use Unipik\ArchitectureBundle\Entity\Ville;

class VilleMock extends EntityMock {

    /**
     * @return Ville
     */
    public static function create() {
        $v = new Ville();

        $v->setNom("Rouen")
        ;

        return $v;
    }

    /**
     * @param $nb
     * @return Ville[]
     */
    public static function createMultiple($nb){
        return parent::createMultiple($nb);
    }
}
