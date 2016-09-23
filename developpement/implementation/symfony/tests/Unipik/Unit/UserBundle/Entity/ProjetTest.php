<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 22/09/16
 * Time: 15:11
 */

namespace Tests\Unipik\Unit\UserBundle\Entity;

use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ProjetMock;
use Unipik\UserBundle\Entity\Projet;
use Tests\Unipik\Unit\Utils\EntityTestCase;

class ProjetTest extends EntityTestCase
{
    protected static $repository = "UserBundle:Projet";

    public static function testCreate() {
        self::bootKernel();

        $p = ProjetMock::create();

        return $p;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(Projet $p) {
        $this->assertEquals($p->getId(), null);
        $this->assertEquals($p->getNom(), "Aquitaine Limousin Poitou-Charentes");

        $p->setNom("Bretagne");
        $p->setChiffreAffaire(102.5);
        $p->setRemarques("Très long texte.");
        $p->setType("superieur");

        $this->assertEquals($p->getNom(),"Bretagne");
        $this->assertEquals($p->getChiffreAffaire(), 102.5);
        $this->assertEquals($p->getRemarques(), "Très long texte.");
        $this->assertEquals($p->getType(), "superieur");

    }

    public function badEntityProvider() {
        $p1 = ProjetMock::create();
        $p2 = clone $p1;
        $longName = str_repeat("a", 1001);
        $p3 = clone $p1;

        return [
            "Projet with null name" => [$p1->setNom(null)],
            "Projet with long name" => [$p2->setNom($longName)],
            "Projet with wrong type chiffre_affaire" => [$p3->setChiffreAffaire("chaine de caractère")],
        ];
    }

}
