<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 08/11/16
 * Time: 14:59
 */

namespace Tests\Unipik\Unit\UserBundle\Entity;


use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\NiveauThemeMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\BenevoleMock;
use Unipik\UserBundle\Entity\Benevole;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\VilleMock;
use Unipik\InterventionBundle\Form\Etablissement;
use Tests\Unipik\Unit\Utils\RepositoryTestCase;

class BenevoleRepositoryTest extends RepositoryTestCase
{
    public function getTypeDataProvider() {
        $b = BenevoleMock::createMultiple(6);

        // Dans la ville de POUIC POUIC, de nombreuses interventions ont été demandés:
        // 3 plaidoyers, 2 frimousses, 1 autre


        // On test tous les types de requêtes possibles:
        return(array(
            "test1" =>  [6, [0, 1, 2, 3, 4, 5], $b, null, true, "POUIC POUIC"],
            "test2" =>  [6, [0, 1, 2, 3, 4, 5], $b, null, false, "POUIC POUIC"],
            "test3" =>  [6, [0, 1, 2, 3, 4, 5], $b, "nom", true, "POUIC POUIC"],
            "test4" =>  [6, [0, 1, 2, 3, 4, 5], $b, "nom", false, "POUIC POUIC"],
        ));
    }

    /**
     * @dataProvider getTypeDataProvider
     *
     * @param Benevole[] $benevoles
     */
    public function testGetType(
        $expectedCount,
        $expectedResult,
        $benevoles,
        $field,
        $desc,
        $nomVille
    ) {
        // Begin transaction
        $this->em->beginTransaction();

        // Persist
        $ville = VilleMock::create();
        $ville->setNom($nomVille);
        foreach ($benevoles as $key=>$b) {
            $b->getAdresse()->setVille($ville);
            $this->em->persist($b);
        }
        $this->em->flush();


        // get ville
        $ville = $this->em
            ->getRepository('ArchitectureBundle:Ville')
            ->findOneBy(array(
                'nom' => $nomVille,
            ))
        ;

        // Test getType method
        $result = $this->em
            ->getRepository('UserBundle:Benevole')
            ->getType($field, $desc, $ville)
        ;


        // Prepare expected result
        $expectedIds = array();
        foreach ($expectedResult as $r) {
            $expectedIds[$benevoles[$r]->getId()] = true;
        }

        // Check Result
        foreach ($result as $r) {
            $this->assertArrayHasKey($r->getId(), $expectedIds);
        }
        $this->assertCount($expectedCount, $result);

        // Rollback
        $this->em->rollBack();
    }
}
