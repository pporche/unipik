<?php

namespace Unipik\ArchitectureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Unipik\ArchitectureBundle\Entity\Volunteer;
use Symfony\Component\HttpFoundation\Request;
use Unipik\ArchitectureBundle\Form\VolunteerType;

//Contrôleur en charge de la gestion des managers
class VolunteerController extends Controller {

    // Permet de récupérer tout les volontaires
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $volunteersRepository = $em->getRepository('ArchitectureBundle:Volunteer');
        $volunteers=$volunteersRepository->findAll();

        return $this->render('ArchitectureBundle:Volunteer:index.html.twig', array('volunteers'=>$volunteers));
    }

    // Permet d'ajouter un volontaire
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

    // Permet de détailler un volontaire en le récupérant
    public function viewAction(Request $request, $id){
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('ArchitectureBundle:Volunteer')
        ;

        $volunteer = $repository->find($id);

        if($volunteer == null)
            throw new NotFoundHttpException("Le bénévole d'id ".$id." n'existe pas.");

        return $this->render('ArchitectureBundle:Volunteer:view.html.twig', array('volunteer' => $volunteer));
    }

    //Permet de supprimer un volontaire en le récupérant
    public function deleteAction(Request $request){

    }

}
