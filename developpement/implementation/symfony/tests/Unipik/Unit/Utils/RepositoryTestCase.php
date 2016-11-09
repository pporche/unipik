<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 07/11/16
 * Time: 09:15
 */

namespace Tests\Unipik\Unit\Utils;


use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class RepositoryTestCase extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }


    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null; // avoid memory leaks
    }
}
