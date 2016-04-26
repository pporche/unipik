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

class SecurityController extends BaseController {

    private $_loginForm;


    public function loginAction(Request $request) {
        /*$session = $request->getSession();

        if (class_exists('\Symfony\Component\Security\Core\Security')) {
            $authErrorKey = Security::AUTHENTICATION_ERROR;
            $lastUsernameKey = Security::LAST_USERNAME;
        } else {
            // BC for SF < 2.6
            $authErrorKey = SecurityContextInterface::AUTHENTICATION_ERROR;
            $lastUsernameKey = SecurityContextInterface::LAST_USERNAME;
        }

        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }*/

        $form = $this->createForm(LoginType::class);
        $form->handleRequest($request);

        /*if($form->isValid()) {

            $session =$request->getSession();
            $session->getFlashBag()->add('notice', array(
                'title'=>'Rebonjour !',
                'message'=>'Connexion réussi.',
                'alert'=>'success'
            ));


            return $this->RedirectToRoute('fos_user_security_check');
        }*/

        $this->_loginForm = $form->createView();


        return parent::loginAction($request);
    }

    protected function renderLogin(array $data) {
        //return $this->render('UserBundle:Security:login.html.twig', $data);

        return $this->render('UserBundle:Security:login.html.twig', array(
            'form' => $this->_loginForm,
        ));
    }

    public function logoutAction() {
        return parent::logoutAction();
    }
}
