<?php

namespace Unipik\InterventionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Unipik\InterventionBundle\Form\DemandeInterventionType;


/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:55
 */
class InterventionController extends Controller {

    public function demandeAction(Request $request, $id) {

        $form = $this->createForm(DemandeInterventionType::class);
        $form->handleRequest($request);

        if($form->isValid()) {

            $session =$request->getSession();
            $session->getFlashBag()->add('notice', array(
                'title'=>'Félicitation',
                'message'=>'Votre demande a bien été enregistrée.',
                'alert'=>'success'
            ));


            return $this->RedirectToRoute('');
        }
        return $this->render('InterventionBundle:Demande:demande.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function getConsultationVue(){
        return $this->render('InterventionBundle::consultation.html.twig');
    }

    public function consultationAction($id) {
        // Faire la vérication si l'intervention est un plaidoyer, frimousse ou autre
        // Et appeler la vue correspondante
        return $this->getConsultationVue();
    }

    public function addAction() {

    }

    public function editAction() {

    }

    public function deleteAction() {

    }

    public function getListeVue($liste){

        return $this->render('InterventionBundle::liste.html.twig', array(
            'liste' => $liste
        ));
    }

    public function getListeRepository(){
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('ArchitectureBundle:Intervention');
    }

    public function listeAction() {
        $repository = $this->getListeRepository();
        $listIntervention = $repository->findAll();

        return $this->getListeVue($listIntervention);

    }

    public function attribueesAction() {

        return $this->render('InterventionBundle:Liste:listeAttribuees.html.twig', array(
            'liste' => null
        ));

    }

    public function locationAction() {

    }
}
