<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 14/03/16
 * Time: 17:01
 */

namespace Unipik\ArchitectureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Unipik\ArchitectureBundle\Entity\School;
use Symfony\Component\HttpFoundation\Request;
use Unipik\ArchitectureBundle\Form\SchoolType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Contrôleur en charge de la gestion des établissements
class SchoolController extends Controller {

    // Permet de récupérer tout les établissements
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();
        $schoolsRepository = $em->getRepository('ArchitectureBundle:School');
        $schools=$schoolsRepository->findAll();
        return $this->render('ArchitectureBundle:School:index.html.twig', array('schools'=>$schools));
    }

    // Permet d'ajouter un établissement
    public function addAction(Request $request) {

        //On crée un objet School
        $School = new School();

        $form = $this->createForm(SchoolType::class,$School);
        $form->handleRequest($request);
        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($School);
            $em->flush();

            $session =$request->getSession();
            $session->getFlashBag()->add('notice', array(
                'title'=>'Félicitation',
                'message'=>'Etablissement bien enregistrée.',
                'alert'=>'success'
            ));


            return $this->redirectToRoute('architecture_homepage');
        }

        return $this->render('ArchitectureBundle:School:add.html.twig', array(
            'form' => $form->createView(),
        ));
        }



    // Permet de détailler un établissement en le récupérant
    public function viewAction($id){

        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('ArchitectureBundle:School')
        ;

        $school = $repository->find($id);

        if($school == null)
            throw new NotFoundHttpException("L'établissement ayant pour id ".$id." n'existe pas.");

        return $this->render('ArchitectureBundle:School:view.html.twig', array('school' => $school));


    }

    //Permet de supprimer un établissement en le récupérant
    public function deleteAction(Request $request,$id){

        $em = $this->getDoctrine()
            ->getManager()
        ;

        $repository = $em->getRepository('ArchitectureBundle:School');

        $school = $repository->find($id);

        if($school == null)
            throw new NotFoundHttpException("L'établissement ayant pour id ".$id." n'existe pas.");

        $em->remove($school);
        $em->flush();

        $session =$request->getSession();
        $session->getFlashBag()->add('notice', array(
            'title'=>'Félicitation',
            'message'=>'Bénévole bien supprimé.',
            'alert'=>'success'
        ));

        return $this->redirectToRoute('architecture_school_homepage');



    }

}