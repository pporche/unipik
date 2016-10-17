<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 06/10/16
 * Time: 08:20
 */

namespace Tests\Unipik\Unit\InterventionBundle\Entity;

use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\AdresseMock;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\NiveauThemeMock;
use Tests\Unipik\Unit\InterventionBundle\Entity\Mocks\DemandeMock;
use Tests\Unipik\Unit\InterventionBundle\Entity\Mocks\EtablissementMock;
use Tests\Unipik\Unit\InterventionBundle\Entity\Mocks\InterventionMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\BenevoleMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ComiteMock;
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
        $this->assertEquals(null,   $i->getId());
        $this->assertEquals(7,      $i->getNbPersonne());
        $this->assertEquals(false,  $i->isRealisee());

        $b = BenevoleMock::create();
        $c = ComiteMock::create();
        $d = DemandeMock::create();
        $e = EtablissementMock::create();
        $nt = NiveauThemeMock::create();

        $i
            ->setBenevole($b)
            ->setComite($c)
            ->setDemande($d)
            ->setEtablissement($e)
            ->setNiveauTheme($nt)
            ->setNbPersonne(15)
            ->setRealisee(true)
            ->setDateIntervention(new \DateTime('2010-10-10'))
            ->setHeure("18:00")
            ->setLieu("nulle part")
            ->setRemarques("remarque très intéressante")
            ->setNiveauFrimousse("CE2-CM1");


        $this->assertEquals($d,                             $i->getDemande());
        $this->assertEquals($c,                             $i->getComite());
        $this->assertEquals($e,                             $i->getEtablissement());
        $this->assertEquals($b,                             $i->getBenevole());
        $this->assertEquals($nt,                            $i->getNiveauTheme());
        $this->assertEquals(15,                             $i->getNbPersonne());
        $this->assertEquals(true,                           $i->isRealisee());
        $this->assertEquals(new \DateTime('2010-10-10'),    $i->getDateIntervention());
        $this->assertEquals("18:00",                        $i->getHeure());
        $this->assertEquals("nulle part",                   $i->getLieu());
        $this->assertEquals("remarque très intéressante",   $i->getRemarques());
        $this->assertEquals("CE2-CM1",                      $i->getNiveauFrimousse());

        $this->assertEquals(false,                          $i->isPlaidoyer());
        $i->addMaterielDispoPlaidoyer("videoprojecteur");
        $this->assertEquals("videoprojecteur", $i->getMaterielDispoPlaidoyer()[0]);
        $this->assertEquals(true,                           $i->isPlaidoyer());
        $i->removeMaterielDispoPlaidoyer("videoprojecteur");
        $this->assertEquals(null, $i->getMaterielDispoPlaidoyer()[0]);
        $this->assertEquals(false,                          $i->isPlaidoyer());


        $this->assertEquals(false,                          $i->isFrimousse());
        $i->addMateriauxFrimousse("patron");
        $this->assertEquals("patron", $i->getMateriauxFrimousse()[0]);
        $this->assertEquals(true,                           $i->isFrimousse());
        $i->removeMateriauxFrimousse("patron");
        $this->assertEquals(null, $i->getMateriauxFrimousse()[0]);
        $this->assertEquals(false,                          $i->isFrimousse());


        $this->assertEquals(false,                           $i->isAutreIntervention());
        $i->setDescription("Long texte de description");
        $this->assertEquals("Long texte de description",    $i->getDescription());
        $this->assertEquals(true,                           $i->isAutreIntervention());
        $i->setDescription("");
        $this->assertEquals("",    $i->getDescription());
        $this->assertEquals(false,                           $i->isAutreIntervention());

    }

    public function validEntityProvider() 
    {
        $i = InterventionMock::createMultiple(3);
        $c = ContactMock::create();

        $b = BenevoleMock::create();
        $c = ComiteMock::create();
        $d = DemandeMock::create();
        $e = EtablissementMock::create();
        $nt = NiveauThemeMock::create();

        $i[2]
            ->setBenevole($b)
            ->setComite($c)
            ->setDemande($d)
            ->setEtablissement($e)
            ->setNiveauTheme($nt)
            ->setNbPersonne(15)
            ->setRealisee(true)
            ->setDateIntervention(new \DateTime('2010-10-10'))
            ->setHeure("18:00")
            ->setLieu("nulle part")
            ->setRemarques("remarque très intéressante");

        $frimousse = clone $i[2];
        $plaidoyer = clone $i[2];
        $autre     = clone $i[2];

        $frimousse
            ->setNiveauFrimousse("CE2-CM1")
            ->addMateriauxFrimousse("patron");
        ;

        $plaidoyer
            ->addMaterielDispoPlaidoyer("videoprojecteur");

        $autre
            ->setDescription("Long texte de description");

        return [
            "1 Intervention"                        => [$i[0]],
            "3 Interventions"                       => [clone $i[0], clone $i[0], clone $i[0]],
            "1 Frimousse with all optional values"  => [$frimousse],
            "1 Plaidoyer with all optional values"  => [$plaidoyer],
            "1 Autre with all optional values"      => [$autre]
        ];
    }

    public function badEntityProvider()
    {
        $i = InterventionMock::createMultiple(4);

        return [
            "Intervention with wrong nbPersonne type"          => [$i[0]->setNbPersonne("ceci n'est pas un nombre")],
            "Intervention with wrong NiveauFrimousse"          => [$i[1]->setNiveauFrimousse("niveau inexistant")],
            "Intervention with wrong materiel dispo"           => [$i[2]->addMaterielDispoPlaidoyer("materiel non existant")],
            "Intervention with wrong materiaux"                => [$i[3]->addMateriauxFrimousse("materiaux non existant")],
        ];
    }
}
