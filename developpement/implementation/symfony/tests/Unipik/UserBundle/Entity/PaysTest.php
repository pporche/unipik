<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 20/09/16
 * Time: 18:32
 */

namespace Tests\Unipik\UserBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Unipik\UserBundle\Entity\Pays;

class PaysTest extends KernelTestCase {

    public function testCreate() {
        self::bootKernel();

        return PaysMock::createPays();
    }

    public function provider() {
        $p = PaysMock::createPays();

        return [
            "1 Pays" => [$p],
            "3 Pays" => [clone $p, clone $p, clone $p]
        ];
    }


    /**
     * @dataProvider provider
     */
    public function testPersist(Pays $p) {
        self::bootKernel();

        $em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $em->persist($p);
        $em->flush();
    }

    /**
     * @dataProvider provider
     * @depends testPersist
     */
    public function testRetrieve(Pays $p) {
        self::bootKernel();

        $em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $repository = $em->getRepository('UserBundle:Pays');
        return $repository->findOneBy(array('id' => $p->getId()));
    }

    /**
     * @depends testRetrieve
     * @dataProvider provider
     */
    public function testRemove(Pays $p) {
        self::bootKernel();

        $em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $em->remove($p);
        $em->flush();
    }
}
