<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 05/10/16
 * Time: 18:01
 */

namespace Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks;

use Tests\Unipik\Unit\Utils\Mock;
use Unipik\ArchitectureBundle\Entity\MomentHebdomadaire;

class MomentHebdomadaireMock extends Mock {

    /**
     * @return MomentHebdomadaire
     */
    public static function create() {
        $mh = new MomentHebdomadaire();

        $mh
            ->setJour("mardi")
            ->setMoment("soir")
        ;

        return $mh;
    }

    /**
     * @param $nb
     * @return MomentHebdomadaire[]
     */
    public static function createMultiple($nb){
        return parent::createMultiple($nb);
    }
}
