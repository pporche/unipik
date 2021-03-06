<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 06/10/16
 * Time: 08:30
 */


namespace Tests\Unipik\Unit\InterventionBundle\Entity;

use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\AdresseMock;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\MomentHebdomadaireMock;
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
        $this->assertEquals(new \DateTime(date('Y').'-12-15'), $d->getDateDebutDisponibilite());
        $this->assertEquals(new \DateTime(date('Y').'-12-30'), $d->getDateFinDisponibilite());
        $this->assertEquals(new \DateTime(date('Y').'-01-01'), $d->getDateDemande());

        $c = ContactMock::create();

        $d
            ->setContact($c)
            ->setDateDemande(new \DateTime('2010-10-10'))
            ->setDateDebutDisponibilite(new \DateTime('2010-01-30'))
            ->setDateFinDisponibilite(new \DateTime('2010-02-15')) ;

        $this->assertEquals($c, $d->getContact());
        $this->assertEquals(new \DateTime('2010-01-30'), $d->getDateDebutDisponibilite());
        $this->assertEquals(new \DateTime('2010-02-15'), $d->getDateFinDisponibilite());
        $this->assertEquals(new \DateTime('2010-10-10'), $d->getDateDemande());


        $mh = MomentHebdomadaireMock::create();

        $d->addMomentsVoulus($mh);
        $this->assertEquals($mh, $d->getMomentsVoulus()[0]);
        $d->removeMomentsVoulus($mh);
        $this->assertEquals(null, $d->getMomentsVoulus()[0]);

        $d->addMomentsAEviter($mh);
        $this->assertEquals($mh, $d->getMomentsAEviter()[0]);
        $d->removeMomentsAEviter($mh);
        $this->assertEquals(null, $d->getMomentsAEviter()[0]);
    }

    public function validEntityProvider()
    {
        $d = DemandeMock::createMultiple(2);
        $mh = MomentHebdomadaireMock::createMultiple(2);

        $d[1]
            ->addMomentsVoulus($mh[0])
            ->addMomentsAEviter($mh[1]);

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
    public function testBadEntities($e)
    {
        $this->assertTrue(true);
    }
}
