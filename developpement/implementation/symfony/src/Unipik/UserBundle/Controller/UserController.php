<?php

namespace Unipik\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Unipik\UserBundle\Entity\Benevole;

class UserController extends Controller {

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

    public function deletesAction(Request $request) {
        if($request->isXmlHttpRequest()) {
            $usernames = json_decode( $request->request->get('usernames'));

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('UserBundle:Benevole');
            $benevoles = $repository->findBy(array('username' => $usernames));
            foreach ($benevoles as $benevole) {
                $em->remove($benevole);
            }
            $em->flush();

            return new Response("ok");
        }
        return new Response(print_r('lol'));
    }

    public function modifyAction(Request $request) {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');

        $user = $this->getUser();
       // $user = $userManager->findUserBy(array('id' => 1));
        $form = $formFactory->createForm();
        $form = $form->setData($user);

        $form->handleRequest($request);

        if($form->isValid()){
            $responsibilitiesArray = $form->get("responsabiliteActivite")->getData(); //récup les responsabilités choisies sur le form + format pour persist
            $responsibilitiesString = $this->arrayToString($responsibilitiesArray);
            $user->setResponsabiliteActivite($responsibilitiesString);
        }
        return $this->render('FOSUserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function showProfileAction($username) {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('UserBundle:Benevole');
        $benevole = $repository->findBy(array('username' => $username))[0];
        return $this->render('UserBundle:Profile:showBenevole.html.twig', array('benevole' => $benevole));
    }
}
