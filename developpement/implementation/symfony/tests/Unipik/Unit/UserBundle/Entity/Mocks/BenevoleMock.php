<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 30/09/16
 * Time: 15:52
 */


namespace Tests\Unipik\Unit\UserBundle\Entity\Mocks;

use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\AdresseMock;
use Tests\Unipik\Unit\Utils\EntityMock;
use Unipik\UserBundle\Entity\Benevole;

class BenevoleMock extends EntityMock {

    /**
     * @return Benevole
     */
    public static function create() {
        $ad = AdresseMock::create();

        $b = new Benevole();
        $b
            ->setNom("Dupond")
            ->setPrenom("charles")
            ->setAdresse($ad)
            ->setUsername("username")
            ->setUsernameCanonical("usernamecanonical")
            ->setEmail("truc@machin.com")
            ->setEmailCanonical("canonical@machin.com")
            ->setPassword("p@ssw0rd")
        ;

        return $b;
    }

    /**
     * @param $nb
     * @return Benevole[]
     */
    public static function createMultiple($nb){
        return parent::createMultiple($nb);
    }
}
