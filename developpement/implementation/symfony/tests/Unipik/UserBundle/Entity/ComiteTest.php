<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 22/09/16
 * Time: 15:43
 */

namespace Tests\Unipik\UserBundle\Entity;

use Tests\Unipik\UserBundle\Entity\Mocks\ComiteMock;
use Unipik\UserBundle\Entity\Comite;
use Tests\Unipik\Utils\EntityTestCase;

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
        $c1 = $this->testCreate();

        return [
            "comite with bad departement name" => [$c1->setNomDepartement("departement inexistant")]
        ];
    }
}
