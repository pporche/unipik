<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 05/10/16
 * Time: 17:17
 */


namespace Tests\Unipik\Unit\UserBundle\Entity;

use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\CodePostalMock;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\DepartementMock;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\VilleMock;
use Unipik\ArchitectureBundle\Entity\CodePostal;
use Tests\Unipik\Unit\Utils\EntityTestCase;

class CodePostalTest extends EntityTestCase {

    protected static $repository = "ArchitectureBundle:CodePostal";

    public static function testCreate() {
        self::bootKernel();

        $cp = CodePostalMock::create();

        return $cp;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(CodePostal $cp) {
        $this->assertEquals(null, $cp->getId());
        $this->assertEquals("76000", $cp->getCode());

        $d = DepartementMock::create();

        $cp
            ->setCode("27000")
            ->setDepartement($d);

        $this->assertEquals("27000", $cp->getCode());
        $this->assertEquals($d, $cp->getDepartement());

        $r = VilleMock::create();
        $cp->addVille($r);
        $this->assertEquals($r, $cp->getVille()[0]);
        $cp->removeVille($r);
        $this->assertEquals(null, $cp->getVille()[0]);
    }

    public function badEntityProvider() {
        $cp = CodePostalMock::createMultiple(2);

        return [
            "Code postal with null name" => [$cp[0]->setCode(null)],
            "Code postal with incorrect type" => [$cp[1]->setCode("blabla")]
        ];
    }
}
