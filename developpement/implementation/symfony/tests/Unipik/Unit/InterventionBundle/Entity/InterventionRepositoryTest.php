<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 08/11/16
 * Time: 14:59
 */

namespace Tests\Unipik\Unit\InterventionBundle\Entity;


use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\NiveauThemeMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\BenevoleMock;
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

        $b = BenevoleMock::createMultiple(2);

        $nt = NiveauThemeMock::createMultiple(6);
        $inter[0]
            ->setTypeIntervention("plaidoyer")
            ->addMaterielDispoPlaidoyer("videoprojecteur")
            ->setDateIntervention(new \DateTime(date('Y')."-01-01"))
            ->setBenevole($b[0])
        ;

        $nt[1]
            ->setNiveau("CM1")
            ->setTheme("travail des enfants");
        $inter[1]
            ->setTypeIntervention("plaidoyer")
            ->addMaterielDispoPlaidoyer("videoprojecteur")
            ->setDateIntervention(new \DateTime(date('Y')."-05-12"))
            ->setBenevole($b[1])
            ->setRealisee(true)
        ;

        $nt[2]
            ->setNiveau("CM2")
            ->setTheme("enfants et soldats");
        $inter[2]
            ->setTypeIntervention("plaidoyer")
            ->addMaterielDispoPlaidoyer("videoprojecteur")
            ->setDateIntervention(new \DateTime(date('Y')."-10-12"))
            ->setBenevole($b[0])
        ;

        $nt[3] = null;
        $inter[3]
            ->setTypeIntervention("frimousse")
            ->addMateriauxFrimousse("bourre")
            ->setNiveauFrimousse("CE1-CE2")
            ->setDateIntervention(new \DateTime(date('Y')."-05-11"))
            ->setBenevole($b[1])
            ->setRealisee(true)
            ->getDemande()
            ->setDateDebutDisponibilite(new \DateTime(date('Y')."-05-10"))
            ->setDateFinDisponibilite(new \DateTime(date('Y')."-05-12"))
        ;

        $nt[4] = null;
        $inter[4]
            ->setTypeIntervention("frimousse")
            ->addMateriauxFrimousse("patron")
            ->setNiveauFrimousse("CM1-CM2")
            ->setDateIntervention(new \DateTime(date('Y')."-10-11"))
            ->getDemande()
            ->setDateDebutDisponibilite(new \DateTime(date('Y')."-10-10"))
            ->setDateFinDisponibilite(new \DateTime(date('Y')."-10-12"))
        ;

        $nt[5] = null;
        $inter[5]
            ->setTypeIntervention("autre_intervention")
            ->setDescription("Intervention particulière")
        ;

        // On test tous les types de requêtes possibles:
        return(array(
            "test1" =>  [3, [0, 1, 2], $inter, $nt, null, null, true, "plaidoyer", null, true, null, "POUIC POUIC"],
            "test2" =>  [1, [2], $inter, $nt, null, null, true, "plaidoyer", null, null, null, "POUIC POUIC", null, null, null, ["CM2"]],
            "test3" =>  [2, [1, 2], $inter, $nt, null, null, true, "plaidoyer", null, null, null, "POUIC POUIC", null, null, null, ["CM2", "CM1"]],
            "test4" =>  [1, [2], $inter, $nt, null, null, true, "plaidoyer", null, null, null, "POUIC POUIC", null, null, null, null, ['enfants et soldats']],
            "test5" =>  [2, [1, 2], $inter, $nt, null, null, true, "plaidoyer", null, null, null, "POUIC POUIC", null, null, null, null, ['travail des enfants', 'enfants et soldats']],
            "test6" =>  [3, [0, 1, 2], $inter, $nt, null, null, true, "plaidoyer", "lieu", true, null, "POUIC POUIC"],
            "test7" =>  [3, [0, 1, 2], $inter, $nt, null, null, true, "plaidoyer", "lieu", false, null, "POUIC POUIC"],
            "test8" =>  [0, [1], $inter, $nt, new \DateTime(date('Y')."04-12"), new \DateTime(date('Y')."06-12"), false, "plaidoyer", null, null, null, "POUIC POUIC", null, null, null, null, null, "SRID=4326;POINT(45 69)", "1"],
            "test9" =>  [2, [3, 4], $inter, $nt, null, null, true, "frimousse", null, true, null, "POUIC POUIC"],
            "test10" => [1, [4], $inter, $nt, null, null, true, "frimousse", null, null, null, "POUIC POUIC", null, null,["CM1-CM2"], null],
            "test11" => [2, [3, 4], $inter, $nt, null, null, true, "frimousse", null, null, null, "POUIC POUIC", null, null, ["CE1-CE2", "CM1-CM2"], null],
            "test12" => [1, [3], $inter, $nt, new \DateTime(date('Y')."-04-12"), new \DateTime(date('Y')."-06-12"), false, "frimousse", null, null, null, "POUIC POUIC"],
            "test13" => [1, [5], $inter, $nt, null, null, true, "autreIntervention", null, null, null, "POUIC POUIC"],
            "test14" => [0, [], $inter, $nt, new \DateTime(date('Y')."-04-12"), new \DateTime(date('Y')."-06-12"), false, "autreIntervention", null, null, null, "", null, null, null, null, null, "SRID=4326;POINT(45 69)", "1"],
            "test15" => [6, [0, 1, 2, 3, 4, 5], $inter, $nt, null, null, true, null, null, null, null, "POUIC POUIC"],
            "test16" => [2, [1, 3], $inter, $nt, new \DateTime(date('Y')."-04-12"), new \DateTime(date('Y')."-06-12"), false, null, null, null, null, "POUIC POUIC"],
            "test17" => [2, [0, 2], $inter, $nt, null, null, true, null, null, null, null, "POUIC POUIC", true, $b[0]],
            "test18" => [2, [0, 2], $inter, $nt, null, null, true, null, null, null, "attribuees", "POUIC POUIC"],
            "test19" => [2, [4, 5], $inter, $nt, null, null, true, null, null, null, "nonAttribuees", "POUIC POUIC"],
            "test20" => [2, [1, 3], $inter, $nt, null, null, true, null, null, null, "realisees", "POUIC POUIC"],
            "test21" => [2, [1, 3], $inter, $nt, null, null, true, null, null, null, "realisees", "POUIC POUIC"],
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
        $mesInterventions = null,
        $user = null,
        $niveauFrimousse = null,
        $niveauPlaidoyer = null,
        $theme = null,
        $geolocalisation = null,
        $distance = null
    ) {
        // Begin transaction
        $this->em->beginTransaction();

        // Persist
        $ville = VilleMock::create();
        if($nomVille != "")
            $ville->setNom($nomVille);
        else
            $ville->setNom("POUIC POUIC");
        foreach ($interventions as $key=>$i) {
            $i->getEtablissement()->getAdresse()->setVille($ville);
            $i->setNiveauTheme($niveauxThemes[$key]);
            $this->em->persist($i);
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
            ->getRepository('InterventionBundle:Intervention')
            ->getType($start, $end, $dateChecked, $typeIntervention, $field, $desc, $statut, $mesInterventions, $user, $niveauFrimousse, $niveauPlaidoyer, $theme, $ville, $distance, $geolocalisation)
        ;
        // Prepare expected result
        $expectedIds = array();
        foreach ($expectedResult as $r) {
            $expectedIds[$interventions[$r]->getId()] = true;
        }


        // Check Result
        foreach ($result as $r) {

            //var_dump($r->getId());
            $this->assertArrayHasKey($r->getId(), $expectedIds);

//            var_dump($r->getTypeIntervention());
//            var_dump($r->getDateIntervention());
//            var_dump($r->getMateriauxFrimousse());
        }
        $this->assertCount($expectedCount, $result);

        // Rollback
        $this->em->rollBack();
    }

    public function testGetInterventionsBenevole() {
        $this->em->beginTransaction();

        $inter = InterventionMock::createMultiple(3);
        $benevole = BenevoleMock::create();
        $benevole2 = BenevoleMock::create();
        $this->em->persist($benevole);
        $this->em->persist($benevole2);

        $inter[0]->setBenevole($benevole);
        $inter[1]->setBenevole($benevole);
        $inter[2]->setBenevole($benevole2);

        $this->em->persist($inter[0]);
        $this->em->persist($inter[1]);
        $this->em->persist($inter[2]);
        $this->em->flush();
        $this->em->clear();

        // Test getInterventionsBenevole method
        $result = $this->em
            ->getRepository('InterventionBundle:Intervention')
            ->getInterventionsBenevole($benevole);
        ;

        $this->assertCount(2, $result);
        $this->em->rollBack();
    }

//    public function testGetInterventionsRealiseesOuNon() {
//        $this->em->beginTransaction();
//
//        $inter = InterventionMock::createMultiple(3);
//
//        $inter[0]->setRealisee(true);
//        $inter[1]->setRealisee(true);
//        $inter[2]->setRealisee(false);
//        $this->em->persist($inter[0]);
//        $this->em->persist($inter[1]);
//        $this->em->persist($inter[2]);
//        $this->em->flush();
//        $this->em->clear();
//
//        // Test getInterventionsBenevole method
//        $result = $this->em
//            ->getRepository('InterventionBundle:Intervention')
//            ->getInterventionsRealiseesOuNon(true);
//        ;
//
//        $result2 = $this->em
//            ->getRepository('InterventionBundle:Intervention')
//            ->getInterventionsRealiseesOuNon(false);
//        ;
//
//        $this->assertCount(2, $result);
//        $this->assertCount(1, $result2);
//        $this->em->rollBack();
//    }
}
