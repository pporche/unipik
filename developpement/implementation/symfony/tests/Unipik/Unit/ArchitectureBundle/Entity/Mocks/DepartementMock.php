<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 05/10/16
 * Time: 11:24
 */
namespace Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks;

use Tests\Unipik\Unit\Utils\EntityMock;
use Unipik\ArchitectureBundle\Entity\Departement;

class DepartementMock extends EntityMock {

    /**
     * @return Departement
     */
    public static function create() {
        $d = new Departement();

        $r = RegionMock::create();

        $d
            ->setNom("Eure")
            ->setNumero("27")
            ->setRegion($r)
        ;

        return $d;
    }

    /**
     * @param $nb
     * @return Departement[]
     */
    public static function createMultiple($nb){
        return parent::createMultiple($nb);
    }
}
