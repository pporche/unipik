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

//Contrôleur en charge de la gestion des établissements
class SchoolController extends Controller {

    // Permet de récupérer tout les établissements
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $schoolsRepository = $em->getRepository('ArchitectureBundle:School');
        $schools=$schoolsRepository->findAll();

        return $this->render('ArchitectureBundle:School:index.html.twig', array('schools'=>schools));
    }

    // Permet d'ajouter un établissement
    public function addAction(Request $request) {


        return $this->redirectToRoute('architecture_homepage');
        }



    // Permet de détailler un établissement en le récupérant
    public function viewAction(Request $request){

    }

    //Permet de supprimer un établissement en le récupérant
    public function deleteAction(Request $request){

    }

}