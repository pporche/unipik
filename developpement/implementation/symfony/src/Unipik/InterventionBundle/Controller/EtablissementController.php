<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 04/05/16
 * Time: 09:48
 */

namespace Unipik\InterventionBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EtablissementController extends Controller {


    public function consultationAction($id) {

        return $this->render('InterventionBundle:Etablissement:consultation.html.twig');
    }

    public function addAction() {

    }

    public function editAction() {

    }

    public function deleteAction() {

    }

    public function listeAction() {
        /*$em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('ArchitectureBundle:Intervention');//('ArchitectureBundle:Plaidoyer');
        $listPlaidoyers = $repository->findAll();*/

        return $this->render('InterventionBundle:Etablissement:liste.html.twig', array(
            //'listPlaidoyers' => $listPlaidoyers
        ));
    }
}
