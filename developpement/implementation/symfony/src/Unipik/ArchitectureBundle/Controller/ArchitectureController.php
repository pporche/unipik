<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:59
 */

namespace Unipik\ArchitectureBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Unipik\ArchitectureBundle\Form\DemandeInterventionType;

class ArchitectureController extends Controller {

    public function indexAction() {
        return $this->render('ArchitectureBundle::accueilAnonyme.html.twig');
    }

    public function demandeInterventionAction(Request $request) {

        $form = $this->createForm(DemandeInterventionType::class);
        $form->handleRequest($request);

        if($form->isValid()) {

            $session =$request->getSession();
            $session->getFlashBag()->add('notice', array(
                'title'=>'Félicitation',
                'message'=>'Intervention bien enregistrée.',
                'alert'=>'success'
            ));


            return $this->RedirectToRoute('');
        }
        return $this->render('ArchitectureBundle:Intervention:demande.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function profileAction() {

    }

    public function plaidoyerAction() {

    }

    public function frimousseAction() {

    }

    public function mailAction() {

    }

    public function testAction($id) {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('UserBundle:MyUser');

        $user = $repository->find($id);
        return $this->render('ArchitectureBundle::accueilBenevole.html.twig', array('user' => $user));
    }

}
