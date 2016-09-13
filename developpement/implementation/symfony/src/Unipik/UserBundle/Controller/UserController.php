<?php

namespace Unipik\UserBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserController extends Controller {

   public function testAction() {
        $lol = 'singe';
        return $this->render('UserBundle::test.html.twig', array('coucou' => $lol));
    }
}
