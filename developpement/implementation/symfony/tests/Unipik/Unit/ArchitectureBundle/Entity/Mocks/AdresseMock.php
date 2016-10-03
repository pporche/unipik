<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 23/09/16
 * Time: 17:18
 */

namespace Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks;

use Tests\Unipik\Unit\Utils\Mock;
use Unipik\ArchitectureBundle\Entity\Adresse;

class AdresseMock extends Mock {

    /**
     * @return Adresse
     */
    public static function create() {
        $r = new Adresse();

        $r
            ->setville("Rouen")
            ->setCodePostal("76000")
            ->setAdresse("22 rue du gros")
        ;

        return $r;
    }

    /**
     * @param $nb
     * @return Adresse[]
     */
    public static function createMultiple($nb){
        return parent::createMultiple($nb);
    }
}
