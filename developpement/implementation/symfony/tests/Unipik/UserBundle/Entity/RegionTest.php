<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 20/09/16
 * Time: 18:32
 */

namespace Tests\Unipik\UserBundle\Entity;

use Unipik\UserBundle\Entity\Region;
use Tests\Unipik\Utils\EntityTestCase;

class RegionTest extends EntityTestCase {

    protected static $repository = "UserBundle:Region";

    public static function testCreate() {
        self::bootKernel();

        $p = new Region();
        $p
            ->setNom("Aquitaine Limousin Poitou-Charentes")
            ->setPays(PaysTest::testCreate())
        ;

        return $p;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(Region $p) {
        $this->assertEquals($p->getId(), null);
        $this->assertEquals($p->getNom(), "Aquitaine Limousin Poitou-Charentes");

        $p->setNom("Bretagne");

        $this->assertEquals($p->getNom(),"Bretagne");
    }

    public function badEntityProvider() {
        $p1 = $this->testCreate();
        $p2 = clone $p1;

        return [
            "Region with null name" => [$p1->setNom(null)],
            "Region with null pays" => [$p2->setPays(null)]
        ];
    }
}
