<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 20/09/16
 * Time: 18:32
 */

namespace Tests\Unipik\UserBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Unipik\UserBundle\Entity\Region;

class RegionTest extends KernelTestCase {

    public function testCreate() {
        self::bootKernel();

        return RegionMock::createRegion();
    }

    public function provider() {
        $r = RegionMock::createRegion();

        return [
            "1 Region" => [$r],
            "3 Regions" => [clone $r, clone $r, clone $r]
        ];
    }


    /**
     * @dataProvider provider
     */
    public function testPersist(Region $r) {
        self::bootKernel();

        $em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $em->persist($r);
        $em->flush();
    }

    /**
     * @dataProvider provider
     * @depends testPersist
     */
    public function testRetrieve(Region $r) {
        self::bootKernel();

        $em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $repository = $em->getRepository('UserBundle:Region');
        return $repository->findOneBy(array('id' => $r->getId()));
    }

    /**
     * @depends testRetrieve
     * @dataProvider provider
     */
    public function testRemove(Region $r) {
        self::bootKernel();

        $em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $em->remove($r);
        $em->flush();
    }
}
