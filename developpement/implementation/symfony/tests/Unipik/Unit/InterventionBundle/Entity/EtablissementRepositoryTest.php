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
        $et = EtablissementMock::createMultiple(7);

        // la ville "Pouic Pouic" a 2 lycées, 3 collèges, 1 centre de loisir et 1 etablissement "autre"

        $et[0]->setNom("lycée Pouic Pouic");
        $et[0]->setTypeEnseignement("lycee");

        $et[1]->setNom("collège Pouic Pouic");
        $et[1]->setTypeEnseignement("college");

        $et[2]->setNom("lycée2 Pouic Pouic");
        $et[2]->setTypeEnseignement("lycee");

        $et[3]->setNom("collège2 Pouic Pouic");
        $et[3]->setTypeEnseignement("college");

        $et[4]->setNom("collège3 Pouic Pouic");
        $et[4]->setTypeEnseignement("college");

        $et[5]->setNom("centre de loisir Pouic Pouic");
        $et[5]->setTypeCentre("elementaire");

        $et[6]->setNom("maison de retraite Pouic Pouic");
        $et[6]->setTypeAutreEtablissement("maison de retraite");

        return(array(
            "lycées"            => [$et, "Pouic Pouic", "enseignement", ["lycee"], null, null, true, 2],
            "collèges"          => [$et, "Pouic Pouic", "enseignement", ["college"], null, null, false, 3],
            "lycées + collèges" => [$et, "Pouic Pouic", "enseignement", ["lycee", "college"], null, true, null, 5],
            "centres"           => [$et, "Pouic Pouic", "centre", null, ["elementaire"], null, true, 1],
            "centres2"          => [$et, "Pouic Pouic", "centre", null, ["elementaire"], null, false, 1],
            "autres"            => [$et, "Pouic Pouic", "autreEtablissement", null, null, ["maison de retraite"], true, 1],
            "autres2"           => [$et, "Pouic Pouic", "autreEtablissement", null, null, ["maison de retraite"], false, 1],
            "tout"              => [$et, "Pouic Pouic", null, null, null, null, true, 7],
            "tout2"             => [$et, "Pouic Pouic", null, null, null, null, false, 7],
        ));
    }

    /**
     * @dataProvider getTypeDataProvider
     */
    public function testGetType($et, $nomVille, $typeEtablissement, $typeEnseignement, $typeCentre, $typeAutre, $desc, $expectedResult) {
        // Begin transaction
        $this->em->beginTransaction();

        // Persist
        $ville = VilleMock::create();
        $ville->setNom("Pouic Pouic");
        foreach ($et as $e) {
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
        $products = $this->em
            ->getRepository('InterventionBundle:Etablissement')
            ->getType($typeEtablissement, $typeEnseignement, $typeCentre, $typeAutre, $ville, "nom", $desc)
        ;
        $this->assertCount($expectedResult, $products);

        // Rollback
        $this->em->rollBack();
    }
}
