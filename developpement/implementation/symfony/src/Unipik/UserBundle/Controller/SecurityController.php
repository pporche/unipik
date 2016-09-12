<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 22/04/16
 * Time: 11:30
 */

namespace Unipik\UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContext;
use Unipik\UserBundle\Form\LoginType;
use Unipik\UserBundle\Form\RegistrationType;

class SecurityController extends BaseController {

    public function loginPageAction() {
        return $this->render('UserBundle:Security:loginPage.html.twig');
    }

    public function loginAction(Request $request) {
        return parent::loginAction($request);
    }

    protected function renderLogin(array $data) {
        $form = $this->createForm(LoginType::class, null,  array("action" => $this->generateUrl("fos_user_security_check")))
            ->createView();

        return $this->render('UserBundle:Security:login.html.twig', array(
            'form' => $form,
            'error' => $data['error']
        ));
    }

    public function logoutAction() {
        return parent::logoutAction();
    }
}
