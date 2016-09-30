<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 20/09/16
 * Time: 18:32
 */

namespace Tests\Unipik\Unit\UserBundle\Entity;

use Tests\Unipik\Unit\UserBundle\Entity\Mocks\RegionMock;
use Unipik\UserBundle\Entity\Region;
use Tests\Unipik\Unit\Utils\EntityTestCase;

class RegionTest extends EntityTestCase {

    protected static $repository = "UserBundle:Region";

    public static function testCreate() {
        self::bootKernel();

        $r = RegionMock::create();

        return $r;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(Region $r) {
        $this->assertEquals($r->getId(), null);
        $this->assertEquals($r->getNom(), "Aquitaine Limousin Poitou-Charentes");

        $r->setNom("Bretagne");
        $p = PaysTest::testCreate();
        $r->setPays($p);

        $this->assertEquals($r->getNom(),"Bretagne");
        $this->assertEquals($r->getPays(), $p);
    }

    public function badEntityProvider() {
        $r = RegionMock::create();

        return [
            "Region with null name" => [$r[0]->setNom(null)],
            //"Region with null pays" => [$r[1]->setPays(null)],
            "Region with bad name" => [$r[2]->setNom("Region inexistante")]
        ];
    }
}
