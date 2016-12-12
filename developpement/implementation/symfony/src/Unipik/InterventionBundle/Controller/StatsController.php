<?php
/**
 * Created by PhpStorm.
 * User: scolomies
 * Date: 23/11/16
 * Time: 11:20
 *
 * PHP version 5
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\InterventionBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Le controller qui gère les statistiques
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class StatsController extends Controller {
    const PLAIDOYER = 'plaidoyer';
    const FRIMOUSSE = 'frimousse';
    const AUTRE = 'autre_intervention';
    const NUMBER_YEAR = 3;

    /**
     * Intervention action
     *
     * @return object
     */
    public function interventionsAction() {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('InterventionBundle:Intervention');

        $themes = array('education' => 0,
            'role unicef' => 0,
            'sante en generale' => 0,
            'sante et alimentation' => 0,
            'eau' => 0,
            'convention internationale des droits de l enfant' => 0,
            'travail des enfants' => 0,
            'harcelement' => 0,
            'discrimination' => 0,
            'millenaire dev' => 0,
            'VIH et sida' => 0,
            'urgences mondiales' => 0,
            'enfants et soldats' => 0
        );

        $niveaux = array('maternelle' => 0,
            'elementaire' => 0,
            'college' => 0,
            'lycee' => 0,
            'superieur' => 0
        );

        $themesArray = array();
        $niveauxArray = array();

        $interventionsArray = array();
        $currentYear = date('Y') + 1;
        for ($i = 0; $i < self::NUMBER_YEAR; $i++) {
            $currentYearSup = $currentYear - $i;
            $currentYearInf = $currentYear - $i - 1;

            $countPlaidoyer = $repository->getNumberInterventionRealisee('31/08/'.$currentYearSup, '01/09/'.$currentYearInf, null, self::PLAIDOYER);
            $countFrimousse = $repository->getNumberInterventionRealisee('31/08/'.$currentYearSup, '01/09/'.$currentYearInf, null, self::FRIMOUSSE);
            $countAutre = $repository->getNumberInterventionRealisee('31/08/'.$currentYearSup, '01/09/'.$currentYearInf, null, self::AUTRE);

            foreach ($themes as $theme => $value) {
                $countTheme = $repository->getNumberInterventionByTheme('31/08/'.$currentYearSup, '01/09/'.$currentYearInf, $theme);
                $themes[$theme] = $countTheme;
            }

            foreach ($niveaux as $niveau => $value) {
                $countNiveau = $repository->getNumberInterventionByNiveau('31/08/'.$currentYearSup, '01/09/'.$currentYearInf, $niveau);
                $niveaux[$niveau] = $countNiveau;
            }

            array_push($interventionsArray, array('plaidoyers' => $countPlaidoyer, 'frimousses' => $countFrimousse, 'autres' => $countAutre));
            array_push($themesArray, $themes);
            array_push($niveauxArray, $niveaux);
        }

        $topEtablissements = $em->getRepository('InterventionBundle:Etablissement')->getTop10Etablissements();

        return $this->render(
            'InterventionBundle:Statistiques:statsIntervention.html.twig', array(
            'interventions' => json_encode($interventionsArray),
            'themes' => json_encode($themesArray),
            'niveaux' => json_encode($niveauxArray),
            'topEtablissements' => json_encode($topEtablissements)
            )
        );
    }

    /**
     * @return Response
     */
    public function ventesAction() {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('InterventionBundle:Vente');

        $months = array('09', '10', '11', '12', '01', '02', '03', '04', '05', '06', '07', '08', '09');

        $ventesYearArray = array();
        $ventesMonthArray = array();
        $currentYear = date('Y') + 1;
        for ($i = 0; $i < self::NUMBER_YEAR; $i++) {
            $ventesOneYearArray = array();
            $currentYearSup = $currentYear - $i;
            $currentYearInf = $currentYear - $i - 1;
            $countVenteYear = $repository->getNumberVente('31/08/'.$currentYearSup, '01/09/'.$currentYearInf);
            for ($j = 1; $j < count($months); $j++) {
                if ($j < 4) {
                    $countVenteMonth = $repository->getNumberVenteMonth('01/' . $months[$j] . '/' . $currentYearInf, '01/' . $months[$j - 1] . '/' . $currentYearInf);
                }
                elseif ($j > 4) {
                    $countVenteMonth = $repository->getNumberVenteMonth('01/' . $months[$j] . '/' . $currentYearSup, '01/' . $months[$j - 1] . '/' . $currentYearSup);
                }
                else {
                    $countVenteMonth = $repository->getNumberVenteMonth('01/' . $months[$j] . '/' . $currentYearSup, '01/' . $months[$j - 1] . '/' . $currentYearInf);
                }
                array_push($ventesOneYearArray, $countVenteMonth);
            }
            array_push($ventesMonthArray, $ventesOneYearArray);
            array_push($ventesYearArray, $countVenteYear);
        }

        return $this->render(
            'InterventionBundle:Statistiques:statsVente.html.twig', array(
                'ventesYear' => json_encode($ventesYearArray),
                'ventesMonth' => json_encode($ventesMonthArray),
            )
        );
    }
}