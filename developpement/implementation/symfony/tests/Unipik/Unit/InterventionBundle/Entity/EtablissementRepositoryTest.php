<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 07/11/16
 * Time: 09:10
 */

namespace Tests\Unipik\Unit\InterventionBundle\Entity;


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
}
