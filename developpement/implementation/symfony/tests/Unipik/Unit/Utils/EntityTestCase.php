<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 22/09/16
 * Time: 09:02
 */

namespace Tests\Unipik\Unit\Utils;

use Prophecy\Exception\Exception;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class EntityTestCase extends KernelTestCase {

    protected static $repository = "";

    public function validEntityProvider() {
        $e = $this->testCreate();

        return [
            "1 Entity" => [$e],
            "3 Entities" => [clone $e, clone $e, clone $e]
        ];
    }


    /**
     * @dataProvider validEntityProvider
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
     * @dataProvider validEntityProvider
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
     */
    public function testBadEntities($e) {
        self::bootKernel();

        try{
            $em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();
            $em->persist($e);
            $em->flush();
        } catch (\Doctrine\DBAL\Exception\DriverException $e){

        } catch (\Doctrine\ORM\ORMInvalidArgumentException $e){

        } catch (Exception $e) {
            $this->hasFailed();
        }
    }
}
