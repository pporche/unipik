<?php

namespace Unipik\UserBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Unipik\UserBundle\Form\ProfileFormType;

use Symfony\Component\HttpFoundation\Response;
use Unipik\UserBundle\Entity\Benevole;


class UserController extends Controller {


    public function listeAction() {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('UserBundle:Benevole');
        $listBenevoles = $repository->findAll();
        return $this->render('UserBundle::liste.html.twig', array('listBenevoles' => $listBenevoles));
    }


    public function modifyAction(Request $request)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->findUserBy(array('id' => 1));
        $form = $formFactory->createForm();
        $form = $form->setData($user);

        $form->handleRequest($request);

        return $this->render('FOSUserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView(),
        ));
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
