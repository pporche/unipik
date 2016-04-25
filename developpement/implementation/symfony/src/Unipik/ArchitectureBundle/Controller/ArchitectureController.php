<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:59
 */

namespace Unipik\ArchitectureBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArchitectureController extends Controller {

    public function indexAction() {
        return $this->render('ArchitectureBundle::accueilAnonyme.html.twig');
    }

    public function profileAction() {

    }

    public function plaidoyerAction() {

    }

    public function frimousseAction() {

    }

    public function mailAction() {

    }

    public function testAction($id) {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('UserBundle:MyUser');

        $user = $repository->find($id);
        return $this->render('ArchitectureBundle::accueilBenevole.html.twig', array('user' => $user));
    }

}
