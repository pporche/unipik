<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 06/10/16
 * Time: 08:30
 */


namespace Tests\Unipik\Unit\InterventionBundle\Entity;

use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\AdresseMock;
use Tests\Unipik\Unit\InterventionBundle\Entity\Mocks\DemandeMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ContactMock;
use Unipik\InterventionBundle\Entity\Demande;
use Tests\Unipik\Unit\Utils\EntityTestCase;

class DemandeTest extends  EntityTestCase
{
    protected static $repository = "InterventionBundle:Demande";

    public static function testCreate()
    {
        self::bootKernel();

        $d = DemandeMock::create();

        return $d;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(Demande $d)
    {
        $this->assertEquals(null, $d->getId());

//        $d->setNom("College trucmuche")
//            ->setTelFixe("0232010203")
//            ->setUai("uai") //Aucune vérification sur l'UAI: normal
//            ->setTypeEnseignement("lycee")
//            ->setTypeCentre("adolescent")
//            ->setTypeAutreDemande("autre")
//        ;
//
//        $ad = AdresseMock::create();
//        $d->setAdresse($ad);
//
//        $this->assertEquals("College trucmuche",    $d->getNom());
//        $this->assertEquals("0232010203",           $d->getTelFixe());
//        $this->assertEquals("uai",                  $d->getUai());
//        $this->assertEquals("lycee",                $d->getTypeEnseignement());
//        $this->assertEquals("adolescent",           $d->getTypeCentre());
//        $this->assertEquals("autre",                $d->getTypeAutreDemande());
//        $this->assertEquals($ad,                    $d->getAdresse());
//        $this->assertEquals(true,                   $d->isEnseignement());
//        $this->assertEquals(true,                   $d->isCentreLoisirs());
//        $this->assertEquals(true,                   $d->isAutreDemande());
//
//        $d->addEmail("dupont@topmail.com");
//        $this->assertEquals("dupont@topmail.com", $d->getEmails()[1]);
//        $d->removeEmail("dupont@topmail.com");
//        $this->assertEquals(null, $d->getEmails()[1]);
//        $d->addEmail("dupont@topmail.com");
//        $d->addEmail("test@test.test");
//        $d->addEmail("truc@truc.truc");
//        $d->removeAllEmails();
//        $this->assertEquals(null, $d->getEmails()[0]);
//        $this->assertEquals(null, $d->getEmails()[1]);
//        $this->assertEquals(null, $d->getEmails()[2]);
//        $this->assertEquals(null, $d->getEmails()[3]);
//
//        $c = ContactMock::create();
//        $d->addContact($c);
//        $this->assertEquals($c, $d->getContacts()[0]);
//        $d->removeContact($c);
//        $this->assertEquals(null, $d->getContacts()[0]);
    }

    public function validEntityProvider() {
        $d = DemandeMock::createMultiple(2);
        $c = ContactMock::create();

//        $d[1]->setNom("Dupont")
//            ->addEmail("dupont@super-univ.fr")
//            ->setTypeEnseignement("lycee")
//            ->setTelFixe("0232010203")
//            ->setUai("uai")
//            ->addContact($c)
//        ;

        return [
            "1 Demande" => [$d[0]],
            "3 Demandes" => [clone $d[0], clone $d[0], clone $d[0]],
            "1 Demande with all optional values" => [$d[1]]
        ];
    }

    public function badEntityProvider()
    {
        return [
            [null]
            //
        ];
    }

    /**
     * @dataProvider badEntityProvider
     */
    public function testBadEntities($e) {
        $this->assertTrue(true);
    }
}
