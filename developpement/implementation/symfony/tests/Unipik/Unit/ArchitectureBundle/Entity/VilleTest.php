<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 20/09/16
 * Time: 18:32
 */

namespace Tests\Unipik\Unit\UserBundle\Entity;

use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\CodePostalMock;
use Unipik\ArchitectureBundle\Entity\Ville;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\VilleMock;
use Tests\Unipik\Unit\Utils\EntityTestCase;

class VilleTest extends EntityTestCase
{

    protected static $repository = "ArchitectureBundle:Ville";

    public static function testCreate() 
    {
        self::bootKernel();

        $v = VilleMock::create();

        return $v;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(Ville $v) 
    {
        $this->assertEquals($v->getId(), null);
        $this->assertEquals($v->getNom(), "Rouen");

        $v->setNom("Paris");

        $this->assertEquals($v->getNom(), "Paris");

        $c = CodePostalMock::create();
        $v->addCodePostal($c);
        $this->assertEquals($c, $v->getCodePostal()[0]);
        $v->removeCodePostal($c);
        $this->assertEquals(null, $v->getCodePostal()[0]);
    }

    public function badEntityProvider() 
    {
        $v = VilleMock::createMultiple(2);
        $longName = str_repeat("a", 101);

        return [
            "Ville with null name" => [$v[0]->setNom(null)],
            "Ville with too long name" => [$v[1]->setNom($longName)]
        ];
    }
}
