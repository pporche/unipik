<?php

namespace Unipik\UserBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Unipik\UserBundle\Entity\Benevole;
use FOS\UserBundle\Controller\ProfileController as BaseUserController;

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

    public function deleteAction($username) {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('UserBundle:Benevole');
        $benevole = $repository->findBy(array('username' => $username))[0];
        $em->remove($benevole);
        $em->flush();
        return $this->redirectToRoute('user_admin_list');
    }

    public function showProfileAction($username) {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('UserBundle:Benevole');
        $benevole = $repository->findBy(array('username' => $username))[0];
        return $this->render('UserBundle:Profile:showBenevole.html.twig', array('benevole' => $benevole));
    }
}
