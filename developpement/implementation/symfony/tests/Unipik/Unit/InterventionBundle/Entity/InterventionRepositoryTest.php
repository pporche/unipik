<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 08/11/16
 * Time: 14:59
 */

namespace Tests\Unipik\Unit\InterventionBundle\Entity;


use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\NiveauThemeMock;
use Unipik\InterventionBundle\Entity\Intervention;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\VilleMock;
use Tests\Unipik\Unit\InterventionBundle\Entity\Mocks\InterventionMock;
use Unipik\InterventionBundle\Form\Etablissement;
use Tests\Unipik\Unit\Utils\RepositoryTestCase;

class InterventionRepositoryTest extends RepositoryTestCase
{
    public function getTypeDataProvider() {
        $inter = InterventionMock::createMultiple(6);

        // Dans la ville de POUIC POUIC, de nombreuses interventions ont été demandés:
        // 3 plaidoyers, 2 frimousses, 1 autre

        $nt = NiveauThemeMock::createMultiple(6);
        $inter[0]
            ->addMaterielDispoPlaidoyer("videoprojecteur")
            ->setDateIntervention(new \DateTime("2000-12-31"))
        ;

        $nt[1]
            ->setNiveau("CM1")
            ->setTheme("travail des enfants");
        $inter[1]
            ->addMaterielDispoPlaidoyer("videoprojecteur")
            ->setDateIntervention(new \DateTime("2005-12-31"))
        ;

        $nt[2]
            ->setNiveau("CM2")
            ->setTheme("enfants et soldats");
        $inter[2]
            ->addMaterielDispoPlaidoyer("videoprojecteur")
            ->setDateIntervention(new \DateTime("2010-12-31"))
        ;

        $nt[3] = null;
        $inter[3]
            ->addMateriauxFrimousse("bourre")
            ->setNiveauFrimousse("CE1-CE2")
            ->setDateIntervention(new \DateTime("2005-12-31"))
        ;

        $nt[4] = null;
        $inter[4]
            ->addMateriauxFrimousse("patron")
            ->setNiveauFrimousse("CM1-CM2")
            ->setDateIntervention(new \DateTime("2010-12-31"))
        ;

        $nt[5] = null;
        $inter[5]
            ->setDescription("Intervention particulière")
        ;

        return(array(
            /*"test1" =>  [3, [0, 1, 2], $inter, $nt, null, null, true, "plaidoyer", null, true, null, "POUIC POUIC"],
            "test2" =>  [1, [2], $inter, $nt, null, null, true, "plaidoyer", null, null, null, "POUIC POUIC", null, null, ["CM2"]],
            "test3" =>  [2, [1, 2], $inter, $nt, null, null, true, "plaidoyer", null, null, null, "POUIC POUIC", null, null, ["CM2", "CM1"]],
            "test4" =>  [1, [2], $inter, $nt, null, null, true, "plaidoyer", null, null, null, "POUIC POUIC", null, null, null, ['enfants et soldats']],
            "test5" =>  [2, [1, 2], $inter, $nt, null, null, true, "plaidoyer", null, null, null, "POUIC POUIC", null, null, null, ['travail des enfants', 'enfants et soldats']],
            "test6" =>  [3, [0, 1, 2], $inter, $nt, null, null, true, "plaidoyer", "lieu", true, null, "POUIC POUIC"],
            "test7" =>  [3, [0, 1, 2], $inter, $nt, null, null, true, "plaidoyer", "lieu", false, null, "POUIC POUIC"],
            "test8" =>  [1, [1], $inter, $nt, new \DateTime("2004-12-31"), new \DateTime("2006-12-31"), false, "plaidoyer", null, null, null, "POUIC POUIC"],
            "test9" =>  [2, [3, 4], $inter, $nt, null, null, true, "frimousse", null, true, null, "POUIC POUIC"],
            "test10" => [1, [4], $inter, $nt, null, null, true, "frimousse", null, null, null, "POUIC POUIC", null,["CM1-CM2"], null],
            "test11" => [2, [3, 4], $inter, $nt, null, null, true, "frimousse", null, null, null, "POUIC POUIC", null, ["CE1-CE2", "CM1-CM2"], null],
            "test12" => [1, [3], $inter, $nt, new \DateTime("2004-12-31"), new \DateTime("2006-12-31"), false, "frimousse", null, null, null, "POUIC POUIC"],
            "test14" => [1, [5], $inter, $nt, null, null, true, "autreIntervention", null, "Intervention particulière", null, "POUIC POUIC"],*/

        ));
    }

    /**
     * @dataProvider getTypeDataProvider
     *
     * @param Intervention[] $interventions
     */
    public function testGetType(
        $expectedCount,
        $expectedResult,
        $interventions,
        $niveauxThemes,
        $start,
        $end,
        $dateChecked,
        $typeIntervention,
        $field,
        $desc,
        $statut,
        $nomVille,
        $user = null,
        $niveauFrimousse = null,
        $niveauPlaidoyer = null,
        $theme = null
    ) {
        // Begin transaction
        $this->em->beginTransaction();

        // Persist
        $ville = VilleMock::create();
        $ville->setNom($nomVille);
        //$this->em->persist($ville);
        foreach ($interventions as $key=>$i) {
            $i->getEtablissement()->getAdresse()->setVille($ville);
            $i->setNiveauTheme($niveauxThemes[$key]);
            //$this->em->persist($niveauxThemes[$key]);
            //$this->em->persist($i->getEtablissement()->getAdresse());
            //$this->em->persist($i->getEtablissement());
            $this->em->persist($i);
        }
        $this->em->flush();
        //$this->em->clear();


        // get ville
        $ville = $this->em
            ->getRepository('ArchitectureBundle:Ville')
            ->findOneBy(array(
                'nom' => $nomVille,
            ))
        ;

        //var_dump($ville->getNom());
        //var_dump($interventions[0]->getEtablissement()->getAdresse()->getVille()->getNom());
        //var_dump($interventions[0]->getNiveauTheme()->getNiveau());
        //var_dump($interventions[1]->getNiveauTheme()->getNiveau());

        // Test getType method
        $products = $this->em
            ->getRepository('InterventionBundle:Intervention')
            ->getType($start, $end, $dateChecked, $typeIntervention, $field, $desc, $statut, $user, $niveauFrimousse, $niveauPlaidoyer, $theme, $ville)
        ;


        // Prepare expected result
        $expectedIds = array();
        foreach ($expectedResult as $r){
            $expectedIds[$interventions[$r]->getId()] = true;
        }

        // Check Result
        foreach ($products as $p){
            $this->assertArrayHasKey($p->getId(), $expectedIds);
        }
        $this->assertCount($expectedCount, $products);

        //var_dump($products[2]->getNiveauTheme()->getNiveau());

        // Rollback
        $this->em->rollBack();
    }
}
