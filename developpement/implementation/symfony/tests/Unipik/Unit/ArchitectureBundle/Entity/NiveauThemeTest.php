<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 23/09/16
 * Time: 09:15
 */


use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\NiveauThemeMock;
use Unipik\ArchitectureBundle\Entity\NiveauTheme;
use Tests\Unipik\Unit\Utils\EntityTestCase;

class NiveauThemeTest extends EntityTestCase {

    protected static $repository = "ArchitectureBundle:NiveauTheme";

    public static function testCreate() {
        self::bootKernel();

        $nt = NiveauThemeMock::create();

        return $nt;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(NiveauTheme $nt) {
        $this->assertEquals($nt->getId(), null);
        $this->assertEquals($nt->getTheme(), "convention internationale des droits de l enfant");
        $this->assertEquals($nt->getNiveau(), "CM1-CM2");

        $nt->setTheme("enfants et soldats");
        $nt->setNiveau("grande section");

        $this->assertEquals($nt->getTheme(),"enfants et soldats");
        $this->assertEquals($nt->getNiveau(), "grande section");
    }

    public function badEntityProvider() {
        $nt1 = NiveauThemeMock::create();
        $nt2 = clone $nt1;
        $nt3 = clone $nt1;
        $nt4 = clone $nt3;

        return [
            "NiveauTheme with null niveau" => [$nt1->setNiveau(null)],
            "NiveauTheme with bad niveau" => [$nt2->setNiveau("Niveau inexistante")],
            "NiveauTheme with null theme" => [$nt3->setNiveau(null)],
            "NiveauTheme with bad theme" => [$nt4->setTheme("Theme inexistant")],
        ];
    }
}
