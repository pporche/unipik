<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 30/09/16
 * Time: 16:00
 */

namespace Tests\Unipik\Unit\UserBundle\Entity;

use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\AdresseMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\BenevoleMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ComiteMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ProjetMock;
use Unipik\UserBundle\Entity\Benevole;
use Tests\Unipik\Unit\Utils\EntityTestCase;

class BenevoleTest extends  EntityTestCase
{
    protected static $repository = "UserBundle:Benevole";

    public static function testCreate()
    {
        self::bootKernel();

        $b = BenevoleMock::create();

        return $b;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(Benevole $b)
    {
        $this->assertEquals($b->getId(), null);
        $this->assertEquals($b->getNom(), "Dupond");
        $this->assertEquals($b->getEmail(), "truc@machin.com");

        $b->setNom("Dupont")
            ->setEmail("dupont@super-univ.fr")
            ->setPrenom("Alfred")
            ->setTelFixe("0232010203")
            ->setTelPortable("0601020304")
        ;

        $ad = AdresseMock::create();
        $b->setAdresse($ad);

        $this->assertEquals($b->getNom(),"Dupont");
        $this->assertEquals($b->getEmail(), "dupont@super-univ.fr");
        $this->assertEquals($b->getPrenom(), "Alfred");
        $this->assertEquals($b->getTelFixe(), "0232010203");
        $this->assertEquals($b->getTelPortable(), "0601020304");
        $this->assertEquals($b->getAdresse(), $ad);

        $p = ProjetMock::create();
        $b->addProjet($p);
        $this->assertEquals($b->getProjet()[0], $p);
        $b->removeProjet($p);
        $this->assertEquals($b->getProjet()[0], null);

        $c = ComiteMock::create();
        $b->addComite($c);
        $this->assertEquals($b->getComite()[0], $c);
        $b->removeComite($c);
        $this->assertEquals($b->getComite()[0], null);

        $b->addActivitesPotentielles("plaidoyers");
        $this->assertEquals("plaidoyers", $b->getActivitesPotentielles()[0]);
        $b->removeActivitesPotentielles("plaidoyers");
        $this->assertTrue(is_null($b->getActivitesPotentielles()[0]));
    }

    public function badEntityProvider()
    {
        $b = BenevoleMock::createMultiple(9);
        $longName = str_repeat("a", 101);


        return [
            "Benevole with badly formatted email" => [$b[0]->setEmail("invalid.email@")],
            "Benevole with too long nom" => [$b[2]->setNom($longName)],
            "Benevole with too long prenom" => [$b[3]->setPrenom($longName)],
            "Benevole with badly formatted Tel fixe" => [$b[4]->setTelFixe("02.32.01.02.03")],
            "Benevole with badly formatted Tel portable" => [$b[5]->setTelPortable("06.32.01.02.03")],
        ];
    }

    public function badSetterProvider()
    {
        $b = BenevoleMock::createMultiple(3);


        return [
            "Benevole with wrong type estTuteur" => [$b[0]->setEstTuteur("Vrai")],
            "Benevole with est tuteur but without any Projet" => [$b[1]->setEstTuteur(true)],
            "Benevole with wrong typeActivite" => [$b[2]->setTypeActivite("active inexistante")],
        ];
    }
}
