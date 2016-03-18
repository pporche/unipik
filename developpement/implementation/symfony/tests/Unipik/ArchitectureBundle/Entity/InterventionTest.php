<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 16/03/16
 * Time: 11:11
 */

namespace Tests\Unipik\ArchitectureBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Unipik\ArchitectureBundle\Entity\Intervention;

class InterventionTest extends KernelTestCase {

    public function testIntervention() {

        self::bootKernel();

        $em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        // Création d'une intervention.
        $intervention = new Intervention();
        $intervention->setMaterielDispo('TBI');
        $intervention->setRemarques('');
        $intervention->setLieu('Rouen');
        $intervention->setNbPersonnes('25');
        $intervention->setMoment('Matin');

        // Ajout en BD.
        $em->persist($intervention);
        $em->flush();

        // Recupération du repository pour intervention.
        $interventionRepository = $em
            ->getRepository('ArchitectureBundle:Intervention')
        ;

        // On récupère l'intervention en BD.
        $intervention = $interventionRepository->findOneBy(array('id' => $intervention->getId()));

        $this->assertEquals($intervention->getMaterielDispo(),'TBI');
        $this->assertEquals($intervention->getRemarques(),'');
        $this->assertEquals($intervention->getLieu(),'Rouen');
        $this->assertEquals($intervention->getNbPersonnes(),'25');
        $this->assertEquals($intervention->getMoment(),'Matin');

        $em->remove($intervention);
        $em->flush();
    }
}
