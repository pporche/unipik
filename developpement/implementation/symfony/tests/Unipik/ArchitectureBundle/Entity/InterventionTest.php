<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 16/03/16
 * Time: 11:11
 */

namespace Tests\Unipik\ArchitectureBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Unipik\InterventionBundle\Entity\Intervention;

class InterventionTest extends KernelTestCase {


    public function testCreateIntervention() {
        self::bootKernel();

        $intervention = new Intervention();

        $intervention
            ->setDate(new \DateTime())
            ->setLieu("nulle part")
            ->setNbPersonne(5)
            ->setRemarques("remarques blablabla")
            ->setHeure("05:00")
            ->setRealisee(true)//->setRealisee("réalisé")
            ->setMaterielDispoPlaidoyer("{}")
            ->setNiveauFrimousse("CM1-CM2")
            ->setMateriauxFrimousse("{}")
            ->setDescription("Ma super description")
            //->setNiveauTheme()
            //->setEtablissement()
            //->setComite()
            //->setBenevole()
            //->setDemande()
            ;

        return $intervention;
    }

    /**
     * @depends testCreateIntervention
     */
    public function testPersistIntervention(Intervention $intervention) {
        self::bootKernel();

        $em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $em->persist($intervention);
        $em->flush();
    }

    /**
     * @depends testPersistIntervention
     */
    public function testRetrieveIntervention() {
        $retrievedIntervention = $interventionRepository->findOneBy(array('id' => $intervention->getId()));

    }

    /**
     * @depends testPersistIntervention
     */
    public function testRemoveIntervention() {

         $em->remove($retrievedIntervention);
         $em->flush();
    }

    /*public function testIntervention() {

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
    }*/
}
