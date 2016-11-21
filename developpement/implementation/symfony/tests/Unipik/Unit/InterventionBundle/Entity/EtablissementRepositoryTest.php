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
        $etab = EtablissementMock::createMultiple(7);

        // la ville "Pouic Pouic" a 2 lycées, 3 collèges, 1 centre de loisir et 1 etablissement "autre"

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

        return(array(
            "lycées"            => [$etab, "POUIC POUIC", "enseignement", ["lycee"], null, null, true, 2],
            "collèges"          => [$etab, "POUIC POUIC", "enseignement", ["college"], null, null, false, 3],
            "lycées + collèges" => [$etab, "POUIC POUIC", "enseignement", ["lycee", "college"], null, true, null, 5],
            "centres"           => [$etab, "POUIC POUIC", "centre", null, ["elementaire"], null, true, 1],
            "centres2"          => [$etab, "POUIC POUIC", "centre", null, ["elementaire"], null, false, 1],
            "autres"            => [$etab, "POUIC POUIC", "autreEtablissement", null, null, ["maison de retraite"], true, 1],
            "autres2"           => [$etab, "POUIC POUIC", "autreEtablissement", null, null, ["maison de retraite"], false, 1],
            "tout"              => [$etab, "POUIC POUIC", null, null, null, null, true, 7],
            "tout2"             => [$etab, "POUIC POUIC", null, null, null, null, false, 7],
        ));
    }

    /**
     * @dataProvider getTypeDataProvider
     */
    public function testGetType(
        $etablissements,
        $nomVille,
        $typeEtablissement,
        $typeEnseignement,
        $typeCentre,
        $typeAutre,
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
            ->getTypeIntervention($typeEtablissement, $typeEnseignement, $typeCentre, $typeAutre, $ville, "nom", $desc)
        ;
        $this->assertCount($expectedResult, $result);

        // Rollback
        $this->em->rollBack();
    }
}
