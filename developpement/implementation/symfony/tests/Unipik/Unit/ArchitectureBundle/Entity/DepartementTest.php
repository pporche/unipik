<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 05/10/16
 * Time: 17:32
 */

namespace Tests\Unipik\Unit\UserBundle\Entity;

use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\DepartementMock;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\RegionMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ComiteMock;
use Unipik\ArchitectureBundle\Entity\Departement;
use Tests\Unipik\Unit\Utils\EntityTestCase;

class DepartementTest extends EntityTestCase {

    protected static $repository = "ArchitectureBundle:Departement";

    public static function testCreate() {
        self::bootKernel();

        $d = DepartementMock::create();

        return $d;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(Departement $d) {
        $this->assertEquals(null, $d->getId());
        $this->assertEquals("Eure", $d->getNom());
        $this->assertEquals("27", $d->getNumero());

        $r = RegionMock::create();

        $d
            ->setNom("Seine-Maritime")
            ->setNumero("76")
            ->setRegion($r)
        ;

        $this->assertEquals("Seine-Maritime", $d->getNom());
        $this->assertEquals("76", $d->getNumero());
        $this->assertEquals($r, $d->getRegion());

        $c = ComiteMock::create();
        $d->addComite($c);
        $this->assertEquals($c, $d->getComite()[0]);
        $d->removeComite($c);
        $this->assertEquals(null, $d->getComite()[0]);
    }

    public function badEntityProvider() {
        $d = DepartementMock::createMultiple(2);

        return [
            "Departement with null name" => [$d[0]->setNom(null)],
            "Departement with bad name" => [$d[1]->setNom("Departement inexistante")],
        ];
    }
}
