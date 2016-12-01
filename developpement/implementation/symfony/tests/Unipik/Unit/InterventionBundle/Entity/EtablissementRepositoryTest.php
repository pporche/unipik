<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 07/11/16
 * Time: 09:10
 */

namespace Tests\Unipik\Unit\InterventionBundle\Entity;


use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\CodePostalMock;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\DepartementMock;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\NiveauThemeMock;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\VilleMock;
use Tests\Unipik\Unit\InterventionBundle\Entity\Mocks\DemandeMock;
use Tests\Unipik\Unit\InterventionBundle\Entity\Mocks\EtablissementMock;
use Tests\Unipik\Unit\InterventionBundle\Entity\Mocks\InterventionMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\BenevoleMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ComiteMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ContactMock;
use Unipik\InterventionBundle\Entity\Demande;
use Unipik\InterventionBundle\Form\Etablissement;
use Tests\Unipik\Unit\Utils\RepositoryTestCase;

class EtablissementRepositoryTest extends RepositoryTestCase
{
    public function getTypeDataProvider() {
        $etab = EtablissementMock::createMultiple(10);

        // la ville "Pouic Pouic" a 2 lycées, 3 collèges, 2 centre de loisir et 1 etablissement "autre"

        $etab[0]->setNom("lycée Pouic Pouic");
        $etab[0]->setTypeEnseignement("lycee");

        $etab[1]->setNom("collège Pouic Pouic");
        $etab[1]->setTypeEnseignement("college");

        $etab[2]->setNom("lycée2 Pouic Pouic");
        $etab[2]->setTypeEnseignement("lycee");

        $etab[3]->setNom("collège2 Pouic Pouic");
        $etab[3]->setTypeEnseignement("college");

        $etab[4]->setNom("collège3 Pouic Pouic");
        $etab[4]->setTypeEnseignement("college");

        $etab[5]->setNom("centre de loisir Pouic Pouic");
        $etab[5]->setTypeCentre("elementaire");

        $etab[6]->setNom("maison de retraite Pouic Pouic");
        $etab[6]->setTypeAutreEtablissement("maison de retraite");

        $etab[7]->setNom("centre de loisir2 Pouic Pouic");
        $etab[7]->setTypeCentre("adolescent");

        $etab[8]->setNom("maternelle Pouic Pouic");
        $etab[8]->setTypeEnseignement("maternelle");

        $etab[9]->setNom("centre de loisirs3 Pouic Pouic");
        $etab[9]->setTypeCentre("maternelle");

        return(array(
            "lycées"             => [$etab, "POUIC POUIC", "enseignement", ["lycee"], "nom", true, 2],
            "collèges"           => [$etab, "POUIC POUIC", "enseignement", ["college"], "nom", false, 3],
            "lycées + collèges"  => [$etab, "POUIC POUIC", "enseignement", ["lycee", "college"], "nom", true, 5],
            "centres"            => [$etab, "POUIC POUIC", "centre", ["elementaire"], "nom", true, 1],
            "centres2"           => [$etab, "POUIC POUIC", "centre", ["elementaire"], "nom", false, 1],
            "autres"             => [$etab, "POUIC POUIC", "autreEtablissement", ["maison de retraite"], "", true, 1],
            "autres2"            => [$etab, "POUIC POUIC", "autreEtablissement", ["maison de retraite"], "", false, 1],
            "tout"               => [$etab, "POUIC POUIC", null, ["maternelle", "elementaire", "college", "lycee", "maison de retraite"], "nom", true, 9],
            "tout2"              => [$etab, "POUIC POUIC", null, null, "nom", false, 10],
            "toutes maternelles" => [$etab, "POUIC POUIC", null, ["maternelle"], "nom", false, 2],
            "lycées2"            => [$etab, "POUIC POUIC", "enseignement", ["lycee"], "nom", true, 0, "SRID=4326;POINT(45 69)", "1"]
        ));
    }

    public function getDataProviderAutocomplete() {
        $etab = EtablissementMock::createMultiple(10);

        $etab[0]->setNom("LYCEE POUIC POUIC");
        $etab[0]->setTypeEnseignement("lycee");

        $etab[1]->setNom("COLLEGE POUIC POUIC");
        $etab[1]->setTypeEnseignement("college");

        $etab[2]->setNom("LYCEE ANDREPOUIC");
        $etab[2]->setTypeEnseignement("lycee");

        $etab[3]->setNom("COLLEGE YOUPI");
        $etab[3]->setTypeEnseignement("college");

        $etab[4]->setNom("COLLEGE JOLI JOLI");
        $etab[4]->setTypeEnseignement("college");

        $etab[5]->setNom("CENTRE DE LOISIR RIGOLO");
        $etab[5]->setTypeCentre("elementaire");

        $etab[6]->setNom("MAISON DE RETRAITE DES VIEUX");
        $etab[6]->setTypeAutreEtablissement("maison de retraite");

        $etab[7]->setNom("CENTRE LOISIR RIDICULE");
        $etab[7]->setTypeCentre("adolescent");

        $etab[8]->setNom("MATERNELLE BOUT DE CHOU");
        $etab[8]->setTypeEnseignement("maternelle");

        $etab[9]->setNom("CENTRE DE LOISIR POUIC POUIC");
        $etab[9]->setTypeCentre("maternelle");

        return(array(
            "test1" => [$etab,'POUIC',"COUCOU", "POUIC POUIC",'college',null,null,1],
            "test2" => [$etab,'ZXWT',"COUCOU", "POUIC POUIC",'college',null,null,0],
            "test3" => [$etab,'POUIC',"COUCOU", "POUIC POUIC",'lycee',null,null,2],
            "test4" => [$etab,'E',"COUCOU", "POUIC POUIC",null,null,null,5],
            "test5" => [$etab,'E',"BONJOUR", "NULLE PART",null,null,null,5],
            "test6" => [$etab,'E',"BONJOUR", "NULLE PART",null,'elementaire',null,1],
            "test7" => [$etab,'U',"BONJOUR", "NULLE PART",null,'elementaire',null,0],
            "test8" => [$etab,'CHOU',"BONJOUR", "NULLE PART",null,null,null,1],
            "test9" => [$etab,'POUIC',null, null,null,null,null,4],
            "test10" => [$etab,'POUIC',"BONJOUR", null,null,null,null,1],
            "test11" => [$etab,'RETRAITE',"BONJOUR", "NULLE PART",null,null,'maison de retraite',1],
        ));

    }

    /**
     * @dataProvider getTypeDataProvider
     */
    public function testGetType(
        $etablissements,
        $nomVille,
        $typeEtablissement,
        $type,
        $field,
        $desc,
        $expectedResult,
        $geolocalisation = null,
        $distance = null
    ) {
        // Begin transaction
        $this->em->beginTransaction();

        // Persist
        $ville = VilleMock::create();
        $ville->setNom($nomVille);
        foreach ($etablissements as $e) {
            $e->getAdresse()->setVille($ville);
            $this->em->persist($e);
        }
        $this->em->flush();
        $this->em->clear();

        // get ville
        $ville = $this->em
            ->getRepository('ArchitectureBundle:Ville')
            ->findOneBy(array(
                'nom' => $nomVille,
            ))
        ;

        // Test
        $result = $this->em
            ->getRepository('InterventionBundle:Etablissement')
            /*->getTypeIntervention($typeEtablissement, $typeEnseignement, $typeCentre, $typeAutre, $ville, "nom", $desc)*/
            ->getType($typeEtablissement, $type, $ville, $field, $desc, $geolocalisation, $distance)
        ;

        $this->assertCount($expectedResult, $result);

        // Rollback
        $this->em->rollBack();
    }

    /**
     * @param $typeEtablissement
     * @param $type
     * @param $ville
     *
     * @dataProvider getDataProviderAutocomplete
     */
    public function testEtablissementAutocomplete(
        $etablissements,
        $term,
        $dep,
        $ville,
        $typeEns,
        $typeCentre,
        $typeAutre,
        $expected
    ) {
        // Begin transaction
        $this->em->beginTransaction();

        // Persit
        $departements = DepartementMock::createMultiple(2);

        $departements[0]->setNom("COUCOU");
        $departements[1]->setNom("BONJOUR");

        $villes = VilleMock::createMultiple(2);

        $villes[0]->setNom("POUIC POUIC");
        $villes[1]->setNom("NULLE PART");

        $codes = CodePostalMock::createMultiple(2);

        foreach($departements as $d){
            $this->em->persist($d);
        }
        foreach($villes as $v){
            $this->em->persist($v);
        }
        $codes[0]->addVille($villes[0])->setCode('99123')->setDepartement($departements[0]);
        $codes[1]->addVille($villes[1])->setCode('99456')->setDepartement($departements[1]);
        foreach($codes as $c){
            $this->em->persist($c);
        }
        $etablissements[0]->getAdresse()->setVille($villes[0]);
        $etablissements[1]->getAdresse()->setVille($villes[0]);
        $etablissements[2]->getAdresse()->setVille($villes[0]);
        $etablissements[3]->getAdresse()->setVille($villes[0]);
        $etablissements[4]->getAdresse()->setVille($villes[0]);
        $etablissements[5]->getAdresse()->setVille($villes[1]);
        $etablissements[6]->getAdresse()->setVille($villes[1]);
        $etablissements[7]->getAdresse()->setVille($villes[1]);
        $etablissements[8]->getAdresse()->setVille($villes[1]);
        $etablissements[9]->getAdresse()->setVille($villes[1]);
        foreach($etablissements as $e) {
            $this->em->persist($e);
        }

        $this->em->flush();

        // Test
        $result = $this->em
            ->getRepository('InterventionBundle:Etablissement')
            ->etablissementAutocomplete($term, $dep, $ville, $typeEns, $typeCentre, $typeAutre )
        ;


        $this->assertCount($expected, $result);


        // Rollback
        $this->em->rollBack();
    }

    public function GetTypeAndNoInterventionThisYearDataProvider() {
        $etab = EtablissementMock::createMultiple(10);

        // la ville "Pouic Pouic" a 2 lycées, 3 collèges, 2 centre de loisir et 1 etablissement "autre"

        $etab[0]->setNom("lycée Pouic Pouic");
        $etab[0]->setTypeEnseignement("lycee");

        $etab[1]->setNom("collège Pouic Pouic");
        $etab[1]->setTypeEnseignement("college");

        $etab[2]->setNom("lycée2 Pouic Pouic");
        $etab[2]->setTypeEnseignement("lycee");

        $etab[3]->setNom("collège2 Pouic Pouic");
        $etab[3]->setTypeEnseignement("college");

        $etab[4]->setNom("collège3 Pouic Pouic");
        $etab[4]->setTypeEnseignement("college");

        $etab[5]->setNom("centre de loisir Pouic Pouic");
        $etab[5]->setTypeCentre("elementaire");

        $etab[6]->setNom("maison de retraite Pouic Pouic");
        $etab[6]->setTypeAutreEtablissement("maison de retraite");

        $etab[7]->setNom("centre de loisir2 Pouic Pouic");
        $etab[7]->setTypeCentre("adolescent");

        $etab[8]->setNom("maternelle Pouic Pouic");
        $etab[8]->setTypeEnseignement("maternelle");

        $etab[9]->setNom("centre de loisirs3 Pouic Pouic");
        $etab[9]->setTypeCentre("maternelle");

        return(array(
            "lycées"            => [$etab, "POUIC POUIC", "enseignement", ["lycee"], 2, "plaidoyer"],
            "collèges"          => [$etab, "POUIC POUIC", "enseignement", ["college"], 3, "frimousse"],
            "lycées + collèges" => [$etab, "POUIC POUIC", "enseignement", ["lycee", "college"], 5, "plaidoyer"],
            "lycées2"            => [$etab, "POUIC POUIC", "enseignement", ["lycee"], 0, "plaidoyer", "SRID=4326;POINT(45 69)", "10"],
            "centres"           => [$etab, "POUIC POUIC", "centre", ["elementaire"], 1],
            "centres2"          => [$etab, "POUIC POUIC", "centre", null, 3],
            "autres"            => [$etab, "POUIC POUIC", "autreEtablissement", ["maison de retraite"], 1],
            "autres2"           => [$etab, "POUIC POUIC", "", ["maison de retraite"], 1],
        ));
    }

    /**
     * @dataProvider GetTypeAndNoInterventionThisYearDataProvider
     */
    public function testGetTypeAndNoInterventionThisYear(
        $etablissements,
        $nomVille,
        $typeEtablissement,
        $type,
        $expectedResult,
        $typeIntervention = null,
        $geolocalisation = null,
        $distance = null
    ) {
        // Begin transaction
        $this->em->beginTransaction();

        $interventions = InterventionMock::createMultiple(3);
        $b = BenevoleMock::create();
        $c = ComiteMock::create();
        $nt = NiveauThemeMock::create();
        $contact = ContactMock::create();

        $d = DemandeMock::createMultiple(3);
        $d[0]->setDateDemande(new \DateTime('2000-01-01'));
        $d[0]->setContact($contact);
        $d[1]->setDateDemande(new \DateTime('1999-10-12'));
        $d[1]->setContact($contact);
        $d[2]->setDateDemande(new \DateTime('1999-04-02'));
        $d[2]->setContact($contact);

        $ville = VilleMock::create();
        $ville->setNom($nomVille);
        foreach ($etablissements as $e) {
            $e->getAdresse()->setVille($ville);
            $this->em->persist($e);
        }
        $this->em->flush();

        $ville = $this->em
            ->getRepository('ArchitectureBundle:Ville')
            ->findOneBy(array(
                'nom' => $nomVille,
            ))
        ;

        $index = -1;
        $interventions[0]->setTypeIntervention("plaidoyer");
        $interventions[1]->setTypeIntervention("frimousse");
        $interventions[2]->setTypeIntervention("plaidoyer");
        foreach ($interventions as $i) {
            $index++;
            $i
                ->setBenevole($b)
                ->setComite($c)
                ->setDemande($d[$index])
                ->setNiveauTheme($nt)
                ->setNbPersonne(15)
                ->setRealisee(true)
                ->setHeure("18:00")
                ->setEtablissement($etablissements[$index])
                ->setLieu("nulle part")
                ->setRemarques("remarque très intéressante");
            ;
            $this->em->persist($i);
        }
        $this->em->flush();
        $this->em->clear();

        // Test
        $result = $this->em
            ->getRepository('InterventionBundle:Etablissement')
            ->getTypeAndNoInterventionThisYear($typeEtablissement, $type, $typeIntervention, $ville, $geolocalisation, $distance)
        ;

        $this->assertCount($expectedResult, $result);

        // Rollback
        $this->em->rollBack();
    }

    /**
     * @dataProvider getTypeDataProvider
     */
    public function testGetEmailEtablissementRappel(
        $etablissements
    ) {
        // Begin transaction
        $this->em->beginTransaction();

        $expectedResult = 3;

        $dateTime = new \DateTime();
        $interventions = InterventionMock::createMultiple(5);
        $b = BenevoleMock::create();
        $c = ComiteMock::create();
        $nt = NiveauThemeMock::create();
        $d = DemandeMock::create();

        foreach ($etablissements as $e) {
            $this->em->persist($e);
        }

        $dateTime->add(new \DateInterval('P7D'));
        $interventions[0]->setDateIntervention($dateTime);
        $interventions[0]->setEtablissement($etablissements[5]);
        $interventions[2]->setDateIntervention($dateTime);
        $interventions[2]->setEtablissement($etablissements[2]);
        $interventions[4]->setDateIntervention($dateTime);
        $interventions[4]->setEtablissement($etablissements[3]);

        $index = -1;
        foreach ($interventions as $i) {
            $index++;
            $i
                ->setBenevole($b)
                ->setComite($c)
                ->setTypeIntervention("plaidoyer")
                ->setDemande($d)
                ->setNiveauTheme($nt)
                ->setNbPersonne(15)
                ->setRealisee(true)
                ->setHeure("18:00")
                ->setEtablissement($etablissements[$index])
                ->setLieu("nulle part")
                ->setRemarques("remarque très intéressante");
            ;
            $this->em->persist($i);
        }

        $this->em->flush();
        $this->em->clear();

        // Test
        $result = $this->em
            ->getRepository('InterventionBundle:Etablissement')
            ->getEmailEtablissementRappel()
        ;

        $this->assertCount($expectedResult, $result);

        // Rollback
        $this->em->rollBack();
    }

    /**
     * @dataProvider getTypeDataProvider
     */
    public function testGetEtablissementDemandeNonSatisfaite (
        $etablissements
    ) {
        // Begin transaction
        $this->em->beginTransaction();

        $expectedResult = 9;

        $contact = ContactMock::create();
        $d = new Demande();
        $d  ->setContact($contact)
            ->setDateDemande(new \DateTime(date('Y').'-10-05'))
            ->setDateDebutDisponibilite(new \DateTime(date('Y').'-11-05'))
            ->setDateFinDisponibilite(new \DateTime(date('Y').'-12-07'))
        ;
        $this->em->persist($d);

        $d2 = new Demande();
        $d2  ->setContact($contact)
            ->setDateDemande(new \DateTime(date('Y').'-09-15'))
            ->setDateDebutDisponibilite(new \DateTime(date('Y').'-09-18'))
            ->setDateFinDisponibilite(new \DateTime(date('Y').'-10-07'))
        ;
        $this->em->persist($d2);

        $dateTime = new \DateTime();
        $interventions = InterventionMock::createMultiple(5);
        $b = BenevoleMock::create();
        $c = ComiteMock::create();
        $nt = NiveauThemeMock::create();
        $d = DemandeMock::create();

        foreach ($etablissements as $e) {
            $this->em->persist($e);
        }

        $dateTime->add(new \DateInterval('P7D'));
        $interventions[0]->setDateIntervention(new \DateTime(date('Y').'-11-15'));
        $interventions[0]->setDemande($d);
        $interventions[0]->setRealisee(true);
        $interventions[0]->setEtablissement($etablissements[5]);
        $interventions[2]->setDateIntervention(new \DateTime(date('Y').'-11-16'));
        $interventions[2]->setEtablissement($etablissements[5]);
        $interventions[2]->setDemande($d);
        $interventions[2]->setRealisee(true);
        $interventions[4]->setDateIntervention(new \DateTime(date('Y').'-'.date('m').'-15'));
        $interventions[4]->setEtablissement($etablissements[3]);
        $interventions[4]->setDemande($d2);
        $interventions[4]->setRealisee(false);

        $index = -1;
        foreach ($interventions as $i) {
            $index++;
            $i
                ->setBenevole($b)
                ->setComite($c)
                ->setTypeIntervention("plaidoyer")
                ->setDemande($d)
                ->setNiveauTheme($nt)
                ->setNbPersonne(15)
                ->setRealisee(true)
                ->setHeure("18:00")
                ->setEtablissement($etablissements[$index])
                ->setLieu("nulle part")
                ->setRemarques("remarque très intéressante");
            ;
            $this->em->persist($i);
        }

        $this->em->flush();
        $this->em->clear();

        // Test
        $result = $this->em
            ->getRepository('InterventionBundle:Etablissement')
            ->getEtablissementDemandeNonSatisfaite()
        ;

        $this->assertCount($expectedResult, $result);

        // Rollback
        $this->em->rollBack();
    }
}
