<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 06/10/16
 * Time: 08:20
 */

namespace Tests\Unipik\Unit\InterventionBundle\Entity\Mocks;

use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\AdresseMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ComiteMock;
use Tests\Unipik\Unit\Utils\EntityMock;
use Unipik\InterventionBundle\Entity\Intervention;

class InterventionMock extends EntityMock
{

    /**
     * @return Intervention
     */
    public static function create() 
    {
        $d = DemandeMock::create();
        $c = ComiteMock::create();
        $e = EtablissementMock::create();

        $i = new Intervention();
        $i
            ->setDemande($d)
            ->setComite($c)
            ->setEtablissement($e)
            ->setNbPersonne(7)
            ->setRealisee(false);

        return $i;
    }

    /**
     * @param $nb
     * @return Intervention[]
     */
    public static function createMultiple($nb)
    {
        return parent::createMultiple($nb);
    }
}
