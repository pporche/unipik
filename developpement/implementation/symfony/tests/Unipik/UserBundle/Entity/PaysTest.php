<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 20/09/16
 * Time: 18:32
 */

namespace Tests\Unipik\UserBundle\Entity;

use Unipik\UserBundle\Entity\Pays;
use Tests\Unipik\Utils\EntityTestCase;

class PaysTest extends EntityTestCase {

    protected static $repository = "UserBundle:Pays";

    public static function testCreate() {
        self::bootKernel();

        $p = new Pays();
        $p->setNom("France");

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
        $p = $this->testCreate();

        return [
            "Pays with null name" => [$p->setNom(null)]
        ];
    }
}
