<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 06/10/16
 * Time: 08:29
 */

namespace Tests\Unipik\Unit\InterventionBundle\Entity\Mocks;

use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ContactMock;
use Tests\Unipik\Unit\Utils\EntityMock;
use Unipik\InterventionBundle\Entity\Demande;

class DemandeMock extends EntityMock
{

    /**
     * @return Demande
     */
    public static function create()
    {
        $c = ContactMock::create();


        $d = new Demande();
        $d  ->setContact($c)
            ->setDateDemande(new \DateTime(date('Y').'-01-01'))
            ->setDateDebutDisponibilite(new \DateTime(date('Y').'-12-15'))
            ->setDateFinDisponibilite(new \DateTime(date('Y').'-12-30')) ;

        return $d;
    }

    /**
     * @param $nb
     * @return Demande[]
     */
    public static function createMultiple($nb)
    {
        return parent::createMultiple($nb);
    }
}
