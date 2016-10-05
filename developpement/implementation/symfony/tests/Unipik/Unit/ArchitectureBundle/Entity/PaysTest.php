<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 20/09/16
 * Time: 18:32
 */

namespace Tests\Unipik\Unit\UserBundle\Entity;

use Unipik\ArchitectureBundle\Entity\Pays;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\PaysMock;
use Tests\Unipik\Unit\Utils\EntityTestCase;

class PaysTest extends EntityTestCase {

    protected static $repository = "ArchitectureBundle:Pays";

    public static function testCreate() {
        self::bootKernel();

        $p = PaysMock::create();

        return $p;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(Pays $p) {
        $this->assertEquals($p->getId(), null);
        $this->assertEquals($p->getNom(), "France");

        $p->setNom("Russie");

        $this->assertEquals($p->getNom(),"Russie");
    }

    public function badEntityProvider() {
        $p = PaysMock::createMultiple(2);
        $longName = str_repeat("a", 101);

        return [
            "Pays with null name" => [$p[0]->setNom(null)],
            "Pays with too long name" => [$p[1]->setNom($longName)]
        ];
    }
}
