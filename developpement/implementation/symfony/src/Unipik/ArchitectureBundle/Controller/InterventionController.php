<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 14/03/16
 * Time: 17:01
 */

namespace Unipik\ArchitectureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Unipik\ArchitectureBundle\Entity\Intervention;
use Symfony\Component\HttpFoundation\Request;

//Contrôleur en charge de la gestion des interventions
class InterventionController extends Controller {

    // Permet de récupérer tout les interventions
    public function indexAction() {

    }

    // Permet d'ajouter un intervention
    public function addAction(Request $request) {


        return $this->redirectToRoute('architecture_homepage');
    }



    // Permet de détailler une intervention en la récupérant(id)
    public function viewAction(Request $request){

    }

    //Permet de supprimer une intervention en la récupérant(id)
    public function deleteAction(Request $request){

    }

}