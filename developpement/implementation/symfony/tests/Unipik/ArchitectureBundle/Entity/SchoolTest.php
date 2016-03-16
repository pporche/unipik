<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 16/03/16
 * Time: 11:27
 */

namespace Tests\Unipik\ArchitectureBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Unipik\ArchitectureBundle\Entity\School;

class SchoolTest extends KernelTestCase {

    public function testSchool() {

        self::bootKernel();

        $em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        // Création d'un établissement.
        $school = new school();
        $school->setNom('INSA');
        $school->setNbEleve('32');
        $school->setVille('Rouen');
        $school->setChefEtablissement('Robert');

        // Ajout en BD.
        $em->persist($school);
        $em->flush();

        // Recupération du repository pour établissement.
        $schoolRepository = $em
            ->getRepository('ArchitectureBundle:School')
        ;

        // On récupère l'établissement en BD.
        $school = $schoolRepository->findOneBy(array('id' => $school->getId()));

        $this->assertEquals($school->getNbEleve(),'32');
        $this->assertEquals($school->getNom(),'INSA');
        $this->assertEquals($school->getVille(),'Rouen');
        $this->assertEquals($school->getChefEtablissement(),'Robert');

        $em->remove($school);
        $em->flush();
    }
}
