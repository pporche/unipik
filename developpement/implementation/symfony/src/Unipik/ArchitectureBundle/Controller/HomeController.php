<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 15/03/16
 * Time: 13:40
 */

namespace Unipik\ArchitectureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Unipik\ArchitectureBundle\Entity\Intervention;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
//use Unipik\ArchitectureBundle\Entity\Intervention;
//use Unipik\ArchitectureBundle\Form\InterventionType;

class HomeController extends Controller{

    // Permet d'afficher la page d'acceuil
    public function indexAction() {

        return $this->render('ArchitectureBundle:Home:index.html.twig');
    }
}