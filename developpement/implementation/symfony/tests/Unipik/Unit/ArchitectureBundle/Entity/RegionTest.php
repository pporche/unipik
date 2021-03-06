<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 20/09/16
 * Time: 18:32
 */

namespace Tests\Unipik\Unit\UserBundle\Entity;

use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\PaysMock;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\RegionMock;
use Unipik\ArchitectureBundle\Entity\Region;
use Tests\Unipik\Unit\Utils\EntityTestCase;

class RegionTest extends EntityTestCase
{

    protected static $repository = "ArchitectureBundle:Region";

    public static function testCreate()
    {
        self::bootKernel();

        $r = RegionMock::create();

        return $r;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(Region $r)
    {
        $this->assertEquals($r->getId(), null);
        $this->assertEquals($r->getNom(), "Normandie");

        $r->setNom("Bretagne");
        $p = PaysMock::create();
        $r->setPays($p);

        $this->assertEquals($r->getNom(), "Bretagne");
        $this->assertEquals($r->getPays(), $p);
    }

    public function badEntityProvider()
    {
        $r = RegionMock::createMultiple(3);

        return [
            "Region with null name" => [$r[0]->setNom(null)],
            "Region with bad name" => [$r[2]->setNom("Region inexistante")],
            //"Region with invalid pays type" => [$r->setPays("pays")],
        ];
    }
}
