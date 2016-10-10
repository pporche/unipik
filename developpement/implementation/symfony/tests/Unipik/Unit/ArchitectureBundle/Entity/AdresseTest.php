<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 05/10/16
 * Time: 17:49
 */

namespace Tests\Unipik\Unit\UserBundle\Entity;

use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\AdresseMock;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\CodePostalMock;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\RegionMock;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\VilleMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ComiteMock;
use Unipik\ArchitectureBundle\Entity\Adresse;
use Tests\Unipik\Unit\Utils\EntityTestCase;

class AdresseTest extends EntityTestCase {

    protected static $repository = "ArchitectureBundle:Adresse";

    public static function testCreate() {
        self::bootKernel();

        $a = AdresseMock::create();

        return $a;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(Adresse $a) {
        $this->assertEquals(null, $a->getId());
        $this->assertEquals("22 rue du gros", $a->getAdresse());

        $v = VilleMock::create();
        $cp = CodePostalMock::create();

        $a
            ->setVille($v)
            ->setCodePostal($cp)
            ->setComplement("4ème étage, appartement 34B")
            ->setGeolocalisation("truc")
        ;


        $this->assertEquals($v, $a->getVille());
        $this->assertEquals($cp, $a->getCodePostal());
        $this->assertEquals("4ème étage, appartement 34B", $a->getComplement());
        $this->assertEquals("truc", $a->getGeolocalisation());
    }

    public function badEntityProvider() {
        $a = AdresseMock::createMultiple(2);
        $longName = str_repeat("a", 501);

        return [
            "Adresse with null name" => [$a[0]->setAdresse(null)],
            "Adresse with too long adresse" => [$a[1]->setAdresse($longName)],
        ];
    }
}
