<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 17/11/16
 * Time: 10:26
 */

namespace Unipik\InterventionBundle\Controller;

use Doctrine\ORM\Repository\RepositoryFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class VenteController extends Controller
{

    public function listeAction(){
        return new Response("Ici s'affichera une liste de ventes");
    }

    public function consultationAction($id){
        $vente = $this->getDoctrine()->getManager()->getRepository("InterventionBundle:Vente")->find($id);



        return $this->render('InterventionBundle:Vente:consultation.html.twig',array('vente' => $vente));
    }

    public function editAction($id){
        return new Response("Ici on pourra modifier la vente ".$id);
    }

}

