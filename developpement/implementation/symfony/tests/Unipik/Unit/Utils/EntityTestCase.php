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

abstract class EntityTestCase extends KernelTestCase
{

    protected static $repository = "";

    protected static $em;

    public function setUp()
    {
        parent::setUp();
        self::bootKernel();

        static::$em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    protected function tearDown()
    {
        parent::tearDown();
        //static::$em->rollBack();
    }

    public function validEntityProvider()
    {
        $e = $this->testCreate();

        return [
            "1 Entity" => [$e],
            "3 Entities" => [[clone $e, clone $e, clone $e]]
        ];
    }


    /**
     * @dataProvider validEntityProvider
     */
    public function testPersist($entities)
    {
        // Begin transaction
        self::bootKernel();
        static::$em->beginTransaction();

        // test Persist
        foreach ($entities as $e) {
            static::$em->persist($e);
        }
        static::$em->flush();

        // test retrieve
        $entities = array();
        foreach ($entities as $e) {
            $repository = static::$em->getRepository(static::$repository);
            array_push($entities, $repository->find($e->getId()));
        }

        // test remove
        foreach ($entities as $e) {
            static::$em->remove($e);
        }
        static::$em->flush();

        // rollBack
        static::$em->rollBack();
    }

    /**
     * @dataProvider badEntityProvider
     */
    public function testBadEntities($e)
    {
        self::bootKernel();
        static::$em->beginTransaction();

        try{
            static::$em->persist($e);
            static::$em->flush();
        } catch (\Doctrine\DBAL\Exception\DriverException $e){

        } catch (\Doctrine\ORM\ORMInvalidArgumentException $e){

        } catch (Exception $e) {
            $this->hasFailed();
        }

        static::$em->rollBack();
    }
}
