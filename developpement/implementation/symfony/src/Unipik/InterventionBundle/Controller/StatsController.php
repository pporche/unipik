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
    const NUMBER_YEAR = 5;

    /**
     * Intervention action
     *
     * @return object
     */
    public function interventionsAction() {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('InterventionBundle:Intervention');

        $interventionsArray = array();
        $currentYear = date('Y') + 1;
        for ($i = 0; $i < self::NUMBER_YEAR; $i++) {
            $currentYearSup = $currentYear - $i;
            $currentYearInf = $currentYear - $i - 1;
            $countPlaidoyer = $repository->getNumberInterventionRealisee('31/08/'.$currentYearSup, '01/09/'.$currentYearInf, null, self::PLAIDOYER);
            $countFrimousse = $repository->getNumberInterventionRealisee('31/08/'.$currentYearSup, '01/09/'.$currentYearInf, null, self::FRIMOUSSE);
            $countAutre = $repository->getNumberInterventionRealisee('31/08/'.$currentYearSup, '01/09/'.$currentYearInf, null, self::AUTRE);
            array_push($interventionsArray, array('plaidoyers' => $countPlaidoyer, 'frimousses' => $countFrimousse, 'autres' => $countAutre));
        }

        return $this->render(
            'InterventionBundle:Statistiques:statsIntervention.html.twig', array(
            'interventions' => json_encode($interventionsArray)
            )
        );
    }
}