<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 22/09/16
 * Time: 15:43
 */

namespace Tests\Unipik\Unit\UserBundle\Entity;

use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\DepartementMock;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\NiveauThemeMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\BenevoleMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ComiteMock;
use Unipik\UserBundle\Entity\Comite;
use Tests\Unipik\Unit\Utils\EntityTestCase;

class ComiteTest extends  EntityTestCase
{
    protected static $repository = "UserBundle:Comite";

    public static function testCreate()
    {
        self::bootKernel();

        $c = ComiteMock::create();

        return $c;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(Comite $c)
    {
        $this->assertEquals($c->getId(), null);

        $b = BenevoleMock::create();

        $c->addBenevole($b);
        $this->assertEquals($b, $c->getBenevole()[0]);
        $c->removeBenevole($b);
        $this->assertEquals(null, $c->getBenevole()[0]);

        $d = DepartementMock::create();

        $c->addDepartement($d);
        $this->assertEquals($d, $c->getDepartement()[0]);
        $c->removeDepartement($d);
        $this->assertEquals(null, $c->getDepartement()[0]);

        $nt = NiveauThemeMock::create();

        $c->addNiveauTheme($nt);
        $this->assertEquals($nt, $c->getNiveauTheme()[0]);
        $c->removeNiveauTheme($nt);
        $this->assertEquals(null, $c->getNiveauTheme()[0]);
    }

    public function badEntityProvider()
    {
        $c1 = ComiteMock::create();

        return [
            //"comite with null departement" => [$c1->addDepartement(null)]
            "null" => [null]
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
