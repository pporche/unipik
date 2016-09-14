<?php

namespace Unipik\UserBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Unipik\UserBundle\Entity\Benevole;

class UserController extends Controller {

   public function testAction() {
        $lol = 'singe';
        return $this->render('UserBundle::test.html.twig', array('coucou' => $lol));
    }

    public function listeAction() {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('UserBundle:Benevole');
        $listBenevoles = $repository->findAll();
        return $this->render('UserBundle::liste.html.twig', array('listBenevoles' => $listBenevoles));
    }

    public function deleteAction(Request $request) {
        return $this->render('ArchitectureBundle::accueilBenevole.html.twig');
    }

    public function showAction($username) {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('UserBundle:Benevole');
        $benevole = $repository->findBy(array('username' => $username));
        return $this->render('UserBundle:Profile:showBenevole.html.twig', array('benevole' => $benevole));
    }
}
