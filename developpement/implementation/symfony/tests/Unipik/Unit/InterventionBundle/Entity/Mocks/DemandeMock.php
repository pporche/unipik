<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 06/10/16
 * Time: 08:29
 */

namespace Tests\Unipik\Unit\InterventionBundle\Entity\Mocks;

use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ContactMock;
use Tests\Unipik\Unit\Utils\Mock;
use Unipik\InterventionBundle\Entity\Demande;

class DemandeMock extends Mock {

    /**
     * @return Demande
     */
    public static function create() {
        $c = ContactMock::create();


        $d = new Demande();
        $d
            ->setContact($c)
            ->setDateDemande(new \DateTime('2000-01-01'))
            ->addSemaine("42")
        ;

        return $d;
    }

    /**
     * @param $nb
     * @return Demande[]
     */
    public static function createMultiple($nb){
        return parent::createMultiple($nb);
    }
}
