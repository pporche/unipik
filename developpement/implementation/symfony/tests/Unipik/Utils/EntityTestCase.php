<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 22/09/16
 * Time: 09:02
 */

namespace Tests\Unipik\Utils;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class EntityTestCase extends KernelTestCase {

    protected static $repository = "";

    public function provider() {
        $e = $this->testCreate();

        return [
            "1 Entity" => [$e],
            "3 Entities" => [clone $e, clone $e, clone $e]
        ];
    }


    /**
     * @dataProvider provider
     */
    public function testPersist($e) {
        self::bootKernel();

        $em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $em->persist($e);
        $em->flush();
    }

    /**
     * @depends testPersist
     */
    public function testRetrieve() {
        self::bootKernel();

        $em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $repository = $em->getRepository(static::$repository);
        return $repository->findAll();
    }

    /**
     * @depends testRetrieve
     * @dataProvider provider
     */
    public function testRemove($e) {
        self::bootKernel();

        $em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $em->remove($e);
        $em->flush();
    }

    /**
     * @dataProvider badEntityProvider
     * @expectedException \Doctrine\DBAL\Exception\DriverException
     */
    public function testBadEntities($e) {
        self::bootKernel();

        $em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
        $em->persist($e);
        $em->flush();
    }
}
