<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 05/10/16
 * Time: 14:38
 */

namespace Tests\Unipik\Unit\InterventionBundle\Entity\Mocks;

use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\AdresseMock;
use Tests\Unipik\Unit\Utils\Mock;
use Unipik\InterventionBundle\Entity\Etablissement;

class EtablissementMock extends Mock {

    /**
     * @return Etablissement
     */
    public static function create() {
        $ad = AdresseMock::create();

        $e = new Etablissement();
        $e
            ->setAdresse($ad)
            ->addEmail("truc@machin.com")
        ;

        return $e;
    }

    /**
     * @param $nb
     * @return Etablissement[]
     */
    public static function createMultiple($nb){
        return parent::createMultiple($nb);
    }
}
