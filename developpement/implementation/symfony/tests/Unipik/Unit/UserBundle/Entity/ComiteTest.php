<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 22/09/16
 * Time: 15:43
 */

namespace Tests\Unipik\Unit\UserBundle\Entity;

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
