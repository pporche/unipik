<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 06/10/16
 * Time: 16:41
 */

namespace Tests\Unipik\Unit\InterventionBundle\Entity;

use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\AdresseMock;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\MomentHebdomadaireMock;
use Tests\Unipik\Unit\InterventionBundle\Entity\Mocks\EtablissementMock;
use Tests\Unipik\Unit\InterventionBundle\Entity\Mocks\InterventionMock;
use Tests\Unipik\Unit\InterventionBundle\Entity\Mocks\VenteMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ContactMock;
use Unipik\InterventionBundle\Entity\Vente;
use Tests\Unipik\Unit\Utils\EntityTestCase;

class VenteTest extends  EntityTestCase
{
    protected static $repository = "InterventionBundle:Vente";

    public static function testCreate()
    {
        self::bootKernel();

        $v = VenteMock::create();

        return $v;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(Vente $v)
    {
        $this->assertEquals(null, $v->getId());
        $this->assertEquals(4.22, $v->getChiffreAffaire());
        $this->assertEquals(new \DateTime('2000-01-01'), $v->getDateVente());


        $i = InterventionMock::create();
        $e = EtablissementMock::create();

        $v
            ->setChiffreAffaire(4.04)
            ->setDateVente(new \DateTime('2010-10-10'))
            ->setRemarques("Remarque très intéressante")
            ->setIntervention($i)
            ->setEtablissement($e);


        $this->assertEquals(4.04, $v->getChiffreAffaire());
        $this->assertEquals(new \DateTime('2010-10-10'), $v->getDateVente());
        $this->assertEquals("Remarque très intéressante", $v->getRemarques());
        $this->assertEquals($i, $v->getIntervention());
        $this->assertEquals($e, $v->getEtablissement());

    }

    public function validEntityProvider() 
    {
        $v = VenteMock::createMultiple(2);

        $i = InterventionMock::create();
        $e = EtablissementMock::create();

        $v[1]
            ->setChiffreAffaire(4.04)
            ->setDateVente(new \DateTime('2010-10-10'))
            ->setRemarques("Remarque très intéressante")
            ->setIntervention($i)
            ->setEtablissement($e);

        return [
            "1 Vente" => [$v[0]],
            "3 Ventes" => [clone $v[0], clone $v[0], clone $v[0]],
            "1 Vente with all optional values" => [$v[1]]
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
