<?php

namespace Unipik\ArchitectureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Unipik\ArchitectureBundle\Entity\Volunteer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class VolunteerController extends Controller {

    public function indexAction() {
        return $this->render('ArchitectureBundle:Volunteer:index.html.twig');
    }

    public function addAction(Request $request) {

        //Création d'un objet Volunteer (Un bénévole)
        $volunteer = new Volunteer();
        $formBuilder = $this->createFormBuilder($volunteer)
            ->add('prenom', 'Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('nom', 'Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('telFixe', 'Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('telPortable', 'Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('email', 'Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('save', 'Symfony\Component\Form\Extension\Core\Type\SubmitType')
        ;

        $form = $formBuilder->getForm();

        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($volunteer);
            $em->flush();

            $session =$request->getSession();
            $session->getFlashBag()->add('success', 'Bénévole bien enregistré.');
            return $this->redirectToRoute('architecture_homepage');
        }
        return $this->render('ArchitectureBundle:Volunteer:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
