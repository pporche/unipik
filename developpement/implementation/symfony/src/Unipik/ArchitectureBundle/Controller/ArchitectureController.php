<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:59
 */

namespace Unipik\ArchitectureBundle\Controller;


use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Unipik\ArchitectureBundle\Form\DemandeInterventionType;

class ArchitectureController extends Controller {

    public function indexAction() {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            return $this->render('ArchitectureBundle::accueilAnonyme.html.twig');
        }

        return $this->render('ArchitectureBundle::accueilBenevole.html.twig', array('user' => $user));
    }

    public function homeVolunteerAction() {

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

    public function profileAction($id) {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('UserBundle:MyUser');

        $user = $repository->find($id);

        if($user === null) {
            throw new NotFoundHttpException("User ".$id." not found.");
        }

        return $this->render('ArchitectureBundle:Benevole:profil.html.twig', array('user' => $user));
    }

    public function plaidoyerAction() {

    }

    public function frimousseAction() {

    }

    public function mailAction() {

    }

}
