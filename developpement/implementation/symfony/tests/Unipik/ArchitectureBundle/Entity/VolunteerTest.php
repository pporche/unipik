<?php

namespace Tests\Unipik\ArchitectureBundle\Entity;

use Unipik\ArchitectureBundle\Entity\Volunteer;
use Unipik\ArchitectureBundle\Controller\VolunteerController;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class VolunteerTest extends KernelTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

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
     * @param $em
     */
    public function testLol($em)
    {
    	self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

    	$volunteer = new Volunteer();
		$volunteer->setPrenom("onch");

		$em->persist($volunteer);
        $em->flush();
        $products = $this->em
            ->getRepository('ArchitectureBundle:Volunteer')
            ->findOneBy(array('prenom' => 'onch'))
        ;

        $this->assertCount(1, $products);
    }

    /**
     *
     */
    public function testPk() {
        $this->assertTrue(TRUE);

    }


    /**
     * {@inheritDoc}
     */
    protected function tearDown() {
        parent::tearDown();
        $this->em->close();
    }
}
