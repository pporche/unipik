<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 22/09/16
 * Time: 17:43
 */

namespace Tests\Unipik\Unit\UserBundle\Entity\Mocks;

use Tests\Unipik\Unit\Utils\Mock;
use Unipik\UserBundle\Entity\Projet;

class ProjetMock extends Mock {

    /**
     * @return Projet
     */
    public static function create() {
        $p = new Projet();

        $p
            ->setNom("Aquitaine Limousin Poitou-Charentes")
            ->setChiffreAffaire(500.0)
            ->setType("college")
        ;

        return $p;
    }

    /**
     * @param $nb
     * @return Projet[]
     */
    public static function createMultiple($nb){
        return parent::createMultiple($nb);
    }
}

