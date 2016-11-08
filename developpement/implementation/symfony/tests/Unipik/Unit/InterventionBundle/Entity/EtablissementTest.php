<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 05/10/16
 * Time: 14:37
 */

namespace Tests\Unipik\Unit\InterventionBundle\Entity;

use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\AdresseMock;
use Tests\Unipik\Unit\InterventionBundle\Entity\Mocks\EtablissementMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ContactMock;
use Unipik\InterventionBundle\Entity\Etablissement;
use Tests\Unipik\Unit\Utils\EntityTestCase;

class EtablissementTest extends  EntityTestCase
{
    protected static $repository = "InterventionBundle:Etablissement";

    public static function testCreate()
    {
        self::bootKernel();

        $e = EtablissementMock::create();

        return $e;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(Etablissement $e)
    {
        $this->assertEquals(null, $e->getId());
        $this->assertEquals("truc@machin.com", $e->getEmails()[0]);

        $e->setNom("College trucmuche")
            ->setTelFixe("0232010203")
            ->setUai("uai") //Aucune vérification sur l'UAI: normal
            ->setTypeEnseignement("lycee")
            ->setTypeCentre("adolescent")
            ->setTypeAutreEtablissement("autre");

        $ad = AdresseMock::create();
        $e->setAdresse($ad);

        $this->assertEquals("College trucmuche",    $e->getNom());
        $this->assertEquals("0232010203",           $e->getTelFixe());
        $this->assertEquals("uai",                  $e->getUai());
        $this->assertEquals("lycee",                $e->getTypeEnseignement());
        $this->assertEquals("adolescent",           $e->getTypeCentre());
        $this->assertEquals("autre",                $e->getTypeAutreEtablissement());
        $this->assertEquals($ad,                    $e->getAdresse());
        $this->assertEquals(true,                   $e->isEnseignement());
        $this->assertEquals(true,                   $e->isCentreLoisirs());
        $this->assertEquals(true,                   $e->isAutreEtablissement());

        $e->addEmail("dupont@topmail.com");
        $this->assertEquals("dupont@topmail.com", $e->getEmails()[1]);
        $e->removeEmail("dupont@topmail.com");
        $this->assertEquals(null, $e->getEmails()[1]);
        $e->addEmail("dupont@topmail.com");
        $e->addEmail("test@test.test");
        $e->addEmail("truc@truc.truc");
        $e->removeAllEmails();
        $this->assertEquals(null, $e->getEmails()[0]);
        $this->assertEquals(null, $e->getEmails()[1]);
        $this->assertEquals(null, $e->getEmails()[2]);
        $this->assertEquals(null, $e->getEmails()[3]);

        $c = ContactMock::create();
        $e->addContact($c);
        $this->assertEquals($c, $e->getContacts()[0]);
        $e->removeContact($c);
        $this->assertEquals(null, $e->getContacts()[0]);
    }

    public function validEntityProvider()
    {
        $e = EtablissementMock::createMultiple(2);
        $c = ContactMock::create();

        $e[1]->setNom("Dupont")
            ->addEmail("dupont@super-univ.fr")
            ->setTypeEnseignement("lycee")
            ->setTelFixe("0232010203")
            ->setUai("uai")
            ->addContact($c);

        return [
            "1 Etablissement" => [$e[0]],
            "3 Etablissements" => [[clone $e[0], clone $e[0], clone $e[0]]],
            "1 Etablissement with all optional values" => [$e[1]]
        ];
    }

    public function badEntityProvider()
    {
        $e = EtablissementMock::createMultiple(6);
        $longName = str_repeat("a", 101);

        return [
            "Etablissement with badly formatted email"          => [$e[0]->addEmail("invalid.email@")],
            "Etablissement with too long nom"                   => [$e[1]->setNom($longName)],
            "Etablissement with badly formatted Tel fixe"       => [$e[2]->setTelFixe("02.32.01.02.03")],
            "Etablissement with wrong TypeEnseignement"         => [$e[3]->setTypeEnseignement("type inexistant")],
            "Etablissement with wrong TypeCentre"               => [$e[4]->setTypeCentre("type inexistant")],
            "Etablissement with wrong TypeAutreEtablissement"   => [$e[5]->setTypeAutreEtablissement("type inexistant")],
        ];
    }
}
