<?php

namespace Tests\Unipik\ArchitectureBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\SecurityBundle\Tests\Functional\WebTestCase;
use Unipik\ArchitectureBundle\Entity\Volunteer;
use Unipik\ArchitectureBundle\Controller\VolunteerController;

class VolunteerTest extends KernelTestCase {






    public function testCreationDUnVolontaireEtAjoutDansLaBD() {

        self::bootKernel();

        $em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $volunteer = new Volunteer();
        $volunteer->setNom('onch');
        $volunteer->setPrenom('tuveuxduponch');
        $volunteer->setEmail('onch@tuVeuxduponch.com');
        $volunteer->setTelPortable('0102030405');
        $volunteer->setTelFixe('0102030405');

        $volunteerRepository = $em
            ->getRepository('ArchitectureBundle:Volunteer')
        ;
        $em->persist($volunteer);
        $em->flush();

        $bidule = $volunteerRepository->findOneBy(array('nom' => 'onch'));
        $this->assertEquals($bidule->getNom(),'onch');
    }


/*
    public function testsetteurEtGetteur() {
        $volunteer = new Volunteer();
        $volunteer->setNom('onch');
        $this->assertEquals($volunteer->getNom(), 'onch');

        $volunteer->setPrenom('tuveuxduponch');
        $this->assertEquals($volunteer->getPrenom(), 'tuveuxduponch');

        $volunteer->setEmail('onch@tuveuxduponch.com');
        $this->assertEquals($volunteer->getEmail(), 'onch@tuveuxduponch.com');

        $volunteer->setTelPortable('0102030405');
        $this->assertEquals($volunteer->getTelPortable(),'0102030405');

        $volunteer->setTelFixe('0102030405');
        $this->assertEquals($volunteer->getTelFixe(),'0102030405');
    }

*/



}
