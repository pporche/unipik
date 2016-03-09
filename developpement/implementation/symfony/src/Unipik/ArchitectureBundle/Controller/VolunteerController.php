<?php

namespace Unipik\ArchitectureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Unipik\ArchitectureBundle\Entity\Volunteer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Unipik\ArchitectureBundle\Form\VolunteerType;

class VolunteerController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $volunteersRepository = $em->getRepository('ArchitectureBundle:Volunteer');
        $volunteers=$volunteersRepository->findAll();

        return $this->render('ArchitectureBundle:Volunteer:index.html.twig', array('volunteers'=>$volunteers));
    }

    public function addAction(Request $request) {

        //Création d'un objet Volunteer (Un bénévole)
        $volunteer = new Volunteer();
        $form =  $this->createForm(VolunteerType::class, $volunteer);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($volunteer);
            $em->flush();

            $session =$request->getSession();
            $session->getFlashBag()->add('notice', array(
                'title'=>'Félicitation',
                'message'=>'Bénévole bien enregistré.',
                'alert'=>'success'
            ));

            return $this->redirectToRoute('architecture_homepage');
        }
        return $this->render('ArchitectureBundle:Volunteer:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
