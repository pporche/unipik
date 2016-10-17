<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 05/10/16
 * Time: 18:26
 */

namespace Tests\Unipik\Unit\UserBundle\Entity;

use Unipik\ArchitectureBundle\Entity\MomentHebdomadaire;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\MomentHebdomadaireMock;
use Tests\Unipik\Unit\Utils\EntityTestCase;

class MomentHebdomadaireTest extends EntityTestCase
{

    protected static $repository = "ArchitectureBundle:MomentHebdomadaire";

    public static function testCreate() 
    {
        self::bootKernel();

        $mh = MomentHebdomadaireMock::create();

        return $mh;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(MomentHebdomadaire $mh) 
    {
        $this->assertEquals($mh->getId(), null);
        $this->assertEquals("mardi", $mh->getJour());
        $this->assertEquals("soir", $mh->getMoment());

        $mh
            ->setJour("lundi")
            ->setMoment("matin");

        $this->assertEquals("lundi", $mh->getJour());
        $this->assertEquals("matin", $mh->getMoment());
    }

    public function validEntityProvider() 
    {
        $mh = MomentHebdomadaireMock::createMultiple(2);

        $mh[1]
            ->setJour("lundi")
            ->setMoment("matin");

        return [
            "1 MomentHebdomadaire" => [$mh[0]],
            "3 MomentHebdomadaires" => [clone $mh[0], clone $mh[0], clone $mh[0]],
            "1 MomentHebdomadaire with all optional values" => [$mh[1]]
        ];
    }

    public function badEntityProvider() 
    {
        $mh = MomentHebdomadaireMock::createMultiple(2);

        return [
            "MomentHebdomadaire with wrong jour"    => [$mh[0]->setJour("jour inexistante")],
            "MomentHebdomadaire with wrong moment"  => [$mh[1]->setMoment("moment inexistante")],
        ];
    }
}
