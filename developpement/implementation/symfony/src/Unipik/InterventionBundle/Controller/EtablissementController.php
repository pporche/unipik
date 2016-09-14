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
use Symfony\Component\HttpFoundation\Request;
use Unipik\InterventionBundle\Entity\Etablissement;
use Unipik\InterventionBundle\Form\EtablissementType;

class EtablissementController extends Controller {

    /**
     * @param $id integer Id de l'établissement souhaitant réaliser une demande.
     * @return Response Renvoie vers la page de consultation liée à l'établissement.
     */
    public function consultationAction($id) {

        return $this->render('InterventionBundle:Etablissement:consultation.html.twig');
    }

    public function addAction(Request $request) {
        $institute = new Etablissement();
        $form = $this->get('form.factory')->create(EtablissementType::class, $institute);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $educationTypeArray = $form->get("typeEnseignement")->getData();
            $institute->setTypeEnseignement($educationTypeArray[0]);

            $otherTypeArray = $form->get("typeAutreEtablissement")->getData();
            $institute->setTypeAutreEtablissement($otherTypeArray[0]);

            $centreTypeArray = $form->get("typeCentre")->getData();
            $institute->setTypeCentre($centreTypeArray[0]);

            $em = $this->getDoctrine()->getManager();
            $em->persist($institute);
            $em->flush();

            return $this->redirectToRoute('architecture_homepage');
        }

        return $this->render('InterventionBundle:Etablissement:ajouterEtablissement.html.twig', array('form' => $form->createView()));
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
