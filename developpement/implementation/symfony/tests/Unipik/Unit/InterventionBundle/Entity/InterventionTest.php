<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 06/10/16
 * Time: 08:20
 */

namespace Tests\Unipik\Unit\InterventionBundle\Entity;

use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\AdresseMock;
use Tests\Unipik\Unit\InterventionBundle\Entity\Mocks\InterventionMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ContactMock;
use Unipik\InterventionBundle\Entity\Intervention;
use Tests\Unipik\Unit\Utils\EntityTestCase;

class InterventionTest extends  EntityTestCase
{
    protected static $repository = "InterventionBundle:Intervention";

    public static function testCreate()
    {
        self::bootKernel();

        $i = InterventionMock::create();

        return $i;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(Intervention $i)
    {
        $this->assertEquals(null, $i->getId());

        $i
//            ->setUai("uai") //Aucune vérification sur l'UAI: normal
//            ->setTypeEnseignement("lycee")
//            ->setTypeCentre("adolescent")
//            ->setTypeAutreIntervention("autre")
        ;

//        $this->assertEquals("College trucmuche",    $i->getNom());
//        $this->assertEquals("0232010203",           $i->getTelFixe());
//        $this->assertEquals("uai",                  $i->getUai());
//        $this->assertEquals("lycee",                $i->getTypeEnseignement());
//        $this->assertEquals("adolescent",           $i->getTypeCentre());
//        $this->assertEquals("autre",                $i->getTypeAutreIntervention());
//        $this->assertEquals($ad,                    $i->getAdresse());
//        $this->assertEquals(true,                   $i->isEnseignement());
//        $this->assertEquals(true,                   $i->isCentreLoisirs());
//        $this->assertEquals(true,                   $i->isAutreIntervention());

//        $i->addEmail("dupont@topmail.com");
//        $this->assertEquals("dupont@topmail.com", $i->getEmails()[1]);
//        $i->removeEmail("dupont@topmail.com");
//        $this->assertEquals(null, $i->getEmails()[1]);
//        $i->addEmail("dupont@topmail.com");
//        $i->addEmail("test@test.test");
//        $i->addEmail("truc@truc.truc");
//        $i->removeAllEmails();
//        $this->assertEquals(null, $i->getEmails()[0]);
//        $this->assertEquals(null, $i->getEmails()[1]);
//        $this->assertEquals(null, $i->getEmails()[2]);
//        $this->assertEquals(null, $i->getEmails()[3]);
//
//        $c = ContactMock::create();
//        $i->addContact($c);
//        $this->assertEquals($c, $i->getContacts()[0]);
//        $i->removeContact($c);
//        $this->assertEquals(null, $i->getContacts()[0]);
    }

    public function validEntityProvider() {
        $i = InterventionMock::createMultiple(2);
        $c = ContactMock::create();

//        $i[1]->setNom("Dupont")
//            ->addEmail("dupont@super-univ.fr")
//            ->setTypeEnseignement("lycee")
//            ->setTelFixe("0232010203")
//            ->setUai("uai")
//            ->addContact($c)
//        ;

        return [
            "1 Intervention" => [$i[0]],
            "3 Interventions" => [clone $i[0], clone $i[0], clone $i[0]],
            "1 Intervention with all optional values" => [$i[1]]
        ];
    }

    public function badEntityProvider()
    {
        $i = InterventionMock::createMultiple(6);

        return [
            "Intervention with wrong nbPersonne type"          => [$i[0]->setNbPersonne("ceci n'est pas un nombre")],
        ];
    }
}
