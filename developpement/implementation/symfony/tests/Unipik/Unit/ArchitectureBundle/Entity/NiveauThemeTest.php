<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 23/09/16
 * Time: 09:15
 */

namespace Tests\Unipik\Unit\UserBundle\Entity;

use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\NiveauThemeMock;
use Unipik\ArchitectureBundle\Entity\NiveauTheme;
use Tests\Unipik\Unit\Utils\EntityTestCase;
use \Tests\Unipik\Unit\UserBundle\Entity\Mocks\ComiteMock;

class NiveauThemeTest extends EntityTestCase
{

    protected static $repository = "ArchitectureBundle:NiveauTheme";

    public static function testCreate()
    {
        self::bootKernel();

        $nt = NiveauThemeMock::create();

        return $nt;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(NiveauTheme $nt)
    {
        $this->assertEquals($nt->getId(), null);
        $this->assertEquals($nt->getTheme(), "Droits - Education");
        $this->assertEquals($nt->getNiveau(), "CM1-CM2");

        $nt->setTheme("enfants et soldats");
        $nt->setNiveau("grande section");

        $this->assertEquals($nt->getTheme(), "enfants et soldats");
        $this->assertEquals($nt->getNiveau(), "grande section");

        $c = ComiteMock::create();
        $nt->addComite($c);
        $this->assertEquals($c, $nt->getComites()[0]);
        $nt->removeComite($c);
        $this->assertEquals(null, $nt->getComites()[0]);
    }

    /**
     * @dataProvider badEntityProvider
     * @expectedException \Doctrine\DBAL\Exception\DriverException
     *
     * @TODO: changer la BD pour empêcher que Niveau et theme soient nuls
     */
    public function testBadEntities($e)
    {
        parent::testBadEntities($e);

        $this->markTestIncomplete(
            'Entité NiveauTheme à modifier, niveau et theme ne doivent pas pouvoir être nuls'
        );
    }

    public function badEntityProvider()
    {
        $nt = NiveauThemeMock::createMultiple(5);

        return [
            "NiveauTheme with null niveau" => [$nt[0]->setNiveau(null)],
            "NiveauTheme with bad niveau" => [$nt[1]->setNiveau("Niveau inexistante")],
            "NiveauTheme with null theme" => [$nt[2]->setNiveau(null)],
            "NiveauTheme with bad theme" => [$nt[3]->setTheme("Theme inexistant")],
            "NiveauTheme with wrong niveau type" => [$nt[4]->setNiveau(42)],
        ];
    }
}
