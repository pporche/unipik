<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 14/03/16
 * Time: 17:01
 */

namespace Unipik\ArchitectureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Unipik\ArchitectureBundle\Entity\Intervention;
use Unipik\ArchitectureBundle\Form\InterventionType;

//Contrôleur en charge de la gestion des interventions
class InterventionController extends Controller {

    // Permet de récupérer tout les volontaires
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $interventionRepository = $em->getRepository('ArchitectureBundle:Intervention');
        $interventions=$interventionRepository->findBy(array(), array('id' => 'ASC'));

        return $this->render('ArchitectureBundle:Intervention:index.html.twig', array('interventions'=>$interventions));
    }

    // Permet d'ajouter une intervention
    public function addAction(Request $request) {

        //Création d'un objet Intervention
        $intervention = new Intervention();

        $form =  $this->createForm(InterventionType::class, $intervention);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($intervention);
            $em->flush();

            $session =$request->getSession();
            $session->getFlashBag()->add('notice', array(
                'title'=>'Félicitation',
                'message'=>'Intervention bien enregistrée.',
                'alert'=>'success'
            ));

            return $this->redirectToRoute('architecture_intervention_homepage');
        }
        return $this->render('ArchitectureBundle:Intervention:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    // Permet de détailler un volontaire en le récupérant
    public function viewAction($id){
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('ArchitectureBundle:Intervention')
        ;

        $intervention= $repository->find($id);

        if($intervention == null)
            throw new NotFoundHttpException("L'intervention d'id ".$id." n'existe pas.");

        return $this->render('ArchitectureBundle:Intervention:view.html.twig', array('intervention' => $intervention));
    }

    //Permet de supprimer un volontaire en le récupérant
    public function deleteAction(Request $request, $id){
        $em = $this->getDoctrine()
            ->getManager()
        ;

        $repository = $em->getRepository('ArchitectureBundle:Intervention');

        $intervention = $repository->find($id);

        if($intervention == null)
            throw new NotFoundHttpException("L'intervention d'id ".$id." n'existe pas.");

        $em->remove($intervention);
        $em->flush();

        $session =$request->getSession();
        $session->getFlashBag()->add('notice', array(
            'title'=>'Félicitation',
            'message'=>'Intervention bien supprimée.',
            'alert'=>'success'
        ));

        return $this->redirectToRoute('architecture_intervention_homepage');
    }

}