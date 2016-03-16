<?php

namespace Tests\Unipik\ArchitectureBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Unipik\ArchitectureBundle\Entity\Volunteer;

class VolunteerTest extends KernelTestCase {

    public function testVolunteer() {

        self::bootKernel();

        $em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        // Création du bénévole.
        $volunteer = new Volunteer();
        $volunteer->setNom('Dupont');
        $volunteer->setPrenom('Simone');
        $volunteer->setEmail('dupont.simone@gmail.com');
        $volunteer->setTelPortable('0602030405');
        $volunteer->setTelFixe('0102030405');

        // Ajout en BD.
        $em->persist($volunteer);
        $em->flush();

        // Recupération du repository pour bénévole.
        $volunteerRepository = $em
            ->getRepository('ArchitectureBundle:Volunteer')
        ;

        // On récupère le bénévole en BD.
        $volunteer = $volunteerRepository->findOneBy(array('email' => 'dupont.simone@gmail.com'));

        $this->assertEquals($volunteer->getNom(),'Dupont');
        $this->assertEquals($volunteer->getPrenom(),'Simone');
        $this->assertEquals($volunteer->getTelPortable(),'0602030405');
        $this->assertEquals($volunteer->getTelFixe(),'0102030405');

        $em->remove($volunteer);
        $em->flush();
    }
}
