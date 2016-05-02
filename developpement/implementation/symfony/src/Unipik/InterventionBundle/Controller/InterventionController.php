<?php

namespace Unipik\InterventionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Unipik\InterventionBundle\Form\DemandeInterventionType;
//use Unipik\ArchitectureBundle\Repository\PlaidoyerRepository;
use Unipik\ArchitectureBundle\Entity\Plaidoyer;

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

    public function consultationAction($id) {
        // Faire la vérication si l'intervention est un plaidoyer, frimousse ou autre
        // Et appeler la vue correspondante
        return $this->render('InterventionBundle:Consultation:consultationPlaidoyer.html.twig');
    }

    public function addAction() {

    }

    public function editAction() {

    }

    public function deleteAction() {

    }

    public function listPlaidoyersAction() {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('ArchitectureBundle:Intervention');//('ArchitectureBundle:Plaidoyer');
        $listPlaidoyers = $repository->findAll();

        return $this->render('InterventionBundle:Plaidoyer:liste.html.twig', array(
            'listPlaidoyers' => $listPlaidoyers
        ));
    }

    public function locationAction() {

    }
}
