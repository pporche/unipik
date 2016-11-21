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
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\VilleMock;
use Tests\Unipik\Unit\InterventionBundle\Entity\Mocks\EtablissementMock;
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
            "lycées"            => [$etab, "POUIC POUIC", "enseignement", ["lycee"], true, 2],
            "collèges"          => [$etab, "POUIC POUIC", "enseignement", ["college"], false, 3],
            "lycées + collèges" => [$etab, "POUIC POUIC", "enseignement", ["lycee", "college"], true, 5],
            "centres"           => [$etab, "POUIC POUIC", "centre", ["elementaire"], true, 1],
            "centres2"          => [$etab, "POUIC POUIC", "centre", ["elementaire"], false, 1],
            "autres"            => [$etab, "POUIC POUIC", "autreEtablissement", ["maison de retraite"], true, 1],
            "autres2"           => [$etab, "POUIC POUIC", "autreEtablissement", ["maison de retraite"], false, 1],
            "tout"              => [$etab, "POUIC POUIC", null, ["maternelle", "elementaire", "college", "lycee", "maison de retraite"], true, 9],
            "tout2"             => [$etab, "POUIC POUIC", null, null, false, 10],
            "toutes maternelles"             => [$etab, "POUIC POUIC", null, ["maternelle"], false, 2],
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
        $desc,
        $expectedResult
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
            ->getType($typeEtablissement, $type, $ville, "nom", $desc)

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
}
