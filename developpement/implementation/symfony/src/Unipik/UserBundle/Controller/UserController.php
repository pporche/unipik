<?php

namespace Unipik\UserBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserController extends Controller {

   public function viewProfileAction() {
       $user = $this->getUser();
       if (!is_object($user) || !$user instanceof UserInterface) {
           throw new AccessDeniedException("Cet utilisateur n'a pas accès à cette section.");
       }

       return $this->render('UserBundle:Profile:show.html.twig', array(
           'user' => $user
       ));
    }

    public function editProfileAction() {

    }

    public function scheduleAction() {

    }

    public function takeInterventionAction() {

    }

    public function cancelInterventionAction() {

    }

    public function mapAction() {

    }

    public function editInterventionAction() {

    }
}
