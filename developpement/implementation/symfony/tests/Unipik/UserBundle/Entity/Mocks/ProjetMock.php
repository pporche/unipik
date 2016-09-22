<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 22/09/16
 * Time: 17:43
 */

namespace Tests\Unipik\UserBundle\Entity\Mocks;

use Unipik\UserBundle\Entity\Projet;

class ProjetMock {

    public static function create() {
        $p = new Projet();

        $p
            ->setNom("Aquitaine Limousin Poitou-Charentes")
            ->setChiffreAffaire(500.0)
            ->setType("college")
        ;

        return $p;
    }
}

