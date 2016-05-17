<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 04/05/16
 * Time: 09:48
 */

namespace Unipik\InterventionBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;

class EtablissementController extends Controller {

    /**
     * @param $id integer Id de l'établissement souhaitant réaliser une demande.
     * @return Response Renvoie vers la page de consultation liée à l'établissement.
     */
    public function consultationAction($id) {

        return $this->render('InterventionBundle:Etablissement:consultation.html.twig');
    }

    public function addAction() {

    }

    public function editAction() {

    }

    public function deleteAction() {

    }

    /**
     * @return Response Renvoie vers la page affichant la liste des données des établissements.
     */
    public function listeAction() {
        /*$em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('ArchitectureBundle:Intervention');//('ArchitectureBundle:Plaidoyer');
        $listPlaidoyers = $repository->findAll();*/

        return $this->render('InterventionBundle:Etablissement:liste.html.twig', array(
            //'listPlaidoyers' => $listPlaidoyers
        ));
    }
}
